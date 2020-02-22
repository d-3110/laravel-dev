@php
    $title = __('職種 一覧');
@endphp

@extends('admin.layouts.template')

@section('title','タイトル')
@section('description','ディスクリプション')
@include('head')

@section('content')
@include('admin.header')
@include('admin.sidebar')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div id="app" class=" container mt-5">
        <h4>職種一覧</h4>
        <table class="table table-striped">
            <thead>
                <tr class="table-success">
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('職種名')}}</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jobs as $job)
                    <tr>
                        <td>{{ $job->id }}</td>
                        <td>{{ $job->name }}</td>
                        <td><a href="{{ url('admin/jobs/'.$job->id.'/edit') }}"><i class="fa fa-pencil"></i></a></td>
                        <td>
                            <form action="{{ url('admin/jobs/'.$job->id.'/delete') }}" method="POST" name="delete_job">
                                @csrf
                                <input type="hidden" name="jobs">

                                <!-- DELETEボタン -->
                                <a href="javascript:void(0)" class="text-danger" data-toggle="modal" data-target="#delete_modal_{{$job->id}}" data-whatever="@president">
                                    <i class="fa fa-trash"></i>
                                </a>
                                <!-- モーダル -->
                                <div class="modal fade" id="delete_modal_{{$job->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">削除確認</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">{{ $job->name }}を削除しましか？</div>
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
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center pagination">
        {{ $jobs->links('pagination.default') }}
    </div>
</div>
</main>
@include('script')
@endsection