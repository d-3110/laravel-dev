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
<div id="app" class="container">
  <show-users v-bind:users="{{ $users }}"></show-users>
</div>
@include('script')
@endsection