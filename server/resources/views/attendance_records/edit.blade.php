@php
    $title = __('勤怠編集');
    $url = 'work_time/edit';
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
  <div class="alert alert-alert-danger">
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
    {{ Form::label('edit_date', 'date', ['class' => 'col-form-label']) }}
    {{ Form::date('date', $record->date, ['id' => 'edit_date', 'class' => 'form-control']) }}
  </div>
  <div class="form-group">
    {{ Form::label('edit_start_time', 'start_time', ['class' => 'col-form-label']) }}
    {{ Form::time('start_time', $record->start_time , ['id' => 'edit_start_time', 'class' => 'form-control']) }}
  </div>
  <div class="form-group">
    {{ Form::label('edit_break_time', 'break_time', ['class' => 'col-form-label']) }}
    {{ Form::time('break_time', $record->break_time , ['id' => 'edit_break_time', 'class' => 'form-control']) }}
  </div>
  <div class="form-group">
    {{ Form::label('edit_end_time', 'end_time', ['class' => 'col-form-label']) }}
    {{ Form::time('end_time', $record->end_time , ['id' => 'edit_end_time', 'class' => 'form-control']) }}
  </div>
  <div class="form-group">
    {{ Form::submit('UPDATE', ['class' => 'btn btn-primary', 'onfocus' => 'this.blur();']) }}
  </div>
  {{ Form::close() }}
</div>
@include('script')
@endsection