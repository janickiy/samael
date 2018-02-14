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
                <div class="row">
                    <div class="col-md-12">
                        @foreach($news as $new)
                            <div class="col-md-11">
                                <h4><a href="{{ url($new->slug) }}">{{ $new->title }}</a></h4>
                                <div class="post-content">
                                    {!! $new->excerpt()  !!}
                                </div>
                                <div class="read-more">
                                    <a href="{{ url($new->slug) }}">подробно &gt;&gt;</a>
                                </div>
                                <hr/>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-12">
                        <div class="text-center">
                            {!! $news->links() !!}
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