@extends('admin.layout')
@section('title', ' — Темы')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading panel-heading-divider">
            <span class="title">
                <h3><strong>Создание темы для онлайн курсов</strong></h3>
            </span>
        </div>
        <div class="panel-body">
            @include('admin.errors')
            <form action="{{route('admin.themes.store')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="form-data">
                    <label for="name">Название темы</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{old('name')}}"/>
                </div>
                <br>
                <div class="form-data">
                    <label for="desc">Описание урока</label>
                    <textarea name="description" id="desc" cols="30" rows="10" class="form-control" style="resize: vertical">{{old('description')}}</textarea>
                </div>
                <br>
                <div class="form-data">
                    <label for="subject">Выберите предмет</label>
                    <select name="subject" id="subject" class="form-control">
                        <option value="">Выберите предмет</option>
                        @foreach($subjects as $subject)
                            <option value="{{$subject->id}}">{{$subject->subject}}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <div class="form-data">
                    <label for="url">Укажите ссылку видео для урока</label>
                    <div id="errorMessage"></div>
                    <input type="text" name="url" class="form-control" id="url" placeholder="https://" value="{{old('url')}}"/>
                    <span class="input-desc">Введите ссылку <span class="youtube-name">Youtube</span> или <span class="mover-name">Mover</span></span>
                </div>
                <br>
                <div class="form-data">
                    <label for="files">
                        <span class="btn btn-info">
                            Прекрипите файлы для задания
                        </span>
                    </label>
                    <input type="file" name="files[]" class="form-control" id="files" multiple="multiple" {{-- accept="application/pdf" --}} style="display: none">
                </div>
                <div id="file-drop">

                </div>
                <br>
                <button type="submit" class="btn btn-success">Создать</button>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <!-- Load WysiBB JS -->
    <script src="/assets/js/own/user.js"></script>
    <script>
        var control = document.getElementById("files"),
            j       = 0;

        control.addEventListener("change", function(event) {
            // Когда происходит изменение элементов управления, значит появились новые файлы
            var i       = 0,
                files   = control.files,
                len     = files.length,
                text    = "";

            for (; i < len; i++) {
                text += "<img src='/assets/img/pdf-logo.png' width='50px'>" + files[i].name;
                // console.log("Size: " + files[i].size + " bytes");
                if(j%2 == 1){
                    text += "<br>";
                }
                j++;
            }
            $("#file-drop").html(text);
            $('#file-drop').addClass('file-icons');

        }, false);

        $("input[name='url']").change(function() {
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
@section('css')
    <link rel="stylesheet" href="/wysibb/theme/default/wbbtheme.css" />
    <style>
        .file-icons{
            border: 2px dashed #0c57d3;
            padding: 5px 0;
            font-size: 12px;
        }
        .input-desc{
            display: block;
            width: 100%;
            background-color: rgba(50,250,10,0.4);
            border: 1px solid rgb(50,250,10);
            color: #555;
            padding: 2px;
        }
        .youtube-name{
            font-weight: bold;
            color: #d11;
        }
        .mover-name{
            font-weight: bold;
            color: #333;
        }
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
    </style>
@endsection
