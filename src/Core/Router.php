<?php

namespace Core;

class Router
{
    private array $paths = [
        '/' => ['IndexController', 'index'],
        '/auth' => ['AuthController', 'index']
    ];

    public function goToPage(string $uri)
    {
        [$controller, $method] = $this->paths[$uri] ?? $this->paths['/'];
        (new ('Controllers\\' . $controller))->$method();
    }
}