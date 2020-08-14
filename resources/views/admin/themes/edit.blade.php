<?php
    $url = str_replace('video/embed','watch', $theme->url);
?>
@extends('admin.layout')
@section('title', ' — '.$theme->name)
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading panel-heading-divider">
            <span class="title">
                <h3><strong>Редактирование урока — </strong>{{$theme->name}}</h3>
            </span>
        </div>
        <div class="panel-body">
            @include('admin.errors')
            <form action="{{route('admin.themes.update',$theme->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-data">
                    <label for="name">Название темы</label>
                    <input type="text" name="name" value="{{$theme->name}}" class="form-control" id="name">
                </div>
                <br>
                <div class="form-data">
                    <label for="description">Название темы</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control" style="resize: vertical">{{$theme->description}}</textarea>
                </div>
                <br>
                <div class="form-data">
                    <label for="url">Видео контент от <span class="mover-name">Mover</span> или <span class="youtube-name">Youtube</span></label>
                    <div id="errorMessage"></div>
                    <input type="text" name="url" value="{{$url}}" class="form-control" id="name" placeholder="https://">
                </div>
                <div class="form-data">
                    <br>
                    <div>
                        <button class="btn btn-info">Файлы для задания</button>
                        <div class="files-area">
<?
    $files = explode("|", $theme->files);
?>
                            @foreach($files as $file)
                                <a href="/storage/files/{{$file}}" download>{{$file}}</a>
                            @endforeach
                        </div>
                    </div>
                    <br>
                    <label for="file">Изменить</label>
                    <input type="file" name="files[]" class="form-control" id="file" multiple style="display: none">
                    <input type="text" name="old_files" value="{{$theme->files}}" hidden>
                </div>
                <br>
                <button type="submit" class="btn btn-success">Изменить</button>
            </form>
        </div>
    </div>
@endsection
@section('css')
    <style>
        .errorText{
            display: block;
            width: 100%;
            background-color: rgba(255,0,0,0.2);
            border: 1px solid #f00;
            padding: 5px;
            font-weight: bold;
            font-size: 16px;
            color: #f00;
        }
        .youtube-name{
            font-weight: bold;
            color: #d11;
        }
        .mover-name{
            font-weight: bold;
            color: #333;
        }
    </style>
@endsection
@section('js')
    <script src="/assets/js/own/user.js"></script>
    <script>
        $( "input[name='url']" ).change(function() {
            let val = $(this).val();
            if(val.slice(0, 5) == 'https'){
                val = urlChecking(val);
            }
            else{
                val = "https://" + val;
                val = urlChecking(val);
            }
            $(this).val(val);
        });
    </script>
@endsection
