@php
    $i = 1;
    $questions_num = count($questions);
    $letter = "A";
@endphp
@extends('frontend.guest.layout')
@section('title', " — Тест")
@section('content')

    <!-- ##### Header Area Start ##### -->
    <header class="header-area"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <!-- Navbar Area -->
        <div class="clever-main-menu">
            <div class="classy-nav-container breakpoint-off">
                <!-- Menu -->
                <nav class="classy-navbar justify-content-between" id="cleverNav">

                    <!-- Logo -->
                    <a class="nav-brand" href="#"><img src="/assets/img/logo2.png" alt="logo" width="280"></a>

                    <!-- Navbar Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>

                    <!-- Menu -->
                    <div class="classy-menu">

                        <!-- Close Button -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>

                        <!-- Nav End -->
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <!-- ##### Header Area End ##### -->

    <!-- ##### Regular Page Area Start ##### -->
    <div class="regular-page-area section-padding-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-content">
                        <div class="p-3" id="message" style="height: 50px;"></div>
                        <form method="POST" action="{{route('frontend.test.check',$questions[0]->question->subject->id)}}">
                            @csrf
                            <input type="text" name="questions_number" value="{{$questions_num}}" hidden>
                            <input type="text" name="test_id" value="{{$questions[0]->userAnswer->id}}" hidden>
                            <div class="tests">
                                @foreach($questions as $question)
                                    @if(!$question->answers_id)
                                        <div class="questions">
                                            <h4 class="col-md-10 text-center">{{$i}}) {{$question->question->question}}</h4>
                                            <hr>
                                            <div class="row">
                                                <div class="col-7">
                                                    @php
                                                        $i++;
                                                        $cor = null;
                                                        foreach($question->question->answers as $answer){
                                                        $answer->correct ? $cor++ : '';
                                                        }
                                                    @endphp
                                                        @foreach($question->question->answers as $answer)
                                                            @if($cor == 1)
                                                                <div class="custom-control custom-radio">
                                                                    <input
                                                                        type="radio"
                                                                        class="custom-control-input"
                                                                        name="{{$question->id}}"
                                                                        value="{{$answer->id}}"
                                                                        id="answer_{{$answer->id}}">
                                                                    <label class="custom-control-label" for="answer_{{$answer->id}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$letter}}) {!! $answer->answer  !!}</label>
                                                                </div>
                                                            @else
                                                                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                                    <input
                                                                        type="checkbox"
                                                                        class="custom-control-input"
                                                                        name="{{$question->id}}[]"
                                                                        value="{{$answer->id}}"
                                                                        id="answer_{{$answer->id}}">
                                                                    <label class="custom-control-label" for="answer_{{$answer->id}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$letter}}) {!! $answer->answer  !!}</label>
                                                                </div>
                                                            @endif
                                                            @php
                                                                $letter++;
                                                            @endphp
                                                        @endforeach
                                                    @php
                                                        $letter = "A";
                                                    @endphp
                                                </div>
                                                <div class="col-4">
                                                    <h1 id="questionImage" style="background-image: url('{{$question->question->photo}}');"></h1>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </form>
                        <div class="row mt-4" id="button">
                            <div class="col-7">
                                <div class="float-right">
                                    <button class="btn btn-success next-btn" type="button">Следующее</button>
                                </div>
                            </div>
                            <div class="col-4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Regular Page Area End ##### -->
    @include('frontend.guest.partials.footer')
@endsection
@section('script')
    <script>
        var questions_number = $("div.questions").length;
        var clicked = false;
        var iter = 1;

        if (questions_number == 1) {
            $('.float-right').appendTo('form');
            var next = $(".next-btn").attr('type','submit').text('Завершить').removeClass('next-btn');
        }
        if (!clicked) {
            $('.questions:first-child').addClass('current');
        }
        $(document).on('click','.next-btn',function () {
            var thiselem = $(this);
            $.ajax({
                url: "{{route('frontend.test.check',$questions[0]->question->subject->id)}}",
                type: "post",
                data: $('form').serialize(),
                success: function (response) {
                    if(response.url) {
                        $('.page-content').html("<h1 class='text-center'>ИЗВИНИТЕ ПЕРЕЗАПУСК СТРАНИЦЫ<h1>");
                        setTimeout(function () {
                            location.reload();
                        },1000);
                    }
                    else{

                        if(iter == (questions_number-1)) {
                            $('div#button').appendTo('form');
                            $('.next-btn').attr('type','submit');
                            $('.next-btn').text('Завершить');
                            thiselem.removeClass("next-btn");
                        }
                        var text = "<div class='alert alert-success' role='alert'>"+response.message+"</div>";
                        $('.current').appendTo('.tests');
                        $('.questions.current').detach();
                        $('.tests .questions:first-child').addClass('current');
                        $('#message').html(text);

                        setTimeout(function () {
                            $('div.alert').detach();
                        },2000);
                    	iter++;
                    }

                },
                error: function (response) {
                    alert("Error/n"+response);
                },
            });
            clicked = true;
        });

    </script>

@endsection
@section('style')
    <style>
        *, ::after, ::before {
            box-sizing: inherit;
        }
        .questions{
            display:none;
        }
        .current{
            display:block;
        }
        #questionImage{
            background-size: contain;
            width: 400px;
            height: 300px;
        }
    </style>
@endsection
