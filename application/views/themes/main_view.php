<!DOCTYPE html>
<html lang="<?=lang('es');?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?=SITE_NAME;?><?=(!empty($custom_title) ? ' | ' . $custom_title : '')?></title>
	<meta name="author" content="Esto es Vixnet">
    <meta name="keywords" content=""/>
    <meta name="description" content="<?=(!empty($custom_description) ? $custom_description : 'Somos una empresa independiente argentina con sede en la Ciudad de Buenos Aires que nace en el 2019 especializándose en la reparación de palas de aerogeneradores  y aportando soluciones en la instalación, puesta en marcha y mantenimiento de activos en proyectos de energías renovables. Tenemos una marcada orientación internacional, participando de proyectos y desarrollando tareas en Latinoamérica, Europa y Asia.')?>">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="<?=assets_url('images/favicon/apple-icon-57x57.png')?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?=assets_url('images/favicon/apple-icon-60x60.png')?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?=assets_url('images/favicon/apple-icon-72x72.png')?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?=assets_url('images/favicon/apple-icon-76x76.png')?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?=assets_url('images/favicon/apple-icon-114x114.png')?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?=assets_url('images/favicon/apple-icon-120x120.png')?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?=assets_url('images/favicon/apple-icon-144x144.png')?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?=assets_url('images/favicon/apple-icon-152x152.png')?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?=assets_url('images/favicon/apple-icon-180x180.png')?>">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?=assets_url('images/favicon/android-icon-192x192.png')?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=assets_url('images/favicon/favicon-32x32.png')?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?=assets_url('images/favicon/favicon-96x96.png')?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=assets_url('images/favicon/favicon-16x16.png')?>">
    <link rel="manifest" href="<?=assets_url('images/favicon/manifest.json')?>">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?=assets_url('images/favicon/ms-icon-144x144.png')?>">
    <meta name="theme-color" content="#ffffff">

    <!-- meta Facebook -->
    <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="<?=(!empty($custom_title)) ? $custom_title : SITE_NAME?>"/>
    <meta property="og:site_name" content="<?=SITE_NAME;?>"/>
    <meta property="og:image" content="<?=(!empty($page_thumbnail)) ? $page_thumbnail : assets_url('images/template/thumb.jpg');?>"/>
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta property="og:url" content="<?=current_url()?>" />
    <meta property="og:description" content="<?=(!empty($custom_description)) ? $custom_description : 'Somos una empresa independiente argentina con sede en la Ciudad de Buenos Aires que nace en el 2019 especializándose en la reparación de palas de aerogeneradores  y aportando soluciones en la instalación, puesta en marcha y mantenimiento de activos en proyectos de energías renovables. Tenemos una marcada orientación internacional, participando de proyectos y desarrollando tareas en Latinoamérica, Europa y Asia.';?>"/>

    <!-- meta Twitter -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="<?=(!empty($custom_title)) ? $custom_title : SITE_NAME?>" />
    <meta name="twitter:description" content="<?=(!empty($custom_description)) ? $custom_description : 'Somos una empresa independiente argentina con sede en la Ciudad de Buenos Aires que nace en el 2019 especializándose en la reparación de palas de aerogeneradores  y aportando soluciones en la instalación, puesta en marcha y mantenimiento de activos en proyectos de energías renovables. Tenemos una marcada orientación internacional, participando de proyectos y desarrollando tareas en Latinoamérica, Europa y Asia.';?>"/>
    <meta name="twitter:image" content="<?=(!empty($page_thumbnail)) ? $page_thumbnail : assets_url('images/template/thumb.jpg');?>" />
    <meta name="twitter:image:width" content="1200">
    <meta name="twitter:image:height" content="630">

    <!-- Jquery -->
    <script src="<?=assets_url('libs/jquery.min.js');?>"></script>
    <!-- JS Bootstrap -->
    <script src="<?=assets_url('libs/bootstrap.min.js');?>"></script>
    <!-- styles (include Bootstrap) -->
    <link type="text/css" href="<?=assets_url('css/main.css');?>" rel="stylesheet">
    <!-- swiperJS -->
    <link rel="stylesheet" type="text/css" href="<?=assets_url('libs/swiper/css/swiper.min.css');?>">
    <script type="text/javascript" src="<?=assets_url('libs/swiper/js/swiper.min.js');?>"></script>
    <!-- Fancybox -->
    <link rel="stylesheet" type="text/css" href="<?=assets_url('libs/fancybox/css/fancybox.min.css');?>">
    <script type="text/javascript" src="<?=assets_url('libs/fancybox/js/fancybox.min.js');?>"></script>
    <!-- Site scripts -->
    <script src="<?=assets_url('libs/source.js');?>"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Display:wght@400;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Overpass&display=swap" rel="stylesheet">
    
    <script>
        var base_url = '<?= base_url(); ?>'; 
    </script>
</head>

<body>
    <?php if (!empty($header)) echo $header; ?>
    <main>
        <?php if (!empty($section)) echo $section; ?>
    </main>
    <?php if (!empty($footer)) echo $footer; ?>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-174911705-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-174911705-1');
    </script>
</body>
</html>
