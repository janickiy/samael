@extends('layouts.frontend.app')

@section('title', 'Отзывы')
@section('meta_desc', '')
@section('meta_keywords','')

@section('css')

@endsection

@section('marks')
    @include('layouts.frontend.includes.mark_list')
@endsection

@section('content')
    <section>
        <h1>Отзывы</h1>
        <div class="row mentions">
            <div class="mentions_list">

                @if(count($reviews) > 0)

                <ul>

                    @foreach($reviews as $review)

                    <li>
                        <div class="row">
                            <div class="mention_pic"></div>
                            <div class="mention_text">
                                <div class="mention_title">{{ $review->author }}</div>
                                <div><i>{{ $review->created_at }}</i></div>
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


            <div class="sidebar">
                <div class="feedback_form">
                    <div class="form_title">Напишите свой отзыв</div>

                    {!! Form::open(['url' =>  '/reviews', 'method' => 'post', 'id'=>'validate']) !!}

                    {!! Form::text('author', old('author'), ['class' => 'form_control  validate[required]', 'placeholder'=>'Ваше имя']) !!}

                    {!! Form::email('email', old('email'), ['class' => 'form_control  validate[custom[email]]', 'placeholder'=>'E-mail']) !!}

                    {!! Form::textarea('message', old('message'), ['class' => 'form_control  validate[required]', 'rows'=>5, 'placeholder'=>'Ваш отзыв']) !!}

                    {!! Form::submit('отправить отзыв', ['class'=>'btn']) !!}

                    {!! Form::close() !!}

                </div>
            </div>

        </div>
    </section>
@endsection

@section('js')
    <script type="text/javascript">

    </script>
@endsection