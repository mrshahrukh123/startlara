<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function settings(Request $request)
    {

        if($request->isMethod('GET')) {
            return view('settings.form');
        }
        if($request->isMethod('POST')) {

        }
    }
}
