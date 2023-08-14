<?php

namespace Source\Models;

use Source\Controllers\NewsApi\Users;
use Source\Core\Model;

/**
 *
 * @package Source\Models
 */
class News extends Model
{
    /**
     * Ads constructor.
     */
    public function __construct()
    {
        parent::__construct("news", ["id"], ["title", "content", "category_id"]);
    }

    /**
     * @param string $title
     * @param string $image
     * @param string $content
     * @param string $uri
     * @param string $author_id
     * @param string $category_id
     * @param string $position
     * @param string $views
     * @param string $status
     * @return Ads
     */
    public function bootstrap(
        string $title,
        string $image,
        string $content,
        string $uri,
        string $author_id,
        string $category_id,
        string $position,
        string $views,
        string $status
       
    
    ): News {
        $this->title = $title;
        $this->image = $image;
        $this->content = $content;
        $this->uri = $uri;
        $this->author_id = $author_id;
        $this->category_id = $category_id;
        $this->position = $position;
        $this->views = $views;
        $this->status = $status;
        
        return $this;
    }


    public function admin(): ?Admin
    {
        if ($this->author_id) {
            return (new Admin())->findById($this->author_id);
        }
        return null;
    }


    public function launch(Admin $admin, array $data): ?News
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        if (
            empty($data["title"]) || empty($data["category_id"]) || empty($data["content"])
            || empty($data["uri"]) || empty($data["position"])
            || empty($data["status"]) || empty($data["image"])
        ) {
            $this->message->error("Faltam dados para adicionar a noticia");
            return null;
        }

        $author = (new Admin())->findById($admin->id);
        if (!$author) {
            $this->message->error("O admin que você informou não existe");
            return null;
        }

        $category = (new Categories())->findById($data["category_id"]);
        if (!$category) {
            $this->message->error("A categoria que você informou não existe");
            return null;
        }

        $this->title = $data["title"];
        $this->content = $data["content"];
        $this->category_id =$data["category_id"];
        $this->author_id = $admin->id;
        $this->uri = $data["uri"];
        $this->position = $data["position"];
        $this->status = $data["status"];
        $this->image = $data["image"];

        if (!$this->save()) {
            return null;
        }

        return $this;
    }

    public function category(): ?Categories
    {
        if ($this->category_id) {
            return (new Categories())->findById($this->category_id);
        }
        return null;
    }


    public function findByUri(string $uri, string $columns = "*"): ?News
    {
        $find = $this->find("uri = :uri", "uri={$uri}", $columns);
        return $find->fetch();
    }


    /**
     * @return bool
     */
    public function save(): bool
    {
        if (!$this->required()) {
            $this->message->warning("Titulo, conteúdo são obrigatórios");
            return false;
        }

        /** news Update */
        if (!empty($this->id)) {
            $newsId = $this->id;

            if ($this->find("uri = :e AND id != :i", "e={$this->uri}&i={$newsId}", "id")->fetch()) {
                $this->message->warning("O titulo informado já está cadastrado");
                return false;
            }

            $this->update($this->safe(), "id = :id", "id={$newsId}");
            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return false;
            }
        }

        /** news Create */
        if (empty($this->id)) {

            if ($this->findByUri($this->uri, "id")) {
                $this->message->warning("O titulo informado já está cadastrado");
                return false;
            }

            $newsId = $this->create($this->safe());
            if ($this->fail()) {
                $this->message->error("Erro ao cadastrar, verifique os dados");
                return false;
            }
        }

        $this->data = ($this->findById($newsId))->data();
        return true;
    }
}