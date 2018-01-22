@extends('layouts.frontend.app')

@section('title', $detail->meta_title ? $detail->meta_title : $detail->mark . ' ' . $detail->model )

@section('meta_desc', $detail->meta_description)

@section('meta_keywords', $detail->meta_keywords)

@section('css')
    <style>
        .select2-container .select2-selection--single { height: 38px;width: 100%; border-radius:5px; padding: 0 10px; width: 100%; color: #bfbfbf; }
        .select2-container--default .select2-selection--single .select2-selection__rendered {line-height: 38px; }
        .select2-container--default .select2-selection--single .select2-selection__arrow {height: 38px;}
        .select2-container--default .select2-selection--single .select2-selection__rendered {color: #bfbfbf;}
        .select2-container--default .select2-results__option--highlighted[aria-selected] {background-color: #ee8116;}
    </style>
@endsection

@section('marks')

@endsection

@section('content')
    <section>
        <h1>{{ $detail->mark }} {{ $detail->model }}</h1>
        <div class="row">
            <div class="detail">
                <div class="row">
                    <div class="detail_image_block">

                        <div class="demo">
                            <div class="item" style="width: 280px">

                                    @if(count($images) > 0)
                                        <ul id="image-gallery" class="gallery list-unstyled cS-hidden">

                                            @foreach($images as $image)

                                                <li data-thumb="{!! $image["small"] !!}">
                                                    <img src="{!! $image["big"] !!}" />
                                                </li>

                                            @endforeach

                                        </ul>
                                    @endif

                                </div>

                        </div>

                    </div>
                    <div class="detail_main_info">
                        <div class="detail_price">
                           {{ $detail->price }} <span class="rub">i</span>
                        </div>
                        <ul>
                            <li><span>Год выпуска</span><strong>{{ $detail->year }} г</strong></li>
                            <li><span>Пробег</span><strong>{{ number_format($detail->mileage,0,'',' ') }} км</strong></li>
                            <li><span>Кузов</span><strong>{{ $detail->body }}</strong></li>
                            <li><span>Двигатель</span><strong>{{ number_format($detail->power,0,'',' ')  }} л., {{ $detail->engine_type }}</strong></li>
                            <li><span>КПП</span><strong>{{ $detail->gearbox }}</strong></li>
                            <li><span>Привод</span><strong>{{ $detail->drive }} привод</strong></li>
                            <li><span>Цвет</span><strong>{{ $detail->color }}</strong></li>
                            <li><span>Салон</span><strong>{{ $detail->salon }}</strong></li>
                        </ul>
                    </div>
                </div>
                <div class="detail_banners row">
                    <div>@if($detail->verified)<img src="/images/detail_banner_1.jpg" />@endif</div>
                    <div>@if($detail->tradein)<img src="/images/detail_banner_2.jpg" />@endif</div>
                </div>

                @if(count($equipments) > 0)
                <section>
                    <h3>Комплектация:</h3>
                    <ul class="detail_options">
                        @foreach($equipments as $equipment)
                        <li>{!! $equipment !!}</li>
                        @endforeach
                    </ul>
                </section>
                @endif

                <section>
                    @if ($detail->description)
                    <h3>Комментарии продавца:</h3>
                      {!! $detail->description !!}
                    @endif

                </section>
            </div>
            <div class="sidebar">
                <div class="request_form">
                    <div class="form_title">Заявка на кредит</div>
                    {!! Form::open(['url' => '/usedcar-request-credit', 'method' => 'post', 'class' => 'form-horizontal', 'id' => 'validate']) !!}
                    {!! Form::hidden('id_car', $detail->id) !!}
                        <div class="form_field">
                            {!! Form::text('name', old('name'), ['class' => 'form_control validate[required]', 'placeholder'=>'ФИО']) !!}
                        </div>
                          <div class="form_field">
                            {!! Form::text('registration', old('registration'), ['class' => 'who form_control validate[required]', 'placeholder'=>'Регион по прописке', 'autocomplete' => 'off', 'id' => 'search_registration']) !!}
                            <ul class="search_result_registration search_result"></ul>
                        </div>
                        <div class="row">
                            <div class="form_field form_field_age">
                                 {!! Form::selectRange('age', 18, 85, 'Возраст', ['class' => 'select2 validate[required]', 'placeholder' => 'Возраст']) !!}
                            </div>
                            <div class="form_field form_field_phone">
                                {!! Form::text('phone', old('phone'), ['class' => 'form_control form_phone validate[required]', 'placeholder' => 'Телефон']) !!}
                            </div>
                        </div>
                        <div class="form_field">
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
                            ], 'Первоначальный взнос', ['class' => 'select2', 'placeholder' => 'Первоначальный взнос']
                            ) !!}
                        </div>
                {!! Form::submit('Купить в кредит', ['class'=>'btn']) !!}
                {!! Form::close() !!}
                </div>
                <div class="map">
                    <div>
                        <div class="address">{!! getSetting('FRONTEND_ADDRESS') !!}</div>
                        <div class="times">{!! getSetting('FRONTEND_TIMES') !!}</div>

                        <div ><div style="width:260px;height:300px;" id="googleMap"></div> </div>
                    </div>
                </div>
                <div>
                    <img src="/images/right_banner_detail.jpg" />
                </div>
            </div>
        </div>

        @if(count($similarCars) > 0)

        <section class="similar">
            <h3>Похожие автомобили с пробегом:</h3>
            <div class="items_list row">
                <ul>

                    @foreach($similarCars as $similarCar)

                    <li class="item">
                        <div class="item_pic"><img src="{!! mainSmallPic($similarCar->image) !!}" /></div>
                        <div class="idem_desc">
                            <a class="item_name" href="{!! url('/auto/used/detail/' .  $similarCar->id) !!}">{!! $similarCar->mark !!} {!! $similarCar->model !!}</a>
                            <p>{!! $similarCar->year !!} г., {!! number_format($similarCar->mileage,0,'',' ') !!} км, {!! $similarCar->engine_type !!}, КПП {!! $similarCar->gearbox !!}</p>
                            <div class="item_price">{!! number_format($similarCar->price,0,'',' ') !!}<span class="rub">o</span></div>
                            <a class="item_btn" href="{!! url('/auto/used/detail/' .  $similarCar->id) !!}">Подробнее</a>
                        </div>
                    </li>

                    @endforeach
                </ul>

            </div>
        </section>

        @endif
    </section>
@endsection

@section('js')

    {!! Html::script('http://maps.googleapis.com/maps/api/js') !!}
    {!! Html::script('assets/plugins/select2/select2.full.min.js') !!}

    <script type="text/javascript">

        $(document).ready(function () {
            $(".select2").select2({
                width: '100%'
            });
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
            $("#content-slider").lightSlider({
                loop:true,
                keyPress:true
            });
            $('#image-gallery').lightSlider({
                gallery:true,
                item:1,
                thumbItem:3,
                slideMargin: 0,
                speed:500,
                auto:false,
                loop:true,
                onSliderLoad: function() {
                    $('#image-gallery').removeClass('cS-hidden');
                }
            });
        });

        $(function(){
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

            $(".form_phone").mask("+7 (999) 999-9999");

        })

    </script>
@endsection







