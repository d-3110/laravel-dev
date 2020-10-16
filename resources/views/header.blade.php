@section('header')
<nav class="navbar navbar-inverse navbar-embossed navbar-expand-lg" role="navigation">
  <a class="navbar-brand" href="/">Laravel APP!</a>
  <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-01"></button>
  <div class="collapse navbar-collapse" id="navbar-collapse-01">
    <ul class="nav navbar-nav mr-auto">
      <!-- <li><a href="#fakelink">hoge<span class="navbar-unread">1</span></a></li> -->
      <li class="nav-item">
        <a href="{{ url('users/') }}" class="nav-link px-3">ユーザ一覧</a>
      </li>
      <li class="nav-item">
        <a href="{{ url('mypage/') }}" class="nav-link px-3">マイページ</a>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">チャット</a>
        <span class="dropdown-arrow"></span>
        <ul class="dropdown-menu">
          <li><a href="{{ url('groups/create/') }}">チャット開始</a></li>
          <li><a href="{{ url('groups/') }}">参加一覧</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">勤怠管理</a>
        <span class="dropdown-arrow"></span>
        <ul class="dropdown-menu">
          <li><a href="{{ url('work_time/list/') }}">当月勤怠</a></li>
          <li><a href="{{ url('work_time/create/') }}">勤怠入力</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">有休管理</a>
        <span class="dropdown-arrow"></span>
        <ul class="dropdown-menu">
          <li><a href="{{ url('holidays/') }}">有休一覧</a></li>
          <li><a href="{{ url('holidays/app/') }}">有休申請</a></li>
        </ul>
      </li>
      @if(Auth::User()->is_admin === 1)
      <li class="nav-item">
        <a href="{{ url('admin/users/') }}" class="nav-link px-3">管理者ページ</a>
      </li>
      @endif
     </ul>
     <ul class="nav navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            {{ __('ログアウト') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
      </li>
    </ul>
     <!-- 検索封印 -->
     <!-- <form class="navbar-form form-inline my-2 my-lg-0" action="#" role="search">
      <div class="form-group">
        <div class="input-group">
          <input class="form-control" id="navbarInput-01" type="search" placeholder="Search">
          <span class="input-group-btn">
            <button type="submit" class="btn"><span class="fui-search"></span></button>
          </span>
        </div>
      </div>
    </form> -->
  </div><!-- /.navbar-collapse -->
</nav>
@endsection