@extends('layouts.default')

@section('title', 'Edit Article')

@section('content-header')
    <a href="{{ route('articles.index') }}" class="btn btn-primary"><i class="fa fa-reply-all"></i> Back</a>
    <ol class="breadcrumb">
        <li><p><i class="fa fa-newspaper-o"></i> Article</p></li>
        <li class="active"><a href="{{ route('articles.edit', ['article' => $article->id]) }}">Edit Article</a></li>
    </ol>
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <!-- col-md-12 -->
        <div class="col-md-12">
            <!-- box box-primary -->
            <div class="box box-primary">
                <!-- box-header -->
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Article</h3>
                </div>
                <!-- box-header -->

                <!-- <form action="{{ route('articles.update', ['article' => $article->id]) }}" method="POST" enctype="multipart/form-data"> -->
                <form action="https://cwc-training-blog-app.local.host/articles/{{ $article->id }}" method="POST" enctype="multipart/form-data">
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
                                    <label for="title">Title*</label>
                                    <input type="text" name="title" id="title" value="{{ $article->title }}" class="form-control">
                                    <span class="text-danger">{{ $errors->first('title') }}</span>
                                </div>
                            </div>
                            <!-- col-md-12 -->
                        </div>
                        <!-- row -->

                        <!-- row -->
                        <div class="row">
                            <!-- col-md-6 -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="slug">Slug*</label>
                                    <input type="text" name="slug" id="slug" value="{{ $article->slug }}" class="form-control">
                                    <span class="text-danger">{{ $errors->first('slug') }}</span>
                                </div>
                            </div>
                            <!-- col-md-6 -->

                            <!-- col-md-6 -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="article_category_id">Article Category*</label>
                                    <select name="article_category_id" id="article_category_id" class="form-control select2" style="width: 100%;">
                                        <option></option>
                                        @foreach($articleCategories as $articleCategory)
                                            @if($articleCategory->id == $article->articleCategory->id)
                                                <option value="{{ $articleCategory->id }}" selected>{{ $articleCategory->name }}</option>
                                            @else
                                                <option value="{{ $articleCategory->id }}">{{ $articleCategory->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span class="text-danger">{{ $errors->first('article_category_id') }}</span>
                                </div>
                            </div>
                            <!-- col-md-6 -->
                        </div>
                        <!-- row -->

                        <!-- row -->
                        <div class="row">
                            <!-- col-md-8 -->
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="image">Image (Optional)</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                    <span class="text-danger">{{ $errors->first('image') }}</span>
                                </div>
                            </div>
                            <!-- col-md-8 -->
                        </div>
                        <!-- row -->

                        <!-- row -->
                        <div class="row">
                            <!-- col-md-8 -->
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="contents">Contents*</label>
                                    <textarea name="contents" id="contents" cols="30" rows="10" class="form-control">{{ $article->contents }}</textarea>
                                    <span class="text-danger">{{ $errors->first('contents') }}</span>
                                </div>
                            </div>
                            <!-- col-md-8 -->
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
        <!-- col-md-12 -->
    </div>
    <!-- row -->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize Select2 Elements
            $('.select2').select2({
                placeholder: 'Select an option',
                allowClear: true,
            });

            $('#btnReset').click(function() {
                $('.text-danger').html('');
            });
        });
    </script>
@endpush
