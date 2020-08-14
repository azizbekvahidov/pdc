<?
    $i=0;
?>

@extends('admin.layout')
@section('title')  - {{__('box.editingQuestion')}} @endsection
@section('content')

@include('admin.errors')
  <h2 style="text-align: center;">{{__('box.editQuestion')}}</h2>
  <form method="post" action="{{route('admin.questions.update', $question->id)}}">
    @csrf

    <div class="col-md-6 col-lg-6 col-sm-6 col-lg-offset-3">
      <div class="form-group">
        <label class="col-form-label" for="question">{{trans_choice('box.question',1)}}</label>
        <textarea name="question" class="form-control " id="question" >{{$question->question}}</textarea>
      </div>
        @foreach($question->answers as $answer)<?$i++;?>
        <label class="col-form-label" for="option-{{$i}}">{{__('box.option')}} {{$i}}</label>
      <div class="input-group xs-mb-15">
        <input
            type="text"
            name="option[]"
            class="form-control"
            id="option-{{$i}}"
            value="{{$answer->answer}}"
             >
            <span class="input-group-addon">
                <input
                    type="checkbox"
                    name="correct[]"
                    value="{{$i-1}}"
                    <?=($answer->correct) ? 'checked' : '';?>
                    >
            </span>
      </div>
        @endforeach
      <button class="btn btn-primary btn-block">{{__('box.edit')}}</button>
    </div>
  </form>

@endsection
