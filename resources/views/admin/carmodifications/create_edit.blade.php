@extends('layouts.admin.app')

@section('title', 'Модификации')

@section('css')
        <!-- iCheck for checkboxes and radio inputs -->
{!! Html::style('assets/plugins/iCheck/all.css') !!}
@endsection

@section('content')
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-list-alt"></i> {{ isset($carmodification) ? 'Редактировать' : 'Добавить' }} модификацию
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Панель управления</a></li>
        <li><a href="{{ url('admin/carmodifications/model/' . (isset($carmodification) ? $carmodification->id_car_model : $id_car_model) ) }}"><i class="fa fa-list-alt"></i> Модификации</a></li>
        <li class="active"><i class="fa {{ isset($carmodification) ? 'fa-pencil' : 'fa-plus' }}"></i> {{ isset($carmodification) ? 'Редактировать' : 'Добавить' }}
           модификацию
        </li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Форма данных модификации</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            <p>* - обязательные поля</p>
            {!! Form::open(['url' => isset($carmodification) ? URL::to('admin/carmodifications/' . $carmodification->id )  :  URL::to('admin/carmodifications/') , 'method' => isset($carmodification) ? 'put': 'post', 'class' => 'form-horizontal', 'id'=>'validate']) !!}
            <div class="col-md-12">
                @if(isset($id_car_model)) {!! Form::hidden('id_car_model', $id_car_model) !!} @endif
                <div class="form-group">
                    {!! Form::label('name', 'Название *', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('name', old('name', isset($carmodification) ? $carmodification->name : null), ['class' => 'form-control validate[required]', 'placeholder'=>'Название модификации']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('body_type', 'Тип кузова*', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('body_type', old('body_type', isset($carmodification) ? $carmodification->body_type : null), ['class' => 'form-control validate[required]', 'placeholder'=>'Тип кузов']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('year_begin', 'Год начала производства*', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!!  Form::selectYear('year_begin', 1980, date("Y"), isset($carmodification) ? $carmodification->year_begin : date("Y"), ['class' => 'form-control select2 validate[required]']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('year_end', 'Год окончания производства*', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!!  Form::selectYear('year_end', 1980, date("Y"), isset($carmodification) ? $carmodification->year_end : date("Y"), ['class' => 'form-control select2 validate[required]']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-2">
                        {!! Form::submit( (isset($carmodification) ? 'Обновить': 'Добавить') . '', ['class'=>'btn btn-primary']) !!}
                    </div>
                </div>
            </div><!-- .col-md-12 -->
            {!! Form::close() !!}
        </div><!-- /.box-body -->
        <div class="box-footer">
        </div><!-- /.box-footer-->
    </div><!-- /.box -->
</section><!-- /.content -->
@endsection


@section('js')

        <!-- iCheck 1.0.1 -->
{!! Html::script('assets/plugins/iCheck/icheck.min.js') !!}

{!! Html::script('assets/plugins/validationengine/languages/jquery.validationEngine-ru.js') !!}

{!! Html::script('assets/plugins/validationengine/jquery.validationEngine.js') !!}

<script type="text/javascript">
    $(document).ready(function () {

        $('input[type="checkbox"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue'
        });

        //Initialize Select2 Elements
        $(".select2").select2();

        // Validation Engine init
        var prefix = 's2id_';
        $("form[id^='validate']").validationEngine('attach',
                {
                    promptPosition: "bottomRight", scroll: false,
                    prettySelect: true,
                    usePrefix: prefix
                });
    });
</script>
@endsection		