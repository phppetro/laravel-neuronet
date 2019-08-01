<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SystemCalendarController extends Controller
{
    public function index()
    {
        $events = [];

        foreach (\App\Calendar::all() as $calendar) {

           $start = new Carbon($calendar->start_date_and_time);
           $end = new Carbon($calendar->end_date_and_time);
           $diff = $start->diff($end)->days;
           $count = $diff - 1;

           $crudFieldValue_next = $crudFieldValue = $calendar->getOriginal('start_date_and_time');

           if (! $crudFieldValue) {
               continue;
           }

           $eventLabel     = $calendar->title;

           $prefix         = 'Starts ';
           $suffix         = '';
           $dataFieldValue = trim($prefix . " " . $eventLabel . " " . $suffix);
           $events[]       = [
                'title' => $dataFieldValue,
                'start' => $crudFieldValue,
                'url'   => route('admin.calendars.edit', $calendar->id)
           ];

           $crudFieldValue_2 = new Carbon($crudFieldValue_next);
           while($count > 0) {
             $crudFieldValue_2 = $crudFieldValue_2->addDays(1);
             $crudFieldValue_3 = $crudFieldValue_2->toDateString();
             $events[]       = [
                  'title' => $eventLabel,
                  'start' => $crudFieldValue_3,
                  'url'   => route('admin.calendars.edit', $calendar->id)
             ];
             $count--;
           }
        }

        foreach (\App\Calendar::all() as $calendar) {
           $crudFieldValue = $calendar->getOriginal('end_date_and_time');

           if (! $crudFieldValue) {
               continue;
           }

           $eventLabel     = $calendar->title;
           $prefix         = 'Ends ';
           $suffix         = '';
           $dataFieldValue = trim($prefix . " " . $eventLabel . " " . $suffix);
           $events[]       = [
                'title' => $dataFieldValue,
                'start' => $crudFieldValue,
                'url'   => route('admin.calendars.edit', $calendar->id)
           ];
        }


       return view('admin.calendar' , compact('events'));
    }

}
