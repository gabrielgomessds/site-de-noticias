<?php

namespace Source\Controllers\Admin;

use Source\Core\Controller;
use Source\Models\AuthAdmin;

class Login extends Controller
{
    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../../themes/" . CONF_VIEW_ADMIN . "/");
    }

    public function root(): void
    {
        $admin = AuthAdmin::admin();

        if ($admin) {
            redirect("/admin/dash");
        } else {
            redirect("/admin/login");
        }
    }

    public function home(array $data): void
    {
        if (!empty($data["email"]) && !empty($data["password"])) {
            
            $auth = new AuthAdmin();
            $login = $auth->login($data["email"], $data["password"], true);

            if ($login) {
                $json["redirect"] = url("/admin/dash");
            } else {
                $json["message"] = $auth->message()->render();
            }

            echo json_encode($json);
            return;
        }

        $head = $this->seo->render(
            CONF_SITE_NAME . " - Login",
            CONF_SITE_DESC,
            url("/login"),
            theme("/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("login/login", [
            "app" => "login",
            "head" => $head
        ]);
    }

}