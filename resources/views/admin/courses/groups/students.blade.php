<?$i=1;?>
@extends('admin.layout')
@section('title', '— Учащиеся группы')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading"><h4><strong>{{$group->name}}</strong></h4></div>
        <div class="panel-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Имя фамилия</th>
                        <th>Телефон номер</th>
                        <th>Статус</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($group->students as $student)
                    <tr>
                        <td>{{$i}}</td>
                        <td>
                            <a href="{{route('admin.groups.studentResults',$student->id)}}">
                                {{$student->name." ".$student->surname}}
                            </a>
                        </td>
                        <td>{{$student->tel}}</td>
                        <td>
                            <button id="{{$student->id}}">{{$student->groupStatus->where('group_id', $group->id)->first()->user_status ? "Учится" : "Не учится"}}</button>
                        </td>
                    </tr>
                    <?$i++;?>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).on('click','button',function () {
            var button = $(this),
                data = {
                    '_token':   '{{csrf_token()}}',
                    'id':       button.attr('id'),
                    'group_id': '{{$group->id}}',
                    'user_status': '1',
                };

            $.post('{{route('admin.groups.status')}}',
                data,
                function (response) {
                    switch (response.status) {
                        case '1':
                            button.text('Учится');
                            break;
                        case '0':
                            button.text('Не учится');
                            break;
                        default:
                            button.text('Окончил учебу');
                            break;
                    }
                }
            );
        });
    </script>
@endsection
