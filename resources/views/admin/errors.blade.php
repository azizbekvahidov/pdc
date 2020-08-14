@if($errors->any())
    @foreach($errors->all() as $error)
	<div role="alert" class="alert alert-danger alert-icon alert-icon-border alert-dismissible">
        <div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
		<div class="message">
            <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button>
		    {!! $error !!}
		</div>
	</div>
    @endforeach
@endif
