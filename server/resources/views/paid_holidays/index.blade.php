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
  <h2>残日数：<a href="#">{$}日</a></h2>
  <table>
    <tr>
      <td>日付</td>
      <td>使用</td>
      <td>状態</td>
    </tr>
    @foreach
    <tr>
      <td>2019/12/1</td>
      <td>1</td>
      <td>承諾済</td>
    </tr>
    @endforeach
  </table>
</div>
@section('page_script')
<script type="text/javascript">
  // 土日の行に色をつける
  $('td:contains("Sat")').parent("tr").addClass("table-info");
  $('td:contains("Sun")').parent("tr").addClass("table-danger");
</script>
@stop
@include('script')
@endsection