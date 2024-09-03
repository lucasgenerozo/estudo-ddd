<?php
namespace Lucas\PortalAcademico\Domain;

use InvalidArgumentException;
use Stringable;

class Email implements Stringable
{
    private string $email;

    public function __construct(
        string $email
    ) {
        $emailValidation = filter_var($email, FILTER_VALIDATE_EMAIL);
        if ($emailValidation === null || $emailValidation === false) {
            throw new InvalidArgumentException(
                'Email inválido',
                400
            );
        }

        $this->email = $email;
    }

    public function __toString(): string
    {
        return $this->email;
    }
}