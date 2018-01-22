@extends('layouts.frontend.app')

@section('title', 'Контакт')

@section('meta_desc', '')

@section('meta_keywords', '')

@section('css')

    {!! Html::style('css/fancybox/jquery.fancybox.css') !!}

    <style>

        .select2-container .select2-selection--single {height: 52px;width: 100%; border-radius:4px;}
        .select2-container--default .select2-selection--single .select2-selection__rendered {line-height: 50px; }
        .select2-container--default .select2-selection--single .select2-selection__arrow {height: 50px;}
        .select2-container--default .select2-selection--single .select2-selection__rendered {color: #747474;}
        .select2-container--default .select2-results__option--highlighted[aria-selected] {background-color: #ee8116;}

    </style>

    <style>

        #wrapper { width: 640px; margin: 0 auto; padding:90px 0 0 0; }
        #inline { display: none; width: 600px; }

        .txt {
            display: inline-block;
            color: #676767;
            width: 420px;
            font-family: Arial, Tahoma, sans-serif;
            margin-bottom: 10px;
            border: 1px dotted #ccc;
            padding: 5px 9px;
            font-size: 1.2em;
            line-height: 1.4em;
        }

        .txtarea {
            display: block;
            resize: none;
            color: #676767;
            font-family: Arial, Tahoma, sans-serif;
            margin-bottom: 10px;
            width: 500px;
            height: 150px;
            border: 1px dotted #ccc;
            padding: 5px 9px;
            font-size: 1.2em;
            line-height: 1.4em;
        }

        .txt:focus, .txtarea:focus { border-style: solid; border-color: #bababa; color: #444; }

        input.error, textarea.error { border-color: #973d3d; border-style: solid; background: #f0bebe; color: #a35959; }
        input.error:focus, textarea.error:focus { border-color: #973d3d; color: #a35959; }

        #send {
            color: #dee5f0;
            display: block;
            cursor: pointer;
            padding: 5px 11px;
            font-size: 1.2em;
            border: solid 1px #224983;
            border-radius: 5px;
            background: #1e4c99;
            background: -webkit-gradient(linear, left top, left bottom, from(#2f52b7), to(#0e3a7d));
            background: -moz-linear-gradient(top, #2f52b7, #0e3a7d);
            background: -webkit-linear-gradient(top, #2f52b7, #0e3a7d);
            background: -o-linear-gradient(top, #2f52b7, #0e3a7d);
            background: -ms-linear-gradient(top, #2f52b7, #0e3a7d);
            background: linear-gradient(top, #2f52b7, #0e3a7d);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#2f52b7', endColorstr='#0e3a7d');
        }
        #send:hover {
            background: #183d80;
            background: -webkit-gradient(linear, left top, left bottom, from(#284f9d), to(#0c2b6b));
            background: -moz-linear-gradient(top,  #284f9d, #0c2b6b);
            background: -webkit-linear-gradient(top, #284f9d, #0c2b6b);
            background: -o-linear-gradient(top, #284f9d, #0c2b6b);
            background: -ms-linear-gradient(top, #284f9d, #0c2b6b);
            background: linear-gradient(top, #284f9d, #0c2b6b);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#284f9d', endColorstr='#0c2b6b');
        }
        #send:active {
            color: #8c9dc0;
            background: -webkit-gradient(linear, left top, left bottom, from(#0e387d), to(#2f55b7));
            background: -moz-linear-gradient(top,  #0e387d,  #2f55b7);
            background: -webkit-linear-gradient(top, #0e387d, #2f55b7);
            background: -o-linear-gradient(top, #0e387d, #2f55b7);
            background: -ms-linear-gradient(top, #0e387d, #2f55b7);
            background: linear-gradient(top, #0e387d, #2f55b7);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#0e387d', endColorstr='#2f55b7');
        }

    </style>

@endsection

@section('marks')
    @include('layouts.frontend.includes.mark_list')
@endsection

@section('content')

    <!-- hidden inline form -->
    <div id="inline">
        <h2>Отправка сообщения</h2>

        {!! Form::open(['url' => '/callback', 'method' => 'post', 'class' => 'form-horizontal', 'id' => 'validate']) !!}

        <div class="form_field">
              {!! Form::text('name', old('name'), ['class' => 'form_control  validate[required]', 'placeholder'=>'Ваше имя']) !!}
        </div>

        <div class="form_field">
            {!! Form::text('phone', old('phone'), ['class' => 'form_control form_phone validate[required,custom[phone]]', 'placeholder'=>'Ваше телефон']) !!}
        </div>

        <div class="form_field">
            Удобное время звонка
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

        {!! Form::submit('Отправить', ['class'=>'btn']) !!}
        {!! Form::close() !!}

    </div>

    <section>
        <h1>Контакты</h1>
        <div class="row">
              <div class="contacts_info">
                <div class="phones">
                    <a href="tel:+78123132274">{!! getSetting('TELEPHONE_1') !!}</a><span>(звонок по России бесплатный)</span>
                    <a href="tel:+78005001463">{!! getSetting('TELEPHONE_2') !!}</a>
                </div>
                <p>{!! getSetting('FRONTEND_ADDRESS') !!}</p>
                <p>{!! getSetting('FRONTEND_TIMES') !!}</p>
                <a  href="#inline" class="btn recall_link modalbox">Обратный звонок</a>
            </div>
            <div  style="float: right; margin-top: -45px;" ><div style="width:460px;height:280px;" id="googleMap"></div> </div>
        </div>
    </section>

@endsection

@section('js')

    {!! Html::script('http://maps.googleapis.com/maps/api/js') !!}
    {!! Html::script('assets/plugins/select2/select2.full.min.js') !!}
    {!! Html::script('assets/plugins/select2/select2.full.min.js') !!}

    <script type="text/javascript">
        $(document).ready(function () {
            $(".select2").select2();
        })


        $(function(){
            $(".form_phone").mask("+7 (999) 999-9999");
        })

        function initialize() {
            var mapProp = {
                center: new google.maps.LatLng( {{ getSetting('MAP_LATITUDE') }}, {{ getSetting('MAP_LONGITUDE') }}),
                zoom: 5,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
        }
        google.maps.event.addDomListener(window, 'load', initialize);

        $(document).ready(function() {
            $(".modalbox").fancybox();

        });

    </script>

@endsection