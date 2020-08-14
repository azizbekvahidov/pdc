@extends('admin.layout')
@section('title', ' — Курсы')
@section('content')
    <div class="panel panel-default panel-table">
        <div class="panel-heading">
            Курсы
            <div class="tools">
                <a href="{{route('admin.courses.create')}}" class="btn btn-info">Создать курс</a>
            </div>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th class="text-center" width="15">#</th>
                        <th class="text-center">Курс</th>
                        <th class="text-center">Предмет</th>
                        <th class="text-center">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
<?
    $subjects_id = explode(',', $course->subject_id);
    $i = 1;
?>
                        <tr>
                            <td>{{$course->id}}</td>
                            <td>{{$course->name}}</td>
                            <td>
                                @foreach($subjects_id as $subject_id)
<?
    $subject = \App\Subjects::find($subject_id);
?>
                                @if($i != count($subjects_id))
                                    {{$subject->subject.", "}}
                                @else
                                    {{$subject->subject}}
                                @endif
<?$i++;?>
                                @endforeach
                            </td>
                            <td>
                                <a href="">Изменить</a>
                                <a href="">Удалить</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
