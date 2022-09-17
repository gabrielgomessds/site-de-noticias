<?php

namespace Source\Models;

use Source\Core\Model;

/**
 *
 * @package Source\Models
 */
class Contact extends Model
{
    /**
     * Contact constructor.
     */
    public function __construct()
    {
        parent::__construct("contact", ["id"], ["name", "subject", "content", "email"]);
    }

    /**
     * @param string $name
     * @param string $subject
     * @param string $content
     * @param string $email
     * @param string $status
     * @return Contact
     */
    public function bootstrap(
        string $name,
        string $subject,
        string $content,
        string $email,
        string $status
    
    ): Contact {
        $this->name = $name;
        $this->subject = $subject;
        $this->content = $content;
        $this->email = $email;
        $this->status = $status;
        return $this;
    }

    /**
     * @param string $email
     * @param string $columns
     * @return null|Admin
     */
    public function findByEmail(string $email, string $columns = "*"): ?Admin
    {
        $find = $this->find("email = :email", "email={$email}", $columns);
        return $find->fetch();
    }

    /**
     * @return bool
     */
    public function save(): bool
    {
        if (!$this->required()) {
            $this->message->warning("Assunto, mensagem, email e nome são obrigatórios");
            return false;
        }

        if (!is_email($this->email)) {
            $this->message->warning("O e-mail informado não tem um formato válido");
            return false;
        }

          /** Contact Update */
          if (!empty($this->id)) {
            $contactId = $this->id;

            $this->update($this->safe(), "id = :id", "id={$contactId}");
            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return false;
            }
        }

        /** Contact Create */
        if (empty($this->id)) {

            $contactId = $this->create($this->safe());
            if ($this->fail()) {
                $this->message->error("Erro ao cadastrar, verifique os dados");
                return false;
            }
        }

        $this->data = ($this->findById($contactId))->data();
        return true;
    }
}