<section id="work" class="pb-3">
    <div class="container">
        <h2><?=lang('Trabajos realizados');?></h2>
        <p><?=lang('Antes y después');?></p>
        <div id="work-swiper" class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <a data-fancybox="gallery" href="<?=assets_url('images/services/work/1.jpg');?>">
                        <img src="<?=assets_url('images/services/work/1.jpg');?>" alt="Trabajo 1">
                    </a>
                </div>
                <div class="swiper-slide">
                    <a data-fancybox="gallery" href="<?=assets_url('images/services/work/2.jpg');?>">
                        <img src="<?=assets_url('images/services/work/2.jpg');?>" alt="Trabajo 2">
                    </a>
                </div>
                <div class="swiper-slide">
                    <a data-fancybox="gallery" href="<?=assets_url('images/services/work/3.jpg');?>">
                        <img src="<?=assets_url('images/services/work/3.jpg');?>" alt="Trabajo 3">
                    </a>
                </div>
                <div class="swiper-slide">
                    <a data-fancybox="gallery" href="<?=assets_url('images/services/work/4.jpg');?>">
                        <img src="<?=assets_url('images/services/work/4.jpg');?>" alt="Trabajo 4">
                    </a>
                </div>
                <!-- <div class="swiper-slide">
                    <a data-fancybox="gallery" href="<?=assets_url('images/services/work/5.jpg');?>">
                        <img src="<?=assets_url('images/services/work/5.jpg');?>" alt="Trabajo 5">
                    </a>
                </div> -->
                <!-- <div class="swiper-slide">
                    <a data-fancybox="gallery" href="<?=assets_url('images/services/work/6.jpg');?>">
                        <img src="<?=assets_url('images/services/work/6.jpg');?>" alt="Trabajo 6">
                    </a>
                </div> -->
                <!-- <div class="swiper-slide">
                    <a data-fancybox="gallery" href="<?=assets_url('images/services/work/7.jpg');?>">
                        <img src="<?=assets_url('images/services/work/7.jpg');?>" alt="Trabajo 7">
                    </a>
                </div> -->
                <!-- <div class="swiper-slide">
                    <a data-fancybox="gallery" href="<?=assets_url('images/services/work/8.jpg');?>">
                        <img src="<?=assets_url('images/services/work/8.jpg');?>" alt="Trabajo 8">
                    </a>
                </div> -->
                <div class="swiper-slide">
                    <a data-fancybox="gallery" href="<?=assets_url('images/services/work/9.jpg');?>">
                        <img src="<?=assets_url('images/services/work/9.jpg');?>" alt="Trabajo 9">
                    </a>
                </div>
                <div class="swiper-slide">
                    <a data-fancybox="gallery" href="<?=assets_url('images/services/work/10.jpg');?>">
                        <img src="<?=assets_url('images/services/work/10.jpg');?>" alt="Trabajo 10">
                    </a>
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        <!-- Pagination -->
        <div class="work-pagination"></div>
    </div>
</section>

<!-- Fancybox CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

<script>
    var swiper = new Swiper('#work-swiper', {
        spaceBetween: 20,
        pagination: {
            el: '.work-pagination',
            clickable: true,
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 3,
            }
        },      
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        watchSlidesVisibility: true, 
    });
</script>