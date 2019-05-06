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

        //Metric Colors
        $colors = ["rgba(96, 92, 168, 1)","rgba(225, 14, 107,1)","rgba(29, 227, 228,1)","rgba(96, 92, 168, 0.4)","rgba(60, 141, 188, 1)","rgba(245, 105, 84, 1)","rgba(210, 214, 222, 1)","rgba(0, 31, 63, 1)","rgba(57, 204, 204, 1)","rgba(96, 92, 168, 1)","rgba(255, 133, 27, 1)","rgba(17, 17, 17, 1)"];

        $labels = ["purple","java","razz","purple","java","razz","purple","java","razz"];

        //echo $labels[0];
        //exit;




        return view('home', compact( 'activities', 'deliverables', 'publications', 'contacts', 'documents','partnersmetrics','projectsmetrics','contactscategories','colors','labels'));
    }
}
