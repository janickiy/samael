@extends('layouts.admin.app')

@section('title', 'Модификации')

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
    <p><a class="btn btn-success" href="{{ url('/admin/catalog/modifications/create/' . $id) }}"> + Добавить модификацию </a></p>
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
                    <th>Комлектация</th>

                </tr>
                </thead>
                <tbody>

                @foreach($)
                <tr >
                    <td class="title"></td>


                </tr>


                </tbody>
            </table>
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

</script>
@endsection
