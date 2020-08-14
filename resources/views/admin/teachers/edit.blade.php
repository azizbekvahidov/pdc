
@extends("admin.layout")

@section("content")
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">

                <div class="x_content">
                    <br />
                    <form action="{{route("admin.teachers.update", $model->id)}}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        @if($model->info)
                            @if($model->info->photo)
                                <input type="text" name="oldPhotoName" value="{{$model->info->photo}}" hidden>
                            @endif
                        @endif
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" > Имя <span class="required"></span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="name" required="required" class="form-control" name="name" value="{{$model->name}}" >
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" > Фамилия <span class="required"></span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="surname" required="required" class="form-control" name="surname" value="{{$model->surname}}" >
                            </div>
                        </div>

                        <div class="form-group xs-pt-10">
                            <label for="text">О себе</label>
                            <textarea name="info" id="info" class="form-control" rows="10"><?=$model->info ? $model->info->info : "";?></textarea>
                        </div>

                        <div class="form-group xs-pt-10">
                            <label for="text">Фото</label>
                            <input type="file" name="photo" class="form-control" accept="image/*" value="{{$model->photo}}">
                        </div>

                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3">
                                <button type="submit" class="btn btn-success">Добавить</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

