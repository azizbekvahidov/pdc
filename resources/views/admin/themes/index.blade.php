@extends('admin.layout')
@section('title', ' — Темы')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading panel-heading-divider">
            <div class="tools">
                <a href="{{route('admin.themes.create')}}" class="btn btn-success">Создать тему</a>
            </div>
            <span class="title">
                <h3><strong>Темы для онлайн курсов</strong></h3>
            </span>
        </div>
        <div class="panel-body">
            <form>
                @csrf
                <div class="form-data">
                    <label for="subject"></label>
                    <select class="form-control" name="subject">
                        <option value="">Выберите предмет</option>
                        @foreach($subjects as $subject)
                            <option value="{{$subject->id}}">{{$subject->subject}}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <div class="form-data">
                    <button type="button" class="btn btn-info" id="showLessons">Показать</button>
                </div>
            </form>
            <section class="lessons">
                @if(isset($themes))
                    @foreach($themes as $theme)
                        <a href="{{route('admin.themes.view',$theme->id)}}">{{$theme->name}}</a>
                    @endforeach
                @endif
            </section>
        </div>
    </div>
@endsection
@section('css')
    <style>
        .lessons{
            margin: 20px 0;
        }
        .lessons>a{
            display: block;
            font-size: 28px;
            font-weight: bold;
        }
    </style>
@endsection

@section('js')
    <script>
        $('#showLessons').click(function () {

            var first = true,
                data = $('form').serialize();

            $.post('{{route('admin.themes.choose')}}',data,function (response) {
                if(first) {
                    $('.lessons').html('');
                    first = false;
                }
                if(response.themes.length == 0){
                    $(".lessons").append("Видеоуроков не существует");
                }
                $.each(response.themes,function (key, item) {
                    var linkTag = document.createElement('a');
                    linkTag.href = "http://test.lc/admin/themes/view/"+key;
                    linkTag.innerText = item;

                    $(".lessons").append(linkTag);

                });
            });
        });
    </script>
@endsection
