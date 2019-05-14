<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
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
        $activities = \App\Activity::latest()->limit(4)->get();
        $deliverables = \App\Deliverable::latest()->limit(7)->get();
        $publications = \App\Publication::latest()->limit(4)->get();
        $contacts = \App\Contact::latest()->limit(5)->get();
        $documents = \App\Document::latest()->limit(7)->get();
        $partnersmetrics = \App\PartnersMetric::all();
        $projectsmetrics = \App\ProjectsMetric::all();
        $contactscategories = \App\ContactCategory::all();
        $projects = \App\Project::all();
        $events = \App\Calendar::where('date','>=',now())->limit(5)->get();

        //Metric Colors
        $colors = ["rgba(58,9,97,1)","rgba(155, 109, 235, 1)","rgba(198, 59, 178, 1)","rgba(18, 238, 227, 1)","rgba(229, 14, 106, 1)","rgba(58,9,97,1)","rgba(18, 238, 227, 1)","rgba(198, 59, 178, 1)","rgba(155, 109, 235, 1)","rgba(229, 14, 106, 1)"];

        $labels = ["indigo","purple","indigo","purple","indigo","purple"];
        $labels_old = ["indigo","purple","violet","pink","aqua","indigo"];

        //echo $labels[0];
        //exit;

        return view('admin.dashboard', compact( 'activities', 'deliverables', 'publications', 'contacts', 'documents','partnersmetrics','projectsmetrics','contactscategories','colors','labels','projects','events'));
    }
}
