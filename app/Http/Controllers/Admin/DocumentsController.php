<?php

namespace App\Http\Controllers\Admin;

use App\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDocumentsRequest;
use App\Http\Requests\Admin\UpdateDocumentsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;

class DocumentsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Document.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('document_access')) {
            return abort(401);
        }



        if (request()->ajax()) {
            $query = Document::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {

        if (! Gate::allows('document_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'documents.id',
                'documents.title',
                'documents.source',
                'documents.publication_date',
                'documents.keywords',
                'documents.file',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'document_';
                $routeKey = 'admin.documents';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('source', function ($row) {
                return $row->source ? $row->source : '';
            });
            $table->editColumn('publication_date', function ($row) {
                return $row->publication_date ? $row->publication_date : '';
            });
            $table->editColumn('keywords', function ($row) {
                return $row->keywords ? $row->keywords : '';
            });
            $table->editColumn('file', function ($row) {
                if($row->file) { return '<a href="'.asset(env('UPLOAD_PATH').'/img/'.$row->file) .'" target="_blank">Download file</a>'; };
            });

            $table->rawColumns(['actions','massDelete','file']);

            return $table->make(true);
        }

        return view('admin.documents.index');
    }

    /**
     * Show the form for creating new Document.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('document_create')) {
            return abort(401);
        }
        return view('admin.documents.create');
    }

    /**
     * Store a newly created Document in storage.
     *
     * @param  \App\Http\Requests\StoreDocumentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDocumentsRequest $request)
    {
        if (! Gate::allows('document_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $document = Document::create($request->all());



        return redirect()->route('admin.documents.index');
    }


    /**
     * Show the form for editing Document.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('document_edit')) {
            return abort(401);
        }
        $document = Document::findOrFail($id);

        return view('admin.documents.edit', compact('document'));
    }

    /**
     * Update Document in storage.
     *
     * @param  \App\Http\Requests\UpdateDocumentsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDocumentsRequest $request, $id)
    {
        if (! Gate::allows('document_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $document = Document::findOrFail($id);
        $document->update($request->all());



        return redirect()->route('admin.documents.index');
    }


    /**
     * Display Document.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('document_view')) {
            return abort(401);
        }
        $document = Document::findOrFail($id);

        return view('admin.documents.show', compact('document'));
    }


    /**
     * Remove Document from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('document_delete')) {
            return abort(401);
        }
        $document = Document::findOrFail($id);
        $document->delete();

        return redirect()->route('admin.documents.index');
    }

    /**
     * Delete all selected Document at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('document_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Document::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Document from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('document_delete')) {
            return abort(401);
        }
        $document = Document::onlyTrashed()->findOrFail($id);
        $document->restore();

        return redirect()->route('admin.documents.index');
    }

    /**
     * Permanently delete Document from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('document_delete')) {
            return abort(401);
        }
        $document = Document::onlyTrashed()->findOrFail($id);
        $document->forceDelete();

        return redirect()->route('admin.documents.index');
    }
}
