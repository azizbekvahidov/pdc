<?php

namespace App\Http\Controllers\Frontend;

use App\UserAnswer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller {

    public function index () {

        $user_answer = UserAnswer::where('user_id', \Auth::user()->id)->orderBy('id','desc')->paginate(5);

        return view('frontend.test.results.index', ['user_answer' => $user_answer]);
    }
}
