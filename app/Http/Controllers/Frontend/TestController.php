<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Test;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\{Groups, GroupsStudents, Questions, SelectedQuestions, Subjects, Answers, User, UserAnswer};
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;

class TestController extends Controller
{

    public function start($id){
        $group = Groups::find($id);
        session()->forget('test_id');
        return view('frontend.test.start',[
            'id'        =>  $group->course->subject_id,
            'group_id'  =>  $id,
        ]);
    }

    public function clickStart(Request $request){

        session(['start' => $request->start]);
        if (UserAnswer::where('user_id', Auth::user()->id)->where('end', null)->get()->last()) {
            if(UserAnswer::where('user_id', Auth::user()->id)->where('end', null)->get()->last()->questions){
                $user_answer = UserAnswer::where('user_id', Auth::user()->id)->where('end', null)->get()->last();
            }
        }
        else{
            $test_action                = new UserAnswer();
            $test_action->user_id       = \Auth::user()->id;
            $test_action->subject_id    = $request->id;
            $test_action->start         = date('Y-m-d H:i:s', time());
            $test_action->save();
            session([ 'test_action' => $test_action->id]);
            session([ 'group'       => $request->group]);
        }

        return redirect()->route('frontend.test.test',$request->id);
    }

    public function test($id) {

        $user_answer = UserAnswer::where('user_id', Auth::user()->id)->where('end', null)->get()->last();

        if (!$user_answer->questions->all()) {
            $subject_ids = explode(',',$id);
            $ids_random_arr = array();
            $ids_sorted_arr = array();
            $ids_num = '0';
            $i = 0;
            $questions = Questions::whereIn('subject_id', $subject_ids)->get();
            $group = Groups::find(session('group'));
            $num = count($questions);
            $ids = DB::table('questions')->whereIn('subject_id',$subject_ids)->pluck('id');

            while(!($num == $ids_num)) {
                $ids_random = Arr::random($ids->all());

                $in_array = in_array($ids_random,$ids_random_arr);
                if(!$in_array){
                    $ids_random_arr[$i]=$ids_random;
                }
                $i++;
                $ids_num = count($ids_random_arr);
            }
            $i=0;
            foreach($ids_random_arr as $item){
                $ids_sorted_arr[$i] = $item;
                $i++;
                if($i == $group->tests_number){
                    break;
                }
            }
            foreach ($ids_sorted_arr as $id) {

                $selected_questions = new SelectedQuestions();
                $selected_questions->user_answer_id = $user_answer->id;
                $selected_questions->question_id = $id;
                $selected_questions->save();
            }
        }
        $user_answer = UserAnswer::where('user_id', Auth::user()->id)->where('end', null)->get()->last();
        return view('frontend.test.test', [
            'questions'         =>  $user_answer->questions,
            ]);
    }

    public function check(Request $request,$id) {

        if (session()->has('start')){
            $test_action = UserAnswer::find($request->test_id);
            foreach ($request->all() as $question => $answer) {
                if (is_integer($question)) {

                    if (is_string($answer)) {
                        $selected_questions             = SelectedQuestions::find($question);
                        $selected_questions->answers_id = $answer;
                        $answers = Answers::whereCorrect('1')->whereId($answer)->get();
                        if($answers->all()){
                            $selected_questions->true = 1;
                        }
                        $selected_questions->save();
                    }

                    if(is_array($answer)){
                        $no                = null;
# Поле где сделает тест строгим
//------------------------------------
//                        $checked_answers   = null;
//                        $answers_number    = Questions::find($question);
//                        foreach ($answers_number->answers->all() as $corrects) {
//                            if (!$corrects->correct) {
//                                $checked_answers+=1;
//                            }
//                        }
//------------------------------------
                    $values = null;
                    $iter = 0;
                        foreach ($answer as $value) {
                            if (!$iter) {
                                $values.=$value;
                            }
                            else {
                                $values.=",".$value;
                            }
                            $iter++;
                            $answers = Answers::whereCorrect('1')->whereId($value)->get();
    //                        if (!$answers->all() || (count($answer) != $checked_answers)) {
                            if (!$answers->all()) {
                                $no = '0';
                            }
                        }

                        $selected_questions = SelectedQuestions::find($question);
                        $selected_questions->answers_id = $values;
                        if ($no != '0') {
                            $selected_questions->true = 1;
                        }
                        $selected_questions->save();
                    }
                }
            }
            if($request->ajax()) {
                $test_action->save();
                return response()->json(['message' => "Отправлено"]);
            }
            else {

                $selected_questions = SelectedQuestions::where('true', '1')->where('user_answer_id', $test_action->id)->get();
                $test_action->true_answers = (count($selected_questions)/$request->questions_number)*100;
                $test_action->save();
                session()->forget('start');

                return redirect()->route('frontend.test.conclusion');
            }
        }
        else{
            return response()->json(['url' => route('frontend.test.test',$id)]);
        }
    }

    public function conclusion()
    {
        $test_action = UserAnswer::find(session()->get('test_action'));
        $test_action->end = date('Y-m-d H:i:s', time());
        $test_action->save();
        GroupsStudents::where('user_id', \Auth::user()->id)
                        ->where('group_id',session('group'))
                        ->update(['user_finished' => 1]);

        session()->forget('group');
        return view('frontend.test.answer',[
            'test_action' => $test_action,
        ]);

    }

    public function finish() {
        session()->forget('test_action');
        session()->forget('start');
        return redirect()->route('frontend.profile.index')->with(["message" => "Вы прошли тест"]);
    }
}
