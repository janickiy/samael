@extends('layouts.admin.app')

@section('title', 'Заявки на автокредит')

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
            <i class="fa fa-bell-o"></i>Заявки на автокредит
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Панель управления</a></li>
            <li class="active"><i class="fa fa-bell-o"></i> Заявки на автокредит</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Заявки</h3>
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
                        <th>ID заявки</th>
                        <th>Марка</th>
                        <th>Модель</th>
                        <th>Комплектация</th>
                        <th>Есть автомобиль<br>в Trade-In</th>
                        <th>Первоначальный взнос</th>
                        <th>ФИО</th>
                        <th>Телефон</th>
                        <th>Возраст</th>
                        <th>Регистрация</th>
                        <th>IP</th>
                        <th>Время заявки</th>
                        <th>Статус</th>
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

    @include('layouts.admin.includes.message_boxes', ['item' => 'Review', 'delete' => true])

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
                ajax: '{!! url("admin/datatables/requestcredits") !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'mark', name: 'mark'},
                    {data: 'model', name: 'model'},
                    {data: 'complectation', name: 'complectation'},
                    {data: 'tradein_available', name: 'tradein_available'},
                    {data: 'fee', name: 'fee'},
                    {data: 'name', name: 'name'},
                    {data: 'phone', name: 'phone'},
                    {data: 'age', name: 'age'},
                    {data: 'registration', name: 'registration'},
                    {data: 'ip', name: 'ip'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'status', name: 'status'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false}
                ]
            });
            //table.column('0:visible').order('desc').draw();
        });

    </script>
@endsection
