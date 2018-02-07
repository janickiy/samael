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
<div class="header_mobile row">
    <div class="main_width">
		<a class="mobile_nav_ico" id="show_nav"><img src="/images/mobile_nav_ico.png" /></a>
        <a href="/" class="logo"><img src="/images/logo.png" /></a>
        <a class="mobile_phone_ico" href="tel:{!! getSetting('TELEPHONE_1') !!}"><img src="/images/mobile_phone_ico.png" /></a>
    </div>
</div> 
<nav class="nav_mobile" id="nav_mobile">
	<div class="mobile_nav_header">
		<a href="/" class="logo"><img src="/images/logo.png" /></a>
		<a class="mobile_nav_ico" id="hide_nav"><img src="/images/mobile_nav_ico.png" /></a>
	</div>
	<ul>
		@foreach(getMenuItems('HEADER') as $item)
            <li><a href="{{ url($item->url) }}"><b>{{ $item->title }}</b></a></li>
         @endforeach
	</ul>
	<div class="mobile_info">
		 <div class="addresses">
			Адрес:<br/>
			<span>{!! getSetting('FRONTEND_ADDRESS') !!}</span>
		 </div>
		 <div class="phones">
			Телефон:<br/>
			<a href="tel:{!! getSetting('TELEPHONE_1') !!}">{!! getSetting('TELEPHONE_1') !!}</a>
			<a href="tel:{!! getSetting('TELEPHONE_2') !!}">{!! getSetting('TELEPHONE_2') !!}</a>
		 </div>
		 <div class="times">
			Часы работы:<br/>
			<span>{!! getSetting('FRONTEND_TIMES') !!}</span>
		</div>
	</div>
</nav>



