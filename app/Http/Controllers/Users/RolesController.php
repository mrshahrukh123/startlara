<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRole;
use App\Imports\RoleImport;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Permission;
use App\Models\Role;
use Yajra\DataTables\DataTables;

class RolesController extends Controller
{
    public function index(Request $request)
    {
        try {
            if(responseInJson($request)) {
                $table_data = [];
                if(auth()->user()->hasRole(User::DEV_ADMIN_ROLE)) {
                    $roles = Role::all();
                } else {
                    $roles = Role::where('name','!=',User::DEV_ADMIN_ROLE)->get();
                }
                foreach($roles as $data) {
                    $table_data[] = [
                        'id'            => $data->id,
                        'name'      => $data->name,
                        'permissions'      => $data->getPermissionNames(),
                    ];
                }
                $collection = new Collection($table_data);
                return Datatables::of($collection)
                    ->addColumn('action', function($query) {

                        return view('partials.action-column')
                            ->with(
                                [
                                    'id'    => $query['id'],
                                    'edit_route' => route('manage.roles.edit', ['role' => $query['id']]),
                                    'delete_route' => route('manage.roles.destroy', ['role' => $query['id']]),
                                    'delete_action' => [[\App\Http\Controllers\Users\RolesController::class,'destroy'],'role'=>$query['id']],
                                    'tool_tip_title' => 'Role',
                                    'edit_permission' => 'update-role',
                                    'delete_permission' => 'delete-role',
                                ]

                            );
                    })

                    ->make(true);
            }
            return view('roles.index');
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function create()
    {

        $newObj = new Role();
        $permissions = Permission::all();
        $checked_roles = [];
        return view('roles.form')
            ->with([
                'newObj'=>$newObj,
                'permissions'=>$permissions,
                'checked'  =>  $checked_roles,
            ]);
    }

    public function store(StoreRole $request)
    {
        try {
            $input = $request->all();
            $role = Role::create($input);
            if(!empty($input['permission'])) {
                $role->permissions()->sync($input['permission']);
            }
            Session::flash('message', 'Role Created.');
            Session::flash('status', 'alert-success');
            return redirect()->route('manage.roles.index');
        }  catch (\Exception $exception) {
            return $exception;
        }
    }

    public function show($id)
    {
        //
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $checked_roles = $role->getPermissionIdsAttribute();
        return view('roles.form')
            ->with([
                'newObj'=>$role,
                'permissions'=>$permissions,
                'checked'  =>  $checked_roles,
            ]);
    }

    public function update(StoreRole $request, Role $role)
    {
        try {
            $input = $request->all();
            $role->update($input);
            if(!empty($input['permission'])) {
                $role->permissions()->sync($input['permission']);
            } else {
                $role->permissions()->detach();
            }
            Session::flash('message', 'Role Updated.');
            Session::flash('status', 'alert-success');
            return redirect()->route('manage.roles.index');
        }  catch (\Exception $exception) {
            return $exception;
        }
    }

    public function destroy(Role $role)
    {
        try {
            $role->delete();
            Session::flash('message', 'Role deleted.');
            Session::flash('status', 'alert-success');
            return redirect()->route('manage.roles.index');

        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function import(Request $request)
    {

        if($request->isMethod('GET')) {
            return view('global.import')
                ->with([
                    'parent_menu_link'=> route('manage.roles.index'),
                    'parent_menu_name'=> 'Roles',
                ]);
        }
        if($request->isMethod('POST')) {
            try {
                Excel::import(new RoleImport, $request->file('excel_file'));

                Session::flash('message', 'Roles imported.');
                Session::flash('status', 'alert-success');
                return redirect()->route('manage.users.index');
            } catch (\Exception $exception) {
                return $exception;
            }
        }
    }
}
