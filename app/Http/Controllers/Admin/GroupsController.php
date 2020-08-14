<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{Answers, User, Courses, Groups, GroupsStudents, UserAnswer};

class GroupsController extends Controller
{
    public function index() {


        if (\Auth::user()->role_id == '1')
            $groups = Groups::get();
        else
            $groups = Groups::where('teacher_id', \Auth::user()->id)->get();

        return view('admin.courses.groups.index',[
            'groups' => $groups
        ]);
    }


    public function create() {

        $courses = Courses::orderBy('name')->get();
        return view('admin.courses.groups.create', [
            'courses' => $courses,
        ]);
    }

    public function store(Request $request) {


        $request->validate([
            'name'      => 'required',
            'course'    => 'required',
            'date'      => 'required',
        ]);

        $date = str_replace('-','/',$request->date);

        $group = new Groups();
        $group->name        = $request->name;
        $group->course_id   = $request->course;
        $group->teacher_id  = \Auth::user()->id;
        $group->status      = "0";
        $group->save();

        $course = Courses::find($group->course_id);
        $course->countdown_time = $date;
        $course->save();

        return redirect()->route('admin.groups.index')->with(['message' => "Группа создана"]);
    }

# В этот метод приходит данные из 3 точек, то есть изменяется статус группы,
# статус ученика в группе и задается тест
    public function status(Request $request) {

        # Ученик активируется
        if($request->user_status) {
            $student = GroupsStudents::where('user_id',$request->id)->where('group_id',$request->group_id)->first();

            if ($student->user_status == "0") {
                $student->user_status = "1";
                $student->save();
                return response()->json(['status' => '1', 'message' => 'Ученик принят в группу']);
            }
            else {
                $student->user_status = "0";
                $student->save();
                return response()->json(['status' => '0', 'message' => 'Ученик удален из группы']);
            }

        }

        # Тест задается
        if ($request->test_condition) {
            $time = time() + (3600);
            $group = Groups::find($request->id);
            $group->tests_number    = $request->num;
            $group->time            = $time;
            $group->save();
            GroupsStudents::where('group_id',$request->id)->update(['user_finished' => 0]);

            return response('Создано');
        }

        # Активируется группа
        $group = Groups::find($request->id);

        $group->status  = "1";
        $group->start   = date('Y/m/j', time());
        $group->save();

        Courses::where('id', $group->course_id)->update(['countdown_time' => date('Y/m/j',(time()-1))]);

        return response()->json(['message' => 'Группа '.$group->name.' активирована']);
    }


    public  function students($id) {
        $group = Groups::find($id);
        return view('admin.courses.groups.students',[
            'group' => $group
        ]);
    }

    public function studentResults($id){
        $user = User::find($id);
        return view('admin.courses.groups.studentResults',['user' => $user]);
    }

    public function data(Request $request) {
        $userAnswer = UserAnswer::find($request->id);
        $data = Array();
        $i = 0;
        foreach ($userAnswer->questions as $question){
            $j = 0;
            $data[$i]["question"]           = $question->question->question;
            $data[$i]["correct"]            = $question->true;
            if($question->answers_id){
                $ids = explode(",",$question->answers_id);
                foreach ($ids as $answer_id) {
                    $answer = Answers::find($answer_id);
                    $data[$i]["answers"][$j]               = $answer->answer;
                    $j++;
                }
            }
            else{
                $data[$i]["answers"][$j] = "Не ответил!";
            }
            $i++;
        }
        return response()->json(["userAnswer" => $data]);
    }
}
