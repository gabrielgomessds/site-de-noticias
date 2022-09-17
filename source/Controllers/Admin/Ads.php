<?php

namespace Source\Controllers\Admin;

use Source\Core\Controller;
use Source\Models\Ads as ModelsAds;
use Source\Support\Pager;
use Source\Support\Thumb;
use Source\Support\Upload;

class Ads extends Controller
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
            echo json_encode(["redirect" => url("/admin/propagandas/{$s}/1")]);
            return;
        }

        $search = null;
        $ads = (new ModelsAds())->find();

        if (!empty($data["search"]) && str_search($data["search"]) != "all") {
            $search = str_search($data["search"]);
            $ads = (new ModelsAds())->find("name LIKE :s OR email LIKE :s", "s=%{$search}%");
            if (!$ads->count()) {
                $this->message->info("Sua pesquisa não retornou resultados")->flash();
                redirect("/admin/propagandas");
            }
        }

            $all = ($search ?? "all");
            $pager = new Pager(url("/admin/propagandas/{$all}/"));
            $pager->pager($ads->count(), 5, (!empty($data["page"]) ? $data["page"] : 1));

            $head = $this->seo->render(
                CONF_SITE_NAME . " - Lista de Propagandas",
                CONF_SITE_DESC,
                url("/list-ads"),
                theme("/images/image.jpg", CONF_VIEW_ADMIN),
                false
            );

            echo $this->view->render("ads/ads", [
                "app" => "propagandas",
                "listAds" => $ads->limit($pager->limit())->offset($pager->offset())->order('id DESC')->fetch(true),
                "countAds" => $ads->count(),
                "paginator" => $pager->render(),
                "search" => $search,
                "head" => $head
            ]);
    }

    public function actions(?array $data): void
    {
        if(!empty($data["action"]) && $data["action"] == "create"){
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $ads = new ModelsAds();
            $ads->name = $data["name"];
            $ads->email = $data["email"];
            $ads->owner = $data["owner"];
            $ads->type = $data["type"];
            $ads->link = $data["link"];
            $ads->status = $data["status"];

            //upload image
            if (!empty($_FILES["image"])) {
                $files = $_FILES["image"];
                $upload = new Upload();
                $image = $upload->image($files, md5(rand()));

                if (!$image) {
                    $json["message"] = $upload->message()->render();
                    echo json_encode($json);
                    return;
                }

                $ads->image = $image;
            }

            if (!$ads->save()) {
                $json["message"] = $ads->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Propaganda cadastrado com sucesso...")->flash();
            $json["redirect"] = url("/admin/propagandas");

            echo json_encode($json);
            return;
        }

         /* UPDATE */

         if (!empty($data['action']) && $data['action'] == 'update') {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $adsUpdate = (new ModelsAds())->findById($data["idAds"]);

            if (!$adsUpdate) {
                $this->message->error("Você tentou acessar uma propaganda que não existe")->flash();
                echo json_encode(["redirect" => url("/admin/propagandas")]);
                return;
            }

            $adsUpdate->name = $data["name"];
            $adsUpdate->email = $data["email"];
            $adsUpdate->email = $data["email"];
            $adsUpdate->owner = $data["email"];
            $adsUpdate->type = $data["type"];
            $adsUpdate->link = $data["link"];
            $adsUpdate->status = $data["status"];

            if (!empty($_FILES["image"])) {
                if ($adsUpdate->image && file_exists(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$adsUpdate->image}")) {
                    unlink(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$adsUpdate->image}");
                    (new Thumb())->flush($adsUpdate->image);
                }

                $files = $_FILES["image"];
                $upload = new Upload();
                $image = $upload->image($files, md5(uniqid(time())), 600);

                if (!$image) {
                    $json["message"] = $upload->message()->render();
                    echo json_encode($json);
                    return;
                }

                $adsUpdate->image = $image;
            }
            
            if (!$adsUpdate->save()) {
                $json["message"] = $adsUpdate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Propaganda atualizado com sucesso...")->flash();
            echo json_encode(["reload" => true]);
            return;
        }
        
        /* DELETE */
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $adsDelete = (new ModelsAds())->findById($data["idAds"]);

            if (!$adsDelete) {
                $this->message->error("Você tentou deletar uma propaganda que não existe")->flash();
                echo json_encode(["redirect" => url("/admin/propagandas")]);
                return;
            }

            if ($adsDelete->image && file_exists(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$adsDelete->image}")) {
                unlink(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$adsDelete->image}");
                (new Thumb())->flush($adsDelete->image);
            }

            $adsDelete->destroy();

            $this->message->success("A propaganda foi excluído com sucesso...")->flash();
            echo json_encode(["redirect" => url("/admin/propagandas")]);

            return;
        }

        $adsEdit = null;
        if (!empty($data["idAds"])) {
            $adsId = filter_var($data["idAds"], FILTER_VALIDATE_INT);
            $adsEdit = (new ModelsAds())->findById($adsId);
        }

        $head = $this->seo->render(
            CONF_SITE_NAME . (empty($adsEdit) ? " - Adicionar Propaganda" : " - Atualizar Propaganda"),
            CONF_SITE_DESC,
            url("/ads"),
            theme("/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("ads/areaAds", [
            "app" => "propagandas",
            "head" => $head,
            "adsEdit" => $adsEdit
        ]);
    }


    
    public function publicAds(array $data): void
    {
        $news = (new ModelsAds)->findById($data['idAds']);
        if(empty($news)){
            $this->message->warning("Parece que essa propaganda não existe!");
        }

        $news->status = 1;

        if(!$news->save()){
            $json["message"] = $news->message()->render();
            echo json_encode($json);
            return;
        }

        $this->message->success("Propaganda publicada com sucesso!")->flash();
        redirect("/admin/propagandas");
        return;
    }

    public function privateAds(array $data): void
    {
        $news = (new ModelsAds)->findById($data['idAds']);
        if(empty($news)){
            $this->message->warning("Parece que essa noticia não existe!");
        }

        $news->status = 0;

        if(!$news->save()){
            $json["message"] = $news->message()->render();
            echo json_encode($json);
            return;
        }

        $this->message->success("Propaganda privada com sucesso")->flash();
        redirect("/admin/propagandas");
        return;
    }

}