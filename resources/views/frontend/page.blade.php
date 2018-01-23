@extends('layouts.frontend.app')

@section('title', isset($title) ? $title : '' )

@section('meta_desc', isset($meta_desc) ? $meta_desc : '')

@section('meta_keywords', isset($meta_keywords) ? $meta_keywords : '')

@section('css')

@endsection

@section('marks')
    @include('layouts.frontend.includes.mark_list')
@endsection


<div class="inset_page">
    <div class="main_width">
        @section('breadcrumbs')
            @include('layouts.frontend.includes.breadcrumbs')
        @endsection
        <div class="inset_page_content">
            @section('content')
                <h1>{!! $page->title !!}</h1>
                {!! $page->content !!}
                @include('layouts.frontend.includes.bottom_page_content')
            @endsection

        </div>
    </div>
</div>


@section('js')
    <script type="text/javascript">

    </script>
@endsection