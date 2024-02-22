@extends('layouts.default')

@section('title', 'Article Category List')

@section('content-header')
    <a href="{{ route('article_categories.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Article Category</a>
    <ol class="breadcrumb">
        <li><p><i class="fa fa-newspaper-o"></i> Article Category</p></li>
        <li class="active"><a href="{{ route('article_categories.index') }}">Article Category List</a></li>
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
                    <h3 class="box-title">List of Article Categories</h3>
                </div>
                <!-- box-header -->

                <!-- box-body -->
                <div class="box-body">
                    @include('component.errors_and_messages')

                    <div class="table-responsive">
                        <table id="articleCategoriesTable" class="table table-bordered table-striped table-hover text-center">
                            <thead>
                                <tr>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Created By</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($articleCategories as $articleCategory)
                                    <tr>
                                        <td>{{ $articleCategory->name }}</td>
                                        <td>{{ $articleCategory->user->first_name . ' ' . $articleCategory->user->last_name }}</td>
                                        <td colspan="2">
                                            <!-- <form action="{{ route('article_categories.destroy', ['article_category', $articleCategory->id]) }}" method="POST"> -->
                                            <form action="https://cwc-training-blog-app.local.host/article_categories/{{ $articleCategory->id }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <a href="{{ route('article_categories.edit', ['article_category' => $articleCategory->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                                <button type="submit" onclick="return confirm('Are you sure you want to delete this article category?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
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
        $('#articleCategoriesTable').DataTable();
    </script>
@endpush