<?php

namespace App\Http\Controllers\Admin;

use App\HighlightsMetric;
use App\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePartnersRequest;
use App\Http\Requests\Admin\UpdatePartnersRequest;
use Yajra\DataTables\DataTables;

class PartnersController extends Controller
{
    /**
     * Display a listing of Partner.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($proj_id=null)
    {
//        if (! Gate::allows('partner_access')) {
//            return abort(401);
//        }

        if (request()->ajax()) {
            $query = Partner::query();
            $query->with("projects");
            $query->with("type_of_institution");
            $query->with("country");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {

        if (! Gate::allows('partner_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'partners.id',
                'partners.name',
                'partners.type_of_institution_id',
                'partners.country_id',
            ]);

            $project_id = request('project_id');
            if( $project_id != null) {
              $projId =[$project_id];
              $query->whereHas('projects', function($q) use($projId) {
                  $q->whereIn('id', $projId);
              })->orderBy('name')->get();
            } else {
              $query->orderBy('name')->get();
            }

            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'partner_';
                $routeKey = 'admin.partners';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('projects.name', function ($row) {
                if(count($row->projects) == 0) {
                    return '';
                }

                return '<span class="label label-info label-many">' . implode('</span><span class="label label-info label-many"> ',
                        $row->projects->pluck('name')->toArray()) . '</span>';
            });
            $table->editColumn('type_of_institution.name', function ($row) {
                return $row->type_of_institution ? $row->type_of_institution->name : '';
            });
            $table->editColumn('country.title', function ($row) {
                return $row->country ? $row->country->title : '';
            });

            $table->rawColumns(['actions','massDelete','projects.name']);

            return $table->make(true);
        }

        $projects = \App\Project::all();
        $project_name = \App\Project::where('id',$proj_id)->value('name');
        return view('admin.partners.index', compact('projects','project_name'));
    }

    /**
     * Show the form for creating new Partner.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('partner_create')) {
            return abort(401);
        }

        $projects = \App\Project::get()->pluck('name', 'id');

        $type_of_institutions = \App\TypeOfInstitution::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $countries = \App\Country::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.partners.create', compact('projects', 'type_of_institutions', 'countries'));
    }

    /**
     * Store a newly created Partner in storage.
     *
     * @param  \App\Http\Requests\StorePartnersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePartnersRequest $request)
    {
        if (! Gate::allows('partner_create')) {
            return abort(401);
        }
        $partner = Partner::create($request->all());
        $partner->projects()->sync(array_filter((array)$request->input('projects')));

        $this->updatePartnerHighlights();

        return redirect()->route('admin.partners.index');
    }


    /**
     * Show the form for editing Partner.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('partner_edit')) {
            return abort(401);
        }

        $projects = \App\Project::get()->pluck('name', 'id');

        $type_of_institutions = \App\TypeOfInstitution::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $countries = \App\Country::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');

        $partner = Partner::findOrFail($id);

        return view('admin.partners.edit', compact('partner', 'projects', 'type_of_institutions', 'countries'));
    }

    /**
     * Update Partner in storage.
     *
     * @param  \App\Http\Requests\UpdatePartnersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePartnersRequest $request, $id)
    {
        if (! Gate::allows('partner_edit')) {
            return abort(401);
        }
        $partner = Partner::findOrFail($id);
        $partner->update($request->all());
        $partner->projects()->sync(array_filter((array)$request->input('projects')));

        $this->updatePartnerHighlights();

        return redirect()->route('admin.partners.index');
    }


    /**
     * Display Partner.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        if (! Gate::allows('partner_view')) {
//            return abort(401);
//        }
        $partner = Partner::findOrFail($id);

        return view('admin.partners.show', compact('partner'));
    }


    /**
     * Remove Partner from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('partner_delete')) {
            return abort(401);
        }
        $partner = Partner::findOrFail($id);
        $partner->delete();

        $this->updatePartnerHighlights();

        return redirect()->route('admin.partners.index');
    }

    /**
     * Delete all selected Partner at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('partner_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Partner::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
        $this->updatePartnerHighlights();
    }


    /**
     * Restore Partner from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('partner_delete')) {
            return abort(401);
        }
        $partner = Partner::onlyTrashed()->findOrFail($id);
        $partner->restore();

        $this->updatePartnerHighlights();

        return redirect()->route('admin.partners.index');
    }

    /**
     * Permanently delete Partner from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('partner_delete')) {
            return abort(401);
        }
        $partner = Partner::onlyTrashed()->findOrFail($id);
        $partner->forceDelete();

        $this->updatePartnerHighlights();

        return redirect()->route('admin.partners.index');
    }

    public function updatePartnerHighlights()
    {
        $partner_count = Partner::all()->count();
        $highlight_metric = HighlightsMetric::findOrFail(6);
        $highlight_metric->update(['number'=>$partner_count]);
    }
}
