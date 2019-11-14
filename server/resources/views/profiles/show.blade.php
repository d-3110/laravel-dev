@php
    $title = __('Users');
@endphp

@extends('layouts.template')


@section('title','public_user_index')
@section('description','ディスクリプション')
@section('page_style')
    <!-- <link rel="stylesheet" href="{{ asset('/css/publicUserIndex.css') }}"> -->
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
  <show-profile></show-profile>
</div>
@section('page_script')
    <!-- <script src="{{ asset('js/publicUserIndex.js') }}" defer></script> -->
@stop
@include('script')
@endsection