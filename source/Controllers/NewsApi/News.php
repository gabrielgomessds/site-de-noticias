<?php

namespace Source\Controllers\NewsApi;

use Source\Models\News as ModelsNews;
use Source\Support\Pager;

class News extends NewsApi
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(): void
    {
        $where = "";
        $params = "";
        $values = $this->headers;

        $news = (new ModelsNews)->find("author_id = :author_id{$where}", 
        "author_id={$this->user->id}{$params}");

        if(!$news){
            $this->call(
                404,
                "not_found",
                "Nada encontrado para sua pesquisa. Tente outros termos"
            )->back(["results" => 0]);
            return;
        }

        $page = (!empty($values["page"]) ? $values["page"] : 1);
        $pager = new Pager(url('/news/'));
        $pager->page($news->count(), 10, $page);

        $response["results"] = $news->count();
        $response["page"] = $pager->page();
        $response["page"] = $pager->pages();


        foreach($news->fetch(true) as $item){
            $response["news"][] = $item->data();
        }

        $this->back($response);
        return;
    }

    public function create(array $data):void
    {
        $request = $this->requestLimit("newsApiCreate", 5, 60);
        if(!$request){
            return;
        }

        $news = new ModelsNews();
        if(!$news->launch($this->user, $data)){
            $this->call(
                400,
                "invalid_data",
                $news->message()->getText()
            )->back();
            return;
        }

        $this->back(["news" => $news->data()]);
       
    }

}