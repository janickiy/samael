@extends('layouts.admin.app')

@section('title', 'Производители')

@section('css')
    <!-- iCheck for checkboxes and radio inputs -->
    {!! Html::style('assets/plugins/iCheck/all.css') !!}
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-folder-open-o"></i> {{ isset($catalogmark) ? 'Редактировать' : 'Добавить' }} производителя
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Панель управления</a></li>
            <li><a href="{{ url('admin/catalog/marks') }}"><i class="fa fa-folder-open-o"></i> Производители</a></li>
            <li class="active"><i
                        class="fa {{ isset($catalogmark) ? 'fa-pencil' : 'fa-plus' }}"></i> {{ isset($catalogmark) ? 'Редактировать' : 'Добавить' }}
                марка
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
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

                {!! Form::open(['url' => isset($catalogmark) ? URL::to('admin/catalog/marks/' . $catalogmark->id )  :  URL::to('admin/catalogmarks') , 'method' => isset($catalogmark) ? 'put': 'post', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'id'=>'validate']) !!}

                {!! Form::hidden('mark_id', isset($catalogmark) ? $catalogmark->id: null) !!}

                <div class="col-md-12">

                    <div class="form-group">
                        {!! Form::label('name', 'Название марки *', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">
                            {!! Form::text('name', old('name', isset($catalogmark) ? $catalogmark->name : null), ['class' => 'form-control validate[required]', 'placeholder'=>'Название марки']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('name_rus', 'Название кирилицей*', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">
                            {!! Form::text('name_rus', old('name_rus', isset($catalogmark) ? $catalogmark->name_rus : null), ['class' => 'form-control validate[required]', 'placeholder'=>'Название марки кирилицей']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('slug', 'Slug*', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">
                            {!! Form::text('slug', old('slug', isset($catalogmark) ? $catalogmark->slug : null), ['class' => 'form-control validate[required]', 'placeholder'=>'slug']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('annotation', 'Аннотация', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">
                            {!! Form::text('annotation', old('annotation', isset($catalogmark) ? $catalogmark->annotation : null), ['class' => 'form-control', 'placeholder' => 'annotation']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('content', 'Контент', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">
                            {!! Form::textarea('content', old('content', isset($catalogmark) ? $catalogmark->content : null), ['class' => 'form-control', 'placeholder' => 'content', 'rows' => 2]) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('bannerText', 'Текст для баннера', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">
                            {!! Form::textarea('bannerText', old('bannerText', isset($catalogmark) ? $catalogmark->bannerText : null), ['class' => 'form-control', 'placeholder' => 'Текст для баннера', 'rows' => 2]) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('logo', 'Логотип (jpeg, png, gif, размер не более 1Мб)', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">
                            {!! Form::file('logo') !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('meta_title', 'meta title', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">
                            {!! Form::text('meta_title', old('meta_title', isset($catalogmark) ? $catalogmark->meta_title : null), ['class' => 'form-control', 'placeholder'=>'meta title']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('meta_keywords', 'meta keywords', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">
                            {!! Form::text('meta_keywords', old('meta_keywordse', isset($catalogmark) ? $catalogmark->meta_keywords : null), ['class' => 'form-control', 'placeholder'=>'meta keywords']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('meta_description', 'meta description', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">
                            {!! Form::textarea('meta_description', old('message', isset($catalogmark) ? $catalogmark->meta_description : null), ['class' => 'form-control', 'placeholder'=>'meta description', 'rows' => 2]) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('published', 'Опубликован', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">
                            <label class="check">
                                @if(isset($catalogmark))
                                    {!! Form::checkbox('published',1,  old('published' , (isset($catalogmark) && ($catalogmark->getOriginal('published') == 1) ) ? true : false ) ,['class'=>'minimal']) !!}
                                @else
                                    {!! Form::checkbox('published',1,  old('published' , true),['class'=>'minimal']) !!}
                                @endif

                                Да</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
                            @if (isset($catalogmark) && (file_exists(public_path() . $catalogmark->logo)) )
                                <img height="30" src="{!! $catalogmark->logo !!}">
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
                            {!! Form::submit( (isset($catalogmark) ? 'Обновить': 'Добавить') . '', ['class'=>'btn btn-primary']) !!}
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