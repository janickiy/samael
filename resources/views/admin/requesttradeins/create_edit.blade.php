@extends('layouts.admin.app')

@section('title', 'Заявка на Trade-in')

@section('css')
        <!-- iCheck for checkboxes and radio inputs -->
{!! Html::style('assets/plugins/iCheck/all.css') !!}
@endsection

@section('content')
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-bell-o"></i> {{ isset($requesttradein) ? 'Редактировать' : 'Добавить' }} заявку на Trade-in
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Панель управления</a></li>
        <li><a href="{{ url('admin/requestcredits') }}"><i class="fa fa-list-alt"></i> Заявки на Trade-in</a></li>
        <li class="active"><i class="fa {{ isset($requesttradein) ? 'fa-pencil' : 'fa-plus' }}"></i> {{ isset($requesttradein) ? 'Редактировать' : 'Добавить' }}
            заявку на Trade-in
        </li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Заявка на Trade-in</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            <p>* - обязательные поля</p>
            {!! Form::open(['url' => isset($requesttradein) ? URL::to('admin/requesttradeins/' . $requesttradein->id )  :  URL::to('admin/requesttradeins') , 'method' => isset($requesttradein) ? 'put': 'post', 'class' => 'form-horizontal', 'id'=>'validate']) !!}
            <div class="col-md-12">
                <div class="form-group">
                    {!! Form::label('mark', 'Марка *', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('mark', old('mark', isset($requesttradein) ? $requesttradein->mark : null), ['class' => 'form-control validate[required]', 'placeholder'=>'Марка автомобиля']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('model', 'Модель *', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('model', old('model', isset($requesttradein) ? $requesttradein->model : null), ['class' => 'form-control validate[required]', 'placeholder'=>'Модель автомобиля']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('year', 'Год выпуска *', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('year', old('year', isset($requesttradein) ? $requesttradein->year : null), ['class' => 'form-control validate[required]', 'placeholder'=>'Год выпуска']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('mileage', 'Пробег *', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('mileage', old('mileage', isset($requesttradein) ? $requesttradein->mileage : null), ['class' => 'form-control validate[required]', 'placeholder'=>'Пробег']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('gearbox', 'КПП *', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('gearbox', old('gearbox', isset($requesttradein) ? $requesttradein->gearbox : null), ['class' => 'form-control validate[required]', 'placeholder'=>'КПП']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('name', 'ФИО клиента*', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('name', old('name', isset($requesttradein) ? $requesttradein->name : null), ['class' => 'form-control validate[required]', 'placeholder'=>'ФИО клиента']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('phone', 'Телефон*', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('phone', old('phone', isset($requesttradein) ? $requesttradein->phone : null), ['class' => 'form-control validate[required]', 'placeholder'=>'Телефон']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-2">
                        {!! Form::submit( (isset($requesttradein) ? 'Обновить': 'Добавить') . '', ['class'=>'btn btn-primary']) !!}
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