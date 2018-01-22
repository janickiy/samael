@extends('layouts.frontend.app')

@section('title', isset($title) ? $title : '' )

@section('meta_desc', isset($meta_desc) ? $meta_desc : '')

@section('meta_keywords', isset($meta_keywords) ? $meta_keywords : '')

@section('css')

@endsection


@section('marks')

@endsection

@section('content')
    <section>
        <h1>Автомобили с пробегом</h1>
        <div class="items_list catalog_list row">
            <div class="right_banner_block">
                <img src="/images/right_banner.jpg" />
            </div>

            @if(count($usedCars)>0)
            <ul>

                @foreach($usedCars as $car)

                <li class="item">
                    <div class="item_pic"><img src="{!! mainSmallPic($car->image) !!}" /></div>
                    <div class="idem_desc">
                        <a class="item_name" href="{{ url('/auto/used/detail/' .  $car->id) }}">{{ $car->mark }} {{ $car->model }}</a>
                        <p>{{ $car->year }} г., {{ number_format($car->mileage,0,'',' ') }} км, {{ $car->engine_type }}, КПП {{ $car->gearbox }}</p>
                        <div class="item_price">{{ number_format($car->price,0,'',' ') }}<span class="rub">o</span></div>
                        <a class="item_btn" href="{{ url('/auto/used/detail/' .  $car->id) }}">Подробнее</a>
                    </div>
                </li>

                @endforeach

            </ul>

            <div class="pager">
                {{ $usedCars->render() }}
            </div>

            @endif
        </div>

    </section>
@endsection

@section('js')
    <script type="text/javascript">

    </script>
@endsection







