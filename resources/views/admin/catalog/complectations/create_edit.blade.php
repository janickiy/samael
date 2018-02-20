@extends('layouts.admin.app')

@section('title', isset($catalogmark) ? 'Редактирование комплектации' : 'Добавление комплектации')

@section('css')

    <!-- iCheck for checkboxes and radio inputs -->
    {!! Html::style('assets/plugins/iCheck/all.css') !!}
@endsection

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-folder-open-o"></i> {{ isset($catalogmark) ? 'Редактировать' : 'Добавить' }} комплектацию
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Панель управления</a></li>
            <li><a href="{{ url('admin/catalog/marks') }}"><i class="fa fa-folder-open-o"></i> Комплектации</a></li>
            <li class="active"><i
                        class="fa {{ isset($catalogcomplectation) ? 'fa-pencil' : 'fa-plus' }}"></i> {{ isset($catalogcomplectation) ? 'Редактировать' : 'Добавить' }}
                комплектацию
            </li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">

        <a href="{!! url('admin/catalog/models/model/' . $id_model . '/complectations') !!}">назад</a>

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

                {!! Form::open(['url' => isset($catalogcomplectation) ? URL::to('admin/catalog/complectations/' . $catalogcomplectation->id )  :  URL::to('admin/catalog/complectations') , 'method' => isset($catalogcomplectation) ? 'put': 'post', 'class' => 'form-horizontal', 'id'=>'validate']) !!}

                {!! Form::hidden('id_model', $id_model) !!}

                {!! Form::hidden('id_complectation', isset($catalogcomplectation) ? $catalogcomplectation->id: null, ['id' => 'id_complectation']) !!}

                <div class="col-md-12">

                    <div class="form-group">
                        {!! Form::label('name', 'Название *', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">
                            {!! Form::text('name', old('name', isset($catalogcomplectation) ? $catalogcomplectation->name : null), ['class' => 'form-control validate[required]', 'placeholder'=>'Название']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('name', 'Стандартные параметры *', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">
                            {!! Form::select('equipment[]', $equipment_options, isset($catalogcomplectation) ? $catalogcomplectation->equipment : null, ['class' => 'itemName form-control validate[required]','multiple' => true, 'id' => 'equipment']) !!}
                        </div>
                    </div>


                    {!! Form::textarea('list', null, ['id' => 'list']) !!}


                    <a id="add_field2" href="#">ses</a>

                    <div class="form-group">
                        {!! Form::label('name', 'Новые параметры*', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4" id="headerslist">
                            <input class="btn btn-default" id="add_field" type="button" value="+ Добавить поле">
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('name', 'Пакеты*', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4" id="packlist">

                            @if(isset($packs))

                                @for($i=0; $i<count($packs); $i++)

                                    <div class="additional_field">
                                        <input type="hidden" name="pack_key[]" value="{!! $i !!}">
                                        @if(isset($packs[$i]['id']) && $packs[$i]['id']) <input type="hidden"
                                                                                                name="pack_id[]"
                                                                                                value="{!! $packs[$i]['id'] !!}"> @endif
                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    {!! Form::label('pack_name[]', 'Название *', ['class' => 'col-lg-3 control-label']) !!}
                                                    <div class="col-lg-7"> {!! Form::text('pack_name[]', $packs[$i]['name'], ['class' => 'form-control validate[required]', 'placeholder'=>'Название']) !!} </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    {!! Form::label('pack_price[]', 'Цена *', ['class' => 'col-lg-3 control-label']) !!}
                                                    <div class="col-lg-7"> {!! Form::text('pack_price[]', $packs[$i]['price'], ['class' => 'form-control validate[required,custom[onlyNumberSp]]', 'placeholder'=>'Цена']) !!} </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    {!! Form::label('parameter_pack[' . $i . '][]', 'Параметры *', ['class' => 'col-lg-3 control-label']) !!}
                                                    <div class="col-lg-7">{!! Form::select('parameter_pack[' . $i . '][]', $equipment_options, isset($packs[$i]['equipment']) ? $packs[$i]['equipment'] : null , ['class' => 'form_control itemName validate[required]','multiple' => true]) !!}</div>
                                                    <div class="col-lg-2"><a class="btn  btn-danger removeBlock"
                                                                             title="Удалить"> - </a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endfor

                            @endif

                        </div>

                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2"><input class="btn btn-default" id="add_field_pack"
                                                                     type="button" value="+ Добавить поле"></div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('published', 'Опубликован', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4">
                            <label class="check">
                                @if(isset($catalogmark))
                                    {!! Form::checkbox('published',1,  old('published' , (isset($catalogcomplectation) && ($catalogcomplectation->getOriginal('published') == 1) ) ? true : false ) ,['class'=>'minimal']) !!}
                                @else
                                    {!! Form::checkbox('published',1,  old('published' , true),['class'=>'minimal']) !!}
                                @endif

                                Да</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
                            {!! Form::submit( (isset($catalogcomplectation) ? 'Обновить': 'Добавить') . '', ['class'=>'btn btn-primary']) !!}
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

        $(document).on("click", '#add_field2', function () {
            $.ajax({
                url: "{!! url('admin/ajax?action=list_complectation') !!}",
                type: "post",
                data: { "_token": "{{ csrf_token() }}", "id_complectation": $("#id_complectation").val(), "list" : $("#list").val() },
                success: function (response) {
                    // you will get response from your php page (what you echo or print)

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }


            });
        });


        $(document).on("click", '#add_field', function () {
            var html = '<div class="additional_field"><div class="form-group">';
            html += '<div class="col-lg-12">';
            html += '<div class="form-group">';
            html += '<label for="newparameters_category[]" class="col-lg-2 control-label">Категория</label>';
            html += '<div class="col-lg-7">';
            html += '{!! Form::select('newparameters_category[]', $category_options, null , ['class' => 'form_control itemName2 validate[required]']) !!}</div>';
            html += '</div>';
            html += '</div>';
            html += '<div class="col-lg-12">';
            html += '<div class="form-group">';
            html += '<label for="newparameters_name[]" class="col-lg-2 control-label">Название</label>';
            html += '<div class="col-lg-7"> <input class="form-control" placeholder="Название" name="newparameters_name[]" type="text" id="newparameters_name[]"> </div>';
            html += '</div>';
            html += '</div>';
            html += '<div class="col-lg-12">';
            html += '<div class="form-group">';
            html += '<label for="newparameters_price[]" class="col-lg-2 control-label">Цена</label>';
            html += '<div class="col-lg-7"> <input class="form-control validate[custom[onlyNumberSp]]" placeholder="Цена" name="newparameters_price[]" type="text" id="newparameters_price[]"> </div>';
            html += '<div class="col-lg-3"><a class="btn  btn-danger removeBlock" title="Удалить"> - </a></div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';

            $('#headerslist').prepend(html);

            $('.itemName2').select2({width: '100%'});

            var prefix = 's2id_';
            $("form[id^='validate']").validationEngine('attach',
                {
                    promptPosition: "bottomRight", scroll: false,
                    prettySelect: true,
                    usePrefix: prefix
                });
        });

        $(document).on("click", '#add_field_pack', function () {

            var lengthBlock = $('div.additional_field').length;
            var html = '<div class="additional_field">';
            html += '<input type="hidden" name="pack_key[]" value="' + lengthBlock + '">';
            html += '<div class="form-group">';
            html += '<div class="col-lg-12">';
            html += '<div class="form-group">';
            html += '<label for="pack_name[]" class="col-lg-3 control-label">Название *</label>';
            html += '<div class="col-lg-7"> <input class="pack_field form-control validate[required]" placeholder="Название" name="pack_name[]" type="text" id="pack_name[]"> </div>';
            html += '</div>';
            html += '</div>';
            html += '<div class="col-lg-12">';
            html += '<div class="form-group">';
            html += '<label for="pack_price[]" class="col-lg-3 control-label">Цена *</label>';
            html += '<div class="col-lg-7"> <input class="form-control validate[required,custom[onlyNumberSp]]" placeholder="Цена" name="pack_price[]" type="text" id="pack_price[]"> </div>';
            html += '</div>';
            html += '</div>';
            html += '<div class="col-lg-12">';
            html += '<div class="form-group">';
            html += '<label for="parameter_pack[' + lengthBlock + '][]" class="col-lg-3 control-label">Параметры *</label>';
            html += '<div class="col-lg-7"><select class="form_control itemName validate[required]" multiple="1" id="parameter_pack[' + lengthBlock + '][]" name="parameter_pack[' + lengthBlock + '][]"></select></div>';
            html += '<div class="col-lg-2"><a class="btn  btn-danger removeBlock" title="Удалить"> - </a></div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';

            $('#packlist').append(html);

            $('.itemName').select2({
                width: '100%',
                placeholder: 'Выберите пункт',
                ajax: {
                    url: "{!! url('admin/ajax?action=complectation') !!}",
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });

            var prefix = 's2id_';
            $("form[id^='validate']").validationEngine('attach',
                {
                    promptPosition: "bottomRight", scroll: false,
                    prettySelect: true,
                    usePrefix: prefix
                });
        });

        $(document).on("click", '.removeBlock', function () {
            var parent = $(this).closest('div[class^="additional_field"]');
            parent.remove();
        });

        $(document).ready(function () {

            $('#equipment').on('select2:opening select2:closing', function (event) {
                var $searchfield = $(this).parent().find('.select2-search__field');
                //$searchfield.prop('disabled', true);
            });

            $('input[type="checkbox"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue'
            });

            $('.itemName').select2({
                width: '100%',
                placeholder: 'Выберите пункт',
                ajax: {
                    url: "{!! url('admin/ajax?action=complectation') !!}",
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });

            // Validation Engine init
            var prefix = 's2id_';
            $("form[id^='validate']").validationEngine('attach',
                {
                    promptPosition: "bottomRight", scroll: false,
                    prettySelect: true,
                    usePrefix: prefix
                });
        });

        $('.itemName').select2({
            width: '100%',
            placeholder: 'Выберите пункт',
            ajax: {
                url: "{!! url('admin/ajax?action=complectation') !!}",
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });

        $('.itemName2').select2({width: '100%'});

    </script>
@endsection		