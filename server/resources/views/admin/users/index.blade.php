@php
    $title = __('Users');
@endphp

@extends('layouts.template')

@section('title','タイトル')
@section('description','ディスクリプション')
@include('head')

@section('content')
@include('header')
<div id="app" class="container">
    <!-- 検索フォーム -->
    <div class="col-sm-12 clearfix">
        <div class="float-right clearfix">
            <form class="form-inline" action="{{url('admin/users')}}">
                @csrf
              <div class="form-group">
              <input type="text" name="keyword" value="{{$keyword}}" class="form-control" placeholder="name or email">
              </div>
              <button type="submit" class="login-button btn btn-info"><i class="fa fa-search"></i></button>
            </form>
            <div class="float-right">
                <a href="{{ url('/admin/users/filter') }}">詳細検索</a>
            </div>
        </div>
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
                        <td>{{ $user->id }}</td>
                        <td>{{ optional($user->profile)->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->dept->name }}</td>
                        <td>{{ $user->job->name }}</td>
                        <td><a href="{{ url('admin/users/'.$user->id.'/edit') }}"><i class="fa fa-pencil"></i></a></td>
                        <td>
                            <form action="{{ url('admin/users/'.$user->id.'/delete') }}" method="POST" name="delete_user">
                                @csrf
                                <input type="hidden" name="users">

                                <!-- DELETEボタン -->
                                <a href="javascript:void(0)" class="text-danger" data-toggle="modal" data-target="#delete_modal_{{$user->id}}" data-whatever="@president">
                                    <i class="fa fa-trash"></i>
                                </a>
                                <!-- モーダル -->
                                <div class="modal fade" id="delete_modal_{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">削除確認</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">{{optional($user->profile)->name}}さんを削除しましか？</div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                                                <button type="submit" class="btn btn-primary">OK</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="d-flex justify-content-center pagination">
    {{ $users->links('pagination.default') }}
</div>
</div>
@include('script')
@endsection