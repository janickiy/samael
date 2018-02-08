@extends('layouts.frontend.app')

@section('title', 'Заявка на автокредит')

@section('meta_desc', '')

@section('meta_keywords', '')

@section('css')

@endsection


@section('marks')

    @include('layouts.frontend.includes.mark_list')

@endsection

@section('content')

    <div class="inset_page">
        <div class="main_width">
            @section('breadcrumbs')

                @include('layouts.frontend.includes.breadcrumbs')

            @endsection
            <div class="row">
                <div class="request_page_content">
                    <h1>Заявка на автокредит от <span>0</span>% </h1>
                    <div class="credit_request_form ">

                        {!! Form::open(['url' => '/request-credit', 'method' => 'post', 'class' => 'form-horizontal', 'id' => 'validate']) !!}

                        <div class="select">
                            {!! Form::select('mark', $mark_options, isset($request->mark) ? $request->mark : 'Марка', ['class' => 'form_control select2 validate[required]', 'id' => 'mark']) !!}
                        </div>

                        <div class="select">
                            {!! Form::select('model', $model_options, isset($request->model) ? $request->model : 'Модель', ['class' => 'form_control select2 validate[required]', 'id' => 'model', !isset($request->model) ? 'disabled' : '']) !!}
                        </div>

                        <div class="select" id="search_result_modification">
                            {!! Form::select('complectation', $complectation_options, isset($request->complectation) ? $request->complectation : 'Коплектация', ['class' => 'select2 validate[required]', 'id' => 'complectation', !isset($request->complectation) ? 'disabled' : '']) !!}
                        </div>

                        <br/>
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
                            ], isset($request->fee) ? $request->fee : 'Первоначальный взнос', ['class' => 'form_control select2 validate[required[alertTextCheckboxMultiple]', 'placeholder' => 'Первоначальный взнос']
                            ) !!}
                        </div>
                        <br/>

                        {!! Form::text('name', old('name'), ['class' => 'form_control validate[required]', 'placeholder'=>'Ф.И.О.']) !!}

                        {!! Form::selectRange('age', 18, 90, 'Возраст', ['class' => 'form_control select2 validate[required]', 'placeholder' => 'Возраст']) !!}

                        {!! Form::text('registration', old('registration'), ['class' => 'who form_control validate[required]', 'placeholder'=>'Регион по прописке', 'autocomplete' => 'off', 'id' => 'search_registration']) !!}

                        <ul class="search_result_registration search_result"></ul>

                        {!! Form::text('phone', old('phone'), ['class' => 'form_control form_phone validate[required,custom[phone]]', 'placeholder' => '+7 (___) ___ - __ - __']) !!}

                        <div class="compliance_check">

                            {!! Form::checkbox('agree', null, null, ['class' => 'checkbox validate[required[alertTextCheckboxe]]', 'id' => 'tradein_check']) !!}

                            {!! Form::label('tradein_check', 'Согласен с обработкой персональных данных', ['class' => 'control-label col-md-2']) !!}

                        </div>

                        {!! Form::submit('Отправить заявку', ['class'=>'btn']) !!}

                        {!! Form::close() !!}

                    </div>
                    <div class="request_desc" id="request_desc">
                        <div class="request_text">
                            <h2>Условия кредитования</h2>
                            <ul class="line">
                                <li>Минимальный пакет документов паспорт, водительское удостоверение.</li>
                                <li>Первоначальный взнос от 0%</li>
                                <li>Сумма кредитования до 3,5 млн. рублей</li>
                                <li>Рассмотрение 15 минут!</li>
                                <li>Досрочное погашение без штрафов и комиссий!</li>
                                <li>Срок кредита от 3 месяцев до 7 лет.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="presents_block sidebar sidebar2 sidebar3">
                    <div class="present_item_container">
                        <div class="present_item">
                            <div><img src="/images/p_1.png" /></div>
                            <div>Зимняя резина<br/>в подарок</div>
                        </div>
                    </div>
                    <div class="present_item_container">
                        <div class="present_item">
                            <div><img src="/images/p_2.png" /></div>
                            <div>Дорога<br/>до Москвы<br/>за наш счет</div>
                        </div>
                    </div>
                    <div class="present_item_container">
                        <div class="present_item">
                            <div><img src="/images/p_3.png" /></div>
                            <div>КАСКО<br/>в подарок</div>
                        </div>
                    </div>
                    <div class="present_item_container">
                        <div class="present_item">
                            <div><img src="/images/p_4.png" /></div>
                            <div>Распродажа<br/>авто 2016</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="credits">
                <h2>Вашу заявку на кредит рассмотрят наши банки-партнеры:</h2>
                <ul class="row">
                    <li><img src="/images/banks/1.png" /></li>
                    <li><img src="/images/banks/2.png" /></li>
                    <li><img src="/images/banks/3.png" /></li>
                    <li><img src="/images/banks/4.png" /></li>
                    <li><img src="/images/banks/5.png" /></li>
                    <li><img src="/images/banks/6.png" /></li>
                    <li><img src="/images/banks/7.png" /></li>
                    <li><img src="/images/banks/8.png" /></li>
                    <li><img src="/images/banks/9.png" /></li>
                </ul>
                <ul class="row">
                    <li><img src="/images/banks/10.png" /></li>
                    <li><img src="/images/banks/11.png" /></li>
                    <li><img src="/images/banks/12.png" /></li>
                    <li><img src="/images/banks/13.png" /></li>
                    <li><img src="/images/banks/14.png" /></li>
                    <li><img src="/images/banks/15.png" /></li>
                    <li><img src="/images/banks/16.png" /></li>
                    <li><img src="/images/banks/17.png" /></li>
                    <li><img src="/images/banks/18.png" /></li>
                </ul>
            </div>
        </div>
        <div class="attantion_block">
            <div class="main_width">
                <div class="fs16">Внимание!</div>
                К сожалению, банки не кредитуют регионы: Республика Кабардино-Балкария, Республика Чечня, Республика Дагестан, Республика Ингушетия, Республика Карачаево-Черкесия, Магадан.
            </div>
        </div>
        <div class="main_width">
            <section>
                <div class="more_credits">
                    <h1>Выгодные предложения в кредит</h1>
                    <ul class="row item_list container">
                        <li>
                            <div class="list_item">
                                <a href="">
                                    <div class="item_image"><img src="/images/m_c_1.png" /></div>
                                    <div class="item_name">Государственная программа автокредитования</div>
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="list_item">
                                <a href="">
                                    <div class="item_image"><img src="/images/m_c_2.png" /></div>
                                    <div class="item_name">Автокредит“ Первый автомобиль”</div>
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="list_item">
                                <a href="">
                                    <div class="item_image"><img src="/images/m_c_3.png" /></div>
                                    <div class="item_name">Программа кредитования “Семейный авто”</div>
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="list_item">
                                <a href="">
                                    <div class="item_image"><img src="/images/m_c_4.png" /></div>
                                    <div class="item_name">Программа автокредитования “Стандарт”</div>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </section>
        </div>
    </div>

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
                        url: './ajax?action=get_modifications&id_model=' + idModel,
                        method: "GET",
                        dataType: "json"
                    });

                    request.done(function (data) {

                        var html = '<option>Комплектация</option>';

                        for (var i = 0; i < data.item.length; i++) {
                            html += '<option value="' + data.item[i].id + '">' + data.item[i].name + '</option>';
                        }

                        console.log(html);

                        if (data.item.length > 0) {
                            if (data.image)
                                $('#request_desc').css('background-image', 'url(' + data.image + ')');
                            else
                                $('#request_desc').css('background-image', 'url("/images/tradein_bg.png")');
                            $("#complectation").prop('disabled',false);
                            $("#complectation").html(html).fadeIn();
                        } else {
                            $('#request_desc').css('background-image', 'url("/images/tradein_bg.png")');
                            $("#complectation").html(html).fadeIn();
                            $("#complectation").prop('disabled',true);
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
