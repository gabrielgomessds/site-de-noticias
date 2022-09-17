<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?=$head?>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="<?=theme("/assets/css/bootstrap.css", CONF_VIEW_ADMIN)?>">
    <link rel="stylesheet" href="<?=theme("/assets/vendors/bootstrap-icons/bootstrap-icons.css", CONF_VIEW_ADMIN)?>">
    <link rel="stylesheet" href="<?=theme("/assets/css/app.css", CONF_VIEW_ADMIN)?>">
    <link rel="stylesheet" href="<?=theme("/assets/css/pages/auth.css", CONF_VIEW_ADMIN)?>"/>
    <link rel="shortcut icon" href="<?=theme("/assets/images/favicon.png", CONF_VIEW_ADMIN)?>" type="image/x-icon"/>
    <link rel="stylesheet" href="<?=theme("/assets/css/myStyle.css", CONF_VIEW_ADMIN)?>"/>

    <link rel="stylesheet" href="<?= theme("/assets/css/login.css", CONF_VIEW_ADMIN); ?>"/>
    <link rel="stylesheet" href="<?= url("/shared/styles/boot.css"); ?>"/>
    <link rel="stylesheet" href="<?= url("/shared/styles/styles.css"); ?>"/>
    
</head>

<body>
    <div class="ajax_load">
        <div class="ajax_load_box">
            <div class="ajax_load_box_circle"></div>
            <p class="ajax_load_box_title">Aguarde, carregando...</p>
        </div>
    </div>


    <?= $v->section("content"); ?>
</body>

<script src="<?= url("/shared/scripts/jquery.min.js"); ?>"></script>
<script src="<?= url("/shared/scripts/jquery-ui.js"); ?>"></script>
<script src="<?= theme("/assets/js/login.js", CONF_VIEW_ADMIN); ?>"></script>

</html>