<section id="clients">
    <div class="container">
        <h3><?=lang('Nuestra experiencia en palas eólicas');?></h3>
        <div class="d-none d-lg-block">
            <div class="row">
                <div class="col-3"><img src="<?=assets_url('images/services/clients/vestas.png');?>" alt="Vestas"></div>
                <div class="col-3"><img src="<?=assets_url('images/services/clients/siemens.png');?>" alt="Siemens Gamesa"></div>
                <div class="col-3"><img src="<?=assets_url('images/services/clients/lm.png');?>" alt="LM Wind Power"></div>
                <div class="col-3 text-left"><img style="max-height:45px;" src="<?=assets_url('images/services/clients/suzlon.png');?>" alt="Suzlon"></div>
            </div>
            <div class="row second-row">
                <div class="col-4 text-left offset-1"><img src="<?=assets_url('images/services/clients/euros.png');?>" alt="Euros"></div>
                <div class="col-3 text-left"><img style="padding-left:20px;" src="<?=assets_url('images/services/clients/ge.png');?>" alt="General Electric"></div>
                <div class="col-4 text-left"><img src="<?=assets_url('images/services/clients/nordex.png');?>" alt="Nordex"></div>
            </div>
        </div><!-- Only desktop -->
        <div class="d-block d-lg-none">
            <div id="clients-swiper" class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><div class="img-slide vestas"></div></div>
                    <div class="swiper-slide"><div class="img-slide siemens"></div></div>
                    <div class="swiper-slide"><div class="img-slide lm"></div></div>
                    <div class="swiper-slide"><div class="img-slide suzlon"></div></div>
                    <div class="swiper-slide"><div class="img-slide euros"></div></div>
                    <div class="swiper-slide" style="max-width: 100px;"><div class="img-slide ge"></div></div>
                    <div class="swiper-slide"><div class="img-slide nordex"></div></div>
                </div>
            </div>
            <div class="clients-pagination"></div>
        </div><!-- Only mobile -->
    </div>
</section>

<script>
var swiper = new Swiper('#clients-swiper', {
    spaceBetween: 40,
    breakpoints: {
        0: {
            slidesPerView: 1.6,
        },
        768: {
            slidesPerView: 4,
        }
    }
});
</script>