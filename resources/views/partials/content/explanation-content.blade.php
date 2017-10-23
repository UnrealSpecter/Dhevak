<!-- explanation-container -->
<div class="explanation-container animated fadeInUp d-none">
    <!-- <div class="arrow previous"></div>
    <div class="arrow next"></div> -->
    <div class="scroll-indicator">

        <div class="mobile-explanation flex flow-r d-none">
            <div class="animated fadeInDown"> Navigeer door te swipen </div>
            <img class="explanation-icon" src="{{ asset('/images/explanation-images/horizontal-swipe-icon.png') }}">
        </div>

        <div class="non-mobile-explanation flex flow-r d-none">
            <div class="animated fadeInDown"> Navigeer door te scrollen </div>
            <div class="animated fadeInUp explanation-skip-transitions skip flex flow-r">
                <span class="skip">Sla Over</span>
                <!-- <div class="flex">
                    <img class="explanation-icon checked img-fluid d-none" src="{{ asset('/images/explanation-images/explanation-checked-icon-black.png') }}">
                    <img class="explanation-icon unchecked img-fluid" src="{{ asset('/images/explanation-images/explanation-unchecked-icon-black.png') }}">
                </div> -->
                <span class="glyphicon glyphicon-ok"></span>
            </div>
            <div class="animated fadeInUp explanation-confirm">Ok, Ik snap het</div>
            <div class="animated fadeInUp explanation-help">
                <a href="https://www.google.nl/search?q=hoe+moet+ik+scrollen+op+een+website%3F" target="_blank">Ik snap het niet help</a>
            </div>
        </div>

    </div>
</div>
