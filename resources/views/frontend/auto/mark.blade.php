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

    <div class="inset_page">
        <div class="main_width">

           @include('layouts.frontend.includes.breadcrumbs')

            <div class="auto_page_content mark_page">
                <div class="row mark_page_title">
                    <h1>Hyundai</h1>
                    <div class="advertising_flag"><div>Скидка <span>до</span> 123 000 <span>руб.</span> <span class="fs14">до 12 февраля</span></div></div>
                </div>
                <div class="row">
                    <div class="cars_list">
                        <ul class="row item_list container">

                            @foreach($model_list as $car)

                            <li>
                                <div class="list_item">
                                    <a href="">
                                        <div class="item_image"><img src="images/item_1.jpg"></div>
                                        <div class="item_name">{!! $car->name !!}</div>
                                        <div class="item_price">от <span>657 000</span> руб.</div>
                                    </a>
                                </div>
                            </li>

                            @endforeach


                        </ul>
                    </div>
                    <div class="presents_block sidebar">


                        <div class="present_item_container">
                            <div class="present_item">
                                <div><img src="/images/p_5.png" /></div>
                                <div>Автокредит<br/>от <span>0</span>%</div>
                            </div>
                        </div>

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

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('bottom_page_content')

@endsection


@section('js')


@endsection