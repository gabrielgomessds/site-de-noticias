<?php

namespace Source\Models;

use Source\Core\Model;

/**
 *
 * @package Source\Models
 */
class Inscriptions extends Model
{
    /**
     * Inscriptions constructor.
     */
    public function __construct()
    {
        parent::__construct("inscriptions", ["id"], ["email"]);
    }

    /**
     * @param string $email
     * @param string $status
     * @return Inscriptions
     */
    public function bootstrap(
        string $email,
        string $status
    
    ): Inscriptions {
        $this->email = $email;
        $this->status = $status;
        return $this;
    }

    /**
     * @return bool
     */
    public function save(): bool
    {
        if (!$this->required()) {
            $this->message->warning("E-mail é obrigatórios");
            return false;
        }

        if (!is_email($this->email)) {
            $this->message->warning("O e-mail informado não tem um formato válido");
            return false;
        }

        
          /** Contact Update */
          if (!empty($this->id)) {
            $insID = $this->id;

            $this->update($this->safe(), "id = :id", "id={$insID}");
            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return false;
            }
        }

        /** Contact Create */
        if (empty($this->id)) {

            $insID = $this->create($this->safe());
            if ($this->fail()) {
                $this->message->error("Erro ao cadastrar, verifique os dados");
                return false;
            }
        }

        $this->data = ($this->findById($insID))->data();
        return true;
    }
}