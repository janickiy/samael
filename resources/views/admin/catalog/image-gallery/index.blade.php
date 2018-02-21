@extends('layouts.admin.app')

@section('title', "Фото галлерея")

@section('css')

    <!-- DataTables -->
    {!! Html::style('assets/dist/css/datatable/dataTables.bootstrap.min.css') !!}

    {!! Html::style('assets/dist/css/datatable/responsive.bootstrap.min.css') !!}

    {!! Html::style('assets/dist/css/datatable/dataTablesCustom.css') !!}

    <style type="text/css">

        .gallery {
            display: inline-block;
            margin-top: 20px;
        }

        .close-icon {
            border-radius: 50%;
            position: absolute;
            right: 5px;
            top: -10px;
            padding: 5px 8px;
        }

        .form-image-upload {
            background: #e8e8e8 none repeat scroll 0 0;
            padding: 15px;
        }

    </style>

@endsection


@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-list-alt"></i> Фото галлерея
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Панель управления</a></li>
            <li class="active"><i class="fa fa-list-alt"></i> Фото галлерея</li>
        </ol>

        <h2>{!! $mark['mark'] !!} {!! $mark['model'] !!}</h2>

    </section>



    <!-- Main content -->
    <section class="content">

        <a href="{!! url('admin/catalog/models/mark/' . $mark['id']) !!}">назад</a>

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"></h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="box-body">

                {!! Form::open(['url' => 'admin/catalog/image-gallery', 'method' => 'post', 'class' => 'form-image-upload', 'enctype' => 'multipart/form-data']) !!}

                {!! Form::hidden('id_model', $id_model) !!}

                <div class="row">
                    <div class="col-md-5">
                        <strong>Загаловок:</strong>

                        {!! Form::text('title', old('title', null), ['class' => 'form-control', 'placeholder' => 'Загаловок']) !!}

                    </div>
                    <div class="col-md-5">
                        <strong>Фото:</strong>

                        {!! Form::file('image',  ['class' => 'form-control']) !!}

                    </div>
                    <div class="col-md-2">
                        <br/>

                        {!! Form::submit( 'Загрузить', ['class' => 'btn btn-success']) !!}

                    </div>
                </div>

                {!! Form::close() !!}

                <div class="row">
                    <div class='list-group gallery'>
                        @if($images->count())
                            @foreach($images as $image)
                                <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                                    <a class="thumbnail fancybox" rel="ligthbox"
                                       href="/uploads/cars/{{ $image->image }}">
                                        <img class="img-responsive" alt="" src="/uploads/cars/{{ $image->image }}"/>
                                        <div class='text-center'>
                                            <small class='text-muted'>{{ $image->title }}</small>
                                        </div> <!-- text-center / end -->
                                    </a>

                                    {!! Form::open(['url' => 'admin/catalog/image-gallery/' . $image->id, 'method' => 'post']) !!}

                                    {!! Form::hidden('_method', 'delete') !!}

                                    <button type="submit" class="close-icon btn btn-danger"><i
                                                class="glyphicon glyphicon-remove"></i></button>

                                    {!! Form::close() !!}
                                </div> <!-- col-6 / end -->

                            @endforeach

                        @endif

                    </div> <!-- list-group / end -->
                </div> <!-- row / end -->

            </div> <!-- container / end -->
        </div><!-- /.box-body -->

        </div><!-- /.box -->
    </section><!-- /.content -->

    @include('layouts.admin.includes.message_boxes', ['item' => 'Menu', 'delete' => true])

@endsection


@section('js')

    <!-- DataTables -->

    {!! Html::script('assets/dist/js/datatable/dataTables.bootstrap.min.js') !!}

    {!! Html::script('assets/dist/js/datatable/dataTables.responsive.min.js') !!}

    {!! Html::script('assets/dist/js/datatable/responsive.bootstrap.min.js') !!}

    <script type="text/javascript">

        $(document).ready(function () {
            $(".fancybox").fancybox({
                openEffect: "none",
                closeEffect: "none"
            });
        });

    </script>
@endsection
