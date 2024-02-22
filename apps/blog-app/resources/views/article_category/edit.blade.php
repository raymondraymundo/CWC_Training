@extends('layouts.default')

@section('title', 'Edit Article Category')

@section('content-header')
    <a href="{{ route('article_categories.index') }}" class="btn btn-primary"><i class="fa fa-reply-all"></i> Back</a>
    <ol class="breadcrumb">
        <li><p><i class="fa fa-newspaper-o"></i> Article Category</p></li>
        <li class="active"><a href="{{ route('article_categories.edit', ['article_category' => $articleCategory->id]) }}">Edit Article Category</a></li>
    </ol>
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <!-- col-md-6 -->
        <div class="col-md-6">
            <!-- box box-primary -->
            <div class="box box-primary">
                <!-- box-header -->
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Article Category</h3>
                </div>
                <!-- box-header -->

                <!-- <form action="{{ route('article_categories.update', ['article_category', $articleCategory->id]) }}" method="POST"> -->
                <form action="https://cwc-training-blog-app.local.host/article_categories/{{ $articleCategory->id }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- box-body -->
                    <div class="box-body">
                        @include('component.errors_and_messages')

                        <!-- row -->
                        <div class="row">
                            <!-- col-md-12 -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Name*</label>
                                    <input type="text" name="name" id="name" value="{{ $articleCategory->name }}" class="form-control">
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                </div>
                            </div>
                            <!-- col-md-12 -->
                        </div>
                        <!-- row -->
                    </div>
                    <!-- box-body -->

                    <!-- box-footer -->
                    <div class="box-footer">
                        <div class="btn-group pull-right">
                            <button type="reset" name="btnReset" id="btnReset" class="btn btn-default">Reset</button>
                            <button type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    <!-- box-footer -->
                </form>
            </div>
            <!-- box box-primary -->
        </div>
        <!-- col-md-6 -->
    </div>
    <!-- row -->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#btnReset').click(function() {
                $('.text-danger').html('');
            });
        });
    </script>
@endpush
