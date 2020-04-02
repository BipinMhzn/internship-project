<?php

namespace App\Http\Controllers;

use App\AgeDuringChildBirth;
use App\ChildMarriage;
use App\HealthDetail;
use App\MarriageDetail;
use App\Women;
use DateTime;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class WomenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        //
    }

    public function index()
    {
        $womens = Women::orderBy('survey_date', 'desc')->paginate(10);

        return view('survey.index', compact('womens'));
    }

    public function get_survey(Request $request)
    {
        $start_date = $request->query('start_date');
        $end_date = $request->query('end_date');
        $name = $request->query('name');
        $address = $request->query('address');

        $query = Women::query();

        if (isValid($start_date) && isValid($end_date)) {
            $this->validate($request, [
                'start_date' => 'required',
                'end_date' => 'after:start_date'
            ]);

            if ($name == 'asc' || $name == 'desc') {
                $query = $query->orderBy('name', $name)
                    ->where('survey_date', '>=', $start_date)
                    ->where('survey_date', '<=', $end_date);
            } elseif ($address == 'asc' || $address == 'desc') {
                $query = $query->orderBy('temporary_address', $address)
                    ->where('survey_date', '>=', $start_date)
                    ->where('survey_date', '<=', $end_date);
            } else {
                $query = $query->orderBy('survey_date', 'desc')
                    ->where('survey_date', '>=', $start_date)
                    ->where('survey_date', '<=', $end_date);
            }

        } elseif (isValid($start_date)) {
            if ($name == 'asc' || $name == 'desc') {
                $query = $query->orderBy('name', $name)
                    ->where('survey_date', '>=', $start_date)
                    ->where('survey_date', '<=', $end_date);
            } elseif ($address == 'asc' || $address == 'desc') {
                $query = $query->orderBy('temporary_address', $address)
                    ->where('survey_date', '>=', $start_date)
                    ->where('survey_date', '<=', $end_date);
            } else {
                $query = $query->orderBy('survey_date', 'desc')
                    ->where('survey_date', '>=', $start_date);
            }

        } else {
            if ($name == 'asc' || $name == 'desc') {
                $query = $query->orderBy('name', $name);
            } elseif ($address == 'asc' || $address == 'desc') {
                $query = $query->orderBy('temporary_address', $address);
            } else {
                $query = Women::orderBy('survey_date', 'desc');
            }
        }

        $womens = $query->paginate(10);

        $womens->appends($request->query());

        return view('survey.partials.womens', compact('womens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'womens' => 'required|file',
            'auth_key' => 'required'
        ]);
        if (Hash::check('survey', $request->auth_key)) {
            $survey_file = $request->file('womens');
            if ($survey_file->getClientOriginalExtension() == 'csv') {
                $survey_array = csvToArray($survey_file);
                for ($i = 0; $i < count($survey_array); $i++) {
                    $womens = Women::create([
                        'name' => $survey_array[$i]['name'],
                        'date_of_birth' => $survey_array[$i]['dateOfBirth'],
                        'contact' => $survey_array[$i]['contact'],
                        'temporary_address' => $survey_array[$i]['temporaryAddress'],
                        'permanent_address' => $survey_array[$i]['permanentAddress'],
                        'survey_date' => $survey_array[$i]['surveyDate']
                    ]);

                    $marriage_detail = MarriageDetail::create([
                        'age_of_marriage' => $survey_array[$i]['ageOfMarriage'],
                        'number_of_years_of_marriage' => $survey_array[$i]['noOfYearsOfMarriage'],
                        'number_of_sons' => $survey_array[$i]['noOfSons'],
                        'number_of_daughters' => $survey_array[$i]['noOfDaughters'],
                        'number_of_others' => $survey_array[$i]['noOfOthers'],
                        'women_id' => $womens->id,
                    ]);

                    $age_during_child_births = explode(", ", $survey_array[$i]['ageOfChildren']);
                    if ($age_during_child_births[0] != "") {
                        foreach ($age_during_child_births as $age) {
                            AgeDuringChildBirth::create([
                                'age_during_child_birth' => (int)$age,
                                'marriage_detail_id' => $marriage_detail->id,
                            ]);
                        }
                    }

                    HealthDetail::create([
                        'used_contraceptive_device' => $survey_array[$i]['usedContraceptiveDevice'],
                        'type_of_contraceptive_device' => ($survey_array[$i]['usedContraceptiveDevice'] == 0) ? NULL : $survey_array[$i]['typeOfContraceptiveDevice'],
                        'contraceptive_device' => ($survey_array[$i]['usedContraceptiveDevice'] == 0) ? NULL : $survey_array[$i]['contraceptiveDevice'],
                        'age_of_first_mensuration' => $survey_array[$i]['ageOfMensuration'],
                        'menopause' => $survey_array[$i]['menopause'],
                        'age_of_menopause' => ($survey_array[$i]['menopause'] == 0) ? NULL : $survey_array[$i]['ageOfMenopause'],
                        'have_health_problem' => $survey_array[$i]['haveHealthProblem'],
                        'health_problem' => ($survey_array[$i]['haveHealthProblem'] == 0) ? NULL : $survey_array[$i]['healthProblem'],
                        'women_id' => $womens->id,
                    ]);

                    ChildMarriage::create([
                        'know_child_marriage' => $survey_array[$i]['knowChildMarriage'],
                        'child_marriage' => ($survey_array[$i]['knowChildMarriage'] == 0) ? NULL : $survey_array[$i]['childMarriage'],
                        'girl_marry_age' => $survey_array[$i]['girlMarryAge'],
                        'boy_marry_age' => $survey_array[$i]['boyMarryAge'],
                        'first_child_age' => $survey_array[$i]['firstChildAge'],
                        'know_marriage_laws' => $survey_array[$i]['knowMarriageLaws'],
                        'marriage_laws' => ($survey_array[$i]['knowMarriageLaws'] == 0) ? NULL : $survey_array[$i]['marriageLaws'],
                        'women_id' => $womens->id,
                    ]);
                }
                return response()->json('Data collection of child marriage and women status is stored in web server', 201);
            }
            return response()->json('The file must be in CSV format', 415);
        }
        return response()->json('Unauthorized user', 401);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\women $women
     * @return \Illuminate\Http\Response
     */
    public function show(women $woman)
    {
        $women = $woman;
        $age = Carbon::parse($women->date_of_birth)->age;
        $total_children = $women->MarriageDetail->number_of_sons +
            $women->MarriageDetail->number_of_daughters + $women->MarriageDetail->number_of_others;
        return view('survey.show', compact('women', 'age', 'total_children'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\women $women
     * @return \Illuminate\Http\Response
     */
    public function edit(women $women)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\women $women
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, women $women)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\women $women
     * @return \Illuminate\Http\Response
     */
    public function destroy(women $women)
    {
        $women->delete();

        return redirect('event')->with('success', 'A survey of women is deleted successfully.');
    }

}
