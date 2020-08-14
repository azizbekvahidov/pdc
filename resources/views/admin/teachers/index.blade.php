@extends("admin.layout")
@section("css")
    <style>

        img{
            border-radius: 3px;
        }
    </style>
@endsection
@section("content")
    @if(session()->has("message"))
        {{session("message")}}
    @endif
    <div>
        <div class="page-title">
            <div class="title_left">
                <h3>{{__("Преподаватели")}}</h3>
            </div>

        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <table class="table table-striped">
                <tr>
                    <th>#</th>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>О себе</th>
                    <th>Фото</th>
                    <th></th>
                </tr>
                @foreach($teachers as $val)
                    <tr>
                        <td>{{$val->id}}</td>
                        <td>{{$val->name}}</td>
                        <td>{{$val->surname}}</td>
                        <td>
                            <?=$val->info ? $val->info->info : "";?>
                        </td>
                        <td>
                            @if($val->info && $val->info->photo)
                                <a href="/storage/images/{{$val->info->photo}}"><img src="/storage/images/{{$val->info->photo}}" width="32px"></a>
                            @else
                                <img src="/assets/img/avatar.png" width="32px">
                            @endif
                        </td>
                        <td>
                            <a class="mdi mdi-edit" href="{{route("admin.teachers.edit", $val->id)}}"><i class="fa fa-pencil"></i></a>
                            <a class="mdi mdi-delete" href="{{route("admin.teachers.destroy", $val->id)}}"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection


