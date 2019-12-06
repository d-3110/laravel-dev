@php
    $title = __('User Filter');
@endphp

@extends('layouts.template')

@section('title','タイトル')
@section('description','ディスクリプション')
@include('head')

@section('content')
@include('header')
<div class="container">
    <h1>{{ $title }}</h1>
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
@include('script')
@endsection