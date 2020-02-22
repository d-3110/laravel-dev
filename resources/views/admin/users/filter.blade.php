@php
    $title = __('ユーザ 詳細検索');
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
        {{ Form::open(['url' => 'admin/users/', 'method' => 'get']) }}
        @csrf
        <div class="form-group">
            {{ Form::label('filter_deptId', 'dept', ['class' => 'col-form-label']) }}
            {{ Form::select('dept_id',
                            $depts,
                            null,
                            ['id' => 'filter_deptId', 'class' => 'form-control form-select'],
                            ['placeholder' => '選択してください']
                            )
            }}
        </div>
        <div class="form-group">
            {{ Form::label('filter_jobId', 'job', ['class' => 'col-form-label']) }}
            {{ Form::select('job_id',
                            $jobs,
                            null,
                            ['id' => 'filter_jobId', 'class' => 'form-control form-select'],
                            ['placeholder' => '選択してください']
                            )
            }}
        </div>
        <div class="form-group">
            {{ Form::hidden('_method', 'patch') }}
            {{ Form::submit('絞り込み', ['class' => 'btn btn-primary', 'onfocus' => 'this.blur();']) }}
        </div>
        {{ Form::close() }}
    </div>
</main>
@include('script')
@endsection