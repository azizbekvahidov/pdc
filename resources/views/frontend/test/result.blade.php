@extends('frontend.layout')
@section('content')
    <div>
        @foreach($user_answer as $key => $user)
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingOne{{$key}}">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse-{{$key}}" aria-expanded="false" aria-controls="collapse-{{$key}}">
                                {{$user->created_at->format('d-M-Y')}}
                            </button>
                        </h2>
                    </div>
                    <div id="collapse-{{$key}}" class="collapse" aria-labelledby="headingOne{{$key}}" data-parent="#accordionExample" style="">
                        <div class="card-body">
                            <br>
<?
    $color = null;
    if ($user->true_answers > 80) $color = "green";
    if ($user->true_answers < 80 && $user->true_answers > 60) $color = "lightblue";
    if ($user->true_answers < 60 && $user->true_answers > 40) $color = "yellow";
    if ($user->true_answers < 40) $color = "red";
?>
                            <p class="" style="color: {{$color}}">{{$user->true_answers? round($user->true_answers)."%" : '0%'}}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <br><br><br>
    {{$user_answer->links()}}
    <p><a href="{{route('frontend.test.index')}}">Назад</a></p>
@endsection
