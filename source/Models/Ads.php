<?php

namespace Source\Models;

use Source\Core\Model;

/**
 *
 * @package Source\Models
 */
class Ads extends Model
{
    /**
     * Ads constructor.
     */
    public function __construct()
    {
        parent::__construct("ads", ["id"], ["name", "email", "owner", "link"]);
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $owner
     * @param string $link
     * @return Ads
     */
    public function bootstrap(
        string $name,
        string $email,
        string $owner,
        string $image,
        string $type,
        string $link,
        string $status
    
    ): Ads {
        $this->name = $name;
        $this->email = $email;
        $this->owner = $owner;
        $this->image = $image;
        $this->type = $type;
        $this->link = $link;
        $this->status = $status;
        return $this;
    }

    /**
     * @return bool
     */
    public function save(): bool
    {
        if (!$this->required()) {
            $this->message->warning("Nome, email, imagem, proprietario e link são obrigatórios");
            return false;
        }

        /** Ads Update */
        if (!empty($this->id)) {
            $adsId = $this->id;

            $this->update($this->safe(), "id = :id", "id={$adsId}");
            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return false;
            }
        }

        /** Ads Create */
        if (empty($this->id)) {

            $adsId = $this->create($this->safe());
            if ($this->fail()) {
                $this->message->error("Erro ao cadastrar, verifique os dados");
                return false;
            }
        }

        $this->data = ($this->findById($adsId))->data();
        return true;
    }
}