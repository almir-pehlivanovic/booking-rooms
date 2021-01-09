<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Room;
use App\Event;

class RoomsController extends Controller
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
            $rooms          = Room::onlyTrashed()->paginate($this->paginateNum);
            $onlyTrashed   = TRUE;
        }
        else 
        {
            $rooms          = Room::paginate($this->paginateNum);
            $onlyTrashed   = FALSE;
        }

        $statusList = $this->statusList();

        return view('booking-rooms.rooms.index', compact('rooms', 'onlyTrashed', 'statusList'));
    }

    private function statusList()
    {
        return [
            'all'   => Room::count(),
            'trash' => Room::onlyTrashed()->count()
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Room $rooms)
    {
        return view('booking-rooms.rooms.create', compact('rooms'));
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
            'name' => 'required'
            ]);
      
        $rooms = Room::create($request->all());

        return redirect('/backend/rooms')->with('message', 'Room added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $room = Room::where('slug', $slug)->firstOrFail();

        return view('booking-rooms.rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $rooms = Room::where('slug', $slug)->firstOrFail();

        return view('booking-rooms.rooms.edit', compact('rooms'));
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
        $room = Room::findOrFail($id);
        
        $room->update($request->all());

        return redirect('/backend/rooms')->with('message', 'Room updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Room::findOrFail($id)->delete();

        Event::where('room_id', $id)->delete();

        return redirect('/backend/rooms')->with('trash-message', ['Your room was moved to trash!', $id]);
    }

    public function restore($id)
    {
        $room  = Room::withTrashed()->findOrFail($id);
        $event = Event::where('room_id', $id);
        $room->restore();
        $event->restore();

        return redirect()->back()->with('message', 'Your room was moved from trash!');
    }

    public function forceDestroy($id)
    {
        Room::withTrashed()->findOrFail($id)->forceDelete();

        return redirect('/backend/rooms?status=trash')->with('message', 'Your room has been deleted successfully!');
    }
}
