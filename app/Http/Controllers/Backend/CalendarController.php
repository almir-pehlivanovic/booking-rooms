<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;

class CalendarController extends Controller
{
    public $sources = [
        [
            'model'         => '\\App\\Event',
            'date_field'    => 'start_time',
            'field'         => 'name',
            'prefix'        => 'Event',
            'sufix'         => '',
            'route'         => 'events.show',
        ],
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = [];

        foreach($this->sources as $source)
        {
            $calendarEvents = $source['model']::when(request('room_id'), function($query){
                
                return $query->where('room_id',request('room_id'));
            
            })->when(request('user_id'), function($query){

                return $query->where('user_id',request('user_id'));
                
            })->get();

            foreach($calendarEvents as $model)
            {
                $crudFieldValue = $model->getOriginal($source['date_field']);

                if(!$crudFieldValue)
                {
                    continue;
                }

                $events[] = [
                    'title' => trim($source['prefix'] . " " . $model->{$source['field']} . " " . $source['sufix']),
                    'start' => $crudFieldValue,
                    'url'   => route($source['route'], $model->slug),
                ];
            }
        }
        
        return view('booking-rooms.calendar.calendar', compact('events'));
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
    }
}
