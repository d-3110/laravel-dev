@php
    $title = __('有給');
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
  <h4>残日数：{{$count}}日</h4>
  <h4>申請中：{{$app_count}}件</h4>
  <h3>
    <a class="btn btn-primary" href="{{ url('holidays/app') }}">有給申請</a>
  </h3>
  <table class="table table-hover table-sm">
    <tr class="table-success">
      <td>付与日付</td>
      <td>有効期限</td>
      <td>使用日</td>
      <td>状態</td>
    </tr>
    @foreach($holidays as $holiday)
    <tr>
      <td>{{$holiday->grant_date}}</td>
      <td>{{$holiday->expire_date}}</td>
      <td>{{$holiday->use_date}}</td>
      <td>{{$holiday->status_name}}</td>
    </tr>
    @endforeach
  </table>
</div>
@section('page_script')
@stop
@include('script')
@endsection