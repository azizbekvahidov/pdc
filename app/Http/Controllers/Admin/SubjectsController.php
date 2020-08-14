<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subjects;
use Illuminate\Support\Str;

class SubjectsController extends Controller
{
  public function index() {
  	$subjects = Subjects::get();
  	return view('admin.subjects.index', ['subjects' => $subjects]);
  }

  public function create() {
  	return view('admin.subjects.create');
  }

  public function store(Request $request) {
  	$validator = \Validator::make($request->all(), [
  		'subject' => 'required'
  	]);

  	if ($validator->fails()) {
  		if($request->ajax()){
        return response()->json(['errors' => $validator->messages()]);
      }
  	}

  	$subject = Subjects::firstOrCreate(['subject' => $request->subject]);

  	return response()->json([
  	    'message' => 'Subject created!',
        'subject' => $subject]);
  }
}
