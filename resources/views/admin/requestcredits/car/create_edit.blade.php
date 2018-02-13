@extends('layouts.admin.app')

@section('title', 'Заявка на автокредит')

@section('css')
<!-- iCheck for checkboxes and radio inputs -->
{!! Html::style('assets/plugins/iCheck/all.css') !!}
@endsection

@section('content')
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-bell-o"></i> {{ isset($requestcredit) ? 'Редактировать' : 'Добавить' }} заявку на автокредит
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Панель управления</a></li>
        <li><a href="{{ url('admin/requestcredits') }}"><i class="fa fa-list-alt"></i> Заявки на автокредит</a></li>
        <li class="active"><i class="fa {{ isset($requestcredit) ? 'fa-pencil' : 'fa-plus' }}"></i> {{ isset($requestcredit) ? 'Редактировать' : 'Добавить' }}
            заявку на автокредит
        </li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Заявка на автокредит</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            <p>* - обязательные поля</p>
            {!! Form::open(['url' => isset($requestcredit) ? URL::to('admin/requestcredits/' . $requestcredit->id )  :  URL::to('admin/requestcredits') , 'method' => isset($requestcredit) ? 'put': 'post', 'class' => 'form-horizontal', 'id'=>'validate']) !!}
            <div class="col-md-12">

                {!! Form::hidden('mark', $requestcredit->mark) !!}

                {!! Form::hidden('model', $requestcredit->model) !!}

                {!! Form::hidden('complectation', $requestcredit->complectation) !!}

                <div class="form-group">
                    {!! Form::label('fee', 'Первоначальный взнос *', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('fee', old('fee', isset($requestcredit) ? $requestcredit->fee : null), ['class' => 'form-control validate[required]', 'placeholder'=>'Первоначальный взнос']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('name', 'ФИО клиента*', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('name', old('name', isset($requestcredit) ? $requestcredit->name : null), ['class' => 'form-control validate[required]', 'placeholder'=>'ФИО клиента']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('age', 'Возраст*', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('age', old('age', isset($requestcredit) ? $requestcredit->age : null), ['class' => 'form-control validate[required]', 'placeholder'=>'Возраст']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('registration', 'Регион по прописке*', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('registration', old('registration', isset($requestcredit) ? $requestcredit->registration : null), ['class' => 'form-control validate[required]', 'placeholder'=>'Регион по прописке']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('phone', 'Телефон*', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('phone', old('phone', isset($requestcredit) ? $requestcredit->phone : null), ['class' => 'form-control validate[required]', 'placeholder'=>'Телефон']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('published', 'Статус', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-sm-10">
                        <label class="check">{!! Form::checkbox('status', 1, isset($requestcredit) ? ($requestcredit->status == 1 ? true: false): false, ['class'=>'minimal']) !!}
                            Выполнена
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-2">
                        {!! Form::submit( (isset($requestcredit) ? 'Обновить': 'Добавить') . '', ['class'=>'btn btn-primary']) !!}
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