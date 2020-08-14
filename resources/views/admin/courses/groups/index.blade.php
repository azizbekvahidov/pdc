<?$i=1;?>
@extends('admin.layout')
@section('title', " — Группы")
@section('content')
    <div class="panel panel-default panel-table">
        <div class="panel-heading">
            Группы
            <div class="tools"><a href="{{route('admin.groups.create')}}" class="btn btn-info">{{__('box.create')}}</a></div>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered text-center">
                <thead>
                <tr>
                    <th class="number" width="15">#</th>
                    <th class="text-center">Название группы</th>
                    <th class="text-center">Количество учеников</th>
                    <th class="text-center">Статус группы</th>
                    <th class="text-center" width="200">Задать тест</th>
                </tr>
                </thead>
                <tbody class="no-border-x">
                @foreach($groups as $group)
                    <tr>
                        <td>
                            {{$i}}

                        </td>
                        <td>
                            <a href="{{route('admin.groups.students',$group->id)}}">
                                {{$group->name}}
                            </a>
                        </td>
                        <td>
                            {{count($group->students)}}
                        </td>
                        <td>
                            {!!$group->status ? "<strong>Группа активна</strong>" : "<button class='btn btn-default change' id='".$group->id."'>Не активна</button>"!!}
                        </td>
                        <td id="td-button" groupId="{{$group->id}}">
                            @if($group->status)
                                @if($group->time < time())
                                <button data-toggle="modal" data-target="#setTestParams" type="button" class="btn btn-space btn-info open" id="{{$group->id}}">Задать</button>
                                @else
                                    Тест задан
                                @endif
                            @else
                                Пока группа не активна
                            @endif
                        </td>
                    </tr>
                    <?$i++;?>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div id="setTestParams" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-primary">
        <div class="modal-dialog custom-width">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
                    <h3 class="modal-title">Задайте тест</h3>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="num">Введите число тестов</label>
                            <input type="tel" class="form-control" id="num">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="reset" data-dismiss="modal" class="btn btn-default md-close">Отмена</button>
                    <button type="button" data-dismiss="modal" class="btn btn-primary md-close" id="send">Задать</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        var idElem;
        $(document).on('click','.change', function () {
            let group = $(this);
            let data = {
                '_token':   "{{csrf_token()}}",
                'id':       group.attr('id'),
            };

            $.post(
                '{{route('admin.groups.status')}}',
                data,
                function (response) {
                    group.parent().html("<strong>Группа активна</strong>");
                    $('#td-button').html("<button  data-toggle=\"modal\" data-target=\"#setTestParams\" type=\"button\" class=\"btn btn-space btn-info open\" id=\""+ $('#td-button').attr('groupId') +"\">Задать</button>");
                    alert(response.message);
                },
            );
        });

        $(document).on('click', '.open', function () {
            idElem = $(this);
        });
        $(document).on('click','#send', function () {
            let data = {
                '_token': "{{csrf_token()}}",
                'num': $('#num').val(),
                'id': idElem.attr('id'),
                'test_condition': '1',
            };
            // Создание теста
            $.post('{{route('admin.groups.status')}}',
                    data,
                    function (response) {
                        let div = idElem.parent();
                        idElem.detach();
                        div.text('Тест задан');
                    }
            );
        });

    </script>
@endsection
