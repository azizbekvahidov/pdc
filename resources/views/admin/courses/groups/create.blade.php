@extends('admin.layout')
@section('title', ' — Создание группу')
@section('css')
    <link rel="stylesheet" href="/assets/css/select2.min.css" type="text/css"/>
@endsection
@section('content')
    <div class="panel panel-default panel-border-color panel-border-color-primary">
        <div class="container">
            <div class="panel-heading panel-heading-divider">Создать Группу</div>
            <div class="panel-body">
                @include('admin.errors')
                <form method="POST" action="{{route('admin.groups.store')}}" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="name">Название группы</label>
                        <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label for="course">Выберите курс</label>
                        <select name="course" id="course" class="form-control">
                            <option value=""></option>
                            @foreach($courses as $course)
                                <option value="{{$course->id}}">{{$course->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date">Укажите дату окончания набора</label>
                        <input type="date" name="date" class="form-control" id="date">
                    </div>
                    <button class="btn btn-primary btn-block">{{__('box.create')}}</button>
                </form>
            </div>
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
