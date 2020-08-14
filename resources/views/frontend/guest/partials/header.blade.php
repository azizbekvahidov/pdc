    <ul id="menu">
        @if(\Auth::user())
            @if(\Auth::user()->role_id == '1' || \Auth::user()->role_id == '2')
                <li><a href="{{route('admin.home')}}">Админ панель</a></li>
            @endif
        @endif
        <li><a href="#main">Главная</a></li>
        <li><a href="#courses">Курсы</a></li>
        <li><a href="#tutors">Преподаватели</a></li>
        <li><a href="#news">Новости</a></li>
        <li><a href="#process">Учебный процесс</a></li>
        <li><a href="/contacts">Контакты</a></li>
    </ul>
