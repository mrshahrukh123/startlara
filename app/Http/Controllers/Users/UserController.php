<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use App\Imports\UserImport;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        try {
            if(responseInJson($request)) {
                $table_data = [];
                if(auth()->user()->hasRole(User::DEV_ADMIN_ROLE)) {
                    $users = User::all();
                } else {
                    $users = User::whereHas('roles', function ($query) {
                        $query->where('name','!=', User::DEV_ADMIN_ROLE);
                    })->get();
                }
                foreach($users as $data) {
                    $table_data[] = [
                        'id'            => $data->id,
                        'name'      => $data->name,
                        'email'      => $data->email,
                        'roles'      => $data->getRoleNames(),
                    ];
                }
                $collection = new Collection($table_data);
                return Datatables::of($collection)
                    ->addColumn('action', function($query) {

                        return view('partials.action-column')
                            ->with(
                                [
                                    'id'    => $query['id'],
                                    'edit_route' => route('manage.users.edit', ['user' => $query['id']]),
                                    'delete_route' => route('manage.users.destroy', ['user' => $query['id']]),
                                    'delete_action' => [[\App\Http\Controllers\Users\UserController::class,'destroy'],'user'=>$query['id']],
                                    'tool_tip_title' => 'User',
                                    'edit_permission' => 'update-user',
                                    'delete_permission' => 'delete-user',
                                ]

                            );
                    })

                    ->make(true);
            }
            return view('users.index');
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function create()
    {

        $newObj = new User();
        $roles = Role::all();
        $checked_roles = [];
        return view('users.form')
            ->with([
                'newObj'=>$newObj,
                'roles'=>$roles,
                'checked'  =>  $checked_roles,
            ]);
    }

    public function store(StoreUser $request)
    {
        try {
            $input = $request->all();
            $user = User::create($input);
            if(!empty($input['role'])) {
                $user->roles()->attach($input['role']);
            }
            Session::flash('message', 'User Created.');
            Session::flash('status', 'alert-success');
            return redirect()->route('manage.users.index');
        }  catch (\Exception $exception) {
            return $exception;
        }
    }

    public function show($id)
    {
        //
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $checked_roles = $user->getRoleIdsAttribute();
        return view('users.form')
            ->with([
                'newObj'=>$user,
                'roles'=>$roles,
                'checked'  =>  $checked_roles,
            ]);
    }

    public function update(UpdateUser $request, User $user)
    {
        try {
            $input = $request->all();
            $arr = [
                'name'=>$input['name'],
                'email' => $input['email'],
            ];
            if(!empty($input['password'])) {
                $arr['password'] = bcrypt($input['password']);
            }
            $user->update($arr);
            if(!empty($input['role'])) {
                $user->roles()->sync($input['role']);
            } else {
                $user->roles()->detach();
            }
            Session::flash('message', 'User Updated.');
            Session::flash('status', 'alert-success');
            return redirect()->route('manage.users.index');
        }  catch (\Exception $exception) {
            return $exception;
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            Session::flash('message', 'User deleted.');
            Session::flash('status', 'alert-success');
            return redirect()->route('manage.users.index');

        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function import(Request $request)
    {

        if($request->isMethod('GET')) {
            return view('global.import')
                ->with([
                    'parent_menu_link'=> route('manage.users.index'),
                    'parent_menu_name'=> 'Users',
                ]);
        }
        if($request->isMethod('POST')) {
            try {
                Excel::import(new UserImport, $request->file('excel_file'));

                Session::flash('message', 'Users imported.');
                Session::flash('status', 'alert-success');
                return redirect()->route('manage.users.index');
            } catch (\Exception $exception) {
                return $exception;
            }
        }
    }
}
