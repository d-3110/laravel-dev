@php
    $title = __('ユーザ 登録');
    $url = 'admin/users/create';
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
</main>
@include('script')
@endsection