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
			<h1>Новости</h1>
                <div class="row news_list">
					<ul>
                        @foreach($news as $new)
                            <li>
								<div class="news_item row">
										<div class="row">
											<div class="news_item_content">
												<a href="{{ url($new->slug) }}" class="news_item_title">{{ $new->title }}</a>
												<p>{!! $new->excerpt()  !!}</p>
											</div>	
										</div>
										<a class="btn" href="{{ url($new->slug) }}">Читать полностью</a>
									</div>
                            </li>
                        @endforeach
					</ul>	
                        <div class="text-center">
                            {!! $news->links() !!}
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