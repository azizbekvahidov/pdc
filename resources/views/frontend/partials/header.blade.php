<header class="masthead mb-auto ">
    <div class="inner">
    	
        <nav class="nav nav-masthead justify-content-center">
            @if(\Auth::user()->role_id == '1' || \Auth::user()->role_id == '2')
                <a class="nav-link active" href="{{route('admin.home')}}">{{__('box.adminPanel')}}</a>
            @endif
                <a class="nav-link" href="/">Главная страница</a>
                <a class="nav-link" target="_blank" href="http://mostbyte.uz/#about" title="Mostbyte">{{__('box.about')}}</a>
                <a class="nav-link" href="{{route('logout')}}">{{__('box.logout')}}</a>
        </nav>
    </div>
</header>
