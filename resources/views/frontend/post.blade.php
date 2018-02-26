@extends('layouts.frontend.app')

@section('title', $post->title)

@section('meta_desc', $post->meta_desc)

@section('meta_keywords', $post->meta_keywords)

@section('css')

@endsection

@section('content')
    <div class="inset_page white_bg">
        <div class="main_width">

			<h1 class="page-head-line">{{ $post->title }}</h1>
			<div class="news_detail">
				<div><p> {!! $post->content !!}</p></div>
			</div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">

    </script>
@endsection
