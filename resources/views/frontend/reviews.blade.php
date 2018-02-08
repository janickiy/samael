@extends('layouts.frontend.app')

@section('title', 'Отзывы' )

@section('meta_desc', '')

@section('meta_keywords', '')

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
                <h1>Отзывы</h1>
                <div class="row mentions">
					  <div class="sidebar">
                        <div class="feedback_form request_form">
                            <div class="form_title">Напишите свой отзыв</div>

                            {!! Form::open(['url' =>  '/reviews', 'method' => 'post', 'id'=>'validate']) !!}

                            {!! Form::text('author', old('author'), ['class' => 'form_control  validate[required]', 'placeholder'=>'Ваше имя']) !!}

                            {!! Form::email('email', old('email'), ['class' => 'form_control  validate[custom[email]]', 'placeholder'=>'E-mail']) !!}

                            {!! Form::textarea('message', old('message'), ['class' => 'form_control  validate[required]', 'rows'=>5, 'placeholder'=>'Ваш отзыв']) !!}

                            {!! Form::submit('отправить отзыв', ['class'=>'btn']) !!}

                            {!! Form::close() !!}

                        </div>
                    </div>
                    <div class="mentions_list">

                        @if(count($reviews) > 0)

                            <ul>

                                @foreach($reviews as $review)

                                    <li class="review_item">
                                        <div class="row">
                                            <div class="mention_pic"></div>
                                            <div class="mention_text">
                                                <div class="mention_title">{{ $review->author }}</div>
                                                <div class="review_date">{{ $review->created_at }}</div>
                                                <p>{{ $review->message }}</p>
                                            </div>
                                        </div>
                                    </li>

                                @endforeach

                            </ul>
                        @else
                            <p style="text-align: center">нет отзывов</p>
                        @endif

                        <div class="pager">
                            {{ $reviews->render() }}
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