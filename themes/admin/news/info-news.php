<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
     <?=$head;?> 
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="<?= theme("/assets/img/favicon.png", CONF_VIEW_WEB); ?>">

    <!-- CSS here -->
    <link rel="stylesheet" href="<?= url("/shared/styles/boot.css"); ?>"/>
    <link rel="stylesheet" href="<?= url("/shared/styles/styles.css"); ?>"/>
    
    <link rel="stylesheet" href="<?= theme("/assets/css/bootstrap.min.css", CONF_VIEW_WEB); ?>">
    <link rel="stylesheet" href="<?= theme("/assets/vendors/bootstrap-icons/bootstrap-icons.css", CONF_VIEW_WEB); ?>">
    <link rel="stylesheet" href="<?= theme("/assets/css/owl.carousel.min.css", CONF_VIEW_WEB); ?>">
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
    <link rel="stylesheet" href="<?= theme("/assets/css/myStyle.css", CONF_VIEW_WEB); ?>">
    <link rel="stylesheet" href="<?= theme("/assets/css/myStyle.css", CONF_VIEW_ADMIN); ?>">
</head>

<body>
    <!-- Preloader Start -->
    <header>
        <!-- Header Start -->

        <div class="header-area">
            <div class="main-header ">
                <div class="header-top black-bg d-none d-sm-block">
                    <div class="container">
                        <div class="col-xl-12">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="header-info-left">
                                    <ul>
                                        <li class="title"><span class="flaticon-energy"></span> Revisão da noticia</li>
                                        <li class="content-title-review"><a href="<?=url("/admin/atualizar-noticia/{$news->id}");?>"><button class="myButton btn-info">Editar</button></a> <button class="myButton btn-danger modalDelete deleteModal" id="<?= $news->id; ?>">Excluir</button></li>
                                    </ul>
                                </div>
                                <div class="header-info-right">
                                    <ul class="header-date">
                                        <li style="padding-right: 10px;">Visualizações: <span class="font_default"><?= $news->views; ?></span></li>
                                        <li>STATUS:
                                            <?= ($news->status == 1) ?
                                                '<a href='.url('/admin/privar-noticia/'.$news->id).'><span class="status_news public">
                                                    <i class="fa fa-eye"></i>
                                                    <span>Publica</span>
                                                </span></a>' :

                                                '<a href='.url('/admin/publicar-noticia/'.$news->id).'><span class="status_news private">
                                                    <i class="fa fa-eye-slash"></i>
                                                    <span>Privada</span>
                                                 </span></a>'; ?>


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
                                <h3><?= $news->title; ?></h3>
                            </div>
                            <div class="about-prea">
                                <?= $news->content; ?>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>


    <!-- MODALS -->
    <div id="modalDelete" class="modal-container ">
        <div class="modal-content modal-smaller">
            <button class="fechar">X</button>
            <h4 class="subtitulo">Tem certeza que deseja deletar esse noticia?</h4>
            <p class="text-center font-bold">Essa ação não poderá ser desfeita</p>

            <form action="<?= url("/admin/deletar-noticia") ?>" method="POST">
                <fieldset class="fieldset_model">
                    <input type="hidden" name="idNews" class="inputID">
                    <input type="hidden" name="action" value="delete">
                    <button class="btn-question btn-no">Confirmar</button>
                </fieldset>
            </form>

        </div>
    </div>

    <script src="<?= url("/shared/scripts/jquery.min.js"); ?>"></script>
    <script src="<?= url("/shared/scripts/jquery-ui.js"); ?>"></script>
    <script src="<?= url("/shared/scripts/jquery.form.js"); ?>"></script>
    <script src="<?= theme("/assets/js/scripts.js", CONF_VIEW_ADMIN); ?>"></script>
    <script type="text/javascript">
        let deleteModal = document.querySelector(".deleteModal");
        let inputID = document.querySelector(".inputID");

        deleteModal.addEventListener('click', () => {
            inputID.value = deleteModal.id
            console.log('Clicou');
        });
    </script>


    <script src="<?= theme("/assets/js/myScript.js", CONF_VIEW_ADMIN); ?>"></script>



</body>

</html>