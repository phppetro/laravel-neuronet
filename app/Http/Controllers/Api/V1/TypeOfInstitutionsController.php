<?php

namespace App\Http\Controllers\Api\V1;

use App\TypeOfInstitution;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTypeOfInstitutionsRequest;
use App\Http\Requests\Admin\UpdateTypeOfInstitutionsRequest;
use Yajra\DataTables\DataTables;

class TypeOfInstitutionsController extends Controller
{
    public function index()
    {
        return TypeOfInstitution::all();
    }

    public function show($id)
    {
        return TypeOfInstitution::findOrFail($id);
    }

    public function update(UpdateTypeOfInstitutionsRequest $request, $id)
    {
        $type_of_institution = TypeOfInstitution::findOrFail($id);
        $type_of_institution->update($request->all());
        

        return $type_of_institution;
    }

    public function store(StoreTypeOfInstitutionsRequest $request)
    {
        $type_of_institution = TypeOfInstitution::create($request->all());
        

        return $type_of_institution;
    }

    public function destroy($id)
    {
        $type_of_institution = TypeOfInstitution::findOrFail($id);
        $type_of_institution->delete();
        return '';
    }
}
