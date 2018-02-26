@extends('layouts.frontend.app')

@section('title', 'Контакты')

@section('meta_desc', '')

@section('meta_keywords', '')

@section('css')

    {!! Html::style('css/fancybox/jquery.fancybox.css') !!}

@endsection

@section('marks')
    @include('layouts.frontend.includes.mark_list')
@endsection

@section('content')

    <!-- hidden inline form -->
    <div id="inline" class="popup_form">
        <h3>Заказать обратный звонок</h3>

        {!! Form::open(['url' => '/callback', 'method' => 'post', 'class' => 'form-horizontal', 'id' => 'validate']) !!}

        <div class="form_field">
            {!! Form::text('name', old('name'), ['class' => 'form_control  validate[required]', 'placeholder'=>'Ваше имя']) !!}
        </div>

        <div class="form_field">
            {!! Form::text('phone', old('phone'), ['class' => 'form_control form_phone validate[required,custom[phone]]', 'placeholder'=>'Ваше телефон']) !!}
        </div>

        <div class="form_field call_time">
            <label>Удобное время звонка:</label>
            <div class="fl_l">
                {!! Form::select('from_time', [
                    '9:00' => '9:00',
                    '10:00' => '10:00',
                    '11:00' => '11:00',
                    '12:00' => '12:00',
                    '13:00' => '13:00',
                    '14:00' => '14:00',
                    '15:00' => '15:00',
                    '16:00' => '16:00',
                    '17:00' => '17:00',
                    '18:00' => '18:00',
                    '19:00' => '19:00',
                    ], '9:00', ['class' => 'select2 validate[required[alertTextCheckboxMultiple]', 'placeholder' => 'От']
                    )
                !!}
            </div>
            <div class="fl_l">
                {!! Form::select('to_time', [
                   '9:00' => '9:00',
                   '10:00' => '10:00',
                   '11:00' => '11:00',
                   '12:00' => '12:00',
                   '13:00' => '13:00',
                   '14:00' => '14:00',
                   '15:00' => '15:00',
                   '16:00' => '16:00',
                   '17:00' => '17:00',
                   '18:00' => '18:00',
                   '19:00' => '19:00',
                   ], '19:00', ['class' => 'select2 validate[required[alertTextCheckboxMultiple]', 'placeholder' => 'От']
                   )
               !!}
            </div>
        </div>

        {!! Form::submit('Отправить', ['class'=>'btn']) !!}
        {!! Form::close() !!}

    </div>


    <div class="inset_page white_bg contacts">
        <div class="main_width">
			<div class="breadcrumbs">
                    <a href="/">Главная</a>  - <span>Контакты</span>
                </div>
            <div class="page_content">
                <h1>Контакты</h1>
                <div class="row">
                    <div class="contants_block address_block">
                        <div>
                            Адрес:
                            <p>г. Москва, <span>метро Ленинский проспект</span>, <br/>
                                ул. Вавилова, 13А
                            </p>
                        </div>
                        <div>
                            Режим работы:
                            <p>с 9:00 до 20:00 ежедневно.</p>
                        </div>
                    </div>
                    <div class="contants_block phones_block">
                        <div>
                            Телефоны:
                            <p>
                                <a href="tel:{!! getSetting('TELEPHONE_1') !!}">{!! getSetting('TELEPHONE_1') !!}</a>,<br/>
                                <a href="tel:{!! getSetting('TELEPHONE_2') !!}">{!! getSetting('TELEPHONE_2') !!}</a>
                            </p>
                        </div>
                    </div>
                    <div class="contants_block recall_block">
                        <div>
                            Бесплатно по России
                            <p>
                                <a class="free_phone"
                                   href="tel:{!! getSetting('TELEPHONE_2') !!}">{!! getSetting('TELEPHONE_2') !!}</a>
                                <a href="#inline" class="btn recall_link modalbox">Обратный звонок</a>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="mobile_contacts">
        <h3>Контакты</h3>
        <div class="addresses">
            <img src="/images/address_ico.png">
            <div>{!! getSetting('FRONTEND_ADDRESS') !!}</div>
        </div>
        <div class="times">
            <img src="/images/times_ico.png">
            <div>{!! getSetting('FRONTEND_TIMES') !!}</div>
        </div>
        <div class="mobile_phones">
            <img src="/images/mobile_phone_ico.png">
            <div>
                <div class="free_phone">
                    <a href="tel:{!! getSetting('TELEPHONE_1') !!}">{!! getSetting('TELEPHONE_1') !!}</a>
                    <span>бесплатная линия</span>
                </div>
                <a class="moscow_phone"
                   href="tel:{!! getSetting('TELEPHONE_2') !!}">{!! getSetting('TELEPHONE_2') !!}</a>
                <span>звонок по Москве</span>
            </div>
        </div>
        <a href="#inline" class="btn recall_link modalbox">Обратный звонок</a>



    </div>

    <div id="map" style="width: 600px; height: 300px"></div>

@endsection

@section('js')

    {!! Html::script('assets/plugins/select2/select2.full.min.js') !!}

    <script type="text/javascript">
        ymaps.ready(init);
        var myMap,
            myPlacemark;

        function init(){
            myMap = new ymaps.Map("map", {
                center: [{!! getSetting('MAP_LONGITUDE') !!}, {!! getSetting('MAP_LATITUDE') !!}],
                zoom: 16
            });

            myPlacemark = new ymaps.Placemark([{!! getSetting('MAP_LONGITUDE') !!}, {!! getSetting('MAP_LATITUDE') !!}], {
                hintContent: '{!! getSetting('FRONTEND_ADDRESS') !!}',
                balloonContent: '{!! getSetting('SITE_TITLE') !!}'
            });

            myMap.geoObjects.add(myPlacemark);
        }
    </script>


    <script type="text/javascript">
        $(document).ready(function () {
            $(".select2").select2();
        })

        $(function () {
            $(".form_phone").mask("+7 (999) 999-9999");
        })

        $(document).ready(function () {
            $(".modalbox").fancybox();

        });

    </script>

@endsection