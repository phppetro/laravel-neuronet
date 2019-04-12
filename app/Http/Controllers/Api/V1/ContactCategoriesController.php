<?php

namespace App\Http\Controllers\Api\V1;

use App\ContactCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreContactCategoriesRequest;
use App\Http\Requests\Admin\UpdateContactCategoriesRequest;
use Yajra\DataTables\DataTables;

class ContactCategoriesController extends Controller
{
    public function index()
    {
        return ContactCategory::all();
    }

    public function show($id)
    {
        return ContactCategory::findOrFail($id);
    }

    public function update(UpdateContactCategoriesRequest $request, $id)
    {
        $contact_category = ContactCategory::findOrFail($id);
        $contact_category->update($request->all());
        

        return $contact_category;
    }

    public function store(StoreContactCategoriesRequest $request)
    {
        $contact_category = ContactCategory::create($request->all());
        

        return $contact_category;
    }

    public function destroy($id)
    {
        $contact_category = ContactCategory::findOrFail($id);
        $contact_category->delete();
        return '';
    }
}
