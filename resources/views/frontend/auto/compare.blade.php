@extends('layouts.frontend.app')

@section('title', 'Сравнение комплектаций')

@section('meta_desc', '')

@section('meta_keywords', '')

@section('css')

    {!! Html::style('css/tablesaw.css') !!}

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

                <table border=1 class="table datatable dt-responsive tablesaw tablesaw-swipe compare_tab" data-tablesaw-mode="swipe"
                       style="width:100%;">
                    <thead>
                    <tr>
                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"></th>

                        @foreach($complectations as $complectation)

                            <th>{!!  $complectation->modification !!} {!! $complectation->complectation !!}</th>

                        @endforeach

                    </tr>
                    </thead>

                    @for($i = 0; $i < count($parameterCategories["category"]); $i++)

                        <tr>
                            <td colspan="{!! count($complectations) + 1 !!}" class="row_td">{!! $parameterCategories["category"][$i] !!}</td>
                        </tr>

                        @foreach(getParameterValuesByCategoryId($parameterCategories["id"][$i]) as $value)
                            <tr>
                                <td>{!! $value['name'] !!}</td>

                                @foreach($complectations as $complectation)

                                    <td>@if( checkParameterComplectation($complectation->id, $value['id']))
                                            <span class="yes"></span> @endif </td>

                                @endforeach

                            </tr>

                        @endforeach

                    @endfor

                    <tbody>
                    </tbody>

                </table>

            </div>
        </div>
    </div>

@endsection

@section('js')

    {!! Html::script('js/tablesaw.jquery.js') !!}
    {!! Html::script('js/tablesaw-init.js') !!}

    <script type="text/javascript">

        var TablesawConfig = {
            i18n: {
                swipePreviousColumn: "прокрутить назад",
                swipeNextColumn: "прокрутить вперед"
            },
            swipe: {
                horizontalThreshold: 45,
                verticalThreshold: 45
            }
        };

    </script>

@endsection