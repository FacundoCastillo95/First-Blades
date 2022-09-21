<footer>
    <div class="container">
        <div class="row no-gutters main-row">
            <div class="col-12 col-lg-4 text-center text-lg-left">
                <a href="<?= base_url(); ?>"><img class="logo" src="<?=assets_url('images/template/logo.svg');?>" alt="First Blades"></a>
            </div>
            <div class="col-12 col-lg-2 text-center text-lg-right footer-link order-last"><a href="<?= base_url('services'); ?>"><?=lang('NUESTROS SERVICIOS');?></a></div>
            <div class="col-12 col-lg-2 text-center text-lg-right footer-link order-last"><a href="<?= base_url('about'); ?>"><?=lang('QUIÉNES SOMOS')?></a></div>
            <div class="col-12 col-lg-2 text-center text-lg-right footer-link order-last"><a href="<?= base_url(); ?>#contact"><?=lang('CONTACTANOS');?></a></div>
            <div class="col-12 col-lg-2 text-center text-lg-right order-lg-last">
                <select name="language" id="language" onchange="language(this.value);">
                    <option value="spanish"><?=lang('Español');?></option>
                    <option <?=(!empty($this->session->userdata('language') == 'english')) ? 'selected' : '';?> value="english"><?=lang('Inglés');?></option>
                    <!-- <option value="portugese"><?=lang('Portugués');?></option> -->
                </select>
            </div>
        </div>
        <div class="row bottom-row no-gutters">
            <div class="col-lg-7 text-center text-lg-left">
                <p>
                    <span>&copy; 2020 First Blades</span>
                    <!-- <a class="policies-link" href="#"><?=lang('Términos y condiciones');?></a>
                    <a class="policies-link" href="#"><?=lang('Políticas de privacidad');?></a>
                    <a class="policies-link" href="#"><?=lang('Políticas de Cookies');?></a> -->
                </p>
            </div>
            <div class="col-lg-5 text-center text-lg-right">
                <span><?=lang('Desarrollado por');?><a target="_blank" href="https://www.estoes.me/"> Esto es Agencia Creativa Digital</a></span>
            </div>
        </div>
    </div>
</footer>
