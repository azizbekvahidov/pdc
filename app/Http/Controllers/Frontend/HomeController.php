<?php

namespace App\Http\Controllers\Frontend;

use App\{Courses, GroupsStudents, News, User, Groups};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index () {

        $date = date('Y/m/j', time());

        $courses = Courses::where('countdown_time', '>', $date)->get();


        $news = News::orderBy("id","desc")->paginate(3);
        $teachers = User::where("role_id","=","2")->get();
        return view('frontend.guest.index', [
            "news"      => $news,
            "teachers"  => $teachers,
            "courses"   => $courses
        ]);

    }

    public function profile() {
        $groupsStudents = GroupsStudents::where('user_id', \Auth::user()->id)->where('user_status', '1')->get();
        return view('frontend.profile.index',['groupsStudents' => $groupsStudents]);
    }

    public function edit() {
        return view('frontend.profile.edit');
    }

    public function update(Request $request){


        if ($request->data == "1" && $request->passwordData == "0") {

            \Validator::make($request->all(), [
                'name'          => 'required',
                'surname'       => 'required',
                'tel'           => 'required',
            ])->validate();

            $user = User::find(\Auth::user()->id);
            $user->name = $request->name;
            $user->surname = $request->surname;
            $user->tel = $request->tel;
            $user->save();

        }
        elseif ($request->data == "0" && $request->passwordData == "1") {
            echo "Пароль";
            dd($request->all());
        }

        return redirect()->route('frontend.profile.index')->with(['message' => 'Данные успешно изменены']);
    }

    public function news($slug){
        $news = News::whereSlug($slug)->first();

        return view("frontend.guest.news",[
            "news" => $news
        ]);
    }
}
