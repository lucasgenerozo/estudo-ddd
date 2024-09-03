<?php

namespace Lucas\PortalAcademico\Infrastructure\Adapter\Controllers;

class HomeController implements Controller
{
    public function index()
    {
        echo "home '/' ";
    }

    public function notFound()
    {
        echo 'rota nao encontrada';
    }
}