<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;

class EventsController extends Controller
{
    protected $paginateNum = 7;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(($status = $request->get('status')) && $status == 'trash')
        {
            $events        = Event::onlyTrashed()->paginate($this->paginateNum);
            $onlyTrashed   = TRUE;
        }
        else 
        {
            $events        = Event::paginate($this->paginateNum);
            $onlyTrashed   = FALSE;
        }
        
        $statusList = $this->statusList();

        return view('booking-rooms.events.index', compact('events', 'onlyTrashed', 'statusList'));
    }

    private function statusList()
    {
        return [
            'all'   => Event::count(),
            'trash' => Event::onlyTrashed()->count()
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Event $events)
    {
        return view('booking-rooms.events.create', compact('events'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $storeData = $request->validate([
            'room_id'       => 'required',
            'name'          => 'required',
            'start_time'    => 'required|date_format:Y-m-d\TH:i',
            'end_time'      => 'required|date_format:Y-m-d\TH:i',
            'user_id'       => 'required',
            ]);
      
        $events = Event::create($request->all());

        return redirect('/backend/events')->with('message', 'Event added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();

        return view('booking-rooms.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $events = Event::where('slug', $slug)->firstOrFail();

        return view('booking-rooms.events.edit', compact('events'));
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
        $event = Event::findOrFail($id);
    
        $event->update($request->all());

        return redirect('/backend/events')->with('message', 'Event updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Event::findOrFail($id)->delete();

        return redirect('/backend/events')->with('event-trash-message', ['Your event was moved to trash!', $id]);
    }

    public function restore($id)
    {
        $event = Event::withTrashed()->findOrFail($id);
        $event->restore();

        return redirect()->back()->with('message', 'Your event was moved from trash!');
    }

    public function forceDestroy($id)
    {
        Event::withTrashed()->findOrFail($id)->forceDelete();

        return redirect('/backend/events?status=trash')->with('message', 'Your event has been deleted successfully!');
    }
}
