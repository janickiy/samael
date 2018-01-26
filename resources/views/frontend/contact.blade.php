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


<div class="inset_page white_bg">
    <div class="main_width">
        @section('breadcrumbs')
            @include('layouts.frontend.includes.breadcrumbs')
        @endsection
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
                            <a class="free_phone" href="tel:{!! getSetting('TELEPHONE_2') !!}">{!! getSetting('TELEPHONE_2') !!}</a>
                            <a href="#inline" class="btn recall_link modalbox">Обратный звонок</a>
                        </p>
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
            $(".select2").select2();
        })

        $(function(){
            $(".form_phone").mask("+7 (999) 999-9999");
        })

        $(document).ready(function() {
            $(".modalbox").fancybox();

        });

    </script>

@endsection