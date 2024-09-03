<?php
namespace Lucas\PortalAcademico\Domain\Entity;

use DomainException;
use Lucas\PortalAcademico\Domain\Email;

class Aluno
{
    private Email $email;

    public function __construct(
        private ?int $id,
        private string $nome,
        string $email,
    ) {
        $this->setEmail($email);
    }

    public function setId(int $id)
    {
        if (!is_null($this->id)) {
            echo "$this->id";
            throw new DomainException('Aluno já tem ID definido e não pode ser sobrescrevido');
        }

        $this->id = $id;
    }

    public function setEmail($email) {

        $this->email = new Email($email);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}