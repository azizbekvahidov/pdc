<?$i = 'A';?>
<p><h3>{{$question->question}}</h3></p>
<p>
    @foreach($question->answers as $answer)
        @if($answer->correct)
            <strong>{{$i}}) {!!$answer->answer!!}</strong>
        @else
            {{$i}}) {!!$answer->answer!!}
        @endif
        <?$i++;?>
        <br>
    @endforeach
</p>
<p><strong>{{trans_choice('box.subject',1)}}: {{$question->subject->subject}}</strong></p>
