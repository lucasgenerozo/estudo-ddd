<?php

use Lucas\PortalAcademico\Infrastructure\Adapter\Controllers\AlunoController;
use Lucas\PortalAcademico\Infrastructure\Adapter\Controllers\LoginController;

return [
    'GET' => [
        '/login' => LoginController::class,
        '/register' => [LoginController::class, 'register'],
        '/alunos' => AlunoController::class,
        '/alunos/ver' => [AlunoController::class, 'show'],
        '/alunos/criar' => [AlunoController::class, 'form'],
        '/alunos/editar' => [AlunoController::class, 'form'],
        '/alunos/excluir' => [AlunoController::class, 'delete'],
    ],
    'POST' => [
        '/alunos/criar' => [AlunoController::class, 'save'],
        '/alunos/editar' => [AlunoController::class, 'save'],
    ],
];