<?php
namespace Lucas\PortalAcademico\Infrastructure\Adapter\Routes;

class Route
{
    public function __construct(
        public readonly string $path,
        public readonly string $controller,
        public readonly mixed $method = 'index'
    ) {
    }
}