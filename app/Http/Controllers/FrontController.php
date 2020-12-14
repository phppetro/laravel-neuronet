<?php

namespace App\Http\Controllers;

use App\AssetMap;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function publicdashboard ()
    {
        $activities = \App\Activity::latest()->limit(4)->get();
        $deliverables = \App\Deliverable::latest()->limit(7)->get();
        $publications = \App\Publication::latest()->limit(4)->get();
        $contacts = \App\Contact::latest()->limit(5)->get();
        $tools = \App\Tool::latest()->limit(5)->get();
        $documents = \App\Document::latest()->limit(7)->get();
        $partnersmetrics = \App\PartnersMetric::all();
        $projectsmetrics = \App\ProjectsMetric::all()->sortBy('name');
        $countriesmetrics = \App\CountriesMetric::all()->sortBy('name');
        $contactscategories = \App\ContactCategory::all();
        $projects = \App\Project::all()->sortBy('name');
        $scheduleprojects = \App\Project::orderBy('start_date')->get();
        //dd($scheduleprojects);
        //exit;
        $events = \App\Calendar::where('start_date','>=',now())->orderBy('start_date')->limit(5)->get();

        //colors
        //Purple: "rgba(155,109,235,1)"
        //Pink: "rgba(229,14,106,1)"
        //Aqua: "rgba(18,238,227,1)"
        //Violet: "rgba(198,59,178,1)"
        //Indigo: "rgba(58,9,97,1)"

        //Metric Colors
        $colors_original = ["rgba(58,9,97,1)","rgba(155, 109, 235, 1)","rgba(198, 59, 178, 1)","rgba(18, 238, 227, 1)","rgba(229, 14, 106, 1)","rgba(58,9,97,1)","rgba(18, 238, 227, 1)","rgba(198, 59, 178, 1)","rgba(155, 109, 235, 1)","rgba(229, 14, 106, 1)"];
        $colors = ["rgba(155,109,235,1)","rgba(229,14,106,1)","rgba(18,238,227,1)","rgba(198,59,178,1)","rgba(58,9,97,1)"];

        $labels_second = ["indigo","purple","indigo","purple","indigo","purple"];
        $labels_all_available_colors = ["indigo","purple","violet","pink","aqua","indigo"];
        $labels = ["purple","aqua","pink","purple","aqua","pink"];

        //echo $labels[0];
        //exit;

        return view('public_dashboard', compact( 'activities', 'deliverables', 'publications', 'contacts', 'tools', 'documents','partnersmetrics','projectsmetrics','countriesmetrics','contactscategories','colors','labels','projects','scheduleprojects','events'));
    }

    public function home()
    {
        $homes = \App\ContentPage::where('id',1)->get();
        $helps = \App\ContentPage::where('id',7)->get();
        $fundings = \App\ContentPage::where('id',6)->get();

        return view('home', compact('homes', 'helps', 'fundings'));
    }

    public function disclaimer()
    {
      $disclaimers = \App\ContentPage::where('id',2)->get();
      $helps = \App\ContentPage::where('id',7)->get();

      return view('disclaimer', compact('disclaimers', 'helps'));
    }

    public function aboutimi()
    {
      $imis = \App\ContentPage::where('id',3)->get();
      $helps = \App\ContentPage::where('id',7)->get();

      return view('about-imi', compact('imis', 'helps'));
    }

    public function legalnotice()
    {
      $notices = \App\ContentPage::where('id',4)->get();
      $helps = \App\ContentPage::where('id',7)->get();

      return view('legal-notice', compact('notices', 'helps'));
    }

    public function privacypolicy()
    {
      $policies = \App\ContentPage::where('id',5)->get();
      $helps = \App\ContentPage::where('id',7)->get();

      return view('privacy-policy', compact('policies', 'helps'));
    }

    public function assetsmap()
    {
        $asset_maps = AssetMap::all();
        return view('asset_map', compact('asset_maps'));
    }
}
