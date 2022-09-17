<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <?= $head; ?>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="<?= theme("/assets/img/favicon.png", CONF_VIEW_WEB) ?>">

    <link rel="stylesheet" href="<?= url("/shared/styles/boot.css"); ?>"/>
    <link rel="stylesheet" href="<?= url("/shared/styles/styles.css"); ?>"/>
    <link rel="stylesheet" href="<?= theme("/assets/css/login.css", CONF_VIEW_ADMIN); ?>"/>
   

    <link rel="stylesheet" href="<?= theme("/assets/css/bootstrap.min.css", CONF_VIEW_WEB) ?>">
    <link rel="stylesheet" href="<?= theme("/assets/css/owl.carousel.min.css", CONF_VIEW_WEB) ?>">
    <link rel="stylesheet" href="<?= theme("/assets/css/ticker-style.css", CONF_VIEW_WEB) ?>">
    <link rel="stylesheet" href="<?= theme("/assets/css/flaticon.css", CONF_VIEW_WEB) ?>">
    <link rel="stylesheet" href="<?= theme("/assets/css/slicknav.css", CONF_VIEW_WEB) ?>">
    <link rel="stylesheet" href="<?= theme("/assets/css/animate.min.css", CONF_VIEW_WEB) ?>">
    <link rel="stylesheet" href="<?= theme("/assets/css/magnific-popup.css", CONF_VIEW_WEB) ?>">
    <link rel="stylesheet" href="<?= theme("/assets/css/fontawesome-all.min.css", CONF_VIEW_WEB) ?>">
    <link rel="stylesheet" href="<?= theme("/assets/css/themify-icons.css", CONF_VIEW_WEB) ?>">
    <link rel="stylesheet" href="<?= theme("/assets/css/slick.css", CONF_VIEW_WEB) ?>">
    <link rel="stylesheet" href="<?= theme("/assets/css/nice-select.css", CONF_VIEW_WEB) ?>">
    <link rel="stylesheet" href="<?= theme("/assets/css/style.css", CONF_VIEW_WEB) ?>">
    

    <link rel="stylesheet" href="<?= theme("assets/css/myStyle.css", CONF_VIEW_WEB) ?>">
</head>

<body>

    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="<?= theme("/assets/img/logo/logo.png", CONF_VIEW_WEB) ?>" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <header>
        <!-- Header Start -->
        <div class="header-area">
            <div class="main-header ">

                <div class="header-mid gray-bg">
                    <div class="container">
                        <div class="row d-flex align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-3 col-lg-3 col-md-3 d-none d-md-block">
                                <div class="logo">
                                    <a href="<?= url('/') ?>"><img src="<?= theme("/assets/img/logo/logo.png", CONF_VIEW_WEB) ?>" alt=""></a>
                                </div>
                            </div>

                            <div class="col-xl-9 col-lg-9 col-md-9">
                            <div class="header-banner f-right ">
                                <img src="<?=theme("assets/img/gallery/header_card.png", CONF_VIEW_WEB) ;?>" alt="">
                            </div>
                        </div>
                            
                        </div>
                    </div>
                </div>
                <div class="header-bottom header-sticky">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-8 col-lg-8 col-md-12 header-flex">
                                <!-- sticky -->
                                <div class="sticky-logo">
                                    <a href="#"><img src="<?= theme("/assets/img/logo/logo.png", CONF_VIEW_WEB) ?>" alt=""></a>
                                </div>
                                <!-- Main-menu -->
                                <div class="main-menu d-none d-md-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="<?= url('/') ?>">Home</a></li>
                                            <li><a href="<?= url('ultimas_noticias') ?>">Últimas Notícias</a></li>
                                            <li><a href="<?= url('categorias') ?>">Categorias</a></li>
                                            <li><a href="<?= url('contato') ?>">Contato</a></li>
                                            <li><a href="<?= url('sobre') ?>">Sobre</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4">
                                <div class="header-right f-right d-none d-lg-block">
                                    <!-- Heder social -->
                                    <ul class="header-social">
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                        <li> <a href="#"><i class="fab fa-youtube"></i></a></li>
                                    </ul>
                                    <!-- Search Nav -->
                                    <div class="nav-search search-switch">
                                        <i class="fa fa-search"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-md-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </header>


    <?= $v->section("content"); ?>


    <footer>
        
        <div class="footer-main footer-bg">
            <div class="footer-area footer-padding">
                <div class="container">
                    <div class="row d-flex justify-content-between">
                        <div class="col-xl-3 col-lg-3 col-md-5 col-sm-8">
                            <div class="single-footer-caption mb-50">
                                <div class="single-footer-caption mb-30">
                                    
                                    <div class="footer-logo">
                                        <a href="index.html"><img src="<?= theme("/assets/img/logo/logo2_footer.png", CONF_VIEW_WEB) ?>" alt=""></a>
                                    </div>
                                    <div class="footer-tittle">
                                        <div class="footer-pera">
                                            <p class="info1">Lorem ipsum dolor sit amet, nsectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-5 col-sm-7">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle ">
                                    <h4 class="text-center">Principais Categorias</h4>
                                </div>
                         
                                <div class="whats-right-single mb-20 d-flex flex-column">
                                    <div class="whats-right-img mb-3">
                                        <?php foreach($categorysFooter as $category):?>
                                            <a href="<?=url("/categoria/".ucwords($category->name));?>"> 
                                            <button type="button" class="myButton-large" style="background-color: <?=$category->color;?>;"><?=$category->name;?></button>
                                         </a>
                                        <?php endforeach;?>
                                    </div>
                                    
                                </div>
                              
                                
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-5 col-sm-7">
                            <div class="single-footer-caption mb-50">
                                <div class="banner">
                                <a href="<?= $adsShort->link ;?>" target="_blank">
                                    <img src="<?=url("/storage/{$adsShort->image}");?>" style="border-radius:6px;" title="<?= $adsShort->name ;?>" alt="<?= $adsShort->name ;?>">
                                </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
           
            
            <div class="footer-bottom-area footer-bg">
                <div class="container">
                    <div class="footer-border">
                        <div class="row d-flex align-items-center">
                            <div class="col-xl-12 ">
                                <div class="footer-copy-right text-center">
                                    <p>
                                        Copyright &copy;<script>
                                            document.write(new Date().getFullYear());
                                        </script> Todos os direitos reservados | Gomess Produções</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="search-model-box">
        <div class="d-flex align-items-center h-100 justify-content-center">
            <div class="search-close-btn">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Buscar por noticias">
            </form>
        </div>
    </div>

    <script src="<?= url("/shared/scripts/jquery.min.js"); ?>"></script>
    <script src="<?= url("/shared/scripts/jquery-ui.js"); ?>"></script>
    <script src="<?= theme("/assets/js/login.js", CONF_VIEW_ADMIN); ?>"></script>

    <script src="<?= theme("/assets/js/vendor/modernizr-3.5.0.min.js", CONF_VIEW_WEB) ?>"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="<?= theme("/assets/js/vendor/jquery-1.12.4.min.js", CONF_VIEW_WEB) ?>"></script>
    <script src="<?= theme("/assets/js/popper.min.js", CONF_VIEW_WEB) ?>"></script>
    <script src="<?= theme("/assets/js/bootstrap.min.js", CONF_VIEW_WEB) ?>"></script>
    <!-- Jquery Mobile Menu -->
    <script src="<?= theme("/assets/js/jquery.slicknav.min.js", CONF_VIEW_WEB) ?>"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="<?= theme("/assets/js/owl.carousel.min.js", CONF_VIEW_WEB) ?>"></script>
    <script src="<?= theme("/assets/js/slick.min.js", CONF_VIEW_WEB) ?>"></script>
    <!-- Date Picker -->
    <script src="<?= theme("/assets/js/gijgo.min.js", CONF_VIEW_WEB) ?>"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="<?= theme("/assets/js/wow.min.js", CONF_VIEW_WEB) ?>"></script>
    <script src="<?= theme("/assets/js/animated.headline.js", CONF_VIEW_WEB) ?>"></script>
    <script src="<?= theme("/assets/js/jquery.magnific-popup.js", CONF_VIEW_WEB) ?>"></script>

    <!-- Scrollup, nice-select, sticky -->
    <script src="<?= theme("/assets/js/jquery.scrollUp.min.js", CONF_VIEW_WEB) ?>"></script>
    <script src="<?= theme("/assets/js/jquery.nice-select.min.js", CONF_VIEW_WEB) ?>"></script>
    <script src="<?= theme("/assets/js/jquery.sticky.js", CONF_VIEW_WEB) ?>"></script>

    <!-- contact js -->
    <script src="<?= theme("/assets/js/contact.js", CONF_VIEW_WEB) ?>"></script>
    <script src="<?= theme("/assets/js/jquery.form.js", CONF_VIEW_WEB) ?>"></script>
    <script src="<?= theme("/assets/js/jquery.validate.min.js", CONF_VIEW_WEB) ?>"></script>
    <script src="<?= theme("/assets/js/mail-script.js", CONF_VIEW_WEB) ?>"></script>
    <script src="<?= theme("/assets/js/jquery.ajaxchimp.min.js", CONF_VIEW_WEB) ?>"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="<?= theme("/assets/js/plugins.js", CONF_VIEW_WEB) ?>"></script>
    <script src="<?= theme("/assets/js/main.js", CONF_VIEW_WEB) ?>"></script>

</body>

</html>