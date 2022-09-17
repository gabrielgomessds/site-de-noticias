<?php

namespace Source\Controllers\Admin;

use Source\Core\Controller;
use Source\Models\Inscriptions as ModelsInscriptions;
use Source\Support\Pager;

class Inscriptions extends Controller
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
            echo json_encode(["redirect" => url("/admin/inscricoes/{$s}/1")]);
            return;
        }

        $search = null;
        $inscriptions = (new ModelsInscriptions())->find();

        if (!empty($data["search"]) && str_search($data["search"]) != "all") {
            $search = str_search($data["search"]);
            $inscriptions = (new ModelsInscriptions())->find("email LIKE :s", "s=%{$search}%");
            if (!$inscriptions->count()) {
                $this->message->info("Sua pesquisa não retornou resultados")->flash();
                redirect("/admin/inscricoes");
            }
        }

        $all = ($search ?? "all");
        $pager = new Pager(url("/admin/inscricoes/{$all}/"));
        $pager->pager($inscriptions->count(), 5, (!empty($data["page"]) ? $data["page"] : 1));

        
        $head = $this->seo->render(
            CONF_SITE_NAME . " - Inscrições",
            CONF_SITE_DESC,
            url("/inscriptions"),
            theme("/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("inscriptions/inscriptions", [
            "app" => "inscricoes",
            "head" => $head,
            "listInscriptions" => $inscriptions->limit($pager->limit())->offset($pager->offset())->order('id DESC')->fetch(true),
            "countInscriptions" => $inscriptions->count(),
            "paginator" => $pager->render(),
            "search" => $search,
        ]);
    }

    public function actions(array $data): void
    {
        /* DELETE */
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $inscriptionsDelete = (new ModelsInscriptions())->findById($data["idInsc"]);

            if (!$inscriptionsDelete) {
                $this->message->error("Você tentou deletar uma inscrição que não existe")->flash();
                echo json_encode(["redirect" => url("/admin/inscricoes")]);
                return;
            }

            $inscriptionsDelete->destroy();

            $this->message->success("Inscrição excluída com sucesso...")->flash();
            echo json_encode(["redirect" => url("/admin/inscricoes")]);

            return;
        }
    }

    public function activeInscription(array $data): void
    {
        $inscription = (new ModelsInscriptions)->findById($data['idInsc']);
        if(empty($inscription)){
            $this->message->warning("Parece que essa inscrição não existe!");
        }

        $inscription->status = 1;

        if(!$inscription->save()){
            $json["message"] = $inscription->message()->render();
            echo json_encode($json);
            return;
        }

        $this->message->success("Inscrição ativada com sucesso!")->flash();
        redirect("/admin/inscricoes");
        return;
    }

    public function disableInscription(array $data): void
    {
        $inscription = (new ModelsInscriptions)->findById($data['idInsc']);
        if(empty($inscription)){
            $this->message->warning("Parece que essa noticia não existe!");
        }

        $inscription->status = 0;

        if(!$inscription->save()){
            $json["message"] = $inscription->message()->render();
            echo json_encode($json);
            return;
        }

        $this->message->success("Inscrição desativada com sucesso")->flash();
        redirect("/admin/inscricoes");
        return;
    }

}