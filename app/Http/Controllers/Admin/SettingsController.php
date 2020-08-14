<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Settings;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function index() {
//        $settings = DB::table('settings')->get();
//        dd($settings->all(),gettype($settings->all()));
        dd(Settings::where('name', 'logo')->first());
    }
}
