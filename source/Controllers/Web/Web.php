<?php

namespace Source\Controllers\Web;

use Source\Core\Controller;
use Source\Models\Ads;
use Source\Models\Categories;
use Source\Models\Contact;
use Source\Models\Inscriptions;
use Source\Models\News;
use Source\Support\Pager;

class Web extends Controller
{

    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../../themes/" . CONF_VIEW_WEB . "/");
    }

    public function home(?array $data)
    {
        /* Listando Principais Noticias */
        $news_first = (new News())->find("position = 1 AND status = 1")->order("id DESC");
        $news_second = (new News())->find("position = 2 AND status = 1")->order("id DESC");
        $news_third = (new News())->find("position = 3 AND status = 1")->order("id DESC");
        $news_fourth = (new News())->find("position = 4 AND status = 1")->order("id DESC");
        $news_fifth = (new News())->find("position = 5 AND status = 1")->order("id DESC");
        $news_sixth = (new News())->find("position = 6 AND status = 1")->order("id DESC");
            
        /* Pegando as propagandas curtas e longas */
        $adsShort = (new Ads)->find("status = '1' AND type = 'Curta'")->order("RAND()");
        $adsLong = (new Ads)->find("status = '1' AND type = 'Longa'")->order("RAND()");
       
        /* Listando Categorias */
        $listCategorys = (new Categories)->find()->limit(5)->order("id DESC");
        $lastCategorys = (new Categories)->find()->limit(1)->order("id DESC");

        /* Listando todas as noticias */
        $news = (new News())->find()->order("id DESC");
        $lastNews = (new News)->find()->limit(1)->order("id DESC");

        /* Mais populares com maior visualização */
        //$newsMoreViews = (new News())->find("views");
        
        $limitNewsCategory = (new News())
           ->minimun("news != 1")
           ->limit(4)
           ->order("id DESC");
        
           $limitNews = (new News())
                ->find()
                ->limit(16)
                ->order("views DESC");

           $mostVisitedNews = (new News())
                ->find()
                ->limit(12)
                ->order("views DESC");

        $categorysFooter = (new Categories())->find()->limit(8)->order("id DESC");
        $head = $this->seo->render(
            CONF_SITE_NAME . " - Noticias rápidas",
            CONF_SITE_DESC,
            url("/home"),
            theme("/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("home", [
            "app" => "home",
            "newsMain" => [
                "first" => $news_first->fetch(), 
                "second" => $news_second->fetch(),
                "third" => $news_third->fetch(),
                "fourth" => $news_fourth->fetch(),
                "fifth" => $news_fifth->fetch(),
                "sixth" => $news_sixth->fetch(),
            ],

            "adsShort" => $adsShort->fetch(),
            "adsLong" => $adsLong->fetch(),
            "listCategorys" => $listCategorys->fetch(true),
            "lastCategorys" => $lastCategorys->fetch(true),
            "listNews" => $news->fetch(true),
            "lastNews" => $lastNews->fetch(true),
            "limitNewsCategory" => $limitNewsCategory->fetch(true),
            "limitNews" => $limitNews->fetch(true),
            "mostVisitedNews" => $mostVisitedNews->fetch(true),
            "categorysFooter" => $categorysFooter->fetch(true),
           
            "head" => $head
        ]);
     
    }

    public function findNewsCategory(int $category)
    {
        $news = (new News())
        ->find("news.id != (SELECT MAX(id) FROM news WHERE category_id = {$category}) AND category_id = {$category}")
        ->limit(4)
        ->order("id DESC")->fetch(true);

        return $news;
    }

    /* public function theme()
    {
        $adsLong = (new Ads)->find("status = '1' AND type = 'Longa'")->order("RAND()")->fetch();
        $adsShort = (new Ads)->find("status = '1' AND type = 'Curta'")->order("RAND()")->fetch();
        $categorysFooter = (new Categories())->find()->limit(6)->order("id DESC");

        echo $this->view->render("_theme", [
            "app" => "home",
            "adsShort" => $adsShort,
            "adsLong" => $adsLong,
            "categorysFooter" => $categorysFooter,
        ]);
    }
 */
    public function news(?array $data)
    {
        $adsLong = (new Ads)->find("status = '1' AND type = 'Longa'")->order("RAND()")->fetch();
        $adsShort = (new Ads)->find("status = '1' AND type = 'Curta'")->order("RAND()")->fetch();
        $categorysFooter = (new Categories())->find()->limit(6)->order("id DESC");
        $mostVisitedNews = (new News())
                ->find()
                ->limit(5)
                ->order("views DESC");

        $news = (new News)->findByUri($data["uri"]);
        $news->views = $news->views + 1;
        if(!$news->save()){
            $this->message->error("Ocorreu um erro na visualização")->flash();
            $json["redirect"] = url("/");
        }

        $head = $this->seo->render(
            CONF_SITE_NAME . " - ". $news->title,
            CONF_SITE_DESC,
            url("/news"),
            theme("/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("news", [
            "app" => "dash",
            "adsShort" => $adsShort,
            "adsLong" => $adsLong,
            "news" => $news->fetch(),
            "categorysFooter" => $categorysFooter,
            "mostVisitedNews" => $mostVisitedNews->fetch(true),
            "head" => $head
        ]);
    }


    public function lastNews(?array $data)
    {

        $adsLong = (new Ads)->find("status = '1' AND type = 'Longa'")->order("RAND()");
        $adsShort = (new Ads)->find("status = '1' AND type = 'Curta'")->order("RAND()");
        $mostVisitedNews = (new News())->find()->limit(5)->order("views DESC");

        if (!empty($data["s"])) {
            $s = str_search($data["s"]);
            echo json_encode(["redirect" => url("/ultimas_noticias/{$s}/1")]);
            return;
        }
        
        $search = null;
        $listNews = (new News())->find()->order("id DESC");


        if (!empty($data["search"]) && str_search($data["search"]) != "all") {
            $search = str_search($data["search"]);
            $listNews = (new News())->find("title LIKE :s", "s=%{$search}%");
            if (!$listNews->count()) {
                $data["searchNotFound"] = "busca_nao_encontrado";
                redirect("/ultimas_noticias/{$data["searchNotFound"]}");
            }
           
        }

        $all = ($search ?? "all");
        $pager = new Pager(url("/ultimas_noticias/{$all}/"));
        $pager->pager($listNews->count(), 5, (!empty($data["page"]) ? $data["page"] : 1));
        
        $head = $this->seo->render(
            CONF_SITE_NAME . " - Últimas Noticias",
            CONF_SITE_DESC,
            url("/last_news"),
            theme("/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("last_news", [
            "app" => "dash",
            "adsShort" => $adsShort->fetch(),
            "adsLong" => $adsLong->fetch(),
            "mostVisitedNews" => $mostVisitedNews->fetch(true),
            "listNews" => $listNews->limit($pager->limit())->offset($pager->offset())->order('id DESC')->fetch(true),
            "categorysFooter" => (new Categories())->find()->limit(6)->order("id DESC")->fetch(true),
            "search" => $search,
            "paginator" => $pager->render(),
            "searchNotFound" => isset($data["searchNotFound"]) ? $data["searchNotFound"] : null,
            "head" => $head
        ]);
    }

    public function categoryNews(?array $data)
    {

        $adsLong = (new Ads)->find("status = '1' AND type = 'Longa'")->order("RAND()")->fetch();
        $adsShort = (new Ads)->find("status = '1' AND type = 'Curta'")->order("RAND()")->fetch();
       
        $categorysFooter = (new Categories())->find()->limit(6)->order("id DESC");
        $categoryNews = (new Categories())->find("name = :name", "name={$data["nameCategory"]}")->fetch();
        $mostVisitedNews = (new News())->find()->limit(5)->order("views DESC");
        $listNews = (new News())->find("category_id = :id", "id={$categoryNews->id}");

        
        if (!empty($data["s"])) {
            $s = str_search($data["s"]);
            echo json_encode(["redirect" => url("/categoria/{$data["nameCategory"]}/{$s}/1")]);
            return;
        }
         
        $search = null;

        if (!empty($data["search"]) && str_search($data["search"]) != "all") {
            $search = str_search($data["search"]);
            $listNews = (new News())->find("title LIKE :s", "s=%{$search}%");
            if (!$listNews->count()) {
                $data["searchNotFound"] = "busca_nao_encontrado";
                redirect("/categoria/{$data["nameCategory"]}/{$data["searchNotFound"]}");
            }
           
        }
     
        $all = ($search ?? "all");
        $pager = new Pager(url("/categoria/{$data["nameCategory"]}/{$all}/"));
        $pager->pager($listNews->count(), 5, (!empty($data["page"]) ? $data["page"] : 1));

        $head = $this->seo->render(
            CONF_SITE_NAME . " - ".ucfirst($data["nameCategory"]),
            CONF_SITE_DESC,
            url("/category_news"),
            theme("/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("category_news", [
            "app" => "dash",
            "adsShort" => $adsShort,
            "adsLong" => $adsLong,
            "categoryNews" => $categoryNews,
            "nameCategory" => $data["nameCategory"],
            "mostVisitedNews" => $mostVisitedNews->fetch(true),
            "categorysFooter" => $categorysFooter,
            "listNews" => $listNews->limit($pager->limit())->offset($pager->offset())->order('id DESC')->fetch(true),
            "search" => $search,
            "paginator" => $pager->render(),
            "categorysFooter" => (new Categories())->find()->limit(6)->order("id DESC")->fetch(true),
            "searchNotFound" => isset($data["searchNotFound"]) ? $data["searchNotFound"] : null,
            "head" => $head
        ]);
    }

    public function categories(?array $data)
    {
        $adsLong = (new Ads)->find("status = '1' AND type = 'Longa'")->order("RAND()")->fetch();
        $adsShort = (new Ads)->find("status = '1' AND type = 'Curta'")->order("RAND()")->fetch();

        $listCategorys = (new Categories)->find()->limit(6)->order("id DESC");
        $lastCategorys = (new Categories)->find()->limit(1)->order("id DESC");
        $categorysFooter = (new Categories())->find()->limit(6)->order("id DESC");

        $news = (new News())->find()->order("id DESC");
        $lastNews = (new News)->find()->limit(1)->order("id DESC");

        $head = $this->seo->render(
            CONF_SITE_NAME . " - Categorias",
            CONF_SITE_DESC,
            url("/last_news"),
            theme("/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("categories", [
            "app" => "dash",
            "adsShort" => $adsShort,
            "adsLong" => $adsLong,
            "listCategorys" => $listCategorys->fetch(true),
            "lastCategorys" => $lastCategorys->fetch(true),
            "listNews" => $news->fetch(true),
            "lastNews" => $lastNews->fetch(true),
            "categorysFooter" => $categorysFooter->fetch(true),
            "head" => $head
        ]);
    }

    public function contact(?array $data): void
    {
        $adsLong = (new Ads)->find("status = '1' AND type = 'Longa'")->order("RAND()")->fetch();
        $adsShort = (new Ads)->find("status = '1' AND type = 'Curta'")->order("RAND()")->fetch();
        $categorysFooter = (new Categories())->find()->limit(6)->order("id DESC");


        if(!empty($data)){
            $contact = new Contact();
            $contact->subject = $data['subject'];
            $contact->content = $data['content'];
            $contact->name = $data['name'];
            $contact->email = $data['email'];

            if(!$contact->save()){
                $json["message"] = $contact->message()->render();
                echo json_encode($json);
                return;
            
            }

            $this->message->success("Sua mensagem foi enviada com sucesso, retornaremos em breve!")->flash();
            $json["redirect"] = url("/contato");

            echo json_encode($json);
            return;
        }
        

        $head = $this->seo->render(
            CONF_SITE_NAME . " - Contato",
            CONF_SITE_DESC,
            url("/last_news"),
            theme("/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("contact", [
            "app" => "dash",
            "adsShort" => $adsShort,
            "adsLong" => $adsLong,
            "categorysFooter" => $categorysFooter,
            "head" => $head
        ]);
    }

    public function inscriptions(?array $data): void
    {
        $adsLong = (new Ads)->find("status = '1' AND type = 'Longa'")->order("RAND()")->fetch();
        $adsShort = (new Ads)->find("status = '1' AND type = 'Curta'")->order("RAND()")->fetch();
        $categorysFooter = (new Categories())->find()->limit(6)->order("id DESC");

        if(!empty($data)){
            $inscriptions = new Inscriptions();
            $inscriptions->email = $data['email'];
            $inscriptions->status = 1;

            if(!$inscriptions->save()){
                $json["message"] = $inscriptions->message()->render();
                echo json_encode($json);
                return;
            
            }

            $json["redirect"] = url("/mensagem/sucesso_inscricao");

            echo json_encode($json);
            return;
        }
        

        $head = $this->seo->render(
            CONF_SITE_NAME . " - Contato",
            CONF_SITE_DESC,
            url("/last_news"),
            theme("/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("contact", [
            "app" => "dash",
            "adsShort" => $adsShort,
            "adsLong" => $adsLong,
            "categorysFooter" => $categorysFooter,
            "head" => $head
        ]);
    }

    public function about(?array $data)
    {
        $adsLong = (new Ads)->find("status = '1' AND type = 'Longa'")->order("RAND()")->fetch();
        $adsShort = (new Ads)->find("status = '1' AND type = 'Curta'")->order("RAND()")->fetch();
        $categorysFooter = (new Categories())->find()->limit(6)->order("id DESC");


        $head = $this->seo->render(
            CONF_SITE_NAME . " - Sobre",
            CONF_SITE_DESC,
            url("/ultimas_noticias"),
            theme("/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("about", [
            "app" => "dash",
            "adsShort" => $adsShort,
            "adsLong" => $adsLong,
            "categorysFooter" => $categorysFooter,
            "head" => $head
        ]);
    }

    public function message(array $data)
    {
        $message = new \stdClass();

        json_encode($message);

        switch ($data['msg']) {
            case "sucesso_inscricao":
                $message->title = " - Obrigado!";
                $message->message = "Inscrição realizada com sucesso! 
                <br/> Seja bem vindo(a) ao maior site de noticias do mundo <br/>
                <p><b>Você receberá todas as noticias no seu e-mail</b></p>";
                $message->image = "/assets/img/img/world.png";
                break;
        }
        $head = $this->seo->render(
            CONF_SITE_NAME .$message->title,
            CONF_SITE_DESC,
            url("/mensagem"),
            theme("/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("message", [
            "app" => "dash",
            "message" => $message,
            "head" => $head
        ]);
    }

}