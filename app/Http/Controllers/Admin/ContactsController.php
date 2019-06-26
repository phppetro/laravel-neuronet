<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreContactsRequest;
use App\Http\Requests\Admin\UpdateContactsRequest;
use Yajra\DataTables\DataTables;

class ContactsController extends Controller
{
    /**
     * Display a listing of Contact.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('contact_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Contact::query();
            $query->with("category");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('contact_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'contacts.id',
                'contacts.first_name',
                'contacts.last_name',
                'contacts.email',
                'contacts.position',
                'contacts.institution',
                'contacts.category_id',
                'contacts.projects_involved',
                'contacts.expertise',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'contact_';
                $routeKey = 'admin.contacts';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('first_name', function ($row) {
                return $row->first_name ? $row->first_name : '';
            });
            $table->editColumn('last_name', function ($row) {
                return $row->last_name ? $row->last_name : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('position', function ($row) {
                return $row->position ? $row->position : '';
            });
            $table->editColumn('institution', function ($row) {
                return $row->institution ? $row->institution : '';
            });
            $table->editColumn('category.name', function ($row) {
                return $row->category ? $row->category->name : '';
            });
            $table->editColumn('projects_involved', function ($row) {
                return $row->projects_involved ? $row->projects_involved : '';
            });
            $table->editColumn('expertise', function ($row) {
                return $row->expertise ? $row->expertise : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.contacts.index');
    }

    /**
     * Show the form for creating new Contact.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('contact_create')) {
            return abort(401);
        }
        
        $categories = \App\ContactCategory::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.contacts.create', compact('categories'));
    }

    /**
     * Store a newly created Contact in storage.
     *
     * @param  \App\Http\Requests\StoreContactsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactsRequest $request)
    {
        if (! Gate::allows('contact_create')) {
            return abort(401);
        }
        $contact = Contact::create($request->all());



        return redirect()->route('admin.contacts.index');
    }


    /**
     * Show the form for editing Contact.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('contact_edit')) {
            return abort(401);
        }
        
        $categories = \App\ContactCategory::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $contact = Contact::findOrFail($id);

        return view('admin.contacts.edit', compact('contact', 'categories'));
    }

    /**
     * Update Contact in storage.
     *
     * @param  \App\Http\Requests\UpdateContactsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContactsRequest $request, $id)
    {
        if (! Gate::allows('contact_edit')) {
            return abort(401);
        }
        $contact = Contact::findOrFail($id);
        $contact->update($request->all());



        return redirect()->route('admin.contacts.index');
    }


    /**
     * Display Contact.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('contact_view')) {
            return abort(401);
        }
        $contact = Contact::findOrFail($id);

        return view('admin.contacts.show', compact('contact'));
    }


    /**
     * Remove Contact from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('contact_delete')) {
            return abort(401);
        }
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin.contacts.index');
    }

    /**
     * Delete all selected Contact at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('contact_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Contact::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Contact from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('contact_delete')) {
            return abort(401);
        }
        $contact = Contact::onlyTrashed()->findOrFail($id);
        $contact->restore();

        return redirect()->route('admin.contacts.index');
    }

    /**
     * Permanently delete Contact from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('contact_delete')) {
            return abort(401);
        }
        $contact = Contact::onlyTrashed()->findOrFail($id);
        $contact->forceDelete();

        return redirect()->route('admin.contacts.index');
    }
}
