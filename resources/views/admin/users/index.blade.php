@extends('admin.layout')
@section('title') - {{trans_choice('box.user',2)}} @endsection
@section('content')

    @include('admin.message')

    <div class="panel panel-default panel-table">
      <div class="panel-heading">
          {{trans_choice('box.user',2)}}
          <div class="tools"><a href="{{route('admin.users.create')}}" class="btn btn-info">{{__('box.create')}}</a></div>
      </div>
      <div class="panel-body">
        <table class="table table-striped table-borderless">
          <thead>
            <tr>
                <th class="number">#</th>
                <th>{{trans_choice('box.name',1)}}</th>
                <th>{{__('box.email')}}</th>
                <th>{{__('box.tel')}}</th>
                <th>{{trans_choice('box.result',2)}}</th>
                <th>{{__('box.privilege')}}</th>
                <th class="actions">{{__('box.actions')}}</th>
             </tr>
          </thead>
          <tbody class="no-border-x">
          @foreach($users as $user)
              <tr>
                  <td class="number">{{$user->id}}</td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->tel}}</td>
                  <td><a href="{{route('admin.groups.studentResults',$user->id)}}">{{__('box.view')}}</a></td>
                  <td id="{{$user->id}}">
                      @if($user->role_id == '1')
                          <button class="btn btn-success" id="change"> {{__('box.admin')}} </button>
                      @elseif($user->role_id == '2')
                          <button class="btn btn-primary" id="change"> {{trans_choice('box.teacher',1)}} </button>
                      @elseif($user->role_id == '3')
                          <button class="btn btn-warning" id="change"> {{trans_choice('box.student',1)}} </button>
                      @elseif($user->role_id == '0')
                          <button class="btn btn-danger" id="change"> Не активен </button>
                      @endif
                  </td>
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

@endsection
@section('js')
    <script src="/assets/js/own/user.js"></script>
    <script>
        $(document).on('click','#send',function () {
            var parent = $(this).parent();

            if($('select').val() != false){
                sendAjax(parent.attr('id'),"{{route('admin.users.role')}}",'{{csrf_token()}}', parent);
                clicked = false;
            }
        });
    </script>
@endsection
