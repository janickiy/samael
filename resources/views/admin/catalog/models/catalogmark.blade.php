@extends('layouts.admin.app')

@section('title', 'Модели')

@section('css')

    <!-- DataTables -->
    {!! Html::style('assets/dist/css/datatable/dataTables.bootstrap.min.css') !!}

    {!! Html::style('assets/dist/css/datatable/responsive.bootstrap.min.css') !!}

    {!! Html::style('assets/dist/css/datatable/dataTablesCustom.css') !!}

@endsection


@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-list-alt"></i> Модели {{ $catalogmark->name }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Панель управления</a></li>
            <li class="active"><i class="fa fa-list-alt"></i> Модели</li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <p><a class="btn btn-success" href="/admin/catalog/models/create/{{ $catalogmark->id }}"> + Добавить модель </a>
        </p>

        <a href="{{ url('/admin/catalog/marks') }}">назад</a>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Модели</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="box-body">
                <table id="data_table" class="table datatable dt-responsive" style="width:100%;">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th>Фото</th>
                        <th>Статус</th>
                        <th>Созданно</th>
                        <th>Обновлено</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>


                    </tbody>
                </table>
            </div><!-- /.box-body -->
            <div class="box-footer">
                <p class="text-muted small">
                    <i class="fa fa-pencil"></i> Редактировать |
                    <i class="fa fa-remove"></i> Удалить
                </p>
            </div><!-- /.box-footer-->
        </div><!-- /.box -->
    </section><!-- /.content -->

    @include('layouts.admin.includes.message_boxes', ['item' => 'Menu', 'delete' => true])

@endsection


@section('js')

    <!-- DataTables -->
    {!! Html::script('assets/dist/js/datatable/jquery.dataTables.min.js') !!}

    {!! Html::script('assets/dist/js/datatable/dataTables.bootstrap.min.js') !!}

    {!! Html::script('assets/dist/js/datatable/dataTables.responsive.min.js') !!}

    {!! Html::script('assets/dist/js/datatable/responsive.bootstrap.min.js') !!}

    <script type="text/javascript">
        $(document).ready(function () {

            var table = $("#data_table").DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! url("admin/datatables/catalogmarkmodels/$catalogmark->id") !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'image', name: 'image'},
                    {data: 'status', name: 'status'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false}
                ]
            });
            //table.column('0:visible').order('desc').draw();
        });

    </script>
@endsection
