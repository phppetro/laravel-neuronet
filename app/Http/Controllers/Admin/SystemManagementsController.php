<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
class SystemManagementsController extends Controller
{
    public function index()
    {
        if (! Gate::allows('system_management_access')) {
            return abort(401);
        }
        return view('admin.system_managements.index');
    }
}
