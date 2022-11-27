<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Event::all();
        return response()->json(Response::HTTP_OK);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        Event::create($request->all());
        return response()->json('Event has been created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return Event::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $events = Event::find($id);
        $events->update($request->all());
        return response()->json('Event updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Event::find($id)->delete();
        return response()->json('Deleted Successfully');
    }

    //function to get all the upcoming event
    public function upcomingEvent()
    {
        return Event::where('start_date', '>=', date('Y-m-d'))
            ->orderBy('start_date')
            ->paginate(10);

    }

    //function to get all the Finished Events
    public function finishedEvent()
    {
        return Event::where('end_date', '<', date('Y-m-d'))
            ->orderBy('end_date')
            ->paginate(10);

    }

    //function to get all the Finished events of the last 7 days
    public function lastFinishedEvent()
    {
        /*$date = Carbon::now()->subDays(7);
        return Event::where('created_at', '>=', $date)->get();*/

        $date = Carbon::now()->subDays(7);
        return Event::where('end_date', '<=', $date)
             ->orderBy('end_date')
             ->paginate(10);
    }

    //function to get all the Upcoming events within 7 days
    public function upcomingWeekEvent()
    {
        $date = Carbon::now()->subDays(7);
        return Event::where('start_date', '>=', $date)
             ->orderBy('start_date')
             ->paginate(10);
    }
}
