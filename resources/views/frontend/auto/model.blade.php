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
        <div class="model_page row">
            <div class="main_width">
                <div class="breadcrumbs">
                    <a href="/">Главная</a> - <a href="{!! url('/auto') !!}">Новые автомобили</a> - <a href="{!! url('/auto/' . $car->mark_slug) !!}">{!! $car->mark !!}</a> - <span>{!! $car->model !!}</span>
                </div>
                <div class="page_content detail_page row">
                    <h1>{!! $car->model !!}</h1>
                    <div class="model_colors_block">
                        <div class="model_images">

                            @if (isset($colors))


                                @for($i=0; $i<count($colors); $i++)
                                <div class="model_sigle_color @if($i == 0) active @endif " >
                                    <div class="model_image" style="background-image:url({!! $colors[$i]['image'] !!});"></div>
                                    <div class="color_name">Цвет:<strong>{!! $colors[$i]['name'] !!}</strong></div>
                                </div>

                                @endfor

                            @endif

                        </div>

                        @if (isset($colors))

                        <ul class="colors_block row">

                             @for($i=0; $i<count($colors); $i++)

                                <li @if($i == 0) class="active" @endif id="color_{!! $colors[$i]['id'] !!}"><span style="background:#{!! $colors[$i]['hex'] !!}"></span></li>

                            @endfor

                        </ul>

                        @endif
                        <script>
                            (function($) {
                                $(function() {
                                    $('ul.colors_block').on('click', 'li:not(.active)', function() {
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
                        @if($prev_price)<div class="old_price"><del>от <span>{!! number_format($prev_price,0,'',' ') !!}</span> руб.</del></div>@endif
                        <div class="new_price">от <span>{!! number_format($price,0,'',' ') !!}</span> руб.</div>
                        @if(isset($car->bannerText) && !empty($car->bannerText))<div class="discount">{!! $car->bannerText !!}</div>@endif
                    </div>
                    <div class="request_form_block">
                        <div class="request_form">
                            <div class="form_title">
                                Заявка<br/>на автокредит от <span>0%</span>
                            </div>
                            <select class="form_control select2">
                                <option>Комплектация</option>
                                <option>Ambiente 1.6 MT</option>
                                <option>Вариант</option>
                                <option>Вариант</option>
                                <option>Вариант</option>
                            </select>
                            <select class="form_control select2">
                                <option>Первоначальный взнос</option>
                                <option>10%</option>
                                <option>Вариант</option>
                                <option>Вариант</option>
                                <option>Вариант</option>
                            </select>
                            <input type="text" class="form_control" placeholder="Ф.И.О." />
                            <select class="form_control select2 region_select">
                                <option>Регион по прописке</option>
                                <option>Москва</option>
                                <option>Свердловская область</option>
                                <option>Ленинградская область</option>
                                <option>Алтайский край</option>
                            </select>
                            <input type="text" class="form_control phone_form" placeholder="+7 (___) ___ - __ - __" />
                            <div class="tradein_check">
                                <input type="checkbox" class="checkbox" id="tradein_check"></input><label for="tradein_check">Есть автомобиль в Trade-In</label>
                            </div>
                            <input type="submit" class="btn" value="Подобрать" />
                        </div>
                        <script>
                            $(document).ready(function() {
                                jQuery(function($){
                                    $(".select2").select2();
                                    $(".phone_form").mask("+7 (999) 999 - 99 - 99");
                                });
                            });
                        </script>
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
                        <div class="tradein_banner"><img src="/images/tradein_banner.png" /></div>
                    </div>
                    <div class="row">
                        <div class="specialty_content_block">
                            <div class="specialty_content active">
                                <div class="model_characteristics">
                                    <div class="model_title">1.4 6МТ</div>
                                    <div class="model_characteristics_tab">
                                        <div class="sort row">
                                            <div class="complectation_name">Комплектация</div>
                                            <div class="KPP"><a class="sort_link minmax">КПП</a></div>
                                            <div class="power"><a class="sort_link minmax">Мощность</a></div>
                                            <div class="price"><a class="sort_link maxmin">Цена</a></div>
                                        </div>
                                        <ul class="sort_results">
                                            <li>
                                                <div class="complectation_item row">
                                                    <div class="complectation_name"><input type="checkbox" class="checkbox" id="c_1"></input><label for="c_1">Active</label></div>
                                                    <div class="KPP">МКПП</div>
                                                    <div class="power">100 л.с.</div>
                                                    <div class="price">от <span>520 000<span> руб</div>
                                                    <div class="buy_link"><a href="" class="btn">Купить в кредит</a></div>
                                                    <div class="print_link"><a href=""><img src="/images/print_ico.png" /></a></div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="complectation_item row">
                                                    <div class="complectation_name"><input type="checkbox" class="checkbox" id="c_2"></input><label for="c_2">Active+ </label></div>
                                                    <div class="KPP">МКПП</div>
                                                    <div class="power">100 л.с.</div>
                                                    <div class="price">от <span>520 000<span> руб</div>
                                                    <div class="buy_link"><a href="" class="btn">Купить в кредит</a></div>
                                                    <div class="print_link"><a href=""><img src="/images/print_ico.png" /></a></div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="complectation_item row">
                                                    <div class="complectation_name"><input type="checkbox" class="checkbox" id="c_2"></input><label for="c_2">Comfort</label></div>
                                                    <div class="KPP">МКПП</div>
                                                    <div class="power">100 л.с.</div>
                                                    <div class="price">от <span>520 000<span> руб</div>
                                                    <div class="buy_link"><a href="" class="btn">Купить в кредит</a></div>
                                                    <div class="print_link"><a href=""><img src="/images/print_ico.png" /></a></div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="complectation_item row">
                                                    <div class="complectation_name"><input type="checkbox" class="checkbox" id="c_2"></input><label for="c_2">Comfort+</label></div>
                                                    <div class="KPP">МКПП</div>
                                                    <div class="power">100 л.с.</div>
                                                    <div class="price">от <span>520 000<span> руб</div>
                                                    <div class="buy_link"><a href="" class="btn">Купить в кредит</a></div>
                                                    <div class="print_link"><a href=""><img src="/images/print_ico.png" /></a></div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="model_characteristics">
                                    <div class="model_title">1.4 6МТ</div>
                                    <div class="model_characteristics_tab">
                                        <div class="sort row">
                                            <div class="complectation_name">Комплектация</div>
                                            <div class="KPP"><a class="sort_link minmax">КПП</a></div>
                                            <div class="power"><a class="sort_link minmax">Мощность</a></div>
                                            <div class="price"><a class="sort_link maxmin">Цена</a></div>
                                        </div>
                                        <ul class="sort_results">
                                            <li>
                                                <div class="complectation_item row">
                                                    <div class="complectation_name"><input type="checkbox" class="checkbox" id="c_1"></input><label for="c_1">Active</label></div>
                                                    <div class="KPP">МКПП</div>
                                                    <div class="power">100 л.с.</div>
                                                    <div class="price">от <span>520 000<span> руб</div>
                                                    <div class="buy_link"><a href="" class="btn">Купить в кредит</a></div>
                                                    <div class="print_link"><a href=""><img src="/images/print_ico.png" /></a></div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="complectation_item row">
                                                    <div class="complectation_name"><input type="checkbox" class="checkbox" id="c_2"></input><label for="c_2">Active+ </label></div>
                                                    <div class="KPP">МКПП</div>
                                                    <div class="power">100 л.с.</div>
                                                    <div class="price">от <span>520 000<span> руб</div>
                                                    <div class="buy_link"><a href="" class="btn">Купить в кредит</a></div>
                                                    <div class="print_link"><a href=""><img src="/images/print_ico.png" /></a></div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="complectation_item row">
                                                    <div class="complectation_name"><input type="checkbox" class="checkbox" id="c_2"></input><label for="c_2">Comfort</label></div>
                                                    <div class="KPP">МКПП</div>
                                                    <div class="power">100 л.с.</div>
                                                    <div class="price">от <span>520 000<span> руб</div>
                                                    <div class="buy_link"><a href="" class="btn">Купить в кредит</a></div>
                                                    <div class="print_link"><a href=""><img src="/images/print_ico.png" /></a></div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="complectation_item row">
                                                    <div class="complectation_name"><input type="checkbox" class="checkbox" id="c_2"></input><label for="c_2">Comfort+</label></div>
                                                    <div class="KPP">МКПП</div>
                                                    <div class="power">100 л.с.</div>
                                                    <div class="price">от <span>520 000<span> руб</div>
                                                    <div class="buy_link"><a href="" class="btn">Купить в кредит</a></div>
                                                    <div class="print_link"><a href=""><img src="/images/print_ico.png" /></a></div>
                                                </div>
                                            </li>
                                        </ul>
                                        <a href="" class="btn disabled">Сравнить</a>
                                    </div>
                                </div>
                            </div>
                            <div class="specialty_content">
                                <table>
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
                                            <td>{!! $value !!}</td>
                                            @foreach($modifications as $modification)
                                                <td>{!! $modification[$key] !!}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                {!! $car->parametersContent !!}

                            </div>
                            <div class="specialty_content">

                                @foreach($gallery_pics as $pic)

                                <a class="gallery" rel="group" title="{!! $pic->title !!}" href="{!! PATH_CARS . $pic->image  !!}"><img width="300px" src="{!! PATH_CARS . $pic->image  !!}" /></a>

                                @endforeach

                                {!! $car->galleryContent !!}
                            </div>
                        </div>
                        <div class="inform_banner">
                            <div class="banner_logo">
                                <img src="/images/logo.png" />
                            </div>
                            <div class="banner_phones">
                                <a href="tel:{!! getSetting('TELEPHONE_1') !!}">{!! getSetting('TELEPHONE_1') !!}</a>
                                <a href="tel:{!! getSetting('TELEPHONE_2') !!}" class="free_phone">{!! getSetting('TELEPHONE_2') !!}</a>
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
                    (function($) {
                        $(function() {
                            $('ul.tabs').on('click', 'li:not(.active)', function() {
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
                                <div class="item_image"><img src="{!! $similarcar->image !!}" /></div>
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
            $(".select2").select2();
        })

        $(function(){
            $(".form_phone").mask("+7 (999) 999-9999");
        })

        $(document).ready(function() {
            $(".modalbox").fancybox();
        });

        $(document).ready(function() {
            $("a.gallery, a.iframe").fancybox();

            url = $("a.modalbox").attr('href').replace("for_spider","content2");
            $("a.modalbox").attr("href", url);
            $("a.modalbox").fancybox(
            {
                "frameWidth" : 400,
                "frameHeight" : 400
            });

            $("a.gallery2").fancybox(
            {
                "padding" : 20,
                "imageScale" : false,
                "zoomOpacity" : false,
                "zoomSpeedIn" : 1000,
                "zoomSpeedOut" : 1000,
                "zoomSpeedChange" : 1000,
                "frameWidth" : 700,
                "frameHeight" : 600,
                "overlayShow" : true,
                "overlayOpacity" : 0.8,
                "hideOnContentClick" :false,
                "centerOnScroll" : false
            });

            $("#menu a, .anim").hover( function() {
                $(this).animate({"paddingLeft" : "10px"}, 300)},
                function() {$(this).animate({"paddingLeft" : "0"}, 300);
            });

            $("a.iframe").fancybox(
            {
                "frameWidth" : 800,
                "frameHeight" : 600
            });
        });

    </script>

@endsection