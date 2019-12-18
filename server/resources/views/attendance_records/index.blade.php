@php
    $title = __('きんたい');
    $current_ym = "{$current_date['year']}/{$current_date['month']}";
    $current_ymd = "{$current_date['year']}/{$current_date['month']}/{$current_date['day']}";
    $prev_url = "work_time/{$prev_date['year']}/{$prev_date['month']}";
    $next_url = "work_time/{$next_date['year']}/{$next_date['month']}";
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
  <!-- 月別画面（初期画面 -->
  <h1 class="date_title">
    <a href="{{ url($prev_url) }}"> << </a>
    <div>{{ $current_date['year'] }}年{{ $current_date['month'] }}月</div>
    <a href="{{ url($next_url) }}"> >> </a>
  </h1>
  <h2>
    <a class="btn btn-primary" href="{{ url(url('work_time/'.$current_ymd. '/create')) }}">勤怠入力</a>
  </h2>
  <table class="table table-hover table-sm">
    <tr class="table-success">
      <td>日付</td>
      <td>曜日</td>
      <td>出勤</td>
      <td>退勤</td>
      <td>実働</td>
      <td></td>
      <td></td>
    </tr>
  @foreach($calendar as $date)
    <tr>
      @if($current_date['day'] == $date['day'] )
          <td><span class="today">{{ $date['day'] }}</span></td>
      @else
          <td>{{ $date['day'] }}</td>
      @endif
      <td>{{ $date['week'] }}</td>
      <td>{{ $date['start_time'] }}</td>
      <td>{{ $date['end_time'] }}</td>
      <td>{{ $date['actual'] }}</td>
      @if($date['id'] !== 0)
        <td>
          <!-- EDITボタン -->
          <a href="{{ url('work_time/'. $date['id']. '/edit') }}">
            <i class="fa fa-pencil"></i>
          </a>
        </td>
      @else
        <td>
          <!-- CREATEボタン -->
          <a href="{{ url('work_time/'.$current_ym. '/'.$date['day']. '/create') }}">
            <i class="fa fa-pencil"></i>
          </a>
        </td>
      @endif
      <td>
        <form action="{{ url('work_time/'. $date['id']. '/delete') }}" method="POST" name="delete_record">
          @csrf
          <input type="hidden" name="attendance_record">

          <!-- DELETEボタン -->
          <a href="javascript:void(0)" class="text-danger" data-toggle="modal" data-target="#delete_modal_{{$date['id']}}" data-whatever="@president">
            <i class="fa fa-trash"></i>
          </a>
          <!-- モーダル -->
          <div class="modal fade" id="delete_modal_{{$date['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">削除確認</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">{{$current_ym. '/'. $date['day']}}を削除しましか？</div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                  <button type="submit" class="btn btn-primary">OK</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </td>
    </tr>
  @endforeach
    <tr>
      <td colspan="6">実働合計</td>
      <td>{{$total}}h</td> <!-- 別変数でcontrollerからもらっておく -->
    </tr>
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