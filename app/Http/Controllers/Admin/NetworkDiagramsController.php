<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class NetworkDiagramsController extends Controller
{
    public function projects()
    {
        return view('admin.network_diagrams.projects');
    }

    public function participants()
    {
        return view('admin.network_diagrams.participants');
    }

    public function publications()
    {
        return view('admin.network_diagrams.publications');
    }
}
