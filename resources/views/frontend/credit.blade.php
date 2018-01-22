@extends('layouts.frontend.app')

@section('title', 'Автокредит' )

@section('meta_desc', '')

@section('meta_keywords', '')

@section('css')
    <style>

        .select2-container .select2-selection--single {height: 52px;width: 100%; border-radius:4px;}
        .select2-container--default .select2-selection--single .select2-selection__rendered {line-height: 50px; }
        .select2-container--default .select2-selection--single .select2-selection__arrow {height: 50px;}
        .select2-container--default .select2-selection--single .select2-selection__rendered {color: #747474;}
        .select2-container--default .select2-results__option--highlighted[aria-selected] {background-color: #ee8116;}

    </style>

@endsection


@section('marks')
    @include('layouts.frontend.includes.mark_list')
@endsection

@section('content')

    <h1>Заявка на автокредит</h1>
    <div class="row">
        <div class="autoredit">

            {!! Form::open(['url' =>  '/request-credit', 'method' => 'post', 'class' => 'form-horizontal', 'id' => 'validate']) !!}

            <div class="select">
                {!! Form::select('mark', $mark_options, isset($request->mark) ? $request->mark : 'Марка', ['class' => 'select2 validate[required]', 'id' => 'mark']) !!}
            </div>

            <div class="select">
                {!! Form::select('model', $models_options, isset($request->model) ? $request->model : 'Модель', ['class' => 'select2 validate[required]', 'id' => 'model', !isset($request->model) ? 'disabled' : '']) !!}
            </div>

            <div class="select" id="search_result_modification">
                {!! Form::select('modification', $models_modification, isset($request->modification) ? $request->modification : 'Коплектация', ['class' => 'select2 validate[required]', 'id' => 'modification', !isset($request->modification) ? 'disabled' : '']) !!}
            </div>

            <div class="select">
                {!! Form::select('fee', [
                '0' => 'Первоначальный взнос 0%',
                '10' => 'Первоначальный взнос 10%',
                '20' => 'Первоначальный взнос 20%',
                '30' => 'Первоначальный взнос 30%',
                '40' => 'Первоначальный взнос 40%',
                '50' => 'Первоначальный взнос 50%',
                '60' => 'Первоначальный взнос 60%',
                '70' => 'Первоначальный взнос 70%',
                '80' => 'Первоначальный взнос 80%',
                ], 'Первоначальный взнос', ['class' => 'select2 validate[required[alertTextCheckboxMultiple]', 'placeholder' => 'Первоначальный взнос']
                ) !!}
            </div>

            <div class="select">
                {!! Form::text('name', old('name'), ['class' => 'form_control validate[required]', 'placeholder'=>'ФИО']) !!}
            </div>

            <div class="select">
                {!! Form::selectRange('age', 18, 85, 'Возраст', ['class' => 'select2 validate[required]', 'placeholder' => 'Возраст']) !!}
            </div>

            <div class="select">
                {!! Form::text('registration', old('registration'), ['class' => 'who form_control validate[required]', 'placeholder'=>'Регион по прописке', 'autocomplete' => 'off', 'id' => 'search_registration']) !!}
                <ul class="search_result_registration search_result"></ul>
            </div>
            <div class="select">
                {!! Form::text('phone', old('phone'), ['class' => 'form_control form_phone validate[required,custom[phone]]', 'placeholder' => 'Телефон']) !!}
            </div>

            <div class="checkboxes">
                <div class="row">
                    {!! Form::checkbox('confirmation', null, null, ['class' => 'checkbox validate[required[alertTextCheckboxe]]', 'id' => 'confirmation']) !!}
                    {!! Form::label('confirmation', 'Я понимаю, что автосалон находится в Москве') !!}
                </div>
                <div class="row">
                    {!! Form::checkbox('agree', null, null, ['class' => 'checkbox validate[required[alertTextCheckboxe]]', 'id' => 'agree']) !!}
                    {!! Form::label('agree', 'Я даю согласие на обработку моих персональных данных') !!}
                </div>
            </div>

            {!! Form::submit('отправить заявку', ['class'=>'btn']) !!}
            {!! Form::close() !!}

        </div>
        <div class="autoredit condition">
            <img id="model_img" src="/images/car_bg_big.png" height="315">
            <h2>Условия кредитования</h2>
            <ul>
                <li>Минимальный пакет документов паспорт, водительское удостоверение.</li>
                <li>Первоначальный взнос от 0%</li>
                <li>Сумма кредитования до 3,5 млн. рублей</li>
                <li>Рассмотрение 15 минут!</li>
                <li>Досрочное погашение без штрафов и комиссий!</li>
                <li>Срок кредита от 3 месяцев до 7 лет.</li>
                <li>Индивидуальный подход к каждому клиенту.</li>
            </ul>

        </div>
    </div>
    <div class="logos"><img src="/images/logos.jpg" /></div>


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
                        url: './ajax?action=get_modifications&id_car_model=' + idModel,
                        method: "GET",
                        dataType: "json"
                    });

                    request.done(function (data) {

                        var html = '<option>Комплектация</option>';

                        for (var i=0; i < data.item.length; i++) {
                            html += '<option value="' + data.item[i].name + '">' + data.item[i].name + '</option>';
                        }

                        console.log(html);

                        if (data.item.length > 0) {
                            $('#modification').prop('disabled',false);
                            $("#modification").html(html).fadeIn();
                        } else {
                            $("#modification").html(html).fadeIn();
                            $('#modification').prop('disabled',true);
                        }

                        $(".select2").select2({
                            width: '100%'
                        });
                    });
                }
            })

            $("#search_registration").on("change keyup input click", function() {
                if (this.value.length >= 2){

                    $.ajax({
                        type: 'GET',
                        url: '/ajax?action=search_registration&registration=' + this.value,
                        dataType : "json",
                        success: function(data){
                            if (data != null && data.item != null) {
                                var html = '';

                                for(var i=0; i < data.item.length; i++) {
                                    html += '<li data-item="' + data.item[i].id + '">' + data.item[i].name + '</li>';
                                }

                                console.log(html);

                                if (html != '')
                                    $(".search_result_registration").html(html).fadeIn();
                                else
                                    $(".search_result_registration").fadeOut();
                            }
                        }
                    })
                }
            })

            $(".search_result_registration").hover(function(){
                $(".who").blur();
            })

            $(".search_result_registration").on("click", "li", function(){
                $("#search_registration").val($(this).text());
                $(".search_result_registration").fadeOut();
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
