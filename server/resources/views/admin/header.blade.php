@section('header')
<nav class="navbar navbar-inverse navbar-embossed navbar-expand-lg  mb-0" role="navigation">
  <a class="navbar-brand" href="#">Laravel APP!</a>
  <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-01"></button>
  <div class="collapse navbar-collapse" id="navbar-collapse-01">
    <ul class="nav navbar-nav mr-auto">
      <li class="nav-item">
        <a href="{{ url('mypage/') }}" class="nav-link px-3">マイページ</a>
      </li>
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
  </div><!-- /.navbar-collapse -->
</nav>
@endsection