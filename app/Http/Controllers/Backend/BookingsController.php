<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\EventService;
use Carbon\Carbon;
use App\Room;
use App\Event;

class BookingsController extends Controller
{
    public function searchRoom(Request $request)
    {
        $rooms      = null;
        $checkRooms = false;
        
        // check all search input fields
        if($request->filled(['start_time', 'end_time', 'capacity']))
        {
            $times = [
                Carbon::parse($request->input('start_time')),
                Carbon::parse($request->input('end_time')),
            ];
            
            // search the room where capacity is equal or higher from the request input capacity,
            // and search the room that dosent have any events between start_time and end_time in events table
            $rooms = Room::where('capacity', '>=', $request->input('capacity'))
                            ->whereDoesntHave('events', function($query) use ($times) {
                                 $query->whereBetween('end_time', $times)
                                        ->orWhereBetween('end_time', $times)
                                        ->orWhere(function ($query) use ($times) {
                                                $query->where('start_time', '<', $times[0])
                                                        ->where('end_time', '>', $times[1]);
                                                });
            })->get();
            $checkRooms = true;
        }

        return view('booking-rooms.bookings.search', compact('rooms', 'checkRooms'));
    }

    public function bookRoom(Request $request, EventService $eventService)
    {
        // on current book request add current user
        $request->merge([
            'user_id' => auth()->user()->id
        ]);
        
        //check required fields, not empty
        $request->validate([
            'name'      => 'required',
            'room_id'   => 'required',
        ]);
        
        //find the room that you are about book it
        $room = Room::findOrFail($request['room_id']);

        //Check in App\Services if the room is taken, method isRoomTaken(with all request data)
        if ($eventService->isRoomTaken($request->all())) {
            return redirect()->back()
                    ->withInput()
                    ->withErrors(['recurring_until' => 'This room is not available until the recurring date you have chosen']);
        }

        if (!auth()->user()->hasRole('admin') && !$eventService->chargeHourlyRate($request->all(), $room)) {
            return redirect('/backend/my-credits')->with('message-alert', 'Please add more credits to your account.')
                    ->withInput()
                    ->withErrors(['Please add more credits to your account. <a href="' . route('balance.index') . '">My Credits</a>']);
        }


        //creating one event (book the room)
        $event = Event::create($request->all());
        
         //if the recurring until time is filled add that same vent every week
        if ($request->filled('recurring_until')) {
            //App\Services call method
            $eventService->createRecurringEvents($request->all());
        }

        return redirect('/backend/calendar')->with('message', 'Event added successfully!');
    }
}
