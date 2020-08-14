<ul class="sidebar-elements">
    <li class="divider">{{__('box.menu')}}</li>
    <li class="active">
        <a href="{{route('admin.home')}}"><i class="icon mdi mdi-home"></i><span>{{__('box.adminPanel')}}</span></a>
    </li>
    @if(\Auth::user()->role_id == '1')

    <li>
        <a href="{{route('admin.users.index')}}"><i class="icon mdi mdi-assignment-account"></i><span>{{trans_choice('box.user',2)}}</span></a>
    </li>
    @endif
    <li style="cursor: pointer"><a><i class="icon mdi mdi-assignment"></i> Тестирование <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
            @if(\Auth::user()->role_id == '1')
            <li>
                <a href="{{route('admin.courses.index')}}">Курсы</a>
            </li>
            @endif
            <li>
                <a href="{{route('admin.groups.index')}}">Группы</a>
            </li>
            <li>
                <a href="{{route('admin.questions.index')}}">{{trans_choice('box.question',2)}}</a>
            </li>
            <li>
                <a href="{{route('admin.subjects.index')}}">{{trans_choice('box.subject',2)}}</a>
            </li>
        </ul>
    </li>
    @if(\Auth::user()->role_id == '1')
    <li style="cursor: pointer"><a><i class="icon mdi mdi-key"></i> Управление <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
            <li><a href="{{route('admin.themes.index')}}">Темы</a></li>
            <li><a href="{{route('admin.news.index')}}">Новости</a></li>
            <li><a href="{{route('admin.teachers.index')}}">Преподаватели</a></li>
        </ul>
    </li>
    @endif
    <li>
        <a href="{{route('index')}}">
            <i class="icon mdi mdi-layers"></i><span class="icon-class">{{__('box.mainPage')}}</span>
        </a>
    </li>

</ul>
