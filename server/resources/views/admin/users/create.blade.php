@php
    $title = __('Users Regist');
    $url = 'admin/users/regist';
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
        {{ Form::label('edit_email', 'email', ['class' => 'col-form-label']) }}
        {{ Form::email('email', '', ['id' => 'edit_email', 'class' => 'form-control', 'placeholder' => 'email']) }}
    </div>
    <div class="form-group">
        {{ Form::label('edit_deptId', 'dept', ['class' => 'col-form-label']) }}
        {{ Form::select('dept_id',
                        $depts,
                        '1',
                        ['id' => 'edit_deptId', 'class' => 'form-control form-select']
                        )
        }}
    </div>
    <div class="form-group">
        {{ Form::label('edit_jobId', 'job', ['class' => 'col-form-label']) }}
        {{ Form::select('job_id',
                        $jobs,
                        '1',
                        ['id' => 'edit_jobId', 'class' => 'form-control form-select']
                        )
        }}
    </div>
    <div>
        {{ Form::label('edit_isAdmin', 'authority', ['class' => 'col-form-label']) }}
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