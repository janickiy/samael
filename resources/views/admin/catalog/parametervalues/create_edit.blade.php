@extends('layouts.admin.app')

@section('title', isset($parametervalue) ? 'Редактирование параметра' : 'Добавление параметра')

@section('css')

<!-- iCheck for checkboxes and radio inputs -->
{!! Html::style('assets/plugins/iCheck/all.css') !!}
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-list-alt"></i> {{ isset($parametervalue) ? 'Редактировать' : 'Добавить' }} параметр
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Панель управления</a></li>
        <li><a href="{{ url('admin/catalog/parametercategories') }}"><i class="fa fa-list-alt"></i> Категории параметров</a></li>
        <li class="active"><i class="fa {{ isset($parametervalue) ? 'fa-pencil' : 'fa-plus' }}"></i> {{ isset($parametervalue) ? 'Редактировать' : 'Добавить' }}
            параметр
        </li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->

    <a href="{!! url('admin/catalog/parametervalues/category/' . $id_category) !!}">назад</a>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Форма данных</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">

            <p>* - обязательные поля</p>

            {!! Form::open(['url' => isset($parametervalue) ? URL::to('admin/catalog/parametervalues/' . $parametervalue->id )  :  URL::to('admin/catalog/parametervalues') , 'method' => isset($parametervalue) ? 'put': 'post', 'class' => 'form-horizontal', 'id'=>'validate']) !!}

            {!! Form::hidden('id_category', $id_category) !!}

            <div class="col-md-12">
                <div class="form-group">
                    {!! Form::label('name', 'Название *', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('name', old('name', isset($parametervalue) ? $parametervalue->name : null), ['class' => 'form-control validate[required]', 'placeholder' => 'Название']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-2">
                        {!! Form::submit( (isset($parametervalue) ? 'Обновить': 'Добавить') . '', ['class'=>'btn btn-primary']) !!}
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