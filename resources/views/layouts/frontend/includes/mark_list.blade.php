<div class="index_marks">
    <div class="main_width">

        <?php $i = 0; ?>
        @foreach($marks as $mark)
            @if($i == 0)
                <ul class="row"> @endif
                    <li>
                        <a href="{!! url('/auto/' . $mark->slug) !!}">
                            <div><img style="height: 23px" src="{!! $mark->logo !!}"/></div>
                            <span>{!! $mark->name !!}</span>
                        </a>
                    </li>
                    <?php $i++; ?>
                    @if($i == 11) </ul>  <?php $i = 0; ?> @endif
        @endforeach

    </div>
</div>