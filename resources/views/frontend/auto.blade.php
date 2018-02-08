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

                {!! Form::open(['url' =>  '/auto', 'method' => 'get']) !!}

                {!! Form::hidden('search', 'Y') !!}

                <div class="cars_filter row">

                    <div class="cars_filter_block">

                        {!! Form::text('price_from', old('price_from', isset($request->price_from) ? $request->price_from : null), ['class' => 'form_control', 'placeholder'=>'Цена от']) !!}

                    </div>
                    <div class="cars_filter_block">

                        {!! Form::text('price_to', old('price_to', isset($request->price_to) ? $request->price_to : null), ['class' => 'form_control', 'placeholder'=>'Цена до']) !!}

                    </div>

                    <div class="cars_filter_block">
                        {{ Form::select('gearbox',
                        ['mt' => 'Механическая',
                        'at' => 'Автоматическая',
                        'rgt' => 'Роботизированная',
                        'cvt' => 'Вариатор',
                        'amt' => 'Автоматизированная механическая'
                        ], isset($request->gearbox) ? $request->gearbox : 'mt', ['class' => 'select2']) }}
                    </div>

                    <div class="cars_filter_block">
                        {{ Form::select('body_type',
                        ['hatchback_5' => 'Хэтчбек 5D',
                        'hatchback_3' => 'Хэтчбек 3D',
                        'liftback' => 'Лифтбек',
                        'sedan' => 'Седан',
                        'wagon' => 'Универсал',
                        'wagon_5' => 'Универсал 5 мест',
                        'wagon_7' => 'Универсал 7 мест',
                        'coupe' => 'Купе',
                        'suv' => 'Внедорожник',
                        'suv_3' => 'Внедорожник 3',
                        'suv_5' => 'Внедорожник 5D',
                        'crossover' => 'Кроссовер',
                        'truck' => 'Грузовик',
                        'pickup' => 'Пикап',
                        'van' => 'Минивен',
                        'convertible' => 'Кабриолет'
                        ], isset($request->body_type) ? $request->body_type : 'sedan', ['class' => 'select2']) }}
                    </div>

                    {!! Form::submit('Подобрать', ['class'=>'btn']) !!}

                </div>

                {!! Form::close() !!}

                <div class="cars_list">

                    @if(count($newcars) > 0)

                    <ul class="row item_list container">

                        @foreach($newcars as $car)

                        <li>
                            <div class="list_item">
                                <a href="{!! url('/auto/' . $car->mark_slug . '/' . $car->model_slug) !!}">
                                    <div class="item_image"><img src="{!! $car->image !!}"></div>
                                    <div class="item_name">{!! $car->mark !!} {{ $car->model }}</div>
                                    <div class="item_price">от <span>{!! $car->price !!}</span> руб.</div>
                                </a>
                            </div>
                        </li>

                        @endforeach

                    </ul>

                    <div class="pager">

                       {{ $newcars->render() }}

                    </div>

                   @else

                        @if(isset($request->search) && !empty($request->search))

                            <p>По вашему запросу ничего ненайдено!</p>

                        @endif

                   @endif

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

    </script>
@endsection







