@extends('layouts.frontend.app')

@section('title', 'Контакт')

@section('meta_desc', '')

@section('meta_keywords', '')

@section('css')

    {!! Html::style('css/fancybox/jquery.fancybox.css') !!}

@endsection

@section('marks')
    @include('layouts.frontend.includes.mark_list')
@endsection

@section('content')




    <div class="inset_page white_bg contacts">
        <div class="main_width">
            @section('breadcrumbs')
                @include('layouts.frontend.includes.breadcrumbs')
            @endsection
            <div class="page_content">
                <h1>Сравнение комплектаций</h1>


            </div>
        </div>
    </div>

@endsection

@section('js')


    <script type="text/javascript">


    </script>

@endsection