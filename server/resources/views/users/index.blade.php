@php
    $title = __('Users');
@endphp

@extends('layouts.template')

@section('title','タイトル')
@section('description','ディスクリプション')
@include('head')

@section('content')
@include('header')
    <!-- 検索フォーム　-->
    <div class="col-sm-4" style="padding:20px 0; padding-left:0px;">
    <form class="form-inline" action="{{url('/users')}}">
        @csrf
      <div class="form-group">
      <input type="text" name="keyword" value="{{$keyword}}" class="form-control" placeholder="name or email">
      </div>
      <button type="submit" class="login-button btn btn-info"><i class="fa fa-search"></i></button>
    </form>
    </div>

    <div class="table-responsive table">
        <table class="table table-striped">
            <thead>
                <tr class="table-success">
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('NAME')}}</th>
                    <th>{{ __('EMAIL') }}</th>
                    <th>{{ __('DEPT') }}</th>
                    <th>{{ __('JOB') }}</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td><a href="{{ url('users/'.$user->id.'/edit') }}">{{ $user->id }}</a></td>
                        <td>{{ optional($user->profile)->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->dept->name }}</td>
                        <td>{{ $user->job->name }}</td>
                        <td><a href="{{ url('admin/users/'.$user->id.'/edit') }}"><i class="fa fa-pencil"></i></a></td>
                        <td>
                            <form action="{{ url('admin/users/'.$user->id.'/delete') }}" method="POST" name="delete_user">
                                @csrf
                                <input type="hidden" name="users">
                                <div class="" onClick="delete_alert(event);return false;">
                                    <i class="fa fa-trash"></i>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center pagination">
        {{ $users->links('pagination.default') }}
    </div>
</div>
<!-- <script>
function delete_alert(e){
   if(!window.confirm('本当に削除しますか？')){
      window.alert('キャンセルされました'); 
      return false;
   }
   document.deleteform.submit();
};
</script> -->

@endsection