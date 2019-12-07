@php
    $title = __('Users Create');
    $url = 'admin/users/create';
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
        {{ Form::label('create_email', 'email', ['class' => 'col-form-label']) }}
        {{ Form::email('email', '', ['id' => 'create_email', 'class' => 'form-control', 'placeholder' => 'email']) }}
    </div>
    <div class="form-group">
        {{ Form::label('create_deptId', 'dept', ['class' => 'col-form-label']) }}
        {{ Form::select('dept_id',
                        $depts,
                        '1',
                        ['id' => 'create_deptId', 'class' => 'form-control form-select']
                        )
        }}
    </div>
    <div class="form-group">
        {{ Form::label('create_jobId', 'job', ['class' => 'col-form-label']) }}
        {{ Form::select('job_id',
                        $jobs,
                        '1',
                        ['id' => 'create_jobId', 'class' => 'form-control form-select']
                        )
        }}
    </div>
    <div>
        {{ Form::label('create_isAdmin', 'authority', ['class' => 'col-form-label']) }}
    </div>
    <div class="form-check form-check-inline">
        <label class="radio ">
              {{ Form::radio('is_admin', '0', true, ['data-toggle' => 'radio']) }}
              General
        </label>
    </div>
    <div class="form-check form-check-inline">
        <label class="radio">
              {{ Form::radio('is_admin', '1', false, ['data-toggle' => 'radio']) }}
              Admin
        </label>
    </div>
    <div class="form-group">
        {{ Form::submit('ADD', ['class' => 'btn btn-primary', 'onfocus' => 'this.blur();']) }}
    </div>
    {{ Form::close() }}
</div>
@include('script')
@endsection