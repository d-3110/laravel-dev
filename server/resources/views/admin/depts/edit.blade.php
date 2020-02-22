@php
    $title = __('部署 編集');
    $url = 'admin/depts/'. $dept->id;
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
        {{ Form::text('name', $dept->name, ['id' => 'create_name', 'class' => 'form-control', 'placeholder' => 'Dept Name']) }}
    </div>
    <div class="form-group">
        {{ Form::hidden('_method', 'patch') }}
        {{ Form::submit('UPDATE', ['class' => 'btn btn-primary', 'onfocus' => 'this.blur();']) }}
    </div>
    {{ Form::close() }}
</div>
@include('script')
@endsection