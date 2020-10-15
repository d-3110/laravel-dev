@php
    $title = __('チャット');
@endphp

@extends('layouts.template')


@section('title','public_user_index')
@section('description','ディスクリプション')
@section('page_style')
    <link rel="stylesheet" href="{{ asset('/css/chat.css') }}">
@stop
@include('head')

@section('content')
@include('header')
<div id="app" class="container">
  <chat :group_id="{{ $group_id }}" :user_id="{{ $user_id }}"></chat>
</div>
@include('script')
@endsection