@extends('admin.layouts.admin')

@section('title', trans('uploader::admin.title'))

@section('content')
@if($errors->any())
    <div class="alert alert-danger" role="alert">
        @foreach($errors->all() as $error)
            - {{ $error }} <br>
        @endforeach
    </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('uploader.admin.file.add') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm">
                        <lable for="file-name">{{ trans('uploader::admin.file_name') }}</lable>
                        <input name="title" id="file-name" class="form-control" type="text">
                    </div>
                    <div class="col-sm">
                        <lable for="file-name">{{ trans('uploader::admin.select_file') }}</lable>
                        <input name="file" id="file-name" class="form-control" type="file">
                    </div>
            </div>
            <div class="mt-3">
            <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> {{ trans('uploader::admin.button_add') }}</button>
            </div>
        </form>
    </div>
        @if($files->count())
<div class="container-fluid">
        <table class="table table-dark">
            <thead>
            <tr>
                <th scope="col">{{ trans('uploader::admin.file_name') }}</th>
                <th scope="col">{{ trans('uploader::admin.link') }}</th>
                <th scope="col">{{ trans('uploader::admin.action') }}</th>
            </tr>
            </thead>
            <tbody>

            @foreach($files as $file)
            <tr>
                <td>{{ $file->title }}</td>
                <td><a href="{{ config('app.url') . Storage::url($file->link) }}" class="">{{ config('app.url') . Storage::url($file->link) }}</a></td>
                <td>
                    <form method="POST" action="{{ route('uploader.admin.file.remove', $file) }}">
                        @csrf
                            <button type="submit" class="btn btn-danger "><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach

            </tbody>
        </table>

</div>
@endif
@endsection
