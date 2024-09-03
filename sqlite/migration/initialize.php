<?php

use Lucas\PortalAcademico\Infrastructure\Persistence\PDOCreator;

require __DIR__ .'/../../vendor/autoload.php';

$sql =
"CREATE TABLE alunos (
    id INTEGER PRIMARY KEY,
    nome TEXT,
    email TEXT,
    excluido INTEGER
);
";

$pdo = PDOCreator::create();

$pdo->query($sql);