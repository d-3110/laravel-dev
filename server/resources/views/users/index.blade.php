@php
    $title = __('Users');
@endphp

@extends('layouts.template')


@section('title','public_user_index')
@section('description','ディスクリプション')
@section('page_style')
    <link rel="stylesheet" href="{{ asset('/css/publicUserIndex.css') }}">
@stop
@include('head')

@section('content')
@include('header')

<!-- 検索フォーム　-->
<div class="col-sm-4" style="padding:20px 0; padding-left:0px;">
  <form class="form-inline" action="{{url('admin/users')}}">
      @csrf
    <div class="form-group">
    <input type="text" name="keyword" value="{{$keyword}}" class="form-control" placeholder="name or email">
    </div>
    <button type="submit" class="login-button btn btn-info"><i class="fa fa-search"></i></button>
  </form>
</div>
<div id="app">
  <div class="card-deck">
    <div class="row">
    @foreach($users as $user)
        <div class="col-sm-3">
          <div class="card h-100">
            <img class="card-img-top" src="/storage/mysteryman.png" alt="profile_img">
            <div class="card-body">
              <h5 class="card-title">{{ $user->profile->name }}</h5>
              <p class="card-text">{{ $user->dept->name }}</p>
              <p class="card-text">{{ $user->job->name }}</p>
              <a href="#" class="btn btn-primary">detail</a>
            </div>
          </div>
        </div>
    @endforeach
    </div>
  </div>
</div>
@section('page_script')
    <script src="{{ asset('js/publicUserIndex.js') }}" defer></script>
@stop
@include('script')
@endsection