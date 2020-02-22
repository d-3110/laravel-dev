@php
    $title = __('有給申請一覧');
@endphp

@extends('layouts.template')

@section('title','public_user_index')
@section('description','ディスクリプション')
@section('page_style')

@stop
@include('head')

@section('content')
@include('header')
<div id="app" class="container">
  <h4>申請中一覧</h4>
  <table class="table table-hover table-sm">
    <tr class="table-success">
      <th>申請日</th>
      <th>申請者名</th>
      <th>有効期限</th>
      <th>使用日</th>
      <th>コメント</th>
      <th>状態</th>
      <th></th>
      <th></th>
    </tr>
    @foreach($holidays as $holiday)
    <tr>
      <td>{{$holiday->application_date}}</td>
      <td>{{$holiday->user_name}}</td>
      <td>{{$holiday->expire_date}}</td>
      <td>{{$holiday->use_date}}</td>
      <td>{{$holiday->comment}}</td>
      <td>{{$holiday->status_name}}</td>
      <td>
        <form action="{{ url('admin/holidays/'.$holiday->id.'/app') }}" method="POST" name="app_holiday">
          @csrf

          <!-- 承認ボタン -->
          <a href="javascript:void(0)" class="text-info" data-toggle="modal" data-target="#app_modal_{{$holiday->id}}" data-whatever="@president">
            <i class="fui fui-check-circle"></i>
          </a>
          <!-- モーダル -->
          <div class="modal fade" id="app_modal_{{$holiday->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">承認確認</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">{{$holiday->user_name}}の{{$holiday->use_date}}を承認しますか？</div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                  <button type="submit" class="btn btn-primary">OK</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </td>
      </td>
      <td>
        <form action="{{ url('admin/holidays/'.$holiday->id.'/cancel') }}" method="POST" name="cancel_holiday">
          @csrf

          <!-- CANCELボタン -->
          <a href="javascript:void(0)" class="text-danger" data-toggle="modal" data-target="#delete_modal_{{$holiday->id}}" data-whatever="@president">
            <i class="fui fui-cross-circle"></i>
          </a>
          <!-- モーダル -->
          <div class="modal fade" id="delete_modal_{{$holiday->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">取り消し確認</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">{{$holiday->user_name}}の{{$holiday->use_date}}を取り消しますか？</div>
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
  </table>
</div>
@section('page_script')
@stop
@include('script')
@endsection