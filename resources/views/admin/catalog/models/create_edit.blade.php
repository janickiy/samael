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
        <i class="fa fa-list-alt"></i> {{ isset($catalogmodel) ? 'Редактировать' : 'Добавить' }} модель
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Панель управления</a></li>
        <li><a href="{{ url('admin/catalog/models') }}"><i class="fa fa-list-alt"></i> Модели</a></li>
        <li class="active"><i class="fa {{ isset($catalogmodel) ? 'fa-pencil' : 'fa-plus' }}"></i> {{ isset($catalogmodel) ? 'Редактировать' : 'Добавить' }}
            модель
        </li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->

    <a href="{!! url('/admin/catalog/models/mark/' . $id_car_mark) !!}">назад</a>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Форма данных модели</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">

            <p>* - обязательные поля</p>

            {!! Form::open(['url' => isset($catalogmodel) ? URL::to('admin/catalog/models/' . $catalogmodel->id )  :  URL::to('admin/catalog/models') , 'method' => isset($catalogmodel) ? 'put': 'post', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal', 'id'=>'validate']) !!}

            {!! Form::hidden('id_car_mark', $id_car_mark) !!}

            {!! Form::hidden('model_id', isset($catalogmodel) ? $catalogmodel->id: null) !!}

            <div class="col-md-12">
                <div class="form-group">
                    {!! Form::label('name', 'Название модели *', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('name', old('name', isset($catalogmodel) ? $catalogmodel->name : null), ['class' => 'form-control validate[required]', 'placeholder'=>'Название модели']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('name_rus', 'Название модели кирилицей*', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('name_rus', old('name_rus', isset($catalogmodel) ? $catalogmodel->name_rus : null), ['class' => 'form-control validate[required]', 'placeholder'=>'Название марки кирилицей']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('slug', 'URL*', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('slug', old('slug', isset($catalogmodel) ? $catalogmodel->slug : null), ['class' => 'form-control validate[required]', 'placeholder'=>'URL']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('image', 'Фото (jpeg, png, gif)', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::file('image') !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('annotation', 'Аннотация', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::textarea('annotation', old('annotation', isset($catalogmodel) ? $catalogmodel->annotation : null), ['class' => 'form-control', 'placeholder' => 'Аннотация', 'rows' => 2]) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('content', 'Контент', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::textarea('content', old('content', isset($catalogmodel) ? $catalogmodel->content : null), ['class' => 'form-control', 'placeholder' => 'Контент', 'rows' => 5]) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('parametersContent', 'Текст для вкладки характеристик', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::textarea('parametersContent', old('parametersContent', isset($catalogmodel) ? $catalogmodel->parametersContent : null), ['class' => 'form-control', 'placeholder' => 'Текст для вкладки характеристик', 'rows' => 5]) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('galleryContent', 'Текст для вкладки галлерея', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::textarea('galleryContent', old('galleryContent', isset($catalogmodel) ? $catalogmodel->galleryContent : null), ['class' => 'form-control', 'placeholder' => 'Текст для вкладки галлерея', 'rows' => 5]) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('bannerText', 'Текст на баннер', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::textarea('bannerText', old('bannerText', isset($catalogmodel) ? $catalogmodel->bannerText : null), ['class' => 'form-control', 'placeholder'=>'Текст на баннер', 'rows' => 2]) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('meta_title', 'meta title', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('meta_title', old('meta_title', isset($catalogmodel) ? $catalogmodel->meta_title : null), ['class' => 'form-control', 'placeholder'=>'meta title']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('meta_keywords', 'meta keywords', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('meta_keywords', old('meta_keywordse', isset($catalogmodel) ? $catalogmodel->meta_keywords : null), ['class' => 'form-control', 'placeholder'=>'meta keywords']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('meta_description', 'meta description', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::textarea('meta_description', old('meta_description', isset($catalogmodel) ? $catalogmodel->meta_description : null), ['class' => 'form-control', 'placeholder'=>'meta description', 'rows' => 2]) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('body_type', 'Тип кузова', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {{ Form::select('body_type',
                        [
                        'hatchback_5' => 'Хэтчбек 5D',
                        'hatchback_3' => 'Хэтчбек 3D',
                        'liftback' => 'Лифтбек',
                        'sedan' => 'Седан',
                        'wagon' => 'Универсал',
                        'wagon_5' => 'Универсал 5 мест',
                        'wagon_7' => 'Универсал 7 мест',
                        'coupe' => 'Купе',
                        'suv' => 'Внедорожник',
                        'suv_3' => 'Внедорожник 3',
                        'suv_5' => 'Внедорожник 5D',
                        'crossover' => 'Кроссовер',
                        'truck' => 'Грузовик',
                        'pickup' => 'Пикап',
                        'van' => 'Минивен',
                        'convertible' => 'Кабриолет'
                         ], isset($catalogmodel) ? $catalogmodel->sedan : 'sedan', ['class' => 'select2']) }}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('special', 'Специальное предложение', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        <label class="check">
                            @if(isset($catalogmodel))
                                {!! Form::checkbox('special',1,  old('special' , (isset($catalogmodel) && ($catalogmodel->getOriginal('special') == 1) ) ? true : false ) ,['class'=>'minimal']) !!}
                            @else
                                {!! Form::checkbox('special',1,  old('special' , true) ,['class'=>'minimal']) !!}
                            @endif

                            Да</label>

                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('published', 'Опубликован', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        <label class="check">
                            @if(isset($catalogmodel))

                            {!! Form::checkbox('published',1,  old('published' , (isset($catalogmodel) && ($catalogmodel->getOriginal('published') == 1) ) ? true : false ) ,['class'=>'minimal']) !!}
                            @else
                                {!! Form::checkbox('published',1,  old('published' , true) ,['class'=>'minimal']) !!}
                            @endif
                            Да</label>
                    </div>
                </div>

                <div class="form-group"><div class="col-md-8 col-md-offset-2">
                        @if (isset($catalogmodel) && (file_exists(public_path() . $catalogmodel->image)) )
                            <img src="{!! $catalogmodel->image !!}">
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-2">
                        {!! Form::submit( (isset($catalogmodel) ? 'Обновить': 'Добавить') . '', ['class'=>'btn btn-primary']) !!}
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