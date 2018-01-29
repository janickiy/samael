@extends('layouts.admin.app')

@section('title', 'Марки')

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
        <i class="fa fa-list-alt"></i> Модификации
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Панель управления</a></li>
        <li class="active"><i class="fa fa-list-alt"></i> Модификации</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <p><a class="btn btn-success" href="/admin/carmodifications/create/{{ $id }}"> + Добавить модификацию </a></p>
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Список модификаций</h3>
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
                    <th>Название</th>
                    <th>Тип кузова</th>
                    <th>Длина,<br>мм</th>
                    <th>Ширина,<br>мм</th>
                    <th>Высота,<br>мм</th>
                    <th>Колесная база,<br>мм</th>
                    <th>Передняя колея колес,<br>мм</th>
                    <th>Задняя колея колес,<br>мм</th>
                    <th>Задняя колея колес,<br>мм</th>
                    <th>Задний свес,<br>мм</th>
                    <th>Минимальный объем багажного отделения,<br>л</th>
                    <th>Максимальный объем багажного отделения, л</th>
                    <th>Объем топливного бака, л</th>
                    <th>Передние тормоза (тип, размер)</th>
                    <th>Задние тормоза (тип, размер)</th>
                    <th>Передняя подвеска</th>
                    <th>Задняя подвеска</th>
                    <th>Объем двигателя, л</th>
                    <th>Рабочий объем двигателя, см3</th>
                    <th>Тип привода</th>
                    <th>Коробка передач</th>
                    <th>Коробка передач</th>
                    <th>Количество передач</th>
                    <th>Тип привода</th>
                    <th>Мощность, л.с.</th>
                    <th>Расход топлива в городе, л/100 км</th>
                    <th>Расход топлива на трассе, л/100 км</th>
                    <th>Смешанный расход топлива, л/100 км</th>
                    <th>Разгон от 0 до 100 км/ч, сек.</th>
                    <th>Максимальная скорость, км/ч</th>
                    <th>Дорожный просвет, мм</th>
                    <th>Минимальная масса, кг</th>
                    <th>Максимальная масса, кг</th>
                    <th>Допустимая масса прицепа без тормозов, кг</th>
                    <th>Опубликован</th>
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
            ajax: '{!! url("admin/datatables/catalogmodifications/{$id}") !!}',
            columns: [
                {data: 'name', name: 'name'},
                {data: 'body_type', name: 'body_type'},
                {data: 'length', name: 'length'},
                {data: 'width', name: 'width'},
                {data: 'height', name: 'height'},
                {data: 'wheel_base', name: 'wheel_base'},
                {data: 'front_rut', name: 'front_rut'},
                {data: 'back_rut', name: 'back_rut'},
                {data: 'front_overhang', name: 'front_overhang'},
                {data: 'back_overhang', name: 'back_overhang'},
                {data: 'trunk_volume_min', name: 'trunk_volume_min'},
                {data: 'trunk_volume_max', name: 'trunk_volume_max'},
                {data: 'tank_volume', name: 'tank_volume'},
                {data: 'front_brakes', name: 'front_brakes'},
                {data: 'back_brakes', name: 'back_brakes'},
                {data: 'front_suspension', name: 'front_suspension'},
                {data: 'back_suspension', name: 'back_suspension'},
                {data: 'engine_displacement', name: 'engine_displacement'},
                {data: 'engine_displacement_working_value', name: 'engine_displacement_working_value'},
                {data: 'engine_type', name: 'engine_type'},
                {data: 'gearbox', name: 'gearbox'},
                {data: 'gears', name: 'gears'},
                {data: 'drive', name: 'drive'},
                {data: 'power', name: 'power'},
                {data: 'consume_city', name: 'consume_city'},
                {data: 'consume_track', name: 'consume_track'},
                {data: 'consume_mixed', name: 'consume_mixed'},
                {data: 'acceleration_100km', name: 'acceleration_100km'},
                {data: 'max_speed', name: 'max_speed'},
                {data: 'clearance', name: 'clearance'},
                {data: 'min_mass', name: 'min_mass'},
                {data: 'max_mass', name: 'max_mass'},
                {data: 'trailer_mass', name: 'trailer_mass'},
                {data: 'status', name: 'status'},
                {data: 'actions', name: 'actions', orderable: false, searchable: false}
            ]
        });
        //table.column('0:visible').order('desc').draw();
    });
</script>
@endsection
