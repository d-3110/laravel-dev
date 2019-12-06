@php
    $title = __('Jobs Create');
    $url = 'admin/jobs/create';
@endphp

@extends('layouts.template')

@section('title','タイトル')
@section('description','ディスクリプション')
@include('head')

@section('content')
@include('header')
<div class="container">
    <h1>{{ $title }}</h1>
    {{ Form::open(['url' => $url, 'method' => 'post']) }}
    @csrf
    <div class="form-group">
        {{ Form::label('create_name', 'name', ['class' => 'col-form-label']) }}
        {{ Form::text('name', '', ['id' => 'create_name', 'class' => 'form-control', 'placeholder' => 'Jobs Name']) }}
    </div>
    <div class="form-group">
        {{ Form::submit('ADD', ['class' => 'btn btn-primary', 'onfocus' => 'this.blur();']) }}
    </div>
    {{ Form::close() }}
</div>
@include('script')
@endsection