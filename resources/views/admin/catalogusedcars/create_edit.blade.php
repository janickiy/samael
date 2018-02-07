@extends('layouts.admin.app')

@section('title', 'Автомобили с пробегом')

@section('css')
    <!-- iCheck for checkboxes and radio inputs -->
    {!! Html::style('assets/plugins/iCheck/all.css') !!}

    <style>

        .search{
            position:relative;
        }

        .search_result {
            background: #FFF;
            border: 1px #ccc solid;
            padding: 0;
            border-radius: 4px;
            max-height:100px;
            overflow-y:scroll;
            display:none;
        }

        .dropdownvisible {
            max-height:100px;
            overflow-y:scroll;

        }

        .search_result li{
            list-style: none;
            padding: 5px 10px;
            margin: 0;
            color: #0896D3;
            border-bottom: 1px #ccc solid;
            cursor: pointer;
            transition:0.3s;
        }

        .search_result li:hover{
            background: #F9FF00;
        }

    </style>

@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-list-alt"></i> {{ isset($menu) ? 'Редактировать' : 'Добавить' }} автомобиль
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Панель управления</a></li>
            <li><a href="{{ url('admin/menus') }}"><i class="fa fa-list-alt"></i> Автомобили с пробегом</a></li>
            <li class="active"><i class="fa {{ isset($menu) ? 'fa-pencil' : 'fa-plus' }}"></i> {{ isset($menu) ? 'Редактировать' : 'Добавить' }}
                автомобиль
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
                {!! Form::open(['url' => isset($catalogusedcar) ? URL::to('admin/catalogusedcars/'.$catalogusedcar->id )  :  URL::to('admin/catalogusedcars') , 'method' => isset($catalogusedcar) ? 'put': 'post', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal', 'id'=>'validate']) !!}
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::hidden('id_mark', null, ['id' => 'id_mark']) !!}
                        {!! Form::label('mark', 'Марка *', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">
                            {!! Form::text('mark', old('mark', isset($catalogusedcar) ? $catalogusedcar->mark : null), ['class' => 'form-control validate[required]', 'placeholder'=>'Марка', 'id' => 'search_mark', 'autocomplete' => 'off']) !!}
                            <ul class="search_result_mark search_result"></ul>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::hidden('id_model', null, ['id' => 'id_model']) !!}
                        {!! Form::label('model', 'Модель *', ['class' => 'control-label col-md-2']) !!}
                        <div id="search_result_model" class="col-md-4">

                            {!! Form::select('model', isset($model_list) ? $model_list : [null]
                            , isset($catalogusedcar) ? $catalogusedcar->model : null, ['class' => 'form-control select2 validate[required]']
                            ) !!}

                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('price', 'Цена *', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">
                            {!! Form::text('price', old('price', isset($catalogusedcar) ? $catalogusedcar->price : null), ['class' => 'form-control validate[required,custom[onlyNumberSp]]', 'placeholder'=>'Цена']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('year', 'Год *', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">
                            {!!  Form::selectYear('year', 1980, date("Y"), isset($catalogusedcar) ? $catalogusedcar->year_begin : date("Y"), ['class' => 'form-control select2 validate[required]']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('mileager', 'Пробег *', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">
                            {!! Form::text('mileage', old('mileage', isset($catalogusedcar) ? $catalogusedcar->mileage : null), ['class' => 'form-control validate[required,custom[onlyNumberSp]]', 'placeholder'=>'Пробег']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('gearbox', 'КПП *', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">
                            {!! Form::select('gearbox', [
                             null => 'КПП',
                             'Механическая' => 'Механическая',
                             'Автоматическая' => 'Автоматическая',
                             'Роботизированная' => 'Роботизированная',
                             'Вариатор' => 'Вариатор',
                             'Автоматизированная механическая' => 'Автоматизированная механическая',
                            ], isset($catalogusedcar) ? $catalogusedcar->gearbox : null, ['class' => 'form-control select2 validate[required]']
                            ) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('drive', 'Привод *', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">
                            {!! Form::select('drive', [
                             'Передний' => 'Передний',
                             'Задний' => 'Задний',
                             'Полный' => 'Полный'
                            ], isset($catalogusedcar) ? $catalogusedcar->drive : null, ['class' => 'select2 form-control validate[required]']
                            ) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('engine_type', 'Тип двигателя *', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">
                            {!! Form::select('engine_type', [
                             'Бензиновый' => 'Бензиновый',
                             'Бензиновый турбированный' => 'Бензиновый турбированный',
                             'Дизельный' => 'Дизельный',
                             'Дизельный турбированный' => 'Дизельный турбированный',
                             'Электро' => 'Электро',
                             'Гибрид' => 'Гибрид',
                            ], isset($catalogusedcar) ? $catalogusedcar->engine_type : null, ['class' => 'select2 form-control validate[required]']
                            ) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('power', 'Мощность двигателя *', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">
                            {!! Form::text('power', old('power', isset($catalogusedcar) ? $catalogusedcar->power : null), ['class' => 'form-control validate[required,custom[onlyNumberSp]]', 'placeholder'=>'Мощность двигателя']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('body', 'Кузов *', ['class' => 'control-label col-md-2']) !!}
                        <div id="body_type" class="col-md-4">
                            {!! Form::select('body', [
                            'sedan' => 'Седан',
                           ], isset($catalogusedcar) ? $catalogusedcar->body : null, ['class' => 'select2 form-control validate[required]']
                           ) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('wheel', 'Руль *', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">

                            {!! Form::select('wheel', [
                             'Левый' => 'Левый',
                             'Правы' => 'Правый',
                            ], isset($catalogusedcar) ? $catalogusedcar->wheel : null, ['class' => 'select2 form-control validate[required]']
                            ) !!}

                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('color', 'Цвет *', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">
                            {!! Form::text('color', old('color', isset($catalogusedcar) ? $catalogusedcar->color : null), ['class' => 'form-control validate[required]', 'placeholder'=>'Цвет']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('salon', 'Салон *', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">
                            {!! Form::text('salon', old('salon', isset($catalogusedcar) ? $catalogusedcar->salon : null), ['class' => 'form-control validate[required]', 'placeholder'=>'Салон']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('description', 'Комментарий продовца', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">
                            {!! Form::textarea('description', old('description', isset($review) ? $review->message : null), ['class' => 'form-control', 'placeholder'=>'комментарий продовца', 'rows' => 5]) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('meta_title', 'meta title', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">
                            {!! Form::text('meta_title', old('meta_title', isset($catalogusedcar) ? $catalogusedcar->meta_title : null), ['class' => 'form-control', 'placeholder'=>'meta title']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('meta_keywords', 'meta keywords', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">
                            {!! Form::text('meta_keywords', old('meta_keywordse', isset($catalogusedcar) ? $catalogusedcar->meta_keywords : null), ['class' => 'form-control', 'placeholder'=>'meta keywords']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('meta_description', 'meta description', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">
                            {!! Form::textarea('meta_description', old('message', isset($catalogusedcar) ? $catalogusedcar->meta_description : null), ['class' => 'form-control', 'placeholder'=>'meta description', 'rows' => 2]) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('image[]', 'Фото (jpeg, png, gif)*', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">
                            {!! Form::file('image[]',  ['multiple' => true]) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('equipment', 'Комплектация', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">
                            {!! Form::select('equipment[]', $options, isset($catalogusedcar) ? $catalogusedcar->equipment : null, ['class' => 'form-control','multiple'=> true ]) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('published', 'Публиковать', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-sm-10">
                            <label class="check">{!! Form::checkbox('published', 1, isset($catalogusedcar) ? ($catalogusedcar->published == 1 ? true: false) : true, ['class'=>'minimal']) !!}
                                Да
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('verified', 'Проверено', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-sm-10">
                            <label class="check">{!! Form::checkbox('verified', 1, isset($catalogusedcar) ? ($catalogusedcar->verified == 1 ? true : false) : false, ['class'=>'minimal']) !!}
                                Да
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('tradein', 'Доступно в Trade-in', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-sm-10">
                            <label class="check">{!! Form::checkbox('tradein', 1, isset($catalogusedcar) ? ($catalogusedcar->tradein == 1 ? true : false) : false, ['class'=>'minimal']) !!}
                                Да
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('special', 'Спец предложение', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-sm-10">
                            <label class="check">{!! Form::checkbox('special', 1, isset($catalogusedcar) ? ($catalogusedcar->special == 1 ? true : false) : false, ['class'=>'minimal']) !!}
                                Да
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
                            {!! Form::submit( (isset($catalogusedcar) ? 'Обновить': 'Добавить') . '', ['class'=>'btn btn-primary']) !!}
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

    <script type="text/javascript">

        $(function(){
            $("#search_mark").on("change keyup input click", function() {
                if(this.value.length >= 2){
                    $.ajax({
                        type: 'GET',
                        url: '/admin/ajax?action=search_mark&mark=' + this.value,
                        dataType : "json",
                        success: function(data){

                            if (data != null && data.item != null) {
                                var html = '';

                                for(var i=0; i < data.item.length; i++) {
                                    html += '<li data-item="' + data.item[i].id + '">' + data.item[i].name + '</li>';
                                }

                                console.log(html);

                                if (html != '')
                                    $(".search_result_mark").html(html).fadeIn();
                                else
                                    $(".search_result_mark").fadeOut();
                            }
                        }
                    })
                }
            })

            $(".search_result_mark").hover(function(){
                $(".search_mark").blur();
            })

            $(".search_result_mark").on("click", "li", function(){
                $("#search_mark").val($(this).text());

                var idMark = $(this).attr('data-item');

                if (idMark != null) {
                    $("#id_mark").val(idMark);

                    var request = $.ajax({
                        url: '/admin/ajax?action=get_models&id_car_mark=' + idMark,
                        method: "GET",
                        dataType: "json"
                    });

                    request.done(function(data) {

                        var html = '<select name="model" class="form-control select2 validate[required]">';

                        for (var i=0; i < data.item.length; i++) {
                            html += '<option value="' + data.item[i].name + '">' + data.item[i].name + '</option>';
                        }

                        html += '</select>';

                        console.log(html);

                        if (html != '')
                            $("#search_result_model").html(html).fadeIn();
                        else
                            $("#search_result_model").fadeOut();

                        $(".select2").select2();
                    });
                }

                $(".search_result_mark").fadeOut();
            })

            $("#select2-model-container").on("change keyup input click", function() {

                var Mark = $("#search_mark").val();
                var Model = $("#select2-model-container").text();

                if (Mark != null && Model != null) {
                    $.ajax({
                        type: 'GET',
                        url: '/admin/ajax?action=search_modifications&mark=' + Mark + '&model=' + Model,
                        dataType: "json",
                        success: function (data) {
                            if (data != null && data.item != null) {

                                var html = '<select name="body" class="form-control select2 validate[required]">';

                                for (var i = 0; i < data.item.length; i++) {
                                    html += '<option value="' + data.item[i].body_type + '">' + data.item[i].body_type + '</option>';
                                }

                                html += '</select>';

                                console.log(html);

                                if (html != '') $("#body_type").html(html).fadeIn();

                                $(".select2").select2();
                            }
                        }
                    })
                }
            })
        })

    </script>

@endsection