<?php

namespace Source\Controllers\Admin;

use Source\Models\Admin;
use Source\Models\Ads;
use Source\Models\AuthAdmin;
use Source\Models\Contact;
use Source\Models\Inscriptions;
use Source\Models\News;

class Dash extends Auth
{
    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../../themes/" . CONF_VIEW_ADMIN . "/");
    }

    public function home(array $data)
    {


        $head = $this->seo->render(
            CONF_SITE_NAME . " - Dash",
            CONF_SITE_DESC,
            url("/index"),
            theme("/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("index", [
            "app" => "dash",
            "countAdmins"       => (new Admin())->find()->count(),
            "countInscriptions" => (new Inscriptions())->find()->count(),
            "countContact"      => (new Contact())->find()->count(),
            "countAds"          => (new Ads())->find()->count(),
            "countNews"         => (new News())->find()->count(),
            "head" => $head
        ]);
    }

    public function logoff(): void
    {

        AuthAdmin::logout();
        redirect("/admin/login");
    }





}