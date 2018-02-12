@extends('layouts.admin.app')

@section('title', 'Цены')

@section('css')

<!-- DataTables -->
{!! Html::style('assets/dist/css/datatable/dataTables.bootstrap.min.css') !!}

{!! Html::style('assets/dist/css/datatable/responsive.bootstrap.min.css') !!}

{!! Html::style('assets/dist/css/datatable/dataTablesCustom.css') !!}

{!! Html::style('css/tablesaw.css') !!}

@endsection


@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-list-alt"></i> Цены
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Панель управления</a></li>
        <li class="active"><i class="fa fa-list-alt"></i> Цены</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <p><a class="btn btn-success" href="{{ url('/admin/catalog/modifications/create/' . $id) }}"> + Добавить модификацию </a></p>
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
            <table class="table datatable dt-responsive tablesaw tablesaw-swipe" data-tablesaw-mode="swipe" style="width:100%;">
                <thead>
                <tr>
                    <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Комлектация</th>

                    @foreach($modifications as $modification)

                        <th>{!! $modification->name !!}</th>

                    @endforeach

                </tr>
                </thead>
                <tbody>

                @foreach($complectations as $complectation)

                <tr>
                    <td class="title">{!! $complectation->name !!}</td>

                    @foreach($modifications as $modification)

                        <th>
                            Цена <input type="text" class="price form-control" name="price" data-modification="{!! $modification->id !!}" data-complectation="{!! $complectation->id !!}" value="{!! @getPrice($modification->id, $complectation->id) !!}"> <br>
                            Старая цена <input type="text" class="prev_price form-control" name="prev_price" data-modification="{!! $modification->id !!}" data-complectation="{!! $complectation->id !!}"  value="{!! getPrevPrice($modification->id, $complectation->id) !!}"> <br>
                            <input type="checkbox" class="best_price" @if($modification->getOriginal('best_price') == 1) checked="checked" @endif data-modification="{!! $modification->id !!}" data-complectation="{!! $complectation->id !!}"  name="best_price"> Лучшая цена
                        </th>

                    @endforeach

                </tr>
                @endforeach
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


    $(document).on( "change", ".price", function() {
        var Price = $(this).val();
        var idComplectation = $(this).attr('data-complectation');
        var idModification = $(this).attr('data-modification');

        $.ajax({
            url: "{!! url('admin/ajax?action=price') !!}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "id_modification" : idModification,
                "id_complectation" : idComplectation,
                "price" : Price,
                "id_model" : "{!! $id !!}"
            },

        });
    });

    $(document).on( "change", ".prev_price", function() {
        var prevPrice = $(this).val();
        var idModification = $(this).attr('data-modification');
        var idComplectation = $(this).attr('data-complectation');

        $.ajax({
            url: "{!! url('admin/ajax?action=prev_price') !!}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "id_modification" : idModification,
                "id_complectation" : idComplectation,
                "prev_price" : prevPrice,
                "id_model" : "{!! $id !!}"
            },
            success: function(data) {

            },
            fail: function() {

            }
        });
    });

    $(document).on( "change", ".best_price", function() {
        var val = $(this).prop("checked");
        val = val == false ? 0 : 1;
        var idModification = $(this).attr('data-modification');
        var idComplectation = $(this).attr('data-complectation');

        $.ajax({
            url: "{!! url('admin/ajax?action=best_price') !!}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "id_modification" : idModification,
                "id_complectation" : idComplectation,
                "val" : val,
                "id_model" : "{!! $id !!}"
            },
            success: function(data) {

            },
            fail: function() {

            }
        });
    });

</script>
@endsection
