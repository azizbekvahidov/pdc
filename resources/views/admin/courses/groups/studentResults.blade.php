@extends('admin.layout')
@section('title',' — '.$user->name)
@section('content')
    <div class="row row-cols-2">
        <div class="col-md-8">
        @foreach($user->answers as $answer)
                <button data-toggle="modal" data-target="#md-fullWidth" type="button" id="{{$answer->id}}" class="btn btn-space btn-primary">
                    {{$answer->created_at->format('d-m-Y')}}
                </button>
                @if(!$answer->end)
                    <span class="text-danger"> <strong>Не завершен!</strong></span>
                @else
                    <strong>Успеваемость: </strong><span class="text-success"><strong>{{round($answer->true_answers)}}%</strong></span>
                @endif
                <br>
            @endforeach
        </div>
        <div class="col-md-4">
            <h4><strong>{{$user->name}} {{$user->surname}}</strong></h4>
            <h5><strong>{{$user->tel}}</strong></h5>
        </div>
    </div>
    <div id="md-fullWidth" tabindex="-1" role="dialog" class="modal fade">
        <div class="modal-dialog full-width">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div class="text-primary" id="date"></div>
                    </div>
                </div>
                <div class="container">
                    <div class="text-center">
                        <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).on('click','.btn',function () {
            var text    = "",
                btn     = $(this),
                data    = {
                "_token":   "{{csrf_token()}}",
                "id":       btn.attr('id'),
            };
            $.post("{{route('admin.groups.data')}}", data, function (response) {

                for(var userAnswer_item of response.userAnswer){

                    text+="<h3 class='mt-3'><strong>"+userAnswer_item.question+"</strong></h3><br>";

                    for(var answers_item of userAnswer_item.answers) {
                        if(userAnswer_item.correct){
                            text+="<p class=\"text-success\"><strong>"+answers_item+"</strong></p>";
                        }
                        else{
                            text+="<p class=\"text-danger\"><strong>"+answers_item+"</strong></p>";
                        }
                    }
                }
                $(".modal-content").children(".container").html(text);
                $("#date").html("<h3><strong>Результаты "+btn.text()+"</strong></h3>");
            });
        });
        $('#md-fullWidth').on('hide.bs.modal', function (e) {
            let text =  "<div class=\"text-center\">\n" +
                        "  <div class=\"spinner-border\" role=\"status\">\n" +
                        "    <span class=\"sr-only\">Loading...</span>\n" +
                        "  </div>\n" +
                        "</div>";
            setTimeout(function () {
                $(".modal-content").children(".container").html(text);
                $("#date").html("");
            },300);
        });
    </script>
@endsection
