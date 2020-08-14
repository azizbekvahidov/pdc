@extends("admin.layout")
@section("content")
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
           @if($errors->any())
                @foreach($errors->all() as $error)
                        <div role="alert" class="alert alert-danger alert-icon alert-icon-border alert-dismissible">
                            <div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
                            <div class="message">
                                <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button>
                                {!! $error !!}
                            </div>
                        </div>
                @endforeach
            @endif
                <div class="x_content">
                    <br/>
                    <form action="{{route("admin.news.store")}}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                            <div class="item form-group">
                            <label for="title" class="col-form-label col-md-3 col-sm-3 label-align" >Заголовок <span class="required"></span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="title"  class="form-control" name="title" value="{{old('title')}}">
                            </div>
                        </div>

                        <div class="form-group xs-pt-10">
                            <label for="article">Статья</label>
                            <textarea name="article" id="article" class="form-control" rows="10"></textarea>
                        </div>

                        <div class="form-group xs-pt-10">
                            <label for="summary">Краткое содержание</label>
                            <textarea name="summary" id="summary" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="form-group xs-pt-10">
                            <label for="photo" id="photoLabel" class="btn btn-primary">Загрузить фотографию </label>
                            <input type="file" name="photo" class="form-control" accept="image/*" style="display:none;" id="photo">
                        </div>

                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3">
                               <button type="submit" class="btn btn-success">Сохранить</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

