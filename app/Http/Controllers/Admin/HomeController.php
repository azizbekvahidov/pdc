<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Localization\LocalizationService;

class HomeController extends Controller
{
    public function index() {
    	return view('admin.index');
    }

    public function subjects() {
        $subjects = Subjects::get();
        return view('admin.subjects.index', ['subjects' => $subjects]);
    }

    public function questions() {
        $questions = Questions::get();
        return view('admin.questions.index',['questions' => $questions]);
    }

    public function user() {
        $users = User::get();
        return view('admin.users.index',['users'=>$users]);
    }

    public function stop(){
        return view('admin.stopPage');
    }

    public function lang($lang) {;
        $a = \App::getLocale();
//        dd($a);
    }
}
