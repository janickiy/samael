@extends('layouts.frontend.app')

@section('title', $post->title)

@section('meta_desc', $post->meta_desc)

@section('meta_keywords', $post->meta_keywords)

@section('css')

@endsection

@section('content')
    <div class="">
        <div class="main_width">
            <h2 class="page-head-line">{{ $post->title }}</h2>
       
            {!! $post->content !!}
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">

    </script>
@endsection
