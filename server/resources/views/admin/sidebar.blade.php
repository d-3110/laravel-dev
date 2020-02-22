@section('sidebar')
<nav class="col-md-2 d-none d-md-block bg-light sidebar">
  <div class="sidebar-sticky">
    <ul class="nav flex-column">
      <!-- <li class="nav-item">
        <a class="nav-link active" href="#">
          <span class="fui-home"></span>
          DashBoard
        </a>
      </li> -->
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="dropdown">
          <span class="fui-user"></span>
          ユーザ管理
        </a>
        <ul class="dropdown-menu">
          <li><a href="{{ url('admin/users/create/') }}">新規作成</a></li>
          <li><a href="{{ url('admin/users/') }}">一覧</a></li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="dropdown">
          <span class="fui-gear"></span>
          部署管理
        </a>
        <ul class="dropdown-menu">
          <li><a href="{{ url('admin/depts/create/') }}">新規作成</a></li>
          <li><a href="{{ url('admin/depts/') }}">一覧</a></li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="dropdown">
          <span class="fui-gear"></span>
          職種管理
        </a>
        <ul class="dropdown-menu">
          <li><a href="{{ url('admin/jobs/create/') }}">新規作成</a></li>
          <li><a href="{{ url('admin/jobs/') }}">一覧</a></li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/work_time/aggregate') }}">
          <span class="fui-calendar"></span>
          当月勤怠表
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/work_time/aggregate') }}">
          <span class="fui-calendar"></span>
          有休申請中一覧
        </a>
      </li>
    </ul>
  </div>
</nav>
@endsection