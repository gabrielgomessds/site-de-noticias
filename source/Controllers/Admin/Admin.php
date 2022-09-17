<?php

namespace Source\Controllers\Admin;

use Source\Models\Admin as ModelsAdmin;
use Source\Support\Pager;

class Admin extends Auth
{

    public function __construct()
    {
        parent::__construct();
    }

    /* Lista de Admins */
    public function list(array $data)
    {
        //search redirect
        if (!empty($data["s"])) {
            $s = str_search($data["s"]);
            echo json_encode(["redirect" => url("/admin/admins/{$s}/1")]);
            return;
        }

        $search = null;
        $admins = (new ModelsAdmin())->find();

        if (!empty($data["search"]) && str_search($data["search"]) != "all") {
            $search = str_search($data["search"]);
            $admins = (new ModelsAdmin())->find("first_name LIKE :s OR email LIKE :s", "s=%{$search}%");
            if (!$admins->count()) {
                $this->message->info("Sua pesquisa não retornou resultados")->flash();
                redirect("/admin/admins");
            }
        }

        $all = ($search ?? "all");
        $pager = new Pager(url("/admin/admins/{$all}/"));
        $pager->pager($admins->count(), 5, (!empty($data["page"]) ? $data["page"] : 1));


        $head = $this->seo->render(
            CONF_SITE_NAME . " - Lista de Admins",
            CONF_SITE_DESC,
            url("/list-admins"),
            theme("/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("admin/admins", [
            "app" => "admins",
            "head" => $head,
            "listAdmins" => $admins->limit($pager->limit())->offset($pager->offset())->order('id DESC')->fetch(true),
            "countAdmins" => $admins->count(),
            "paginator" => $pager->render(),
            "search" => $search,
        ]);
    }

    /* Ações */
    public function actions(?array $data): void
    {
        /* CREATE */
        if(!empty($data["action"]) && $data["action"] == "create"){
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $admin = new ModelsAdmin();
            $admin->first_name = $data["first_name"];
            $admin->last_name = $data["last_name"];
            $admin->email = $data["email"];
            $admin->password = $data["password"];


            if (!$admin->save()) {
                $json["message"] = $admin->message()->render();
                echo json_encode($json);
                return;
            }


            $this->message->success("Admin cadastrado com sucesso...")->flash();
            $json["redirect"] = url("/admin/admins");

            echo json_encode($json);
            return;
        }

        /* UPDATE */

        if (!empty($data['action']) && $data['action'] == 'update') {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $adminUpdate = (new ModelsAdmin())->findById($data["idAdmin"]);

            if (!$adminUpdate) {
                $this->message->error("Você tentou acessar um admin que não existe")->flash();
                echo json_encode(["redirect" => url("/admin/admins")]);
                return;
            }

            $adminUpdate->first_name = $data["first_name"];
            $adminUpdate->last_name = $data["last_name"];
            $adminUpdate->email = $data["email"];
            $adminUpdate->password = (!empty($data["password"]) ? $data["password"] : $adminUpdate->password);
            
            if (!$adminUpdate->save()) {
                $json["message"] = $adminUpdate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Admin atualizado com sucesso...")->flash();
            echo json_encode(["reload" => true]);
            return;
        }

        /* DELETE */
         if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $adminDelete = (new ModelsAdmin())->findById($data["idAdmin"]);

            if (!$adminDelete) {
                $this->message->error("Você tentou deletar um admin que não existe")->flash();
                echo json_encode(["redirect" => url("/admin/admins")]);
                return;
            }

            $adminDelete->destroy();

            $this->message->success("O admin foi excluído com sucesso...")->flash();
            echo json_encode(["redirect" => url("/admin/admins")]);

            return;
        }

        $adminEdit = null;
        if (!empty($data["idAdmin"])) {
            $adminId = filter_var($data["idAdmin"], FILTER_VALIDATE_INT);
            $adminEdit = (new ModelsAdmin())->findById($adminId);
        }

        $head = $this->seo->render(
            CONF_SITE_NAME . (isset($adminEdit) ? " - Atualizar Admin" : " - Adicionar Admins" ),
            CONF_SITE_DESC,
            url("/adicionar-admin"),
            theme("/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("admin/areaAdmin", [
            "app" => "admins",
            "head" => $head,
            "adminEdit" => $adminEdit
        ]);
    }


    /* Configurações da Conta */
    public function settings(array $data)
    {
        $head = $this->seo->render(
            CONF_SITE_NAME . " - Configurar conta",
            CONF_SITE_DESC,
            url("/settings"),
            theme("/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("admin/settings", [
            "app" => "configuracoes",
            "head" => $head
        ]);
    }
}