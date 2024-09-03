<?php
namespace Lucas\PortalAcademico\Infrastructure\Persistence;

use PDO;

class PDOCreator
{
    public static function create(): PDO
    {
        $path = __DIR__ . '/../../../sqlite/bd.sqlite';

        return new PDO(
            "sqlite:$path",
            null,
            null,
            [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
    }
}