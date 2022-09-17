<?php

namespace Source\Controllers\Admin;

use Source\Core\Controller;
use Source\Models\Contact as ModelsContact;
use Source\Support\Pager;

class Contact extends Controller
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
            echo json_encode(["redirect" => url("/admin/contatos/{$s}/1")]);
            return;
        }

        $search = null;
        $contacts = (new ModelsContact())->find();

        if (!empty($data["search"]) && str_search($data["search"]) != "all") {
            $search = str_search($data["search"]);
            $contacts = (new ModelsContact())->find("subject LIKE :s OR content LIKE :s", "s=%{$search}%");
            if (!$contacts->count()) {
                $this->message->info("Sua pesquisa não retornou resultados")->flash();
                redirect("/admin/contatos");
            }
        }

        $all = ($search ?? "all");
        $pager = new Pager(url("/admin/contatos/{$all}/"));
        $pager->pager($contacts->count(), 5, (!empty($data["page"]) ? $data["page"] : 1));

        $head = $this->seo->render(
            CONF_SITE_NAME . " - Lista de Contatos",
            CONF_SITE_DESC,
            url("/list-contact"),
            theme("/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("contact/contact", [
            "app" => "contatos",
            "listContacts" => $contacts->limit($pager->limit())->offset($pager->offset())->order('id DESC')->fetch(true),
            "countContacts" => $contacts->count(),
            "head" => $head,
            "paginator" => $pager->render(),
            "search" => $search,
        ]);
    }

    public function templateDataView(?array $data)
    {
       $contact = (new ModelsContact())->findById($data['idContact']);
       $status = ($contact->status == 0 ) ? "Não lida" : (($contact->status == 1 ) ? "Em Analise" : "Finalizada");
       $templete = '<button class="fechar">X</button><h4 class="subtitulo">'.$contact->subject.'</h4>
       <div class="mt-3 mb-4 d-flex justify-content-center align-items-center">
            <p class="me-5"><b>Nome:</b> '.$contact->name.'</p>
            <p class="me-5"><b>E-mail:</b> '.$contact->email.'</p>
            <p class="me-5"><b>Status:</b> '.$status.'</p>
        </div>
        
        <p>'.$contact->content.'</p>
        
        <div class="mt-5 mb-4 d-flex justify-content-center align-items-center">
        <p class="me-5"><b>Data de Envio:</b> '.date_fmt_br($contact->created_at).'</p>
        <p class="me-5"><b>Data de Reposta:</b>' .date_fmt_br($contact->updated_at).'</p>
       
        </div>
        
        <form action="'.url('/admin/status-contato').'" method="POST" class="d-flex justify-content-center align-items-center">
           <b class="me-1">STATUS:</b> <select class="form-select input_default w-25" id="basicSelect" name="status">
                <option value="0">Não vista</option>
                <option value="1">Em analisado</option>
                <option value="2">Finalizado</option>
            </select>
            <input type="hidden" name="idContact" value="'.$contact->id.'">
            <input type="hidden" name="action" value="updateStatus">
            <button class="ms-1 btn btn-sm btn-primary">Salvar</button>
        </form>';
       echo $templete;
    }

    public function SettingContact(?array $data)
    {
        if(!empty($data) && $data['action'] == "updateStatus"){
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $contactUpdate = (new ModelsContact)->findById(intval($data['idContact']));

            if (!$contactUpdate) {
                $this->message->info("Você tentou alterar um contato que não existe")->flash();
                redirect("/admin/contatos");
            }
    
            $contactUpdate->status = $data['status'];
    
            if (!$contactUpdate->save()) {
                $this->message->error("Erro ao atualizar o status")->flash();
                redirect("/admin/contatos");
            }
    
                $this->message->success("Status atualizado com sucesso")->flash();
                redirect("/admin/contatos");
        }

        
        if(!empty($data) && $data['action'] == "delete"){
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $contactDelete = (new ModelsContact)->findById(intval($data['idContact']));

            if (!$contactDelete) {
                $this->message->error("Erro ao deletar o contato")->flash();
                 echo json_encode(["reload" => true]);
                return;
            }
    
            $contactDelete->destroy();
    
            $this->message->success("Contato deletado com sucesso")->flash();
            echo json_encode(["reload" => true]);
            return;
        }

    }

}