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

            <div class="inset_page_content">
                <h1>{{ $page->title }}</h1>

                {!! $page->content !!}

            </div>
        </div>
    </div>

@endsection

@section('bottom_page_content')

    @include('layouts.frontend.includes.bottom_page_content')

@endsection

@section('js')


@endsection