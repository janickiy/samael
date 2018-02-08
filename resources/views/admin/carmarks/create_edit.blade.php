@extends('layouts.admin.app')

@section('title', 'Марки')

@section('css')
 <!-- iCheck for checkboxes and radio inputs -->
{!! Html::style('assets/plugins/iCheck/all.css') !!}
@endsection

@section('content')
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-folder-open-o"></i> {{ isset($carmark) ? 'Редактировать' : 'Добавить' }} марку
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Панель управления</a></li>
        <li><a href="{{ url('admin/carmarks') }}"><i class="fa fa-folder-open-o"></i> Марки</a></li>
        <li class="active"><i class="fa {{ isset($carmark) ? 'fa-pencil' : 'fa-plus' }}"></i> {{ isset($carmark) ? 'Редактировать' : 'Добавить' }}
            марку
        </li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Форма данных марки</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            <p>* - обязательные поля</p>

            {!! Form::open(['url' => isset($carmark) ? URL::to('admin/carmarks/' . $carmark->id )  :  URL::to('admin/carmarks') , 'method' => isset($carmark) ? 'put': 'post', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'id'=>'validate']) !!}

            {!! Form::hidden('mark_id', isset($carmark) ? $carmark->id: null) !!}

            <div class="col-md-12">

                <div class="form-group">
                    {!! Form::label('name', 'Название марки *', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('name', old('name', isset($carmark) ? $carmark->name : null), ['class' => 'form-control validate[required]', 'placeholder'=>'Название марки']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-2">
                        {!! Form::submit( (isset($carmark) ? 'Обновить': 'Добавить') . '', ['class'=>'btn btn-primary']) !!}
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