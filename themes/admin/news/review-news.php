<!doctype html>
<html lang="pt-br">
<head>
    <?=$head?>
    <link rel="shortcut icon" type="image/x-icon" href="<?=theme("/assets/img/favicon.png", CONF_VIEW_WEB);?>">
    
    <!-- CSS here -->
    <link rel="stylesheet" href="<?=theme("/assets/css/bootstrap.min.css", CONF_VIEW_WEB)?>">
    <link rel="stylesheet" href="<?=theme("/assets/vendors/bootstrap-icons/bootstrap-icons.css", CONF_VIEW_WEB);?>">
    <link rel="stylesheet" href="<?=theme("/assets/css/owl.carousel.min.css", CONF_VIEW_WEB);?>">
    <link rel="stylesheet" href="<?=theme("/assets/css/ticker-style.css", CONF_VIEW_WEB);?>">
    <link rel="stylesheet" href="<?=theme("/assets/css/flaticon.css", CONF_VIEW_WEB);?>">
    <link rel="stylesheet" href="<?=theme("/assets/css/slicknav.css", CONF_VIEW_WEB);?>">
    <link rel="stylesheet" href="<?=theme("/assets/css/animate.min.css", CONF_VIEW_WEB)?>">
    <link rel="stylesheet" href="<?=theme("/assets/css/magnific-popup.css", CONF_VIEW_WEB);?>">
    <link rel="stylesheet" href="<?=theme("/assets/css/fontawesome-all.min.css", CONF_VIEW_WEB);?>">
    <link rel="stylesheet" href="<?=theme("/assets/css/themify-icons.css", CONF_VIEW_WEB);?>">
    <link rel="stylesheet" href="<?=theme("/assets/css/slick.css", CONF_VIEW_WEB);?>">
    <link rel="stylesheet" href="<?=theme("/assets/css/nice-select.css", CONF_VIEW_WEB);?>">
    <link rel="stylesheet" href="<?=theme("/assets/css/style.css", CONF_VIEW_WEB)?>">
    <link rel="stylesheet" href="<?=theme("/assets/css/myStyle.css", CONF_VIEW_WEB);?>">

    
    <link rel="stylesheet" href="<?= url("/shared/styles/boot.css"); ?>"/>
    <link rel="stylesheet" href="<?= url("/shared/styles/styles.css"); ?>"/>
</head>
    
<body>

<!-- Preloader Start -->
<header>
    <!-- Header Start -->
    <div class="header-area ">
        <div class="main-header position-relative">
            <div class="header-top black-bg d-none d-sm-block fixed-top">
                <div class="container ">
                    <div class="col-xl-12  ">
                        <div class="row d-flex justify-content-between align-items-center ">
                            <div class="header-info-left">
                                <ul>     
                                    <li class="title"><span class="flaticon-energy"></span> Revisão da noticia</li>
                                    <li class="content-title-review font_default">Para publicar a noticia <a href="<?=url("/admin/publicar-noticia/{$news->id}")?>" class="link_default">clique aqui</a> para editar <a href="<?=url("/admin/atualizar-noticia/{$news->id}")?>" class="link_default_two">clique aqui</a></li>
                                </ul>
                            </div>
                            <div class="header-info-right">
                                <ul class="header-date">
                                <li>STATUS:
                                            <?= ($news->status == 1) ?
                                            '<span class="status_news public">
                                                <i class="fa fa-eye"></i>
                                                <span>Publica</span>
                                            </span>' :

                                        '<span class="status_news private">
                                            <i class="fa fa-eye-slash"></i>
                                            <span>Privada</span>
                                        </span>'; ?>


                                        </li>
                                        <li>Local: <span class="font_default"><?=$position[$news->position]?></span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
</header>
<main>
    <!-- About US Start -->
    <div class="about-area2 gray-bg pt-60 pb-60 ">
        <div class="container">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-lg-8 ">
                        <!-- Trending Tittle -->
                        <div class="mb-90">
                            <div class="about-img">
                                <img src="<?=url("/storage/{$news->image}")?>" width="750px" height="400px" alt="">
                            </div>
                            <div class="heading-news mb-30 pt-30">
                                <h3><?=$news->title;?></h3>
                            </div>
                            <div class="about-prea">
                               <?=$news->content;?>
                            
                        </div>
                    </div>
                </div> 
            </div>
        </div>
                   
            </main>

    <script src="<?= url("/shared/scripts/jquery.min.js"); ?>"></script>
    <script src="<?= url("/shared/scripts/jquery-ui.js"); ?>"></script>
    <script src="<?= url("/shared/scripts/jquery.form.js"); ?>"></script>
    <?= $v->section("scripts"); ?>
    
</body>
</html>