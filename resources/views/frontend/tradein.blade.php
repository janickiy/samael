@extends('layouts.frontend.app')

@section('title', 'Trade-in' )

@section('meta_desc', '')

@section('meta_keywords', '')

@section('css')
    <style>

    .select2-container .select2-selection--single {height: 52px;width: 100%; border-radius:4px;}.select2-container--default .select2-selection--single .select2-selection__rendered {line-height: 50px; }.select2-container--default .select2-selection--single .select2-selection__arrow {height: 50px;}.select2-container--default .select2-selection--single .select2-selection__rendered {color: #747474;}.select2-container--default .select2-results__option--highlighted[aria-selected] {background-color: #ee8116;}

    </style>
@endsection

@section('marks')
    @include('layouts.frontend.includes.mark_list')
@endsection

@section('content')
    <section>
        <h1>Заявка на Trade-in</h1>
        <div class="row">
            <div class="tradein">
                <h2>Ваш автомобиль</h2>

                {!! Form::open(['url' => '/request-tradein', 'method' => 'post', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal', 'id' => 'validate']) !!}

                <div class="select">
                    {!! Form::select('mark', $mark_options, isset($request->mark) ? $request->mark : 'Марка', ['class' => 'select2 validate[required]', 'id' => 'mark']) !!}
                </div>

                <div class="select">
                    {!! Form::select('model', $models_options, isset($request->model) ? $request->model : 'Модель', ['class' => 'select2 validate[required]', 'id' => 'model', !isset($request->model) ? 'disabled' : '']) !!}
                </div>

                <div class="select">
                    <div class="select">
                        @if(isset($request->year))
                            {!! Form::selectYear('year', isset($year['from']) ? $year['from'] : null, isset($year['to']) ? $year['to'] : null, isset($request->year) ? $request->year : null, ['class' => 'select2 validate[required]', 'id' => 'year', 'placeholder' => 'Год от']) !!}
                        @else
                            {!! Form::select('year', [], 'Год выпуска', ['class' => 'select2 validate[required]', 'id' => 'year', 'disabled', 'placeholder' => 'Год выпуска']) !!}
                        @endif
                    </div>
                </div>

                <div class="select">
                    <div class="select">
                        {!! Form::text('mileage', old('mileage'), ['class' => 'form_control validate[required,custom[onlyNumberSp]]', 'placeholder' => 'Пробег (тыс. км)']) !!}
                    </div>
                </div>

                <div class="select">
                    <div class="select">
                        {!! Form::select('gearbox', [
                         null => 'КПП',
                        'Механическая' => 'Механическая',
                        'Автоматическая' => 'Автоматическая',
                        'Роботизированная' => 'Роботизированная',
                        'Вариатор' => 'Вариатор',
                        'Автоматизированная механическая' => 'Автоматизированная механическая'], isset($request->gearbox) ? $request->gearbox : 'Коробка', ['class' => 'select2 validate[required]]'])
                        !!}
                    </div>
                </div>

                <div class="select">
                    <div class="file-upload">
                        <label>

                            {{ Form::file('photo', ['class' => 'field', 'onchange' => 'getFileParam();', 'id' => 'uploaded-file1']) }}

                            <span>Выберите файл</span><br />
                        </label>
                    </div>
                    <div id="preview1">&nbsp;</div>
                    <div id="file-name1" class="disp_n">&nbsp;</div>
                    <div id="file-size1" class="disp_n">&nbsp;</div>
                </div>

            </div>
            <div class="tradein">

                <h2>Новый автомобиль</h2>
                <div class="select">
                    <div class="select">
                        {!! Form::select('trade_in_mark', $mark_options, isset($request->trade_in_mark) ? $request->trade_in_mark : 'Марка', ['class' => 'select2 validate[required]', 'id' => 'trade_in_mark']) !!}
                    </div>
                </div>
                <div class="select">
                    <div class="select">
                        {!! Form::select('trade_in_model', $models_options, isset($request->trade_in_model) ? $request->trade_in_model : 'Модель', ['class' => 'select2 validate[required]', 'id' => 'trade_in_model', !isset($request->trade_in_model) ? 'disabled' : '']) !!}
                    </div>
                </div>
                <div class="select">
                    <img id="model_img" src="/images/car_bg.png" height="380">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="tradein">
                <div class="select">
                    {!! Form::text('name', old('name'), ['class' => 'form_control validate[required]', 'placeholder' => 'ФИО']) !!}
                </div>
                <div class="checkboxes">
                    <div class="row">
                        {!! Form::checkbox('confirmation', null, null, ['class' => 'checkbox validate[required[alertTextCheckboxe]]', 'id' => 'confirmation']) !!}
                        {!! Form::label('confirmation', 'Я понимаю, что автосалон находится в Москве') !!}
                    </div>
                    <div class="row">
                        {!! Form::checkbox('agree', null, null, ['class' => 'checkbox  validate[required[alertTextCheckboxe]]', 'id' => 'agree']) !!}
                        {!! Form::label('agree', 'Я даю согласие на обработку моих персональных данных') !!}
                    </div>
                </div>
            </div>
            <div class="tradein">
                <div class="select">
                      {!! Form::text('phone', old('phone'), ['class' => 'form_control form_phone validate[required,custom[phone]]', 'placeholder' => 'Телефон']) !!}
                </div>

                {!! Form::submit('отправить заявку', ['class'=>'btn']) !!}

            </div>

            {!! Form::close() !!}

        </div>
    </section>
@endsection

@section('js')

    {!! Html::script('assets/plugins/select2/select2.full.min.js') !!}

    <script type="text/javascript">

        $(document).ready(function () {
            $(".select2").select2({
                width: '100%'
            });
        })

        $(function(){

            $("#mark").on("change keyup input click", function() {

                var idMark = this.value;

                if(idMark != null) {

                    var request = $.ajax({
                        url: './ajax?action=get_models&id_car_mark=' + idMark,
                        method: "GET",
                        dataType: "json"
                    });

                    request.done(function (data) {
                        var html = '<option>Модель</option>';

                        for (var i = 0; i < data.item.length; i++) {
                            html += '<option value="' + data.item[i].id + '">' + data.item[i].name + '</option>';
                        }

                        console.log(html);

                        if (data.item.length > 0) {
                            $('#model').prop('disabled',false);
                            $("#model").html(html).fadeIn();
                        } else {
                            $("#model").html(html).fadeIn();
                            $('#model').prop('disabled',true);
                        }

                        $(".select2").select2({
                            width: '100%'
                        });
                    });
                }
            })

            $(document).on('change keyup input click','#model',function(){
                var idModel = this.value;

                if (idModel != null) {
                    var request = $.ajax({
                        url: './ajax?action=get_year&id_car_model=' + idModel,
                        method: "GET",
                        dataType: "json"
                    });

                    request.done(function (data) {

                        var html = '<option>Год выпуска</option>';

                        for (var i = data.min; i < data.max; i++) {
                            html += '<option value="' + i + '">' + i + '</option>';
                        }

                        if (data.min != null || data.max != null) {
                            $('#year').prop('disabled',false);
                            $("#year").html(html).fadeIn();
                        } else {
                            $("#year").html(html).fadeIn();
                            $('#year').prop('disabled',true);
                        }

                        $(".select2").select2({
                            width: '100%'
                        });
                    });
                }
            })

            $("#trade_in_mark").on("change keyup input click", function() {

                var idMark = this.value;

                if(idMark != null) {

                    var request = $.ajax({
                        url: './ajax?action=get_models&id_car_mark=' + idMark,
                        method: "GET",
                        dataType: "json"
                    });

                    request.done(function (data) {
                        var html = '<option>Модель</option>';

                        for (var i = 0; i < data.item.length; i++) {
                            html += '<option value="' + data.item[i].id + '">' + data.item[i].name + '</option>';
                        }

                        console.log(html);

                        if (data.item.length > 0) {
                            $('#trade_in_model').prop('disabled',false);
                            $("#trade_in_model").html(html).fadeIn();
                        } else {
                            $("#trade_in_model").html(html).fadeIn();
                            $('#trade_in_model').prop('disabled',true);
                        }

                        $(".select2").select2({
                            width: '100%'
                        });
                    });
                }
            })

            $("#trade_in_model").on("change keyup input click", function() {

                var idModel = this.value;

                if(idModel != null) {

                    var request = $.ajax({
                        url: './ajax?action=get_model_info&id=' + idModel,
                        method: "GET",
                        dataType: "json"
                    });

                    request.done(function (data) {
                        if (data.image != null && data.image != '') {
                            $('#model_img').attr("src", data.image).fadeIn();
                        } else {
                            $('#model_img').attr("src", "/images/car_bg.png").fadeIn();
                        }
                    });
                }
            })


            $(".form_phone").mask("+7 (999) 999-9999");


        })

    </script>
@endsection
