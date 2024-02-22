@extends('layouts.default')

@section('title', 'Article List')

@section('content-header')
    <a href="{{ route('articles.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Article</a>
    <ol class="breadcrumb">
        <li><p><i class="fa fa-newspaper-o"></i> Article</p></li>
        <li class="active"><a href="{{ route('articles.index') }}">Article List</a></li>
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
                    <h3 class="box-title">List of Article</h3>
                </div>
                <!-- box-header -->

                <!-- box-body -->
                <div class="box-body">
                    @include('component.errors_and_messages')

                    <div class="table-responsive">
                        <table id="articlesTable" class="table table-bordered table-striped table-hover text-center">
                            <thead>
                                <tr>
                                    <th class="text-center">Title</th>
                                    <th class="text-center">Slug</th>
                                    <th class="text-center">Article Category</th>
                                    <th class="text-center">Created By</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($articles as $article)
                                    <tr>
                                        <td>{{ $article->title }}</td>
                                        <td>{{ $article->slug }}</td>
                                        <td>{{ $article->articleCategory->name }}</td>
                                        <td>{{ $article->user->first_name . ' ' . $article->user->last_name }}</td>
                                        <td colspan="3">
                                            <!-- <form action="{{ route('articles.destroy', ['article', $article->id]) }}" method="POST"> -->
                                            <form action="https://cwc-training-blog-app.local.host/articles/{{ $article->id }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <a href="{{ route('articles.show', ['article' => $article->id]) }}" class="btn btn-default btn-sm"><i class="fa fa-eye"></i> Show</a>
                                                <a href="{{ route('articles.edit', ['article' => $article->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                                <button type="submit" onclick="return confirm('Are you sure you want to delete this article?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- box-body -->
            </div>
            <!-- box box-primary -->
        </div>
        <!-- col-md-12 -->
    </div>
    <!-- row -->
@endsection

@push('scripts')
    <script>
        $('#articlesTable').DataTable();
    </script>
@endpush