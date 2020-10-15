@php
    $title = __('チャットグループ作成');
    $url = 'groups/create';
@endphp

@extends('layouts.template')

@section('title','タイトル')
@section('description','ディスクリプション')
@include('head')

@section('content')
@include('header')
<div id="app" class="container">
  <h3>{{ $title }}</h3>
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
  <div class="form-group">
    {{ Form::hidden('user_id', $user->id, ['id' => 'create_user_id', 'class' => 'form-control']) }}
  </div>
  <div class="form-group">
    {{ Form::label('create_PartnerId', 'select_user', ['class' => 'col-form-label']) }}
    {{ Form::select('partner_user_id',
                    $users,
                    '1',
                    ['id' => 'create_PartnerId', 'class' => 'form-control form-select']
                    )
    }}
  </div>
  <div class="form-group">
    {{ Form::submit('Let\'s Chat', ['class' => 'btn btn-primary', 'onfocus' => 'this.blur();']) }}
  </div>
  {{ Form::close() }}
</div>
@include('script')
@endsection