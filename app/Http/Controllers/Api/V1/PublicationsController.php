<?php

namespace App\Http\Controllers\Api\V1;

use App\Publication;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePublicationsRequest;
use App\Http\Requests\Admin\UpdatePublicationsRequest;
use Yajra\DataTables\DataTables;

class PublicationsController extends Controller
{
    public function index()
    {
        return Publication::all();
    }

    public function show($id)
    {
        return Publication::findOrFail($id);
    }

    public function update(UpdatePublicationsRequest $request, $id)
    {
        $publication = Publication::findOrFail($id);
        $publication->update($request->all());
        

        return $publication;
    }

    public function store(StorePublicationsRequest $request)
    {
        $publication = Publication::create($request->all());
        

        return $publication;
    }

    public function destroy($id)
    {
        $publication = Publication::findOrFail($id);
        $publication->delete();
        return '';
    }
}
