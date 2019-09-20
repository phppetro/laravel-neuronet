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

           $start_date = $calendar->getOriginal('start_date');
           $end_date = $calendar->getOriginal('end_date');

           if (! $start_date) {
               continue;
           }

           if ($start_date != $end_date) {
               $end = new Carbon($end_date);
               $end_date = $end->addDay(1)->toDateString();
           }

          $projects = "";
          if(count($calendar->projects) == 1) {
            foreach ($calendar->projects as $singleProjects) {
              $projects .= $singleProjects->name . " - ";
            }
          } elseif (count($calendar->projects) > 1) {
            $projects = "SEVERAL PROJECTS - ";
          } else {
            $projects = "GENERAL - ";
          }

           $eventLabel = $projects . $calendar->title;
           $color      = $calendar->color->value;

           $events[]       = [
                'title' => $eventLabel,
                'start' => $start_date,
                'end'   => $end_date,
                'color' => $color,
                'url'   => route('admin.calendars.show', $calendar->id)
           ];
        }

       return view('admin.calendar' , compact('events'));
    }

}
