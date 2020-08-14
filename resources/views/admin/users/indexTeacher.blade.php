@extends('admin.layout')
@section('title') - {{trans_choice('box.user',2)}} @endsection
@section('content')
    @include('admin.message')

    <div class="panel panel-default panel-table">
        <div class="panel-heading">
            {{trans_choice('box.user',2)}}
        </div>
        <div class="panel-body">
            <table class="table table-striped table-borderless">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Название группы</th>
                    <th>Предмет</th>
                </tr>
                </thead>
                <tbody class="no-border-x">
                @foreach($groups as $group)
<?
$i = 0;
$subjects = null;
$course = $group->course;
$subj_ids = explode(',',$course->subject_id);
foreach ($subj_ids as $subj_id){
    if ($i == 0){
        $subjects .= \App\Subjects::find($subj_id)->subject;
    }
    else{
        $subjects .= ", ".\App\Subjects::find($subj_id)->subject;
    }
    $i++;
}

?>
                    <tr>
                        <td>{{$group->id}}</td>
                        <td>
                            <a href="#">{{$group->name}}</a>
                        </td>
                        <td>{{$subjects}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
@section('js')

@endsection
