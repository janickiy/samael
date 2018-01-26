@extends('layouts.frontend.app')

@section('title', 'Автокредит' )

@section('meta_desc', '')

@section('meta_keywords', '')

@section('css')


@endsection


@section('banner')
    <div class="main_banner"></div>
@endsection

@section('marks')
    @include('layouts.frontend.includes.mark_list')
@endsection


@section('content')


    <div class="index_page">
        <div class="main_width">
            <div class="presents_block row container">

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
            <div class="specials_block row">
                <div class="specials_block_title">Специальные предложения</div>
                <ul class="row item_list container">
                    <li>
                        <div class="list_item">
                            <a href="">
                                <div class="item_image"><img src="/images/item_1.jpg" /></div>
                                <div class="item_name">Huyndai i30 Седан</div>
                                <div class="item_price">от <span>657 000</span> руб.</div>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="list_item">
                            <a href="">
                                <div class="item_image"><img src="/images/item_2.jpg" /></div>
                                <div class="item_name">Huyndai i30 Седан</div>
                                <div class="item_price">от <span>657 000</span> руб.</div>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="list_item">
                            <a href="">
                                <div class="item_image"><img src="/images/item_1.jpg" /></div>
                                <div class="item_name">Huyndai i30 Седан</div>
                                <div class="item_price">от <span>657 000</span> руб.</div>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="list_item">
                            <a href="">
                                <div class="item_image"><img src="/images/item_2.jpg" /></div>
                                <div class="item_name">Huyndai i30 Седан</div>
                                <div class="item_price">от <span>657 000</span> руб.</div>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="list_item">
                            <a href="">
                                <div class="item_image"><img src="/images/item_1.jpg" /></div>
                                <div class="item_name">Huyndai i30 Седан</div>
                                <div class="item_price">от <span>657 000</span> руб.</div>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="list_item">
                            <a href="">
                                <div class="item_image"><img src="/images/item_2.jpg" /></div>
                                <div class="item_name">Huyndai i30 Седан</div>
                                <div class="item_price">от <span>657 000</span> руб.</div>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="list_item">
                            <a href="">
                                <div class="item_image"><img src="/images/item_1.jpg" /></div>
                                <div class="item_name">Huyndai i30 Седан</div>
                                <div class="item_price">от <span>657 000</span> руб.</div>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="list_item">
                            <a href="">
                                <div class="item_image"><img src="/images/item_2.jpg" /></div>
                                <div class="item_name">Huyndai i30 Седан</div>
                                <div class="item_price">от <span>657 000</span> руб.</div>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="index_page_2">
        <div class="main_width">
            <div class="container row">
                <div class="soc_block">
                    <h2>Мы в соцсетях</h2>
                    <ul>

                        @foreach($news as $new)

                        <li>
                            <div class="article row">
                                <a href="{{ url('/news/' . $new->slug) }}">
                                    <div class="cs_mark"></div>
                                    <div class="article_image" style="background-image:url(/images/a_1.jpg);"></div>
                                    <p>{!! $new->content !!}</p>
                                </a>
                            </div>
                        </li>

                        @endforeach

                    </ul>
                    <a href="{{ url('/news') }}" class="btn">Еще новости</a>
                </div>
                <div class="review_block">
                    <h2>Отзывы</h2>
                    <ul>
                        <li>
                            <div class="review_item row">
                                <div class="user_name">Изольда Грустная</div>
                                <div class="review_date">12 марта</div>
                                <div class="user_image" style="background-image:url(/images/u_1.jpg);"></div>
                                <p>Страх, тревожность и агрессия. Депрессия проявляется как в меланхолии, так и в несвойственном ранее человеку беспокойстве, бессоннице… тревожности. Именно такой вид депрессии чаще приводит к самоубийству, ведь нервная система постоянно напряжена, и человек «устаёт жить».</p>
                            </div>
                        </li>
                        <li>
                            <div class="review_item row">
                                <div class="user_name">Артем Ножик</div>
                                <div class="review_date">12 марта</div>
                                <div class="user_image" style="background-image:url(/images/u_2.jpg);"></div>
                                <p>Но распознать признаки суицидального поведения у человека из своего близкого окружения довольно сложно, поэтому мы собрали…</p>
                            </div>
                        </li>
                    </ul>
                    <a href="" class="btn">Еще отзывы</a>
                </div>
            </div>
        </div>
    </div>
    <div class="action_block">
        <div class="main_width">
            <div class="action_conditions">
                <div class="action_title_black">Успей поймать ее!</div>
                <div class="action_title_white">скидка 90 000 руб. </div>
                <div class="action_title_timer">До конца акции осталось</div>
                <div class="eTimer custom_timer"></div>
                <a href="" class="btn">Получить скидку</a>
            </div>
        </div>
    </div>


    <div class="bottom_map">

    </div>


@endsection

@section('js')



@endsection
