@extends('layouts.frontend.app')

@section('title', isset($title) ? $title : '' )

@section('meta_desc', isset($meta_desc) ? $meta_desc : '')

@section('meta_keywords', isset($meta_keywords) ? $meta_keywords : '')

@section('css')

@endsection

@section('banner')

@endsection

@section('marks')

    @include('layouts.frontend.includes.mark_list')

    {!! Html::style('css/fancybox/jquery.fancybox.css') !!}


@endsection

@section('content')

    <!-- hidden inline form -->
    <div id="inline" class="popup_form">
        <h3>Отправка сообщения</h3>

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

    <!-- hidden inline form -->
    <div id="inline_credit" class="popup_form">
        <h3>Узнайте о кредитовании {!! $car->mark !!}</a> - <span>{!! $car->model !!}</h3>
        <p>Оставьте свои данные и мы попробуем подобрать для Вас лучшие условия по кредиту.</p>

        {!! Form::open(['url' => '/buy_in_credit_request', 'method' => 'post', 'class' => 'form-horizontal', 'id' => 'validate']) !!}

        {!! Form::hidden('mark', $car->id_car_mark) !!}

        {!! Form::hidden('model', $car->id) !!}

        {!! Form::hidden('complectation', null, ['id' => 'inline_credit_complectation']) !!}

        <div class="form_field">

            {!! Form::text('name', old('name'), ['class' => 'form_control  validate[required]', 'placeholder'=>'Ваше ФИО']) !!}

        </div>

        <div class="form_field">

            {!! Form::text('phone', old('phone'), ['class' => 'form_control  form_phone validate[required,custom[phone]]', 'placeholder'=>'+7 (___) ___ - __ - __']) !!}

        </div>

        {!! Form::submit('Отправить', ['class'=>'btn']) !!}

        {!! Form::close() !!}

    </div>


    <div class="inset_page white_bg">
        <div class="model_page row">
            <div class="main_width">
                <div class="breadcrumbs">
                    <a href="/">Главная</a> - <a href="{!! url('/auto') !!}">Новые автомобили</a> - <a
                            href="{!! url('/auto/' . $car->mark_slug) !!}">{!! $car->mark !!}</a> -
                    <span>{!! $car->model !!}</span>
                </div>
                <div class="page_content detail_page row">
                    <h1>{!! $car->model !!}</h1>
                    <div class="model_colors_block">
                        <div class="model_images">

                            @if (isset($colors))

                                @for($i=0; $i<count($colors); $i++)

                                    <div class="model_sigle_color @if($i == 0) active @endif ">
                                        <div class="model_image"
                                             style="background-image:url({!! $colors[$i]['image'] !!});"></div>
                                        <div class="color_name">Цвет:<strong>{!! $colors[$i]['name'] !!}</strong></div>
                                    </div>

                                @endfor

                            @endif

                        </div>

                        @if (isset($colors))

                            <ul class="colors_block row">

                                @for($i=0; $i<count($colors); $i++)

                                    <li @if($i == 0) class="active" @endif id="color_{!! $colors[$i]['id'] !!}"><span
                                                style="background:#{!! $colors[$i]['hex'] !!}"></span></li>

                                @endfor

                            </ul>

                        @endif
                        <script>
                            (function ($) {
                                $(function () {
                                    $('ul.colors_block').on('click', 'li:not(.active)', function () {
                                        $(this)
                                            .addClass('active').siblings().removeClass('active')
                                            .closest('div.model_colors_block').find('div.model_sigle_color').removeClass('active').eq($(this).index()).addClass('active');
                                    });

                                });
                            })(jQuery);
                        </script>
                    </div>
                    <div class="price_block">
                        Цена:
                        @if($prev_price)
                            <div class="old_price">
                                <del>от <span>{!! number_format($prev_price,0,'',' ') !!}</span> руб.</del>
                            </div>@endif
                        <div class="new_price">от <span>{!! number_format($price,0,'',' ') !!}</span> руб.</div>
                        @if(isset($car->bannerText) && !empty($car->bannerText))
                            <div class="discount">{!! $car->bannerText !!}</div>@endif
                    </div>
                    <div class="request_form_block">
                        <div class="request_form">
                            <div class="form_title">
                                Заявка<br/>на автокредит от <span>0%</span>
                            </div>

                            {!! Form::open(['url' => '/request-credit-quick', 'method' => 'post', 'class' => 'form-horizontal', 'id' => 'validate']) !!}

                            {!! Form::hidden('mark', $car->id_car_mark) !!}

                            {!! Form::hidden('model', $car->id) !!}

                            {!! Form::select('complectation', $complectation_options, isset($request->complectation) ? $request->complectation : 'Комплектация', ['class' => 'select2 validate[required]']) !!}

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
                               ], 'Первоначальный взнос', ['class' => 'form_control select2 validate[required[alertTextCheckboxMultiple]', 'placeholder' => 'Первоначальный взнос']
                            ) !!}

                            {!! Form::text('name', old('name'), ['class' => 'form_control validate[required]', 'placeholder'=>'Ф.И.О.']) !!}

                            {!! Form::text('registration', old('registration'), ['class' => 'who form_control validate[required]', 'placeholder'=>'Регион по прописке', 'autocomplete' => 'off', 'id' => 'search_registration']) !!}

                            <ul class="search_result_registration search_result"></ul>

                            {!! Form::text('phone', old('phone'), ['class' => 'form_control form_phone validate[required,custom[phone]]', 'placeholder' => '+7 (___) ___ - __ - __']) !!}

                            <div class="tradein_check">

                                {!! Form::checkbox('tradein_available', null, null, ['class' => 'checkbox', 'id' => 'tradein_check']) !!}

                                {!! Form::label('tradein_check', 'Есть автомобиль в Trade-In') !!}

                            </div>

                            {!! Form::submit('Подобрать', ['class'=>'btn']) !!}

                            {!! Form::close() !!}

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="inset_page">
        <div class="main_width">
            <div class="specialty_page_content">
                <div class="specialty_tabs">
                    <div class="specialty_page_header">
                        <ul class="tabs row">
                            <li class="active">Комплектации и цены</li>
                            <li>Характеристики</li>
                            <li>Фотогалерея</li>
                        </ul>
                        <div class="tradein_banner"><img src="/images/tradein_banner.png"/></div>
                    </div>
                    <div class="row">
                        <div class="specialty_content_block">
                            <div class="specialty_content active">
                                <div class="model_characteristics">

                                    {!! Form::open(['url' => '/auto/' . $car->mark_slug . '/' . $car->model_slug . '/compare', 'method' => 'post']) !!}

                                    @foreach($modifications as $modification)

                                        @if(count(getPacks($car->id, $modification['id'])) > 0)

                                            <div class="model_title">{!! $modification['name'] !!}</div>

                                            <div class="model_characteristics_tab">
                                                <div class="sort row">
                                                    <div class="complectation_name">Комплектация</div>
                                                    <div class="KPP"><a class="sort_link minmax">КПП</a></div>
                                                    <div class="power"><a class="sort_link minmax">Мощность</a></div>
                                                    <div class="price"><a class="sort_link maxmin">Цена</a></div>
                                                </div>

                                                <ul class="sort_results">

                                                    @foreach(getPacks($car->id, $modification['id']) as $row)

                                                        <li>
                                                            <div class="complectation_item row">
                                                                <div class="row">
                                                                    <div class="complectation_name">
																		<div class="complectation_name_tab">
                                                                        {!! Form::checkbox('complectation[]', $row['complectation'], null, ['class' => 'checkbox', 'id' => $modification['id'] . '_' . $row['complectation']]) !!}

                                                                        <label
                                                                                for="{{ $modification['id'] }}_{{ $row['complectation'] }}"></label>
																				
																		</div>
																		<div class="complectation_name_tab">																		
																			<span
																					trigerID="{{ $modification['id'] }}_{{ $row['complectation'] }}"
																					class="show_info">{!! $row['name'] !!}</span>
																		</div>
                                                                    </div>
                                                                    <div class="KPP">{!! gearboxTypeShort($modification['gearbox']) !!}</div>
                                                                    <div class="power">{!! $modification['power'] !!}</div>
                                                                    <div class="price">от <span>{!! number_format($row['price'],0,'',' ') !!}
                                                                            <span> руб</div>
                                                                    <div class="buy_link"><a href="#inline_credit"
                                                                                             data-id="{{ $row['complectation'] }}"
                                                                                             class="btn modalbox">Купить
                                                                            в кредит</a></div>
                                                                    <div class="print_link"><a
                                                                                href="{!! url('/auto/' . $car->mark_slug . '/' . $car->model_slug . '/pack/' . $row['complectation'] . '/print') !!}"
                                                                                title="Распечатать комплектацию"
                                                                                target="_blank"
                                                                                onclick="var popupWin = window.open('{!! url('/auto/' . $car->mark_slug . '/' . $car->model_slug . '/pack/' . $row['complectation'] . '/print') !!}', null, 'menubar=no, toolbar=no, location=yes, status=yes, resizable=yes, scrollbars=yes', true); popupWin.focus(); return false;"><img
                                                                                    src="/images/print_ico.png"/></a>
                                                                    </div>
                                                                </div>
                                                                <div class="row dop_info disp_n"
                                                                     containerID="{{ $modification['id'] }}_{{ $row['complectation'] }}">

                                                                    @foreach($parameter_categories as $parameter_category)

                                                                        @if(count(getParameterValues($parameter_category['id'], $row['complectation'])) > 0)

                                                                            <div>
                                                                                <div class="dop_info_title">{!! $parameter_category['name'] !!}</div>

                                                                                <ul class="disk">

                                                                                    @foreach(getParameterValues($parameter_category['id'], $row['complectation']) as $parameterValue)

                                                                                        <li>{!! $parameterValue['name'] !!}</li>

                                                                                    @endforeach

                                                                                </ul>
                                                                            </div>

                                                                        @endif

                                                                    @endforeach
                                                                    <div class="row pack_info">
                                                                        <ul>

                                                                            @if($parameter_packs)

                                                                            @foreach($parameter_packs as $parameter_pack)

                                                                                <li>
                                                                                    <div class="pack_title">

                                                                                        {!! $parameter_pack['name'] !!} @if(!empty($parameter_pack['price']))
                                                                                            +{!! number_format($parameter_pack['price'], 0, '', ' ') !!}
                                                                                            руб. @endif

                                                                                    </div>

                                                                                    @foreach(getPackValue($parameter_pack['id']) as $pack)

                                                                                        <p>
                                                                                            <span>-</span>
                                                                                            {!! $pack['name'] !!}
                                                                                        </p>

                                                                                    @endforeach

                                                                                </li>

                                                                            @endforeach

                                                                            @endif

                                                                        </ul>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </li>

                                                    @endforeach

                                                </ul>

                                            </div>
                                        @endif
                                    @endforeach

                                    {!! Form::submit('Сравнить', ['class'=>'btn']) !!}

                                    {!! Form::close() !!}

                                </div>

                            </div>
                            <div class="specialty_content">
								<div class="characteristics_tab_wrapper">
									<table class="characteristics_tab" width="100%" cellpadding="0" cellspacing="0">
										<thead>
										<tr>
											<th> Параметры</th>
											@foreach($modifications as $modification)
												<th>{!! $modification['name'] !!}</th>
											@endforeach
										</tr>
										</thead>
										<tbody>
										@foreach($options as $key => $value)
											<tr>
												<td><strong>{!! $value !!}</strong></td>
												@foreach($modifications as $modification)
													<td>{!! $modification[$key] !!}</td>
												@endforeach
											</tr>
										@endforeach
										</tbody>
									</table>
									</div>
									{!! $car->parametersContent !!}
								
                            </div>
                            <div class="specialty_content">

                                @foreach($gallery_pics as $pic)

                                    <a class="gallery" rel="group" href="{!! PATH_CARS . $pic->image  !!}"><img
                                                width="300px" src="{!! PATH_CARS . $pic->image  !!}"/></a>

                                @endforeach

                                {!! $car->galleryContent !!}
                            </div>
                        </div>
                        <div class="inform_banner">
                            <div class="banner_logo">
                                <img src="/images/logo.png"/>
                            </div>
                            <div class="banner_phones">
                                <a href="tel:{!! getSetting('TELEPHONE_1') !!}">{!! getSetting('TELEPHONE_1') !!}</a>
                                <a href="tel:{!! getSetting('TELEPHONE_2') !!}"
                                   class="free_phone">{!! getSetting('TELEPHONE_2') !!}</a>
                                <b>(Звонок по России бесплатный)</b>
                            </div>
                            <div class="banner_info">
                                <div class="times">с <span>9-00</span> до <span>20-00</span>, без выходных</div>
                                <div class="addresses">{!! getSetting('FRONTEND_ADDRESS') !!}</div>
                            </div>
                            <a href="#inline" class="btn modalbox">Обраный звонок</a>
                        </div>
                    </div>
                </div>
                <script>
                    (function ($) {
                        $(function () {
                            $('ul.tabs').on('click', 'li:not(.active)', function () {
                                $(this)
                                    .addClass('active').siblings().removeClass('active')
                                    .closest('div.specialty_tabs').find('div.specialty_content').removeClass('active').eq($(this).index()).addClass('active');
                            });

                        });
                    })(jQuery);
                </script>
            </div>

            @if(isset($similarcars) && count($similarcars) > 0)

                <div class="specials_block row">
                    <h2>Похожие предложения</h2>
                    <ul class="row item_list container">

                        @foreach($similarcars as $similarcar)

                            <li>
                                <div class="list_item">
                                    <a href="{!! url('/auto/' . $similarcar->mark_slug . '/' . $similarcar->model_slug) !!}">
                                        <div class="item_image"><img src="{!! $similarcar->image !!}"/></div>
                                        <div class="item_name">{!! $similarcar->mark !!} {!! $similarcar->model !!} {!! $similarcar->body_type !!}</div>
                                        <div class="item_price">от <span>{!! $similarcar->price !!}</span> руб.</div>
                                    </a>
                                </div>
                            </li>

                        @endforeach

                    </ul>
                </div>

            @endif

        </div>
    </div>

@endsection

@section('bottom_page_content')

@endsection


@section('js')

    {!! Html::script('assets/plugins/select2/select2.full.min.js') !!}

    <script type="text/javascript">

        $(document).ready(function () {
            jQuery(function ($) {
                $(".select2").select2();
                $(".phone_form").mask("+7 (999) 999-99-99");
            });
        });

        $(document).ready(function () {
            $(".select2").select2();
        })

        $(function () {
            $(".form_phone").mask("+7 (999) 999-99-99");
        })

        $(document).ready(function () {
            $(".modalbox").fancybox();
        });

        $(".modalbox").on("click", function () {
            $("#inline_credit_complectation").val('');
            var Complectation = $(this).attr("data-id");
            $("#inline_credit_complectation").val(Complectation);
        });

        $(document).ready(function () {
            $("a.gallery, a.iframe").fancybox();

            url = $("a.modalbox").attr('href').replace("for_spider", "content2");
            $("a.modalbox").attr("href", url);
            $("a.modalbox").fancybox(
                {
                    "frameWidth": 400,
                    "frameHeight": 400
                });

            $("a.gallery2").fancybox(
                {
                    "padding": 20,
                    "imageScale": false,
                    "zoomOpacity": false,
                    "zoomSpeedIn": 1000,
                    "zoomSpeedOut": 1000,
                    "zoomSpeedChange": 1000,
                    "frameWidth": 700,
                    "frameHeight": 600,
                    "overlayShow": true,
                    "overlayOpacity": 0.8,
                    "hideOnContentClick": false,
                    "centerOnScroll": false,
                    "titleShow": false
                });

            $("#menu a, .anim").hover(function () {
                    $(this).animate({"paddingLeft": "10px"}, 300)
                },
                function () {
                    $(this).animate({"paddingLeft": "0"}, 300);
                });

            $("a.iframe").fancybox(
                {
                    "frameWidth": 800,
                    "frameHeight": 600
                });

            $("#search_registration").on("change keyup input click", function () {
                if (this.value.length >= 2) {

                    $.ajax({
                        type: 'GET',
                        url: '/ajax?action=search_registration&registration=' + this.value,
                        dataType: "json",
                        success: function (data) {
                            if (data != null && data.item != null) {
                                var html = '';

                                for (var i = 0; i < data.item.length; i++) {
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

            $(".search_result_registration").hover(function () {
                $(".who").blur();
            })

            $(".search_result_registration").on("click", "li", function () {
                $("#search_registration").val($(this).text());
                $(".search_result_registration").fadeOut();
            })

        });

    </script>

@endsection