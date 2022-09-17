<?php

namespace Source\Controllers\Admin;

use Source\Controllers\Admin\Categories as AdminCategories;
use Source\Core\Controller;
use Source\Models\Categories;
use Source\Models\News as ModelsNews;
use Source\Support\Pager;
use Source\Support\Thumb;
use Source\Support\Upload;

class News extends Controller
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
            echo json_encode(["redirect" => url("/admin/noticias/{$s}/1")]);
            return;
        }

        $search = null;
        $news = (new ModelsNews())->find();

        if (!empty($data["search"]) && str_search($data["search"]) != "all") {
            $search = str_search($data["search"]);
            $news = (new ModelsNews())->find("title LIKE :s", "s=%{$search}%");
            if (!$news->count()) {
                $this->message->info("Sua pesquisa não retornou resultados")->flash();
                redirect("/admin/noticias");
            }
        }

        $all = ($search ?? "all");
        $pager = new Pager(url("/admin/noticias/{$all}/"));
        $pager->pager($news->count(), 6, (!empty($data["page"]) ? $data["page"] : 1));
       
        $head = $this->seo->render(
            CONF_SITE_NAME . " - Lista de Noticias",
            CONF_SITE_DESC,
            url("/list-news"),
            theme("/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("news/news", [
            "app" => "noticias",
            "listNews" => $news->limit($pager->limit())->offset($pager->offset())->order('id DESC')->fetch(true),
            "countNews" => $news->count(),
            "paginator" => $pager->render(),
            "search" => $search,
            "head" => $head
        ]);
    }

    public function actions(array $data)
    {
        if(!empty($data["action"]) && $data["action"] == "create"){

           /*  $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED); */

            $news = new ModelsNews();
            $news->title = filter_var($data["title"], FILTER_SANITIZE_STRING) ;
            $news->category_id = filter_var($data["category_id"], FILTER_SANITIZE_STRING);
            $news->position = filter_var($data["position"], FILTER_SANITIZE_STRING);
            $news->author_id = filter_var($data["author_id"], FILTER_SANITIZE_NUMBER_INT);
            $news->content = $data["content"];

            $res = preg_replace('/[\@\.\;\,\.\:\;\?\$\%]+/', '', $news->title);
            $news->uri = strtolower(str_replace(" ", "-", 
            preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$res)));

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

                $news->image = $image;
            }


            if (!$news->save()) {
                $json["message"] = $news->message()->render();
                echo json_encode($json);
                return;
            }
        

            $this->message->success("Noticia adicionada com sucesso...")->flash();
            $json["redirect"] = url("/admin/revisar-noticia/".($news->lastId() - 1));

            echo json_encode($json);
            return;
        }

        /* UPDATE NEWS */
        if (!empty($data['action']) && $data['action'] == 'update') {
            $newsUpdate = (new ModelsNews())->findById($data["idNews"]);

            if (!$newsUpdate) {
                $this->message->error("Você tentou acessar uma noticia que não existe")->flash();
                echo json_encode(["redirect" => url("/admin/noticias")]);
                return;
            }

            $newsUpdate->title = filter_var($data["title"], FILTER_SANITIZE_STRING) ;
            $newsUpdate->category_id = filter_var($data["category_id"], FILTER_SANITIZE_STRING);
            $newsUpdate->position = filter_var($data["position"], FILTER_SANITIZE_STRING);
            $newsUpdate->content = $data["content"];

            $res = preg_replace('/[\@\.\;\,\.\:\;\?\$\%]+/', '', $newsUpdate->title);
          
            $newsUpdate->uri = strtolower(str_replace(" ", "-", 
            preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$res)));

            if (!empty($_FILES["image"])) {
                if ($newsUpdate->image && file_exists(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$newsUpdate->image}")) {
                    unlink(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$newsUpdate->image}");
                    (new Thumb())->flush($newsUpdate->image);
                }

                $files = $_FILES["image"];
                $upload = new Upload();
                $image = $upload->image($files, md5(uniqid(time())), 600);

                if (!$image) {
                    $json["message"] = $upload->message()->render();
                    echo json_encode($json);
                    return;
                }

                $newsUpdate->image = $image;
            }
            
            if (!$newsUpdate->save()) {
                $json["message"] = $newsUpdate->message()->render();
                echo json_encode($json);
                return;
            }

           
            $this->message->success("Noticia atualizada com sucesso...")->flash();
            $json["redirect"] = url("/admin/revisar-noticia/".$data["idNews"]);

            echo json_encode($json);
            return;

        }

        /* DELETE */

        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $newsDelete = (new ModelsNews())->findById($data["idNews"]);

            if (!$newsDelete) {
                $this->message->error("Você tentou deletar uma noticia que não existe")->flash();
                echo json_encode(["redirect" => url("/admin/noticias")]);
                return;
            }

            if ($newsDelete->image && file_exists(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$newsDelete->image}")) {
                unlink(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$newsDelete->image}");
                (new Thumb())->flush($newsDelete->image);
            }

            $newsDelete->destroy();

            $this->message->success("A noticia foi excluído com sucesso...")->flash();
            echo json_encode(["redirect" => url("/admin/noticias")]);

            return;
        }

        $newsEdit = null;
        if (!empty($data["idNews"])) {
            $newsId = filter_var($data["idNews"], FILTER_VALIDATE_INT);
            $newsEdit = (new ModelsNews())->findById($newsId);
        }

        $head = $this->seo->render(
            CONF_SITE_NAME . (isset($newsEdit) ? " - Atualizar Noticia" : " - Adicionar Noticia" ),
            CONF_SITE_DESC,
            url("/news"),
            theme("/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("news/areaNews", [
            "app" => "noticias",
            "newsEdit" => $newsEdit,
            "listCategories" => (new Categories)->find()->fetch(true),
            "head" => $head
        ]);
    }

    /* Revisar Noticia */
    public function review(array $data)
    {
        $newsID = filter_var($data["idNews"], FILTER_VALIDATE_INT);
        $news = (new ModelsNews())->findById($newsID);

        $positionsNews = [
            1 => "Primeira noticia a aparecer",
            2 => "Segunda mais importante",
            3 => "Terceira mais importante",
            4 => "Inferior principal",
            5 => "Inferior segunda principal",
            6 => "Inferior terceira principal",
            0 => "Noticia Comum"
        ];

        $head = $this->seo->render(
            CONF_SITE_NAME . " - Revisar Noticia",
            CONF_SITE_DESC,
            url("/review-news"),
            theme("/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("news/review-news", [
            "app" => "noticias",
            "news" => $news,
            "position" => $positionsNews,
            "head" => $head
        ]);
    }

    public function publicNews(array $data): void
    {
        $news = (new ModelsNews)->findById($data['idNews']);
        if(empty($news)){
            $this->message->warning("Parece que essa noticia não existe!");
        }

        $news->status = 1;

        if(!$news->save()){
            $json["message"] = $news->message()->render();
            echo json_encode($json);
            return;
        }

        $this->message->success("Noticia publicada com sucesso!")->flash();
        redirect("/admin/noticias");
        return;
    }

    public function privateNews(array $data): void
    {
        $news = (new ModelsNews)->findById($data['idNews']);
        if(empty($news)){
            $this->message->warning("Parece que essa noticia não existe!");
        }

        $news->status = 0;

        if(!$news->save()){
            $json["message"] = $news->message()->render();
            echo json_encode($json);
            return;
        }

        $this->message->success("Noticia privada com sucesso")->flash();
        redirect("/admin/noticias");
        return;
    }

    public function info(?array $data)
    {
        $news = (new ModelsNews())->findByUri($data["idNews"]);


        $positionsNews = [
            1 => "Primeira noticia a aparecer",
            2 => "Segunda mais importante",
            3 => "Terceira mais importante",
            4 => "Inferior principal",
            5 => "Inferior segunda principal",
            6 => "Inferior terceira principal",
            0 => "Noticia Comum"
        ];

        $head = $this->seo->render(
            CONF_SITE_NAME ." - ". $news->title,
            CONF_SITE_DESC,
            url("/info-news"),
            theme("/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("news/info-news", [
            "app" => "info-noticias",
            "news" => $news,
            "position" => $positionsNews,
            "head" => $head
        ]);
    }
}