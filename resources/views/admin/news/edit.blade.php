@extends("admin.layout")

@section("content")
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">

                <div class="x_content">
                    <br />
                    <form action="{{route("admin.news.update", $model->id)}}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                        @csrf
                        @method('patch')

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" > Тема <span class="required"></span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="title" required="required" class="form-control" name="title" value="{{$model->title}}">
                            </div>
                        </div>

                        <div class="form-group xs-pt-10">
                            <label for="text">Содержание</label>
                            <textarea name="text" id="text" class="form-control" rows="10" >{{$model->text}}</textarea>
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

