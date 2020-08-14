@extends("admin.layout")

@section("content")
    <div>
        <div class="page-title">
            <div class="title_left">
               <h2>Новости</h2>
            </div>
            <div class="title_right">
                <div class="col-md-2 col-sm-2  form-group pull-right top_search">
                    <div class="input-group">
                        <a href="{{ route("admin.news.create") }}" class="btn btn-success">Добавить</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
@if(session()->has('message'))
                <div class="alert alert-success">
                    {{session()->get('message')}}
                </div>
@endif
            <table class="table table-striped">
                <tr>
                    <th>#</th>
                    <th>Заголовок</th>
                    <th>Краткое содержание</th>
                    <th>Фото</th>
                    <th></th>
                </tr>
                @foreach($news as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->title}}</td>
                        <td>{{$item->summary}}</td>
                        <td><img src="{{$item->photo}}" alt="{{$item->photo}}" width="100px"></td>

                        <td>
                            <a class="mdi mdi-edit" href="{{route("admin.news.edit", $item->id)}}"><i class="fa fa-pencil"></i></a>
                            <a class="mdi mdi-delete" href="{{route("admin.news.destroy", $item->id)}}"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
