<!-- start footer -->

<footer class="row">
    <div class="main_width">
        <a href="/" class="logo"><img src="/images/footer_logo.png"/></a>
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
</footer>

<!-- end footer -->
<!-- mobile footer -->

<div class="row footer_mobile">
    <div class="main_width">
        <a href="/" class="logo"><img src="/images/footer_logo.png"/></a>
        <div class="header_phones row">
            <a class="free_phone" href="tel:{!! getSetting('TELEPHONE_1') !!}">{!! getSetting('TELEPHONE_1') !!}</a>
            <a class="default_phone" href="tel:{!! getSetting('TELEPHONE_2') !!}">{!! getSetting('TELEPHONE_2') !!}</a>
        </div>
    </div>
</div>
</div>

<!-- end mobile footer -->