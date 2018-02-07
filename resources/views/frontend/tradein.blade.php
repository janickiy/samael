@extends('layouts.frontend.app')

@section('title', 'Заявка на Trade-in' )

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
                    <h1>Заявка на Trade-in</h1>
                    <div class="tradein_request_form ">
                        <h2>Новый автомобиль</h2>

                        {!! Form::open(['url' => '/request-tradein', 'method' => 'post', 'class' => 'form-horizontal', 'id' => 'validate']) !!}

                        <div class="select">
                            {!! Form::select('trade_in_mark', $trade_in_mark_options, isset($request->trade_in_mark) ? $request->trade_in_mark : 'Марка', ['class' => 'form_control select2 validate[required]', 'id' => 'trade_in_mark']) !!}
                        </div>

                        <div class="select">
                            {!! Form::select('trade_in_model', $trade_in_model_options, isset($request->trade_in_model) ? $request->trade_in_mode : 'Модель', ['class' => 'select2 validate[required]', 'id' => 'trade_in_model', !isset($request->trade_in_model) ? 'disabled' : '']) !!}
                        </div>

                        <div class="select">
                            {!! Form::select('trade_in_complectation', $trade_in_complectation_options, isset($request->trade_in_complectation) ? $request->trade_in_complectation : 'Комплектация', ['class' => 'select2 validate[required]', 'id' => 'trade_in_complectation', !isset($request->trade_in_complectation) ? 'disabled' : '']) !!}
                        </div>

                        <h2>Ваш автомобиль</h2>

                        <div class="select">
                            {!! Form::select('mark', $mark_options, isset($request->mark) ? $request->mark : 'Марка', ['class' => 'form_control select2 validate[required]', 'id' => 'mark']) !!}
                        </div>

                        <div class="select">
                            {!! Form::select('model', $model_options, isset($request->model) ? $request->model : 'Модель', ['class' => 'form_control select2 validate[required]', 'id' => 'model', !isset($request->model) ? 'disabled' : '']) !!}
                        </div>

                        {{ Form::selectYear('year', date('Y'), date('Y')-50, isset($request->year) ? $request->year : null, ['class' => 'form_control select2', 'placeholder' => 'Год выпуска']) }}

                        {!! Form::text('mileage', old('mileage'), ['class' => 'form_control validate[required,custom[integer]]', 'placeholder'=>'Пробег']) !!}

                        {!! Form::text('name', old('name'), ['class' => 'form_control validate[required]', 'placeholder'=>'Ф.И.О.']) !!}

                        {!! Form::text('phone', old('phone'), ['class' => 'form_control form_phone validate[required,custom[phone]]', 'placeholder' => '+7 (___) ___ - __ - __']) !!}

                        <div class="compliance_check">

                            {!! Form::checkbox('agree', null, null, ['class' => 'checkbox validate[required[alertTextCheckboxe]]', 'id' => 'tradein_check']) !!}

                            {!! Form::label('tradein_check', 'Согласен с обработкой персональных данных', ['class' => 'control-label col-md-2']) !!}

                        </div>

                        {!! Form::submit('Отправить заявку', ['class'=>'btn']) !!}

                        {!! Form::close() !!}

                    </div>
                    <div class="request_desc">
                        <div class="request_text">
                            <h2>Trade-in - это удобно</h2>
                            <p>Вы доставляете автомобиль<br/>с пакетом необходимых документов.</p>
                            <p>Перед выкупом авто менеджер проводит осмотр Вашего автомобиля.</p>
                            <p>Эксперт по оценке автомобилей предлагает цену за Ваш автомобиль.</p>
                            <p>Мы оформляем все необходимые документы. Вы получаете деньги наличными.</p>
                            <p>Вы получаете скидку в размере стоимости Вашего старого автомобиля и дополнительную скидку от нашего салона.</p>
                        </div>
                    </div>
                </div>
                <div class="presents_block sidebar sidebar2">
                    <div class="present_item_container present_image_container">
                        <div class="present_item">
                            <img src="images/present.jpg" />
                        </div>
                    </div>
                    <div class="present_item_container">
                        <div class="present_item">
                            <div><img src="images/p_1.png" /></div>
                            <div>Зимняя резина<br/>в подарок</div>
                        </div>
                    </div>
                    <div class="present_item_container">
                        <div class="present_item">
                            <div><img src="images/p_1.png" /></div>
                            <div>Зимняя резина<br/>в подарок</div>
                        </div>
                    </div>
                    <div class="present_item_container">
                        <div class="present_item">
                            <div><img src="images/p_2.png" /></div>
                            <div>Дорога<br/>до Москвы<br/>за наш счет</div>
                        </div>
                    </div>
                    <div class="present_item_container">
                        <div class="present_item">
                            <div><img src="images/p_3.png" /></div>
                            <div>КАСКО<br/>в подарок</div>
                        </div>
                    </div>
                </div>
            </div>
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
                            $("#trade_in_model").prop('disabled',false);
                            $("#trade_in_model").html(html).fadeIn();
                        } else {
                            $("#trade_in_model").html(html).fadeIn();
                            $("#trade_in_model").prop('disabled',true);
                        }

                        $(".select2").select2({
                            width: '100%'
                        });
                    });
                }
            })

            $(document).on('change keyup input click','#trade_in_model',function(){
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
                            $("#trade_in_complectation").prop('disabled',false);
                            $("#trade_in_complectation").html(html).fadeIn();
                        } else {
                            $("#trade_in_complectation").html(html).fadeIn();
                            $("#trade_in_complectation").prop('disabled',true);
                        }

                        $(".select2").select2({
                            width: '100%'
                        });
                    });
                }
            })

            $("#mark").on("change keyup input click", function() {

                var idMark = this.value;

                if(idMark != null) {

                    var request = $.ajax({
                        url: './ajax?action=get_car_models&id_car_mark=' + idMark,
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
                            $("#model").prop('disabled',false);
                            $("#model").html(html).fadeIn();
                        } else {
                            $("#model").html(html).fadeIn();
                            $("#model").prop('disabled',true);
                        }

                        $(".select2").select2({
                            width: '100%'
                        });
                    });
                }
            })

            $(".form_phone").mask("+7 (999) 999-9999");
        })

    </script>
@endsection
