<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{Courses, Subjects};

class CoursesController extends Controller
{
    public function index() {
        $courses = Courses::get();

        return view('admin.courses.index',[
            'courses' => $courses,
        ]);
    }

    public function create() {
        $subjects = Subjects::get();
        return view('admin.courses.create',[
            'subjects' => $subjects,
        ]);
    }

    public function store(Request $request) {

        $request->validate([
            'name'          => 'required|max:100',
            'subjects'      => 'required',
            'description'   => 'max:255',
        ]);

        $id = implode(',', $request->subjects);

        Courses::Create([
            'name' => $request->name,
            'description' => $request->description,
            'subject_id' => $id,
        ]);

        return redirect()->route('admin.courses.index')->with(['message' => 'Курс создан']);
    }
}
