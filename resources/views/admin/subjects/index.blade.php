@extends('admin.layout')
@section('title') - {{trans_choice('box.subject',2)}} @endsection
@section('content')
@include('admin.message')

	<div>
    <div class="panel panel-default panel-table">
      <div class="panel-heading">{{trans_choice('box.subject',2)}}
        <div class="tools">
            <button data-toggle="modal" data-target="#form-bp1" type="button" class="btn btn-space btn-primary">{{__('box.newSubj')}}</button>
        </div>
      </div>
      <div class="panel-body">
        <table class="table table-striped table-borderless">
          <thead>
            <tr>
            	<th>#</th>
              <th style="width:50%;">{{trans_choice('box.name',2)}}</th>
              <th class="actions">{{__('box.actions')}}</th>
            </tr>
          </thead>
          <tbody class="no-border-x">
          	@foreach ($subjects as $subject)
	            <tr id="{{$subject->subject}}">
	              <td>{{ $subject->id }}</td>
	              <td>{{ $subject->subject }}</td>
	              <td class="actions">
                      <a href="#" class="icon"><i class="mdi mdi-edit"></i></a>
                      <a href="#" class="icon"><i class="mdi mdi-delete"></i></a>
                  </td>
	            </tr>
          	@endforeach
          </tbody>
        </table>

      </div>
    </div>
  </div>
<div id="form-bp1" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-primary">
    <div class="modal-dialog custom-width">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
                <h3 class="modal-title">{{__('box.enterNewSubject')}}</h3>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="col-md-6 col-lg-6 col-sm-6 col-lg-offset-3">
                        <div class="form-group">
                            <label class="col-form-label" for="subject">{{trans_choice('box.subject',1)}}</label>
                            <input type="text" name="subject" class="form-control" id="subject" required>
                        </div>
                        <button class="btn btn-primary btn-block" data-dismiss="modal" aria-hidden="true" id="sbmt" type="button">{{__('box.enter')}}</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        $(document).on('click','#sbmt',function () {
            var input = $('input').val(),
                data = {
                    '_token': "{{csrf_token()}}",
                    'subject': input,
                };
                $.ajax({
                url: "{{route('admin.subjects.store')}}",
                type: "post",
                data: data,
                success: function (response) {
                    $('input').val('');
                    $("tr").removeClass('border');

                    if(!$("td:nth-child(2):contains("+response.subject.subject+")").length){
                        var subject = "<tr>" +
                            "<td>"+response.subject.id+"</td>" +
                            "<td id="+response.subject.subject+">"+response.subject.subject+"</td>" +
                            "<td class=\"actions\"><a href=\"#\" class=\"icon\"><i class=\"mdi mdi-edit\"></i></a>" +
                            "<a href=\"#\" class=\"icon\"><i class=\"mdi mdi-delete\"></i></a></td>" +
                            "</tr>";
                        $('table').append(subject);
                    }
                    else{
                        $("#"+response.subject.subject).addClass('border');
                        setTimeout(function () {
                            $("#"+response.subject.subject).removeClass('border');
                        },3000);
                    }
                },
                error: function (response) {
                    alert("ERROR");
                }
            });
        });
    </script>
@endsection
@section('css')
    <style>
        .border{
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            border: 1px solid #c82333;
        }
    </style>
@endsection
