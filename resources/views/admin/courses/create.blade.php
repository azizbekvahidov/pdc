@extends('admin.layout')
@section('title',' — Создать курс')
@section('css')
    <link rel="stylesheet" href="/assets/css/select2.min.css" type="text/css"/>
@endsection
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Создать курс
        </div>
        <div class="panel-body">
            @include('admin.errors')
            <form action="{{route('admin.courses.store')}}" method="post" autocomplete="off">
                @csrf
                <div class="group-form">
                    <label for="name">Название курса</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{old('name')}}">
                </div>
                <div class="group-form">
                    <label for="description">Описание курса</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control" style="resize: vertical">{{old('description')}}</textarea>
                </div>
                <br>
                <label for="subject">Выберите предмет</label>
                <select class="js-example-basic-multiple form-control" name="subjects[]" multiple="multiple">
                @foreach($subjects as $subject)
                        <option value="{{$subject->id}}">{{$subject->subject}}</option>
                    @endforeach
                </select>
                <br>
                <br>

                <button type="submit" class="btn btn-info">Создать</button>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endsection
