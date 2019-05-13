<?php

namespace App\Http\Controllers\Admin;

use App\ProfessionalCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProfessionalCategoriesRequest;
use App\Http\Requests\Admin\UpdateProfessionalCategoriesRequest;
use Yajra\DataTables\DataTables;

class ProfessionalCategoriesController extends Controller
{
    /**
     * Display a listing of ProfessionalCategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('professional_category_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = ProfessionalCategory::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('professional_category_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'professional_categories.id',
                'professional_categories.name',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'professional_category_';
                $routeKey = 'admin.professional_categories';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.professional_categories.index');
    }

    /**
     * Show the form for creating new ProfessionalCategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('professional_category_create')) {
            return abort(401);
        }
        return view('admin.professional_categories.create');
    }

    /**
     * Store a newly created ProfessionalCategory in storage.
     *
     * @param  \App\Http\Requests\StoreProfessionalCategoriesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfessionalCategoriesRequest $request)
    {
        if (! Gate::allows('professional_category_create')) {
            return abort(401);
        }
        $professional_category = ProfessionalCategory::create($request->all());



        return redirect()->route('admin.professional_categories.index');
    }


    /**
     * Show the form for editing ProfessionalCategory.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('professional_category_edit')) {
            return abort(401);
        }
        $professional_category = ProfessionalCategory::findOrFail($id);

        return view('admin.professional_categories.edit', compact('professional_category'));
    }

    /**
     * Update ProfessionalCategory in storage.
     *
     * @param  \App\Http\Requests\UpdateProfessionalCategoriesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfessionalCategoriesRequest $request, $id)
    {
        if (! Gate::allows('professional_category_edit')) {
            return abort(401);
        }
        $professional_category = ProfessionalCategory::findOrFail($id);
        $professional_category->update($request->all());



        return redirect()->route('admin.professional_categories.index');
    }


    /**
     * Display ProfessionalCategory.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('professional_category_view')) {
            return abort(401);
        }
        $users = \App\User::where('professional_category_id', $id)->get();

        $professional_category = ProfessionalCategory::findOrFail($id);

        return view('admin.professional_categories.show', compact('professional_category', 'users'));
    }


    /**
     * Remove ProfessionalCategory from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('professional_category_delete')) {
            return abort(401);
        }
        $professional_category = ProfessionalCategory::findOrFail($id);
        $professional_category->delete();

        return redirect()->route('admin.professional_categories.index');
    }

    /**
     * Delete all selected ProfessionalCategory at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('professional_category_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = ProfessionalCategory::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore ProfessionalCategory from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('professional_category_delete')) {
            return abort(401);
        }
        $professional_category = ProfessionalCategory::onlyTrashed()->findOrFail($id);
        $professional_category->restore();

        return redirect()->route('admin.professional_categories.index');
    }

    /**
     * Permanently delete ProfessionalCategory from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('professional_category_delete')) {
            return abort(401);
        }
        $professional_category = ProfessionalCategory::onlyTrashed()->findOrFail($id);
        $professional_category->forceDelete();

        return redirect()->route('admin.professional_categories.index');
    }
}
