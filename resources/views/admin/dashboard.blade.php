@extends('layouts.admin.app')

@section('title', 'Панель управления')
@section('css')
{!! Html::style('assets/dist/css/ionicons.min.css') !!}
@endsection

@section('content')
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-dashboard"></i> Панель управления
    </h1>
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-dashboard"></i> Панель управления</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Панель управления</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>{{ $users }}</h3>
                                    <p>Users</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person"></i>
                                </div>
                                <a href="{{ url('admin/users') }}" class="small-box-footer">подробно
                                    <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>{{ $reviews }}</h3>
                                    <p>Отзывы</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-comment-o"></i>
                                </div>
                                <a href="{{ url('admin/reviews') }}" class="small-box-footer">подробно
                                    <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->

                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-gray">
                                <div class="inner">
                                    <h3>{{ $pages }}</h3>
                                    <p>Страницы</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-files-o"></i>
                                </div>
                                <a href="{{ url('admin/pages') }}" class="small-box-footer">подробно
                                    <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->

                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>{{ $requestcredits }}</h3>
                                    <p>Заявки на автокредит</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-money"></i>
                                </div>
                                <a href="{{ url('admin/requestcredits') }}" class="small-box-footer">подробно
                                    <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->

                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>{{ $requesttradeins }}</h3>
                                    <p>Заявки на Trade-in</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-bell-o"></i>
                                </div>
                                <a href="{{ url('admin/requesttradeins') }}" class="small-box-footer">подробно
                                    <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->

                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-purple">
                                <div class="inner">
                                    <h3>{{ $carmarks }}</h3>
                                    <p>Марки и модели</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-folder-open-o"></i>
                                </div>
                                <a href="{{ url('admin/carmarks') }}" class="small-box-footer">подробно
                                    <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->

                    </div><!-- /.row -->
                </div><!-- /.box-body -->
                <div class="box-footer">
                </div><!-- /.box-footer-->
            </div><!-- /.box -->
        </div><!-- /.col-md-12 -->
    </div> <!-- /.row -->
</section><!-- /.content -->
@endsection

@section('js')

    <script type="text/javascript">

    </script>

@endsection
