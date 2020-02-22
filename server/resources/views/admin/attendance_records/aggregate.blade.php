@php
    $title = __('きんたい');
    $current_ym = "{$current_date['year']}/{$current_date['month']}";
    $current_ymd = "{$current_date['year']}/{$current_date['month']}/{$current_date['day']}";
    $prev_url = "admin/work_time/list/{$prev_date['year']}/{$prev_date['month']}";
    $next_url = "admin/work_time/list/{$next_date['year']}/{$next_date['month']}";
@endphp

@extends('layouts.template')


@section('title','public_user_index')
@section('description','ディスクリプション')
@section('page_style')
  <link rel="stylesheet" href="{{ asset('/css/showAttendanceRecord.css') }}">
@stop
@include('head')

@section('content')
@include('header')
<div id="app" class="container">
  <!-- 月別画面（初期画面) -->
  <h3 class="date_title">
    <a href="{{ url($prev_url) }}"> << </a>
    <div>{{ $current_date['year'] }}年{{ $current_date['month'] }}月</div>
    <a href="{{ url($next_url) }}"> >> </a>
  </h3>
  <h4>
    <a class="btn btn-primary" href="{{ url('admin/work_time/'.$current_ymd. '/create') }}">勤怠入力</a>
  </h4>
  <table class="table table-hover table-sm">
    <tr class="table-success">
      <td>ユーザID</td>
      <td>ユーザ名</td>
      <td>実働時間</td>
      <td></td>
    </tr>
  @foreach($users as $user)
    <tr>
      <td>{{ $user->id }}</td>
      <td>{{ $user->profile->name }}</td>
      <td>{{ $user->total }}h</td>
      <td></td>
    </tr>
  @endforeach
    <tr>
      <td colspan="3">月合計稼働時間</td>
      <td>{{$total}}h</td> <!-- 別変数でcontrollerからもらっておく -->
    </tr>
  </table>
</div>
@include('script')
@endsection