@extends('layouts.default')

@section('title', 'Dashboard')

@section('content-header')
    <h1>Dashboard</h1>
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <!-- col -->
        <div class="col-md-6 col-sm-6 col-xs-12">
            <!-- info-box -->
            <div class="info-box">
                <!-- info-box-icon -->
                <span class="info-box-icon bg-aqua">
                    <i class="fa fa-user"></i>
                </span>
                <!-- info-box-icon -->

                <!-- info-box-content -->
                <div class="info-box-content">
                    <span class="info-box-text">No. Of User</span>
                    <span class="info-box-number">10</span>
                </div>
                <!-- info-box-content -->
            </div>
            <!-- info-box -->
        </div>
        <!-- col -->

        <!-- col -->
        <div class="col-md-6 col-sm-6 col-xs-12">
            <!-- info-box -->
            <div class="info-box">
                <!-- info-box-icon -->
                <span class="info-box-icon bg-green">
                    <i class="fa fa-book"></i>
                </span>
                <!-- info-box-icon -->

                <!-- info-box-content -->
                <div class="info-box-content">
                    <span class="info-box-text">No. Of Articles</span>
                    <span class="info-box-number">10</span>
                </div>
                <!-- info-box-content -->
            </div>
            <!-- info-box -->
        </div>
        <!-- col -->
    </div>
    <!-- row -->

    <!-- row -->
    <div class="row">
        <!-- col-md-12 -->
        <div class="col-md-12">
            <!-- box box-primary -->
            <div class="box box-primary">
                <!-- box-header -->
                <div class="box-header with-border">
                    <h3 class="box-title">List of Users</h3>
                </div>
                <!-- box-header -->

                <!-- box-body -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover text-center">

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

    <!-- row -->
    <div class="row">
        <!-- col-md-12 -->
        <div class="col-md-12">
            <!-- box box-primary -->
            <div class="box box-primary">
                <!-- box-header -->
                <div class="box-header with-border">
                    <h3 class="box-title">List of Latest Articles</h3>
                </div>
                <!-- box-header -->

                <!-- box-body -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover text-center">

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
