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
    
@endsection

@section('content')

    <div class="inset_page white_bg">
        <div class="model_page row">
            <div class="main_width">
                <div class="breadcrumbs">
                    <a href="/">Главная</a> - <a href="">Новые автомобили</a> - <a href="/">Hyundai</a> - <span>Hyundai Creta</span>
                </div>
                <div class="page_content detail_page row">
                    <h1>Hyundai Creta</h1>
                    <div class="model_colors_block">
                        <div class="model_images">
                            <div class="model_sigle_color">
                                <div class="model_image" style=""></div>
                                <div class="color_name">Цвет:<strong></strong></div>
                            </div>
                            <div class="model_sigle_color active">
                                <div class="model_image" style="background-image:url(images/model_orange.png);"></div>
                                <div class="color_name">Цвет:<strong>оранжевый металик</strong></div>
                            </div>
                            <div class="model_sigle_color">
                                <div class="model_image" style=""></div>
                                <div class="color_name">Цвет:<strong></strong></div>
                            </div>
                            <div class="model_sigle_color">
                                <div class="model_image" style=""></div>
                                <div class="color_name">Цвет:<strong></strong></div>
                            </div>
                            <div class="model_sigle_color">
                                <div class="model_image" style=""></div>
                                <div class="color_name">Цвет:<strong></strong></div>
                            </div>
                            <div class="model_sigle_color">
                                <div class="model_image" style="background-image:url(images/model_blue.png);"></div>
                                <div class="color_name">Цвет:<strong>синий металик</strong></div>
                            </div>
                        </div>
                        <ul class="colors_block row">
                            <li id="red"><span style="background:#c3092e"></span></li>
                            <li class="active" id="orange"><span style="background:#f8580b"></span></li>
                            <li id="grey"><span style="background:#9c9c9c"></span></li>
                            <li id="white"><span style="background:#ffffff"></span></li>
                            <li id="black"><span style="background:#070707"></span></li>
                            <li id="blue"><span style="background:#0a6fa8"></span></li>
                        </ul>
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
                        <div class="old_price"><del>от <span>1 219 900</span> руб.</del></div>
                        <div class="new_price">от <span>3 224 000</span> руб.</div>
                        <div class="discount">Скидка в феврале<br/>до <span>123 000</span> руб.</div>
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
                        <div class="tradein_banner"><img src="images/tradein_banner.png" /></div>
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
                                                    <div class="print_link"><a href=""><img src="images/print_ico.png" /></a></div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="complectation_item row">
                                                    <div class="complectation_name"><input type="checkbox" class="checkbox" id="c_2"></input><label for="c_2">Active+ </label></div>
                                                    <div class="KPP">МКПП</div>
                                                    <div class="power">100 л.с.</div>
                                                    <div class="price">от <span>520 000<span> руб</div>
                                                    <div class="buy_link"><a href="" class="btn">Купить в кредит</a></div>
                                                    <div class="print_link"><a href=""><img src="images/print_ico.png" /></a></div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="complectation_item row">
                                                    <div class="complectation_name"><input type="checkbox" class="checkbox" id="c_2"></input><label for="c_2">Comfort</label></div>
                                                    <div class="KPP">МКПП</div>
                                                    <div class="power">100 л.с.</div>
                                                    <div class="price">от <span>520 000<span> руб</div>
                                                    <div class="buy_link"><a href="" class="btn">Купить в кредит</a></div>
                                                    <div class="print_link"><a href=""><img src="images/print_ico.png" /></a></div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="complectation_item row">
                                                    <div class="complectation_name"><input type="checkbox" class="checkbox" id="c_2"></input><label for="c_2">Comfort+</label></div>
                                                    <div class="KPP">МКПП</div>
                                                    <div class="power">100 л.с.</div>
                                                    <div class="price">от <span>520 000<span> руб</div>
                                                    <div class="buy_link"><a href="" class="btn">Купить в кредит</a></div>
                                                    <div class="print_link"><a href=""><img src="images/print_ico.png" /></a></div>
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
                                                    <div class="print_link"><a href=""><img src="images/print_ico.png" /></a></div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="complectation_item row">
                                                    <div class="complectation_name"><input type="checkbox" class="checkbox" id="c_2"></input><label for="c_2">Active+ </label></div>
                                                    <div class="KPP">МКПП</div>
                                                    <div class="power">100 л.с.</div>
                                                    <div class="price">от <span>520 000<span> руб</div>
                                                    <div class="buy_link"><a href="" class="btn">Купить в кредит</a></div>
                                                    <div class="print_link"><a href=""><img src="images/print_ico.png" /></a></div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="complectation_item row">
                                                    <div class="complectation_name"><input type="checkbox" class="checkbox" id="c_2"></input><label for="c_2">Comfort</label></div>
                                                    <div class="KPP">МКПП</div>
                                                    <div class="power">100 л.с.</div>
                                                    <div class="price">от <span>520 000<span> руб</div>
                                                    <div class="buy_link"><a href="" class="btn">Купить в кредит</a></div>
                                                    <div class="print_link"><a href=""><img src="images/print_ico.png" /></a></div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="complectation_item row">
                                                    <div class="complectation_name"><input type="checkbox" class="checkbox" id="c_2"></input><label for="c_2">Comfort+</label></div>
                                                    <div class="KPP">МКПП</div>
                                                    <div class="power">100 л.с.</div>
                                                    <div class="price">от <span>520 000<span> руб</div>
                                                    <div class="buy_link"><a href="" class="btn">Купить в кредит</a></div>
                                                    <div class="print_link"><a href=""><img src="images/print_ico.png" /></a></div>
                                                </div>
                                            </li>
                                        </ul>
                                        <a href="" class="btn disabled">Сравнить</a>
                                    </div>
                                </div>
                            </div>
                            <div class="specialty_content">
                                Раздел находится в разработке...
                            </div>
                            <div class="specialty_content">
                                Раздел находится в разработке...
                            </div>
                        </div>
                        <div class="inform_banner">
                            <div class="banner_logo">
                                <img src="images/logo.png" />
                            </div>
                            <div class="banner_phones">
                                <a href="tel:8 (495) 225-35-45">8 (495) 225-35-45</a>
                                <a href="tel:8 (800) 707-11-68" class="free_phone">8 (800) 707-11-68</a>
                                <b>(Звонок по России бесплатный)</b>
                            </div>
                            <div class="banner_info">
                                <div class="times">с <span>9-00</span> до <span>20-00</span>, без выходных</div>
                                <div class="addresses">г. Москва,<br/>ул. Вавилова, д. 13А</div>
                            </div>
                            <a href="" class="btn">Обраный звонок</a>
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

            <div class="specials_block row">
                <h2>Похожие предложения</h2>
                <ul class="row item_list container">
                    <li>
                        <div class="list_item">
                            <a href="">
                                <div class="item_image"><img src="images/item_1.jpg" /></div>
                                <div class="item_name">Huyndai i30 Седан</div>
                                <div class="item_price">от <span>657 000</span> руб.</div>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="list_item">
                            <a href="">
                                <div class="item_image"><img src="images/item_2.jpg" /></div>
                                <div class="item_name">Huyndai i30 Седан</div>
                                <div class="item_price">от <span>657 000</span> руб.</div>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="list_item">
                            <a href="">
                                <div class="item_image"><img src="images/item_1.jpg" /></div>
                                <div class="item_name">Huyndai i30 Седан</div>
                                <div class="item_price">от <span>657 000</span> руб.</div>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="list_item">
                            <a href="">
                                <div class="item_image"><img src="images/item_2.jpg" /></div>
                                <div class="item_name">Huyndai i30 Седан</div>
                                <div class="item_price">от <span>657 000</span> руб.</div>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="list_item">
                            <a href="">
                                <div class="item_image"><img src="images/item_1.jpg" /></div>
                                <div class="item_name">Huyndai i30 Седан</div>
                                <div class="item_price">от <span>657 000</span> руб.</div>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="list_item">
                            <a href="">
                                <div class="item_image"><img src="images/item_2.jpg" /></div>
                                <div class="item_name">Huyndai i30 Седан</div>
                                <div class="item_price">от <span>657 000</span> руб.</div>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="list_item">
                            <a href="">
                                <div class="item_image"><img src="images/item_1.jpg" /></div>
                                <div class="item_name">Huyndai i30 Седан</div>
                                <div class="item_price">от <span>657 000</span> руб.</div>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="list_item">
                            <a href="">
                                <div class="item_image"><img src="images/item_2.jpg" /></div>
                                <div class="item_name">Huyndai i30 Седан</div>
                                <div class="item_price">от <span>657 000</span> руб.</div>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

@endsection

@section('bottom_page_content')

@endsection


@section('js')


@endsection