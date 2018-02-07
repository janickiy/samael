<div class="bottom_page_content">
    <div class="main_width">
        <div class="container row">
            <div class="soc_block">
                <h2>Мы в соцсетях</h2>
                <ul>

                    @foreach($news as $new)

                    <li>
                        <div class="article row">
                            <a href="{{ url('/news/' . $new->slug) }}">
                                <div class="cs_mark"></div>
                                <p>{!! $new->content !!}</p>
                            </a>
                        </div>
                    </li>

                    @endforeach

                </ul>
                <a href="{{ url('/news') }}" class="btn">Еще новости</a>
            </div>
            <div class="review_block">
                <h2>Отзывы</h2>
                <ul>

                    @foreach($reviews as $review)

                    <li>
                        <div class="review_item row">
                            <div class="user_name">{!! $review->author !!}</div>
                            <div class="review_date">{!! $review->published_at !!}</div>
                             <p>{!! $review->message !!}</p>
                        </div>
                    </li>

                    @endforeach


                </ul>
                <a href="{!! url('/reviews') !!}" class="btn">Еще отзывы</a>
            </div>
        </div>
    </div>
</div>