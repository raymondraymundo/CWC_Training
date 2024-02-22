@extends('layouts.default')

@section('title', 'Show Article')

@section('content-header')
    <a href="{{ route('articles.index') }}" class="btn btn-primary"><i class="fa fa-reply-all"></i> Back</a>
    <ol class="breadcrumb">
        <li><p><i class="fa fa-newspaper-o"></i> Article</p></li>
        <li class="active"><a href="{{ route('articles.show', ['article' => $article->id]) }}">Show Article</a></li>
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
                    <h3 class="box-title">View Article</h3>
                </div>
                <!-- box-header -->

                <!-- box-body -->
                <div class="box-body">
                    <!-- row -->
                    <div class="row">
                        <!-- col-md-12 -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <span class="form-control">{{ $article->title }}</span>
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
                                <label for="slug">Slug</label>
                                <span class="form-control">{{ $article->slug }}</span>
                            </div>
                        </div>
                        <!-- col-md-6 -->

                        <!-- col-md-6 -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="article_category_id">Article Category</label>
                                <span class="form-control">{{ $article->articleCategory->name }}</span>
                            </div>
                        </div>
                        <!-- col-md-6 -->
                    </div>
                    <!-- row -->

                    <!-- row -->
                    <div class="row">
                        <!-- col-md-8 -->
                        <div class="col-md-8">
                            <div class="mailbox-read-message">
                                <label for="contents">Contents</label>
                                <p class="text-justify">{{ $article->contents }}</p>
                            </div>
                        </div>
                        <!-- col-md-8 -->

                        <!-- col-md-4 -->
                        <div class="col-md-4">
                            <label for="Image">Image</label>
                            <img class="img-responsive img-bordered-sm" src="{{ asset($article->image_path) }}" alt="{{ $article->title }}">
                        </div>
                        <!-- col-md-4 -->
                    </div>
                    <!-- row -->
                </div>
                <!-- box-body -->
            </div>
            <!-- box box-primary -->
        </div>
        <!-- col-md-12 -->
    </div>
    <!-- row -->
@endsection
