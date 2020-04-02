<?php

namespace App\Http\Controllers;

use App\AgeDuringChildBirth;
use App\ChildMarriage;
use App\Event;
use App\MarriageDetail;
use App\Participant;
use App\Women;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $years = Women::selectRaw('YEAR(survey_date)')->distinct()->orderBy('YEAR(survey_date)', 'asc')->get()->toArray();
        if ($years != []) {
            foreach ($years as $year) {
                $marriage_count[$year['YEAR(survey_date)']] = DB::table('marriage_details as m')
                    ->join('womens as w', 'w.id', '=', 'm.women_id')
                    ->whereYear('survey_date', '=', $year)
                    ->count('*');
                $child_marriage_count[$year['YEAR(survey_date)']] = DB::table('marriage_details as m')
                    ->join('womens as w', 'w.id', '=', 'm.women_id')
                    ->whereYear('survey_date', '=', $year)
                    ->where('age_of_marriage', '<', '18')
                    ->count('*');
            }
        } else {
            $marriage_count = 0;
            $child_marriage_count = 0;
        }
        $events = Event::orderBy('date', 'DESC')->get()->take(6);
        $total_womens = Women::all()->count();
        if ($total_womens != 0) {
            $average_motherhood = AgeDuringChildBirth::distinct('marriage_detail_id')->sum('age_during_child_birth') / $total_womens;
            $average_marriage_age = MarriageDetail::sum('age_of_marriage') / $total_womens;
        } else {
            $average_motherhood = 0;
            $average_marriage_age = 0;
        }
        $know_about_child_marriage = ChildMarriage::where('know_child_marriage', true)->count();
        $total_events = Event::all()->count();
        if ($total_events != 0)
            $average_participants = Participant::all()->count() / $total_events;
        else
            $average_participants = 0;

        return view('home', compact('events', 'total_womens', 'average_motherhood', 'average_marriage_age', 'know_about_child_marriage', 'total_events', 'average_participants', 'marriage_count', 'child_marriage_count'));
    }
}
