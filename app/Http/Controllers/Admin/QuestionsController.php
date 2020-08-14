<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{Questions,Subjects,Answers};
use Illuminate\Support\Str;

class QuestionsController extends Controller {

  public function index() {
        if(\Auth::user()->role_id == '1') $questions = Questions::orderBy('subject_id')->get();
        else $questions = Questions::where('user_id', \Auth::user()->id)->orderBy('subject_id')->get();

        return view('admin.questions.index', ['questions' => $questions]);
  }

  public function sendData(Request $request) {

      $question = Questions::find($request->id);
      return view('admin.questions.modalData',[
          'question' => $question,
      ]);
//      return response()->json([
//          'question' => $question
//      ]);
  }

  public function create(Request $request) {
      $subjects = Subjects::get();
      return view('admin.questions.create',[
          'subjects' => $subjects,
          'number'   =>$request->number,
      ]);
  }

  public function store(Request $request) {
        $temp = "";
        $validator = $request->validate([
            'question'  => 'required',
            'option.*'  => 'required',
            'subject'   => 'required',
        ]);


        $photo = $request->file('photo');

        if ($photo) {
            $path = "public/images/questions";
            $name = $request->id."-".Str::slug($request->question)."-".time();
            $extension = $photo->getClientOriginalExtension();

            $photo->storeAs($path,$name.".".$extension);
        }

        $option_num                 = count($request->option);
        $correct_num                = count($request->correct);

        $question                   = new Questions();
        $question->question         = $request->question;
        if ($photo)
        $question->photo            = "/storage/images/questions/".$name.".".$extension;
        $question->subject_id       = $request->subject;
        $question->user_id          = \Auth::user()->id;
        $question->save();



        for ($i=0;$i<$option_num;$i++) {
            $answer                   = new Answers();

            $temp = str_replace("<", "&lt;", $request->option[$i]);
            $temp = str_replace(">", "&gt;", $temp);

            $answer->answer           = $temp;
            $answer->question_id      = $question->id;

              for ($j=0;$j<$correct_num;$j++){
                  if($i == $request->correct[$j]){
                      $answer->correct  = '1';
                      break;
                  }
                  else{
                      $answer->correct  = '0';
                  }
              }

              $answer->save();

        }


        return redirect()->route('admin.questions.index')->with('message', 'Вопрос создан');
  }

  public function edit($id) {
  	$question = Questions::find($id);

  	return view('admin.questions.edit', ['question' => $question]);
  }

  public function update($id, Request $request) {

        $option_num = count($request->option);
        $correct_num = count($request->correct);
        $i = 0;
        $temp = "";
        $validator = $request->validate([
            'question'  => 'required',
            'option.*'  => 'required',
        ]);

        $question            = Questions::find($id);
  	    $question->question  = $request->question;
  	    $question->save();
        $answers                   = Answers::where('question_id', $question->id)->get();
        foreach($answers as $answer){
            $temp = str_replace("<", "&lt;", $request->option[$i]);
            $temp = str_replace(">", "&gt;", $temp);

            $answer->answer           = $temp;
            $answer->question_id      = $question->id;
            for ($j=0;$j<$correct_num;$j++){
                if($i == $request->correct[$j]){
                    $answer->correct  = '1';
                    break;
                }
                else{
                    $answer->correct  = '0';
                }
            }

            $answer->save();
            $i++;
        }

        return redirect()->route('admin.questions.index')->with('message', __('box.questionEdited'));
  }

  public function destroy($id) {

    $questions = Questions::find($id);

    foreach ($questions->answers as $answer) {
      $answer_id = $answer->id;
      Answers::destroy($answer_id);
    }

    Questions::destroy($id);

    return redirect()->route('admin.questions.index')->with('message', 'Question deleted!');
  }

}
//$2y$10$16/bi3L2SAsOJF/eubGewenPV0Thtu9aFDTWMiiMSSBVqgRd5FXjC

