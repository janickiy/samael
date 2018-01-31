@extends('layouts.frontend.app')

@section('title', isset($title) ? $title : '' )

@section('meta_desc', isset($meta_desc) ? $meta_desc : '')

@section('meta_keywords', isset($meta_keywords) ? $meta_keywords : '')

@section('css')

@endsection




@section('banner')
    <div class="main_banner"></div>
@endsection

@section('marks')
    @include('layouts.frontend.includes.mark_list')
@endsection




@section('content')
    <div class="inset_page">
        <div class="main_width">
            <div class="breadcrumbs">
                <a href="/">Главная</a> - <span>Новые автомобили</span>
            </div>
            <div class="auto_page_content">
                <h1>Новые автомобили</h1>
                <div class="cars_filter row">
                    <div class="cars_filter_block">
                        <input type="text" class="form_control" placeholder="Цена от" />
                    </div>
                    <div class="cars_filter_block">
                        <input type="text" class="form_control" placeholder="Цена до" />
                    </div>
                    <div class="cars_filter_block">
                        <select class="select2">
                            <option>КПП</option>
                            <option>Вариант</option>
                            <option>Вариант</option>
                            <option>Вариант</option>
                            <option>Вариант</option>
                        </select>
                    </div>
                    <div class="cars_filter_block">
                        <select class="select2">
                            <option>Кузов</option>
                            <option>Седан</option>
                            <option>Вариант</option>
                            <option>Вариант</option>
                            <option>Вариант</option>
                        </select>
                    </div>
                    <input type="submit" class="btn" value="Подобрать" />
                </div>
                <div class="cars_list">

                    <ul class="row item_list container">

                        @foreach($newcars as $car)

                        <li>
                            <div class="list_item">
                                <a href="{!! url('/auto/' . $car->mark_slug . '/' . $car->model_slug) !!}">
                                    <div class="item_image"><img src="{!! $car->image !!}"></div>
                                    <div class="item_name">{!! $car->mark !!} {{ $car->model }}</div>
                                    <div class="item_price">от <span>657 000</span> руб.</div>
                                </a>
                            </div>
                        </li>

                        @endforeach

                    </ul>

                </div>

                <div class="pager">
                    {{ $newcars->render() }}
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">

    </script>
@endsection







