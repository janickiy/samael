@extends('layouts.admin.app')

@section('title', 'Модификации')

@section('css')
<!-- iCheck for checkboxes and radio inputs -->
{!! Html::style('assets/plugins/iCheck/all.css') !!}
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-list-alt"></i> {{ isset($catalogmodification) ? 'Редактировать' : 'Добавить' }} модификацию
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Панель управления</a></li>
        <li><a href="{{ url('admin/catalogmodels/model/' . (isset($catalogmodification) ? $catalogmodification->model : $id_model) . '/modifications' ) }}"><i class="fa fa-list-alt"></i> Модификации</a></li>
        <li class="active"><i class="fa {{ isset($catalogmodification) ? 'fa-pencil' : 'fa-plus' }}"></i> {{ isset($catalogmodification) ? 'Редактировать' : 'Добавить' }}
           модификацию
        </li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Форма данных модификации</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            <p>* - обязательные поля</p>
            {!! Form::open(['url' => isset($catalogmodification) ? URL::to('admin/catalogmodifications/' . $catalogmodification->id )  :  URL::to('admin/catalogmodifications/') , 'method' => isset($catalogmodification) ? 'put': 'post', 'class' => 'form-horizontal', 'id'=>'validate']) !!}
            <div class="col-md-12">
                {!! Form::hidden('id_model', $id_model) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Название *', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('name', old('name', isset($catalogmodification) ? $catalogmodification->name : null), ['class' => 'form-control validate[required]', 'placeholder' => 'Название модификации']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('length', 'Длина, мм', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('length', old('length', isset($catalogmodification) ? $catalogmodification->length : null), ['class' => 'form-control validate[custom[integer]]', 'placeholder' => 'Длина, мм']) !!}
                    </div>                </div>

                <div class="form-group">
                    {!! Form::label('width', 'Ширина, мм', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('width', old('width', isset($catalogmodification) ? $catalogmodification->width : null), ['class' => 'form-control validate[custom[integer]]', 'placeholder' => 'Ширина, мм']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('height', 'Высота, мм', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('height', old('height', isset($catalogmodification) ? $catalogmodification->height : null), ['class' => 'form-control validate[custom[integer]]', 'placeholder' => 'Высота, мм']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('wheel_base', 'Колесная база, мм', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('wheel_base', old('wheel_base', isset($catalogmodification) ? $catalogmodification->wheel_base : null), ['class' => 'form-control validate[custom[integer]]', 'placeholder' => 'Высота, мм']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('front_rut', 'Передняя колея колес, мм', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('front_rut', old('front_rut', isset($catalogmodification) ? $catalogmodification->front_rut : null), ['class' => 'form-control validate[custom[integer]]', 'placeholder' => 'Передняя колея колес, мм']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('back_rut', 'Задняя колея колес, мм', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('back_rut', old('back_rut', isset($catalogmodification) ? $catalogmodification->back_rut : null), ['class' => 'form-control validate[custom[integer]]', 'placeholder' => 'Задняя колея колес, мм']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('front_overhang', 'Передний свес, мм', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('front_overhang', old('front_overhang', isset($catalogmodification) ? $catalogmodification->front_overhang : null), ['class' => 'form-control validate[custom[integer]]', 'placeholder' => 'Передний свес, мм']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('back_overhang', 'Задний свес, мм', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('back_overhang', old('back_overhang', isset($catalogmodification) ? $catalogmodification->back_overhang : null), ['class' => 'form-control validate[custom[integer]]', 'placeholder' => 'Задний свес, мм']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('trunk_volume_min', 'Минимальный объем багажного отделения, л', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('trunk_volume_min', old('trunk_volume_min', isset($catalogmodification) ? $catalogmodification->trunk_volume_min : null), ['class' => 'form-control validate[custom[integer]]', 'placeholder' => 'Минимальный объем багажного отделения, л']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('trunk_volume_max', 'Максимальный объем багажного отделения, л', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('trunk_volume_max', old('trunk_volume_max', isset($catalogmodification) ? $catalogmodification->trunk_volume_max : null), ['class' => 'form-control validate[custom[integer]]', 'placeholder' => 'Максимальный объем багажного отделения, л']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('tank_volume', 'Объем топливного бака, л', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('tank_volume', old('tank_volume', isset($catalogmodification) ? $catalogmodification->tank_volume : null), ['class' => 'form-control validate[custom[integer]]', 'placeholder' => 'Объем топливного бака, л']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('front_brakes', 'Передние тормоза (тип, размер)', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('front_brakes', old('front_brakes', isset($catalogmodification) ? $catalogmodification->front_brakes : null), ['class' => 'form-control', 'placeholder' => 'Передние тормоза (тип, размер)']) !!}
                    </div>
                </div>


                <div class="form-group">
                    {!! Form::label('back_brakes', 'Задние тормоза (тип, размер)', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('back_brakes', old('back_brakes', isset($catalogmodification) ? $catalogmodification->back_brakes : null), ['class' => 'form-control', 'placeholder' => 'Задние тормоза (тип, размер)']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('front_suspension', 'Передняя подвеска', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('front_suspension', old('front_suspension', isset($catalogmodification) ? $catalogmodification->front_suspension : null), ['class' => 'form-control', 'placeholder' => 'Передняя подвеска']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('back_suspension', 'Задняя подвеска', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('back_suspension', old('back_suspension', isset($catalogmodification) ? $catalogmodification->back_suspension : null), ['class' => 'form-control', 'placeholder' => 'Задняя подвеска']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('engine_displacement', 'Объем двигателя, л', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('engine_displacement', old('engine_displacement', isset($catalogmodification) ? $catalogmodification->engine_displacement : null), ['class' => 'form-control', 'placeholder' => 'Объем двигателя, л']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('engine_displacement_working_value', 'Рабочий объем двигателя, см3', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('engine_displacement_working_value', old('engine_displacement_working_value', isset($catalogmodification) ? $catalogmodification->engine_displacement_working_value : null), ['class' => 'form-control validate[custom[integer]]', 'placeholder' => 'Рабочий объем двигателя']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('engine_type', 'Тип двигателя', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {{ Form::select('engine_type',
                        ['petrol' => 'Бензиновый',
                        'petrol_turbo' => 'Бензиновый турбированный',
                        'diesel' => 'Дизельный',
                        'diesel_turbo' => 'Дизельный турбированный',
                        'electric' => 'Электродвигатель',
                        'hybrid' => 'Гибрид'
                        ], isset($catalogmodification) ? $catalogmodification->engine_type : 'petrol', ['class' => 'select2']) }}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('gearbox', 'Коробка передач*', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {{ Form::select('gearbox',
                        ['mt' => 'Механическая',
                        'at' => 'Автоматическая',
                        'rgt' => 'Роботизированная',
                        'cvt' => 'Вариатор',
                        'amt' => 'Автоматизированная механическая'
                        ], isset($catalogmodification) ? $catalogmodification->gearbox : 'mt', ['class' => 'select2']) }}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('gears', 'Количество передач', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('gears', old('gears', isset($catalogmodification) ? $catalogmodification->gears : null), ['class' => 'form-control validate[custom[integer],min[1]]', 'placeholder' => 'Количество передач']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('drive', 'Тип привода', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {{ Form::select('drive',
                        ['front' => 'Передний',
                        'rear' => 'Заднийй',
                        'four' => 'Полный'
                        ], isset($catalogmodification) ? $catalogmodification->drive : 'front', ['class' => 'select2']) }}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('power', 'Мощность, л.с.', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('power', old('power', isset($catalogmodification) ? $catalogmodification->power : null), ['class' => 'form-control validate[custom[integer]]', 'placeholder' => 'Мощность, л.с.']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('consume_city', 'Расход топлива в городе, л/100 км', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('consume_city', old('consume_city', isset($catalogmodification) ? $catalogmodification->consume_city : null), ['class' => 'form-control', 'placeholder' => 'Расход топлива в городе, л/100 км']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('consume_track', 'Расход топлива на трассе, л/100 км', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('consume_track', old('consume_track', isset($catalogmodification) ? $catalogmodification->consume_track : null), ['class' => 'form-control', 'placeholder' => 'Расход топлива на трассе, л/100 км']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('consume_mixed', 'Смешанный расход топлива, л/100 км', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('consume_mixed', old('consume_mixed', isset($catalogmodification) ? $catalogmodification->consume_mixed : null), ['class' => 'form-control', 'placeholder' => 'Смешанный расход топлива, л/100 км']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('acceleration_100km', 'Разгон от 0 до 100 км/ч, сек.', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('acceleration_100km', old('acceleration_100km', isset($catalogmodification) ? $catalogmodification->acceleration_100km : null), ['class' => 'form-control', 'placeholder' => 'Разгон от 0 до 100 км/ч, сек.']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('max_speed', 'Максимальная скорость, км/ч', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('max_speed', old('max_speed', isset($catalogmodification) ? $catalogmodification->max_speed : null), ['class' => 'form-control', 'placeholder' => 'Максимальная скорость, км/ч']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('clearance', 'Дорожный просвет, мм', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('clearance', old('clearance', isset($catalogmodification) ? $catalogmodification->clearance : null), ['class' => 'form-control validate[custom[integer]]', 'placeholder' => 'Дорожный просвет, мм']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('min_mass', 'Минимальная масса, кг', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('min_mass', old('min_mass', isset($catalogmodification) ? $catalogmodification->min_mass : null), ['class' => 'form-control validate[custom[integer]]', 'placeholder' => 'Минимальная масса, кг']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('max_mass', 'Максимальная масса, кг', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('max_mass', old('max_mass', isset($catalogmodification) ? $catalogmodification->max_mass : null), ['class' => 'form-control validate[custom[integer]', 'placeholder' => 'Максимальная масса, кг']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('trailer_mass', 'Допустимая масса прицепа без тормозов, кг', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('trailer_mass', old('trailer_mass', isset($catalogmodification) ? $catalogmodification->trailer_mass : null), ['class' => 'form-control validate[custom[integer]]', 'placeholder' => 'Допустимая масса прицепа без тормозов, кг']) !!}
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
                         ], isset($catalogmodification) ? $catalogmodification->sedan : 'sedan', ['class' => 'select2']) }}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('published', 'Опубликован', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        <label class="check">
                            @if(isset($catalogmodification))
                                {!! Form::checkbox('published',1,  old('published' , (isset($catalogmodification) && ($catalogmodification->getOriginal('published') == 1) ) ? true : false ) ,['class'=>'minimal']) !!}
                            @else
                                {!! Form::checkbox('published',1,  old('published' , true) ,['class'=>'minimal']) !!}
                            @endif
                            Да</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-2">
                        {!! Form::submit( (isset($catalogmodification) ? 'Обновить': 'Добавить') . '', ['class'=>'btn btn-primary']) !!}
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