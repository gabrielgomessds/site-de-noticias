<?php

namespace Source\Controllers\Admin;


use Source\Models\Categories as ModelsCategories;
use Source\Support\Pager;

class Categories extends Auth
{
    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../../themes/" . CONF_VIEW_ADMIN . "/");
    }


    public function list(array $data)
    {

       //search redirect
       if (!empty($data["s"])) {
        $s = str_search($data["s"]);
        echo json_encode(["redirect" => url("/admin/categorias/{$s}/1")]);
        return;
    }

        $search = null;
        $categories = (new ModelsCategories())->find();

        if (!empty($data["search"]) && str_search($data["search"]) != "all") {
            $search = str_search($data["search"]);
            $categories = (new ModelsCategories())->find("name LIKE :s", "s=%{$search}%");
            if (!$categories->count()) {
                $this->message->info("Sua pesquisa não retornou resultados")->flash();
                redirect("/admin/categorias");
            }
    }

        $all = ($search ?? "all");
        $pager = new Pager(url("/admin/categorias/{$all}/"));
        $pager->pager($categories->count(), 5, (!empty($data["page"]) ? $data["page"] : 1));

        $head = $this->seo->render(
            CONF_SITE_NAME . " - Lista de Categorias",
            CONF_SITE_DESC,
            url("/categories"),
            theme("/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("categories/categories", [
            "app" => "categorias",
            "head" => $head,
            "listCategories" => $categories->limit($pager->limit())->offset($pager->offset())->order('id DESC')->fetch(true),
            "countCategories" => $categories->count(),
            "paginator" => $pager->render(),
            "search" => $search,
            
        ]);
    }

    public function actions(array $data)
    {
        /* CREATE */

        if(!empty($data["action"]) && $data["action"] == "create"){
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $categories = new ModelsCategories();
            $categories->name = $data["name"];
            $categories->color = $data["color"];
            $categories->author_id = $data["author_id"];

            if (!$categories->save()) {
                $json["message"] = $categories->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Categoria cadastrado com sucesso...")->flash();
            $json["redirect"] = url("/admin/categorias");

            echo json_encode($json);
            return;
        }

        
        /* UPDATE */

        if (!empty($data['action']) && $data['action'] == 'update') {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $categorieUpdate = (new ModelsCategories())->findById($data["idCategorie"]);

            if (!$categorieUpdate) {
                $this->message->error("Você tentou acessar uma categoria que não existe")->flash();
                echo json_encode(["redirect" => url("/admin/categorias")]);
                return;
            }

            $categorieUpdate->name = $data["name"];
            $categorieUpdate->color = $data["color"];
            
            if (!$categorieUpdate->save()) {
                $json["message"] = $categorieUpdate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Categoria atualizado com sucesso...")->flash();
            echo json_encode(["reload" => true]);
            return;
        }


        /* DELETE */

         if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $categorieDelete = (new ModelsCategories())->findById($data["idCategorie"]);

            if (!$categorieDelete) {
                $this->message->error("Você tentou deletar uma categoria que não existe")->flash();
                echo json_encode(["redirect" => url("/admin/categorias")]);
                return;
            }

            $categorieDelete->destroy();

            $this->message->success("A categoria foi excluído com sucesso...")->flash();
            echo json_encode(["redirect" => url("/admin/categorias")]);

            return;
        }


        $categorieEdit = null;
        if (!empty($data["idCategorie"])) {
            $categorieId = filter_var($data["idCategorie"], FILTER_VALIDATE_INT);
            $categorieEdit = (new ModelsCategories())->findById($categorieId);
        }


        $head = $this->seo->render(
            CONF_SITE_NAME . (empty($categorieEdit) ? " - Adicionar Categorias" : " - Atualizar Categoria"),
            CONF_SITE_DESC,
            url("/categories"),
            theme("/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("categories/areaCategories", [
            "app" => "categorias",
            "head" => $head,
            "categorieEdit" => $categorieEdit
        ]);
    }
}