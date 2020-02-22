@php
    $title = __('マイページ');
@endphp

@extends('layouts.template')


@section('title','public_user_index')
@section('description','ディスクリプション')
@section('page_style')
    <link rel="stylesheet" href="{{ asset('/css/showProfile.css') }}">
@stop
@include('head')

@section('content')
@include('header')
<div id="app">
  <show-profile :profile="{{ $profile }}"></show-profile>
</div>
@section('page_script')

@stop
@include('script')
@endsection