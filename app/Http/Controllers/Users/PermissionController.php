<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePermission;
use App\Http\Requests\StoreRole;
use App\Imports\RoleImport;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        try {
            if(responseInJson($request)) {
                $table_data = [];
                foreach(Permission::all() as $data) {
                    $table_data[] = [
                        'id'            => $data->id,
                        'name'      => $data->name,
                    ];
                }
                $collection = new Collection($table_data);
                return Datatables::of($collection)
                    ->addColumn('action', function($query) {

                        return view('partials.action-column')
                            ->with(
                                [
                                    'id'    => $query['id'],
                                    'edit_route' => route('manage.permissions.edit', ['permission' => $query['id']]),
                                    'delete_route' => route('manage.permissions.destroy', ['permission' => $query['id']]),
                                    'delete_action' => [[\App\Http\Controllers\Users\PermissionController::class,'destroy'],'permission'=>$query['id']],
                                    'tool_tip_title' => 'Permission',
                                    'edit_permission' => 'update-permission',
                                    'delete_permission' => 'delete-permission',
                                ]

                            );
                    })

                    ->make(true);
            }
            return view('permissions.index');
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function create()
    {

        $newObj = new Permission();
        return view('permissions.form')
            ->with([
                'newObj'=>$newObj,
            ]);
    }

    public function store(StorePermission $request)
    {
        try {
            $input = $request->all();
            $role = Permission::create($input);
            Session::flash('message', 'Permission Created.');
            Session::flash('status', 'alert-success');
            return redirect()->route('manage.permissions.index');
        }  catch (\Exception $exception) {
            return $exception;
        }
    }

    public function show($id)
    {
        //
    }

    public function edit(Permission $permission)
    {
        return view('permissions.form')
            ->with([
                'newObj'=>$permission,
            ]);
    }

    public function update(StorePermission $request, Permission $permission)
    {
        try {
            $input = $request->all();
            $permission->update($input);

            Session::flash('message', 'Permission Updated.');
            Session::flash('status', 'alert-success');
            return redirect()->route('manage.permissions.index');
        }  catch (\Exception $exception) {
            return $exception;
        }
    }

    public function destroy(Permission $permission)
    {
        try {
            $permission->delete();
            Session::flash('message', 'Permission deleted.');
            Session::flash('status', 'alert-success');
            return redirect()->route('manage.permissions.index');

        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function import(Request $request)
    {

        if($request->isMethod('GET')) {
            return view('global.import')
                ->with([
                    'parent_menu_link'=> route('manage.permissions.index'),
                    'parent_menu_name'=> 'Permissions',
                ]);
        }
        if($request->isMethod('POST')) {
            try {
                Excel::import(new PermissionImport, $request->file('excel_file'));

                Session::flash('message', 'Permissions imported.');
                Session::flash('status', 'alert-success');
                return redirect()->route('manage.permissions.index');
            } catch (\Exception $exception) {
                return $exception;
            }
        }
    }
}
