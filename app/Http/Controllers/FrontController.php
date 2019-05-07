<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
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
}
