<?php

namespace Source\Models;

use Source\Core\Model;

/**
 *
 * @package Source\Models
 */
class Categories extends Model
{
    /**
     * Categories constructor.
     */
    public function __construct()
    {
        parent::__construct("categories", ["id"], ["name", "color", "author_id"]);
    }

    /**
     * @param string $name
     * @param string $color
     * @param string $author_id
     * @return Categories
     */
    public function bootstrap(
        string $name,
        string $color,
        string $author_id
    
    ): Categories {
        $this->name = $name;
        $this->color = $color;
        $this->author_id = $author_id;
        return $this;
    }


    public function admin(): ?Admin
    {
        if ($this->author_id) {
            return (new Admin())->findById($this->author_id);
        }
        return null;
    }

    public function countNewsForCategory()
    {
        if($this->id){
           return (new News())->find("category_id = :id", "id={$this->id}")->count();
        }

        return null;

    }

    /**
     * @return bool
     */
    public function save(): bool
    {
        if (!$this->required()) {
            $this->message->warning("Nome e cor são obrigatórios");
            return false;
        }

        /** Categories Update */
        if (!empty($this->id)) {
            $categoriesId = $this->id;

            $this->update($this->safe(), "id = :id", "id={$categoriesId}");
            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return false;
            }
        }

        /** Categories Create */
        if (empty($this->id)) {

            $categoriesId = $this->create($this->safe());
            if ($this->fail()) {
                $this->message->error("Erro ao cadastrar, verifique os dados");
                return false;
            }
        }

        $this->data = ($this->findById($categoriesId))->data();
        return true;
    }
}