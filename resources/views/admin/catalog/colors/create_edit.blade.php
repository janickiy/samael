@extends('layouts.admin.app')

@section('title', isset($catalogcolor) ? 'Редактирование цвета' : 'Добавление цвета')

@section('css')

    <!-- iCheck for checkboxes and radio inputs -->
    {!! Html::style('assets/plugins/iCheck/all.css') !!}
@endsection

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-folder-open-o"></i> {{ isset($catalogcolor) ? 'Редактировать' : 'Добавить' }} цвет
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Панель управления</a></li>
            <li><a href="{{ url('admin/catalog/colors') }}"><i class="fa fa-folder-open-o"></i> Комплектации</a></li>
            <li class="active"><i
                        class="fa {{ isset($catalogcolor) ? 'fa-pencil' : 'fa-plus' }}"></i> {{ isset($catalogcolor) ? 'Редактировать' : 'Добавить' }}
                цвет
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <a href="{!! url('admin/catalog/models/model/' . $id_model . '/colors') !!}">назад</a>

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <p>* - обязательные поля</p>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i>

                    </button>
                </div>
            </div>

            <div class="box-body">

                {!! Form::open(['url' => isset($catalogcolor) ? URL::to('admin/catalog/colors/' . $catalogcolor->id )  :  URL::to('admin/catalog/colors') , 'method' => isset($catalogcolor) ? 'put': 'post', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal', 'id'=>'validate']) !!}

                {!! Form::hidden('id_model', $id_model) !!}

                <div class="col-md-12">

                    <div class="form-group">
                        {!! Form::label('name', 'Название *', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">
                            {!! Form::text('name', old('name', isset($catalogcolor) ? $catalogcolor->name : null), ['class' => 'form-control validate[required]', 'placeholder' => 'Название']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('hex', 'Код *', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">
                            {!! Form::text('hex', old('hexe', isset($catalogcolor) ? $catalogcolor->hex : null), ['class' => 'form-control validate[required]', 'placeholder' => 'Код']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('image', 'Фото (jpeg, png, gif)*', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">
                            {!! Form::file('image') !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
                            @if (isset($catalogcolor) && (file_exists(public_path() . $catalogcolor->image)) )
                                <img width="300" src="{!! $catalogcolor->image !!}">
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('published', 'Опубликован', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">
                            <label class="check">
                                @if(isset($catalogcolor))
                                    {!! Form::checkbox('published',1,  old('published' , (isset($catalogcolor) && ($catalogcolor->getOriginal('published') == 1) ) ? true : false ) ,['class'=>'minimal']) !!}
                                @else
                                    {!! Form::checkbox('published',1,  old('published' , true) ,['class'=>'minimal']) !!}
                                @endif
                                Да</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
                            {!! Form::submit( (isset($catalogcolor) ? 'Обновить': 'Добавить') . '', ['class'=>'btn btn-primary']) !!}
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