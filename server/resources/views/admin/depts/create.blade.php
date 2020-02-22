@php
    $title = __('部署 新規登録');
    $url = 'admin/depts/create';
@endphp

@extends('layouts.template')

@section('title','タイトル')
@section('description','ディスクリプション')
@include('head')

@section('content')
@include('header')
<div id="app" class="container">
    <h1>{{ $title }}</h1>
    {{ Form::open(['url' => $url, 'method' => 'post']) }}
    @csrf
    <div class="form-group">
        {{ Form::label('create_name', 'name', ['class' => 'col-form-label']) }}
        {{ Form::text('name', '', ['id' => 'create_name', 'class' => 'form-control', 'placeholder' => 'Dept Name']) }}
    </div>
    <div class="form-group">
        {{ Form::submit('ADD', ['class' => 'btn btn-primary', 'onfocus' => 'this.blur();']) }}
    </div>
    {{ Form::close() }}
</div>
@include('script')
@endsection