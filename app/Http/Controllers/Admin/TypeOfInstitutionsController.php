<?php

namespace App\Http\Controllers\Admin;

use App\TypeOfInstitution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTypeOfInstitutionsRequest;
use App\Http\Requests\Admin\UpdateTypeOfInstitutionsRequest;
use Yajra\DataTables\DataTables;

class TypeOfInstitutionsController extends Controller
{
    /**
     * Display a listing of TypeOfInstitution.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('type_of_institution_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = TypeOfInstitution::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('type_of_institution_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'type_of_institutions.id',
                'type_of_institutions.name',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'type_of_institution_';
                $routeKey = 'admin.type_of_institutions';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.type_of_institutions.index');
    }

    /**
     * Show the form for creating new TypeOfInstitution.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('type_of_institution_create')) {
            return abort(401);
        }
        return view('admin.type_of_institutions.create');
    }

    /**
     * Store a newly created TypeOfInstitution in storage.
     *
     * @param  \App\Http\Requests\StoreTypeOfInstitutionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTypeOfInstitutionsRequest $request)
    {
        if (! Gate::allows('type_of_institution_create')) {
            return abort(401);
        }
        $type_of_institution = TypeOfInstitution::create($request->all());



        return redirect()->route('admin.type_of_institutions.index');
    }


    /**
     * Show the form for editing TypeOfInstitution.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('type_of_institution_edit')) {
            return abort(401);
        }
        $type_of_institution = TypeOfInstitution::findOrFail($id);

        return view('admin.type_of_institutions.edit', compact('type_of_institution'));
    }

    /**
     * Update TypeOfInstitution in storage.
     *
     * @param  \App\Http\Requests\UpdateTypeOfInstitutionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTypeOfInstitutionsRequest $request, $id)
    {
        if (! Gate::allows('type_of_institution_edit')) {
            return abort(401);
        }
        $type_of_institution = TypeOfInstitution::findOrFail($id);
        $type_of_institution->update($request->all());



        return redirect()->route('admin.type_of_institutions.index');
    }


    /**
     * Display TypeOfInstitution.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('type_of_institution_view')) {
            return abort(401);
        }
        $partners = \App\Partner::where('type_of_institution_id', $id)->get();

        $type_of_institution = TypeOfInstitution::findOrFail($id);

        return view('admin.type_of_institutions.show', compact('type_of_institution', 'partners'));
    }


    /**
     * Remove TypeOfInstitution from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('type_of_institution_delete')) {
            return abort(401);
        }
        $type_of_institution = TypeOfInstitution::findOrFail($id);
        $type_of_institution->delete();

        return redirect()->route('admin.type_of_institutions.index');
    }

    /**
     * Delete all selected TypeOfInstitution at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('type_of_institution_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = TypeOfInstitution::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore TypeOfInstitution from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('type_of_institution_delete')) {
            return abort(401);
        }
        $type_of_institution = TypeOfInstitution::onlyTrashed()->findOrFail($id);
        $type_of_institution->restore();

        return redirect()->route('admin.type_of_institutions.index');
    }

    /**
     * Permanently delete TypeOfInstitution from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('type_of_institution_delete')) {
            return abort(401);
        }
        $type_of_institution = TypeOfInstitution::onlyTrashed()->findOrFail($id);
        $type_of_institution->forceDelete();

        return redirect()->route('admin.type_of_institutions.index');
    }
}
