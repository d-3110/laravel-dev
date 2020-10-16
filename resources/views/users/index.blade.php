@php
    $title = __('ユーザ一覧');
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
<div id="app" class="container">
  <show-users :csrf="{{json_encode(csrf_token())}}" :user_id="{{ $user_id }}"></show-users>
</div>
@include('script')
@endsection