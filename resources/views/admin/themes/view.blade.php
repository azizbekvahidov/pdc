@extends('admin.layout')
@section('title', ' — '.$theme->name)
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading panel-heading-divider">
            <div class="tools">
                <div class="btn-group btn-group-lg" role="group" aria-label="...">
                    <a href="{{route('admin.themes.edit',$theme->id)}}" class="btn btn-warning">Изменить</a>
                    <a href="{{route('admin.themes.destroy',$theme->id)}}" class="btn btn-danger">Удалить</a>
                </div>
            </div>
            <span class="title">
                <h3><strong>{{$theme->name}}</strong></h3>
            </span>
        </div>
        <div class="panel-body">
            <h4><strong>{{$theme->description}}</strong>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Типа описание урока)</h4>
            <div class="video-content">
                @if($theme->url != null)
                    <iframe width="640" height="360" src="{{$theme->url}}" frameborder="0" allowfullscreen></iframe>
                @else
                    <h4><strong>"Видеоконтент не существует"</strong></h4>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('css')
    <style>
        .video-content{
            margin:50px 0;
        }
    </style>
@endsection
