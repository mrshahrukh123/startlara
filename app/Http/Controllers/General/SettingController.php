<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\AppLog;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SettingController extends Controller
{
    public function settings(Request $request)
    {

        if($request->isMethod('GET')) {
            return view('general.settings');
        }
        if($request->isMethod('POST')) {

        }
    }

    public function logs(Request $request)
    {
        try {
            if(responseInJson($request)) {

                $app_logs = AppLog::all();
                $table_data = [];
                foreach($app_logs as $data) {
                    $table_data[] = [
                        'id'            => $data->id,
                        'name'      => $data->name,
                        'description'      => $data->description,
                    ];
                }
                $collection = new Collection($table_data);
                return DataTables::of($collection)
                    ->make(true);
            }
            return view('general.logs');
        } catch (\Exception $exception) {
            return $exception;
        }
    }
}
