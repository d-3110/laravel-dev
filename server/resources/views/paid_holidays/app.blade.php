@php
    $title = __('有給申請');
    $url = 'holidays/app';
@endphp

@extends('layouts.template')

@section('title','タイトル')
@section('description','ディスクリプション')
@include('head')

@section('content')
@include('header')
<div id="app" class="container">
  <h1>{{ $title }}</h1>
  @if ($errors->any())
  <div class="alert alert-denger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
  {{ Form::open(['url' => $url, 'method' => 'post']) }}
  @csrf
  <div class="form-group">
    {{ Form::label('app_use_date', 'use_date', ['class' => 'col-form-label']) }}
    {{ Form::date('use_date', $today, ['id' => 'app_use_date', 'class' => 'form-control']) }}
  </div>
  <div class="form-group">
    {{ Form::label('app_comment', 'comment', ['class' => 'col-form-label']) }}
    {{ Form::text('comment', '' , ['id' => 'app_comment', 'class' => 'form-control']) }}
  </div>
  <div class="form-group">
    {{ Form::submit('申請', ['class' => 'btn btn-primary', 'onfocus' => 'this.blur();']) }}
  </div>
  {{ Form::close() }}
</div>
@include('script')
@endsection