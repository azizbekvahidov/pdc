<?$i=0;?>
@extends('admin.layout')
@section('title') - {{trans_choice('box.question',2)}} @endsection
@section('content')

@include('admin.errors')
  <div>
    <div class="panel panel-default panel-table">
      <div class="panel-heading">{{trans_choice('box.question',2)}}
        <div class="tools"><a href="{{ route('admin.questions.create') }}" class="btn btn-info">{{__('box.newQuestion')}}</a></div>
      </div>
      <div class="panel-body">
        <table class="table table-striped table-borderless">
          <thead>
            <tr>
              <th>#</th>
              <th>{{trans_choice('box.question',2)}}</th>
              <th>{{__('box.photo')}}</th>
              <th>{{__('box.author')}}</th>
              <th>{{trans_choice('box.subject',2)}}</th>
              <th class="actions">{{__('box.actions')}}</th>
            </tr>
          </thead>
          <tbody class="no-border-x">
            @foreach ($questions as $question)
              <tr>
                <td>{{$question->id}}</td>
                <td>{{$question->question}}</td>
                <td>
                    @if($question->photo)
                        <a href="{{$question->photo}}"><img src="{{$question->photo}}" alt="{{$question->photo}}" width="30px"></a>
                    @endif
                </td>
                <td>{{$question->user->name}}</td>
                <td>{{$question->subject->subject}}</td>
                <td class="actions">
                    <button data-toggle="modal" data-target="#mod-primary" type="button" class="btn icon data-btn" id="{{$question->id}}"><i class="mdi mdi-assignment-o"></i></button>
                    <a href="{{ route('admin.questions.edit',    $question->id) }}" class="btn icon"><i class="mdi mdi-edit"></i></a>
                    <a href="{{ route('admin.questions.destroy', $question->id) }}" class="btn icon"><i class="mdi mdi-delete"></i></a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
<div id="mod-primary" tabindex="-1" role="dialog" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

@endsection
@section('js')
    <script>
        $(document).on('click','.data-btn',function () {
            var id = $(this).attr('id'),
                data = {
                '_token': '{{csrf_token()}}',
                'id':       id
                };
            console.log(data);
            $.ajax({
                url: "{{route('admin.questions.sendData')}}",
                type: 'post',
                data: data,
                success: function (response) {
                    $('.modal-body').html(response);
                }
            });
        });

    </script>
@endsection
