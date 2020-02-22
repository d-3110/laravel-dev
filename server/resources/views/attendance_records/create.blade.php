@php
    $title = __('勤怠入力');
    $url = 'work_time/create';
@endphp

@extends('layouts.template')

@section('title','タイトル')
@section('description','ディスクリプション')
@include('head')

@section('content')
@include('admin.header')
<div id="app" class="container">
  <h3>{{ $title }}</h3>
  <h4><p>{{ $user->profile->name }}</p></h4>
  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
          @endforeach
    </ul>
  </div>
  @endif
  {{ Form::open(['url' => $url, 'method' => 'post']) }}
  @csrf
  @if(!empty($non_self))
  <div class="form-group">
    {{ Form::hidden('user_id', $user->id, ['id' => 'create_user_id', 'class' => 'form-control']) }}
  </div>
  @endif
  <div class="form-group">
    {{ Form::label('create_date', 'date', ['class' => 'col-form-label']) }}
    {{ Form::date('date', $date, ['id' => 'create_date', 'class' => 'form-control']) }}
  </div>
  <div class="form-group">
    {{ Form::label('create_start_time', 'start_time', ['class' => 'col-form-label']) }}
    {{ Form::time('start_time', '09:00' , ['id' => 'create_start_time', 'class' => 'form-control', 'step' => '900']) }}
  </div>
  <div class="form-group">
    {{ Form::label('create_break_time', 'break_time', ['class' => 'col-form-label']) }}
    {{ Form::time('break_time', '01:00' , ['id' => 'create_break_time', 'class' => 'form-control', 'step' => '900']) }}
  </div>
  <div class="form-group">
    {{ Form::label('create_end_time', 'end_time', ['class' => 'col-form-label']) }}
    {{ Form::time('end_time', '18:00' , ['id' => 'create_end_time', 'class' => 'form-control', 'step' => '900']) }}
  </div>
  <div class="form-group">
    {{ Form::submit('ADD', ['class' => 'btn btn-primary', 'onfocus' => 'this.blur();']) }}
  </div>
  {{ Form::close() }}
</div>
@include('script')
@endsection