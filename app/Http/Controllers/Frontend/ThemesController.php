<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Rules\OwnRules;
use App\Http\Controllers\Controller;
use App\{User,Themes,Subjects};

class ThemesController extends Controller
{
    public function index () {
        $subjects = Subjects::get();
        return view("frontend.themes.index", ['subjects' => $subjects]);
    }

    public function lessons($id = null) {
        $themes = Themes::where("subject_id", $id)->get();
        return view("frontend.themes.lessons", ["themes" => $themes]);
    }

    public function view($id) {
        $theme = Themes::find($id);

        return view('frontend.themes.view', ['theme' => $theme]);
    }
}
