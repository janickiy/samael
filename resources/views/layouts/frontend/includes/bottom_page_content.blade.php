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
                                    <div class="article_image" style="background-image:url(/images/a_1.jpg);"></div>
                                    <p>{!! $new->content !!}</p>
                                </a>
                            </div>
                        </li>

                    @endforeach

                </ul>
                <a href="" class="btn">Еще новости</a>
            </div>
            <div class="review_block">
                <h2>Отзывы</h2>
                <ul>
                    <li>
                        <div class="review_item row">
                            <div class="user_name">Изольда Грустная</div>
                            <div class="review_date">12 марта</div>
                            <div class="user_image" style="background-image:url(images/u_1.jpg);"></div>
                            <p>Страх, тревожность и агрессия. Депрессия проявляется как в меланхолии, так и в несвойственном ранее человеку беспокойстве, бессоннице… тревожности. Именно такой вид депрессии чаще приводит к самоубийству, ведь нервная система постоянно напряжена, и человек «устаёт жить».</p>
                        </div>
                    </li>
                    <li>
                        <div class="review_item row">
                            <div class="user_name">Артем Ножик</div>
                            <div class="review_date">12 марта</div>
                            <div class="user_image" style="background-image:url(images/u_2.jpg);"></div>
                            <p>Но распознать признаки суицидального поведения у человека из своего близкого окружения довольно сложно, поэтому мы собрали…</p>
                        </div>
                    </li>
                </ul>
                <a href="" class="btn">Еще отзывы</a>
            </div>
        </div>
    </div>
</div>