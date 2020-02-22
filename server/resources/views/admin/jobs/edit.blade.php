@php
    $title = __('職種 編集');
    $url = 'admin/jobs/'. $job->id;
@endphp

@extends('admin.layouts.template')

@section('title','タイトル')
@section('description','ディスクリプション')
@include('head')

@section('content')
@include('admin.header')
@include('admin.sidebar')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div id="app" class="container mt-5">
        <h4>{{ $title }}</h4>
        {{ Form::open(['url' => $url, 'method' => 'post']) }}
        @csrf
       <div class="form-group">
            {{ Form::label('create_name', 'name', ['class' => 'col-form-label']) }}
            {{ Form::text('name', $job->name, ['id' => 'create_name', 'class' => 'form-control', 'placeholder' => 'Jobs Name']) }}
        </div>
        <div class="form-group">
            {{ Form::hidden('_method', 'patch') }}
            {{ Form::submit('UPDATE', ['class' => 'btn btn-primary', 'onfocus' => 'this.blur();']) }}
        </div>
        {{ Form::close() }}
    </div>
</main>
@include('script')
@endsection