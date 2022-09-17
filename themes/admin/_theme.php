<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?=$head?>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?=theme("/assets/css/bootstrap.css", CONF_VIEW_ADMIN)?>">

    <link rel="stylesheet" href="<?= url("/shared/styles/boot.css"); ?>"/>
    <link rel="stylesheet" href="<?= url("/shared/styles/styles.css"); ?>"/>

    <link rel="stylesheet" href="<?=theme("/assets/vendors/iconly/bold.css", CONF_VIEW_ADMIN)?>">
    <link rel="stylesheet" href="<?=theme("/assets/vendors/summernote/summernote-lite.min.css")?>">

    <link rel="stylesheet" href="<?=theme("/assets/vendors/choices.js/choices.min.css", CONF_VIEW_ADMIN)?>" />

    <link rel="stylesheet" href="<?=theme("/assets/vendors/perfect-scrollbar/perfect-scrollbar.css", CONF_VIEW_ADMIN)?>">
    <link rel="stylesheet" href="<?=theme("/assets/vendors/bootstrap-icons/bootstrap-icons.css", CONF_VIEW_ADMIN)?>">

    <link rel="stylesheet" href="<?=theme("/assets/css/app.css", CONF_VIEW_ADMIN)?>">
    <link rel="stylesheet" href="<?=theme("/assets/css/myStyle.css", CONF_VIEW_ADMIN)?>">

    <link rel="stylesheet" href="<?= theme("/assets/css/style.css", CONF_VIEW_ADMIN); ?>"/>
    
   
    <link rel="shortcut icon" href="<?=theme("/assets/images/favicon.png", CONF_VIEW_ADMIN)?>" type="image/x-icon">
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="<?=url("/")?>"><img style="width: 112px;height:50px;" src="<?=theme("/assets/images/logo/logo.png", CONF_VIEW_ADMIN)?>" alt="Logo" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                    
                        <?php
                            $nav = function ($icon, $title, $href = null) use ($app) {
                            $active = ((is_null($href) && $app == 'dash') || $app == $href ? "active" : null);
                            $url = url("/admin/{$href}");
                            return "<li class=\"sidebar-item {$active}\"><a class=\"sidebar-link\" href=\"{$url}\"><i class='{$icon}'></i> <span>{$title}</span></a></li>";
                            };
                            echo $nav("bi bi-grid-fill", "Dash");
                            echo $nav("bi bi-newspaper", "Noticias", "noticias");
                            echo $nav("bi bi-person-circle", "Admins", 'admins');
                            echo $nav("bi bi-stack", "Categorias", 'categorias');

                            echo $nav("bi bi-person-fill", "Inscrições", 'inscricoes');
                            echo $nav("bi bi-badge-ad-fill", "Propaganda", 'propagandas');

                            echo $nav("bi bi-envelope-fill", "Contatos", 'contatos');
                            echo $nav("bi bi-gear-fill", "Configurações", 'configuracoes');

                            echo '<li class="sidebar-item"><a href="' . url() . '" class="sidebar-link"><i class="bi bi-arrow-clockwise"></i> <span>Site principal</span></a></li>';
                            echo '<li class="sidebar-item"><a href="' . url("admin/sair") . '" class="sidebar-link"><i class="bi bi-box-arrow-left"></i> <span>Sair</span></a></li>';
                        ?>
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="ajax_load" style="z-index: 999;">
                <div class="ajax_load_box">
                    <div class="ajax_load_box_circle"></div>
                    <p class="ajax_load_box_title">Aguarde, carregando...</p>
                </div>
           </div>

            <div class="ajax_response"><?= flash(); ?></div>

            <?= $v->section("content"); ?>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p><script>document.write(new Date().getFullYear());</script> &copy; Gomess Produções - Todos os direitos reservados</p>
                    </div>
                   
                </div>
            </footer>
        </div>
    </div>
    <script src="<?= url("/shared/scripts/jquery.min.js"); ?>"></script>
    <script src="<?= url("/shared/scripts/jquery-ui.js"); ?>"></script>
    <script src="<?= url("/shared/scripts/jquery.form.js"); ?>"></script>
    
    <script src="<?= theme("/assets/js/scripts.js", CONF_VIEW_ADMIN); ?>"></script>

    <script src="<?= theme("/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js", CONF_VIEW_ADMIN)?>"></script>
    <script src="<?= theme("/assets/js/bootstrap.bundle.min.js", CONF_VIEW_ADMIN)?>"></script>
    
    <script src="<?= theme("/assets/js/myScript.js", CONF_VIEW_ADMIN);?>"></script>
    <script src="<?= theme("/assets/vendors/apexcharts/apexcharts.js", CONF_VIEW_ADMIN);?>"></script>
    <script src="<?= theme("/assets/js/pages/dashboard.js", CONF_VIEW_ADMIN);?>"></script>

    <script src="<?= theme("/assets/vendors/choices.js/choices.min.js", CONF_VIEW_ADMIN)?>"></script>
   
    <script src="<?= theme("/assets/js/pages/form-editor.js", CONF_VIEW_ADMIN);?>"></script>

    <script src="<?=theme("/assets/vendors/summernote/summernote-lite.min.js");?>"></script>

    <script src="<?= theme("/assets/js/main.js", CONF_VIEW_ADMIN);?>"></script>

    <script>

$('#summernote').summernote({
        tabsize: 2,
        height: 500,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });
      
    </script>

    <?= $v->section("scripts"); ?>


</body>

</html>