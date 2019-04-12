<?php

namespace App\Http\Controllers\Admin;

use App\ContactCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreContactCategoriesRequest;
use App\Http\Requests\Admin\UpdateContactCategoriesRequest;
use Yajra\DataTables\DataTables;

class ContactCategoriesController extends Controller
{
    /**
     * Display a listing of ContactCategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('contact_category_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = ContactCategory::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('contact_category_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'contact_categories.id',
                'contact_categories.name',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'contact_category_';
                $routeKey = 'admin.contact_categories';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.contact_categories.index');
    }

    /**
     * Show the form for creating new ContactCategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('contact_category_create')) {
            return abort(401);
        }
        return view('admin.contact_categories.create');
    }

    /**
     * Store a newly created ContactCategory in storage.
     *
     * @param  \App\Http\Requests\StoreContactCategoriesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactCategoriesRequest $request)
    {
        if (! Gate::allows('contact_category_create')) {
            return abort(401);
        }
        $contact_category = ContactCategory::create($request->all());



        return redirect()->route('admin.contact_categories.index');
    }


    /**
     * Show the form for editing ContactCategory.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('contact_category_edit')) {
            return abort(401);
        }
        $contact_category = ContactCategory::findOrFail($id);

        return view('admin.contact_categories.edit', compact('contact_category'));
    }

    /**
     * Update ContactCategory in storage.
     *
     * @param  \App\Http\Requests\UpdateContactCategoriesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContactCategoriesRequest $request, $id)
    {
        if (! Gate::allows('contact_category_edit')) {
            return abort(401);
        }
        $contact_category = ContactCategory::findOrFail($id);
        $contact_category->update($request->all());



        return redirect()->route('admin.contact_categories.index');
    }


    /**
     * Display ContactCategory.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('contact_category_view')) {
            return abort(401);
        }
        $contacts = \App\Contact::where('category_id', $id)->get();

        $contact_category = ContactCategory::findOrFail($id);

        return view('admin.contact_categories.show', compact('contact_category', 'contacts'));
    }


    /**
     * Remove ContactCategory from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('contact_category_delete')) {
            return abort(401);
        }
        $contact_category = ContactCategory::findOrFail($id);
        $contact_category->delete();

        return redirect()->route('admin.contact_categories.index');
    }

    /**
     * Delete all selected ContactCategory at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('contact_category_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = ContactCategory::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore ContactCategory from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('contact_category_delete')) {
            return abort(401);
        }
        $contact_category = ContactCategory::onlyTrashed()->findOrFail($id);
        $contact_category->restore();

        return redirect()->route('admin.contact_categories.index');
    }

    /**
     * Permanently delete ContactCategory from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('contact_category_delete')) {
            return abort(401);
        }
        $contact_category = ContactCategory::onlyTrashed()->findOrFail($id);
        $contact_category->forceDelete();

        return redirect()->route('admin.contact_categories.index');
    }
}
