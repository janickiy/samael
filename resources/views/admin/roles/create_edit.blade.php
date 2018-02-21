@extends('layouts.admin.app')

@section('title', 'Roles')

@section('css')
    <style>

    </style>
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-key"></i> {{ isset($role) ? 'Редактировать' : 'Добавить' }} роль
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Панель управления</a></li>
            <li><a href="{{ url('admin/roles') }}"><i class="fa fa-key"></i> Роли</a></li>
            <li class="active"><i
                        class="fa {{ isset($role) ? 'fa-pencil' : 'fa-plus' }}"></i> {{ isset($role) ? 'Редактировать' : 'Добавить' }}
                Роль
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <p>* - обязательные поля</p>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i
                                class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                {!! Form::open(['url' => isset($role) ? URL::to('admin/roles/'.$role->id )  :  URL::to('admin/roles') , 'method' => isset($role) ? 'put': 'post', 'class' => 'form-horizontal', 'id'=>'validate']) !!}
                {!! Form::hidden('role_id', isset($role) ? $role->id: null) !!}
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('name', 'Название роли *', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-8">
                            {!! Form::text('name', old('name', isset($role) ? $role->name : null), ['class' => 'form-control validate[required]', 'placeholder'=>'Название роли']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('routes', 'Роль роутинг', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-8">
                            {!! Form::select('routes[]', $routes, old('routes', isset($role) ? json_decode($role->routes): null), ['class' => 'form-control select2', 'multiple', 'data-placeholder'=>'Выберите маршрут', 'style'=>'width: 100%;']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
                            {!! Form::submit( (isset($role) ? 'Обновить': 'Добавить') . '', ['class'=>'btn btn-primary']) !!}
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

    {!! Html::script('assets/plugins/validationengine/languages/jquery.validationEngine-ru.js') !!}

    {!! Html::script('assets/plugins/validationengine/jquery.validationEngine.js') !!}

    <script type="text/javascript">
        $(document).ready(function () {
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