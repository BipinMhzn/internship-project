<?php

namespace App\Http\Controllers;

use App\Event;
use App\Participant;
use DateTime;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class EventController extends Controller
{
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::orderBy('date', 'DESC')->paginate(10);

        return view('event.index', compact('events'));
    }

    public function get_events(Request $request)
    {
        $start_date = $request->query('start_date');
        $end_date = $request->query('end_date');
        $name = $request->query('name');
        $place = $request->query('place');

        $query = Event::query();

        /* @var Builder $query */
        if (isValid($start_date) && isValid($end_date)) {
            $this->validate($request, [
                'start_date' => 'required',
                'end_date' => 'after:start_date'
            ]);

            if ($name == 'asc' || $name == 'desc') {
                $query = $query->orderBy('name', $name)->where('date', '<=', $end_date)
                    ->where('date', '>=', $start_date);
            } elseif ($place == 'asc' || $place == 'desc') {
                $query = $query->orderBy('place', $place)->where('date', '<=', $end_date)
                    ->where('date', '>=', $start_date);
            } else {
                $query = $query->orderBy('date', 'desc')
                    ->where('date', '<=', $end_date)
                    ->where('date', '>=', $start_date);
            }
        } elseif (isValid($start_date)) {
            if ($name == 'asc' || $name == 'desc') {
                $query = $query->orderBy('name', $name)->where('date', '>=', $start_date);
            } elseif ($place == 'asc' || $place == 'desc') {
                $query = $query->orderBy('place', $place)->where('date', '>=', $start_date);
            } else {
                $query = $query->orderBy('date', 'desc')->where('date', '>=', $start_date);
            }
        } else {
            if ($name == 'asc' || $name == 'desc') {
                $query = $query->orderBy('name', $name);
            } elseif ($place == 'asc' || $place == 'desc') {
                $query = $query->orderBy('place', $place);
            } else {
                $query->orderBy('date', 'desc');
            }
        }

        /* @var LengthAwarePaginator $events */
        $events = $query->paginate(10);

        $events->appends($request->query());

        return view('event.partials.events', compact('events'));
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
            'events' => 'required|file',
            'participants' => 'required|file',
            'auth_key' => 'required'
        ]);

        $event_file = $request->file('events');
        $participants_file = $request->file(('participants'));

        if (Hash::check('vitaminevents', $request->auth_key) && $event_file->getClientOriginalExtension() == 'csv' && $participants_file->getClientOriginalExtension() == 'csv') {
            $events = csvToArray($event_file);
            $participants = csvToArray($participants_file);

            for ($i = 0; $i < count($events); $i++) {
                $gps_point = explode(',', $events[$i]['gpsPoint']);
                $event = Event::create([
                    'name' => $events[$i]['eventName'],
                    'place' => $events[$i]['eventPlace'],
                    'date' => $events[$i]['eventDate'],
                    'latitude' => $gps_point[0],
                    'longitude' => $gps_point[1],
                    'objective' => $events[$i]['eventObjective'],
                    'prepared_by' => $events[$i]['preparedBy'],
                    'checked_by' => $events[$i]['checkedBy'],
                    'approved_by' => $events[$i]['approvedBy']
                ]);

                for ($j = 0; $j < count($participants); $j++) {
                    if ($events[$i]['id'] == $participants[$j]['eventId']) {
                        Participant::create([
                            'name' => $participants[$j]['name'],
                            'sex' => $participants[$j]['sex'],
                            'contact' => $participants[$j]['contact'],
                            'photo' => $participants[$j]['photo'],
                            'event_id' => $event->id
                        ]);
                    }
                }
            }
            return response()->json('Data of Attendance of program is exported to web server successfully', 201);
        }
        return response()->json('Please provide credentials properly', 401);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\event $event
     * @return \Illuminate\Http\Response
     */
    public function show(event $event)
    {
        return view('event.show', [
            'event' => $event,
            'participants' => $event->participants()->paginate(5)
        ]);
    }

    public function get_participants(Request $request)
    {
        $name = $request->query('name');

        $query = Event::query();

        /* @var Builder $query */
        if ($name == 'asc' || $name == 'desc') {
            $query = $query->findOrFail($request->query('event_id'))
                ->participants()
                ->orderBy('name', $name);
        } else {
            $query = $query->findOrFail($request->query('event_id'))
                ->participants();
        }

        /* @var LengthAwarePaginator $events */
        $participants = $query->paginate(5);

        $participants->appends($request->query());

        return view('event.partials.participants', compact('participants'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\event $event
     * @return \Illuminate\Http\Response
     */
    public function edit(event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\event $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(event $event)
    {
        $event->delete();

        return redirect('event')->with('success', 'A Event is deleted successfully.');
    }

}
