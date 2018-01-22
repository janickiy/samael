<header class="row">
    <div class="main_width">
        <a href="/" class="logo"><img src="/images/logo.png" /></a>
        <div class="header_info">
            <div class="addresses">{!! getSetting('FRONTEND_ADDRESS') !!}</div>
            <div class="times">{!! getSetting('FRONTEND_TIMES') !!}</div>
        </div>
        <div class="header_phones row">
            <a class="default_phone" href="tel:{!! getSetting('TELEPHONE_1') !!}">{!! getSetting('TELEPHONE_1') !!}</a>
            <div class="free_phone">
                <a href="tel:{!! getSetting('TELEPHONE_2') !!}">{!! getSetting('TELEPHONE_2') !!}</a>
                <span>(Звонок по России бесплатный)</span>
            </div>
        </div>
    </div>
</header>
<div class="nav_wrapper">
    <div class="main_width">
        <nav>
            <ul class="row">
                @foreach(getMenuItems('HEADER') as $item)
                    <li><a href="{{ url($item->url) }}"><b>{{ $item->title }}</b></a></li>
                @endforeach
            </ul>
        </nav>
    </div>
</div>




