@extends('layouts.admin.app')

@section('title', 'Комплектации')

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
        <li class="active"><i class="fa {{ isset($catalogcomplectation) ? 'fa-pencil' : 'fa-plus' }}"></i> {{ isset($catalogcomplectation) ? 'Редактировать' : 'Добавить' }}
            комплектацию
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
            {!! Form::open(['url' => isset($catalogcomplectation) ? URL::to('admin/catalog/complectations/' . $catalogcomplectation->id )  :  URL::to('admin/catalog/complectations') , 'method' => isset($catalogcomplectation) ? 'put': 'post', 'class' => 'form-horizontal', 'id'=>'validate']) !!}

            {!! Form::hidden('id_model', $id_model) !!}

            <div class="col-md-12">

                <div class="form-group">
                    {!! Form::label('name', 'Название *', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('name', old('name', isset($catalogcomplectation) ? $catalogcomplectation->name : null), ['class' => 'form-control validate[required]', 'placeholder'=>'Название']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('name', 'Параметры *', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('name', old('name', isset($catalogcomplectation) ? $catalogcomplectation->name : null), ['class' => 'form-control validate[required]', 'placeholder'=>'Название']) !!}
                    </div>
                </div>


                <div class="form-group">
                        {!! Form::label('name', 'Новые параметры*', ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-4" id="headerslist">
                            <input class="btn btn-default" id="add_field" type="button" value="+ Добавить поле">
                        </div>

                 </div>

                <div class="form-group">
                    {!! Form::label('name', 'Пакеты*', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4" id="packlist">
                        <input class="btn btn-default" id="add_field_pack" type="button" value="+ Добавить поле">
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

    $(document).on( "click", '#add_field', function() {
        var html = '<div class="additional_field"><div class="form-group">';
        html += '<div class="col-lg-12">';
        html += '<div class="form-group">';
        html += '{!! Form::label('newparameters_category[]', 'Категория', ['class' => 'col-lg-2 control-label']) !!}';
        html += '<div class="col-lg-7">';
        html +=  '{!! Form::select('newparameters_category[]', $category_options, 'Категория', ['class' => 'form_control select2']) !!}';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-lg-12">';
        html += '<div class="form-group">';
        html += '{!! Form::label('newparameters_name[]', 'Название', ['class' => 'col-lg-2 control-label']) !!}';
        html += '<div class="col-lg-7"> {!! Form::text('newparameters_name[]', null, ['class' => 'form-control', 'placeholder'=>'Название']) !!} </div>';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-lg-12">';
        html += '<div class="form-group">';
        html += '{!! Form::label('newparameters_price[]', 'Цена', ['class' => 'col-lg-2 control-label']) !!}';
        html += '<div class="col-lg-7"> {!! Form::text('newparameters_price[]', null, ['class' => 'form-control', 'placeholder'=>'Цена']) !!} </div>';
        html += '<div class="col-lg-3"><a class="btn  btn-danger removeBlock" title="Удалить"> - </a></div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';

        $('#headerslist').prepend(html);
        $(".select2").select2();

    });

    $(document).on( "click", '#add_field_pack', function() {
        var html = '<div class="additional_field"><div class="form-group">';
        html += '<div class="col-lg-12">';
        html += '<div class="form-group">';
        html += '{!! Form::label('pack_name[]', 'Название *', ['class' => 'col-lg-2 control-label']) !!}';

        html += '<div class="col-lg-7"> {!! Form::text('pack_name[]', null, ['class' => 'form-control', 'placeholder'=>'Название']) !!} </div>';

        html += '</div>';
        html += '</div>';
        html += '<div class="col-lg-12">';
        html += '<div class="form-group">';
        html += '{!! Form::label('pack_price[]', 'Цена *', ['class' => 'col-lg-2 control-label']) !!}';
        html += '<div class="col-lg-7"> {!! Form::text('pack_price[]', null, ['class' => 'form-control', 'placeholder'=>'Название']) !!} </div>';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-lg-12">';
        html += '<div class="form-group">';
        html += '{!! Form::label('parameter_pack[]', 'Параметры *', ['class' => 'col-lg-2 control-label']) !!}';
        html +=  '{!! Form::select('newparameters_price[]', $category_options, 'Параметры', ['class' => 'form_control select2']) !!}';
        html += '<div class="col-lg-3"><a class="btn  btn-danger removeBlock" title="Удалить"> - </a></div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';

        $('#packlist').prepend(html);
        $(".select2").select2();

    });

    $(document).on( "click", '.removeBlock', function() {
        var parent = $(this).closest('div[class^="additional_field"]');
        parent.remove();
    });

    $(document).ready(function () {

        $('#js-example-basic-hide-search-multi').select2();

        $('#js-example-basic-hide-search-multi').on('select2:opening select2:closing', function( event ) {
            var $searchfield = $(this).parent().find('.select2-search__field');
            //$searchfield.prop('disabled', true);
        });

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