@extends('admin.layout')
@section('title') - {{__('box.creatingQuestion')}} @endsection
@section('content')
<div class="panel panel-default panel-border-color panel-border-color-primary">
	<div class="container">
		<div class="panel-heading panel-heading-divider">{{__('box.createQuestion')}}</div>
	    <div class="panel-body">
            @include('admin.errors')
            <button id="add" class="btn btn-success"><div class="icon"><span class="mdi mdi-plus"></span></div></button>
            <button id="substr" class="btn btn-danger"><div class="icon"><span class="mdi mdi-minus"></span></div></button>
            <form method="POST" action="{{route('admin.questions.store')}}" enctype="multipart/form-data" autocomplete="off">
	        	@csrf
		        <div class="form-group xs-pt-10">
		        	<label for="question">{{trans_choice('box.question',1)}}</label>
					<textarea name="question" id="question" class="form-control" rows="10">{{old('question')}}</textarea>
		        </div>
                <div class="form-group">
                    <label for="photo">Выберите изображение для вопроса (необъязательно)</label>
                    <input type="file" id="photo" class="form-control" name="photo">
                </div>
                <div id="options">
                    @if($errors->any())
<?$i=0;?>
                        @foreach(old('option') as $item)
                            <div class="1">
                                <label for="option-{{$i+1}}" class="options">{{__('box.option')." "}}{{$i+1}}</label>
                                <div class="input-group xs-mb-15">
                                    <input
                                        type="text"
                                        id="option-{{$i+1}}"
                                        name="option[]"
                                        class="form-control"
                                        value="{{$item}}">
                                    <span class="input-group-addon">
                        <input
                            type="checkbox"
                            name="correct[]"
                            value="{{$i}}">
                    </span>
                                </div>
                            </div>
<?$i++;?>
                        @endforeach
                    @else
                    <div class="1">
                        <label for="option-1" class="options">{{__('box.option')." "}}1</label>
                        <div class="input-group xs-mb-15">
                            <input
                                type="text"
                                id="option-1"
                                name="option[]"
                                class="form-control"
                                value="{{old('option[0]')}}">
                            <span class="input-group-addon">
                        <input
                            type="checkbox"
                            name="correct[]"
                            value="0">
                    </span>
                        </div>
                    </div>
                    @endif
                </div>
                <label for="subject">{{trans_choice('box.subject',1)}}</label>
                <div class="form-group">
                    <select name="subject" id="subject" class="form-control" value="{{old('subject')}}">
                        <option value="">{{__('box.select')}}</option>
                        @foreach($subjects as $subject)
                            <option value="{{$subject->id}}">{{$subject->subject}}</option>
                        @endforeach
                    </select>
                </div>
            <button class="btn btn-primary btn-block">{{__('box.create')}}</button>
	    	</form>
	    </div>
	</div>
</div>



@endsection
@section('js')
    <script>
        var i = 1;
        $(document).on('click','#add',function () {
            var options = $('#options'),
            text = "<div class=\"1\"><label for=\"option-"+(i+1)+"\" class=\"options\">{{__('box.option')}}"+(i+1)+"</label>\n" +
                "                    <div class=\"input-group xs-mb-15\">\n" +
                "                        <input\n" +
                "                            type=\"text\"\n" +
                "                            id=\"option-"+(i+1)+"\"\n" +
                "                            name=\"option[]\"\n" +
                "                            class=\"form-control\">\n" +
                "                        <span class=\"input-group-addon\">\n" +
                "                        <input\n" +
                "                            type=\"checkbox\"\n" +
                "                            name=\"correct[]\"\n" +
                "                            value=\""+i+"\">\n" +
                "                    </span>\n" +
                "                    </div>" +
                "                    </div>";
            options.append(text);
            i++;
        });

        $('#substr').click(function () {
            var length = $('.1').length;
            $(".1:nth-child("+length+")").detach();
            i--;
            if (i<1) i=0;
        });

    </script>
@endsection
