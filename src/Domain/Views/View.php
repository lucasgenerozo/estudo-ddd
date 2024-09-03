<?php
namespace Lucas\PortalAcademico\Domain\Views;

use DomainException;
use InvalidArgumentException;

class View
{
    protected static function render(array $args)
    {
        if (!isset($args['view'])) {
            throw new InvalidArgumentException(
                "View name não foi passada"
            );
        }
        $view_name = $args['view'];

        $view_path = __DIR__ . "/../../Interfaces/Web/$view_name.php";
        
        if (!is_file($view_path)) {
            throw new DomainException(
                "View não encontrada ($view_path)"
            );
        }

        unset($args['view']);

        foreach ($args as $name => $value) {
            $$name = $value;
        }

        require __DIR__ . "/../../Interfaces/Web/layout.php";
    }
}