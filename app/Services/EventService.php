<?php

namespace App\Services;

use App\Event;
use App\Room;
use Carbon\Carbon;

class EventService
{
    //check if the room is taken
    public function isRoomTaken($requestData)
    {
        //recurring until format date and time and set time to 23,59,59, format start and end time
        $recurringUntil = Carbon::parse($requestData['recurring_until'])->setTime(23, 59, 59);
        $start_time     = Carbon::parse($requestData['start_time']);
        $end_time       = Carbon::parse($requestData['end_time']);

        //find all events with the booked room
        $events         = Event::where('room_id', $requestData['room_id'])->get();

        //while end time is lees then or equal recurring until time, check if the room is available 
        // check if the room has events until recurring until time, if there is no reservation possible, 
        //the true value is returned which will return the error in the Booking controller 
        do {
            if (
                $events->where('start_time', '<', $start_time)->where('end_time', '>', $start_time)->count() ||
                $events->where('start_time', '<', $end_time)->where('end_time', '>', $end_time)->count() ||
                $events->where('start_time', '<', $start_time)->where('end_time', '>', $end_time)->count()
            ) {
                return true;
            }
            //next week 
            $start_time->addWeek();
            $end_time->addWeek();
        } while ($end_time->lte($recurringUntil));

        return false;
    }

    //creating event every week on the same start and end time
    public function createRecurringEvents($requestData)
    {
        //formating time
        $recurringUntil            = Carbon::parse($requestData['recurring_until'])->setTime(23, 59, 59);
        $requestData['start_time'] = Carbon::parse($requestData['start_time'])->addWeek();
        $requestData['end_time']   = Carbon::parse($requestData['end_time'])->addWeek();

        //while end time is lees then or equal recurring until time
        while ($requestData['end_time']->lte($recurringUntil)) {
            //calling create event custom method, and creating events
            $this->createEvent($requestData);
            //next week
            $requestData['start_time']->addWeek();
            $requestData['end_time']->addWeek();
        }
    }

    // creating a event
    public function createEvent($requestData)
    {
        $requestData['start_time'] = $requestData['start_time']->format('Y-m-d H:i');
        $requestData['end_time']   = $requestData['end_time']->format('Y-m-d H:i');

        return Event::create($requestData);
    }

    public function chargeHourlyRate($requestData, Room $room)
    {
        if (!$room->hourly_rate) {
            return true;
        }

        $recurringUntil = Carbon::parse($requestData['recurring_until'])->setTime(23, 59, 59);
        $start_time     = Carbon::parse($requestData['start_time']);
        $end_time       = Carbon::parse($requestData['end_time']);
        $hours          = (int) ceil($end_time->diffInMinutes($start_time) / 60);
        $totalHours     = 0;

        do {
            $totalHours += $hours;

            $start_time->addWeek();
            $end_time->addWeek();
        } while ($end_time->lte($recurringUntil));

        return auth()->user()->chargeCredits($totalHours, $room);
    }
}