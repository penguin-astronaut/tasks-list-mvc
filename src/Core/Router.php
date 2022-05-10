<?php

namespace Core;

class Router
{
    private array $paths = [
        '/auth' => ['AuthController', 'index']
    ];

    private array $protectedPaths = [
        '/' => ['IndexController', 'index'],
        '/add' => ['IndexController', 'addTask'],
        '/remove' => ['IndexController', 'removeTask'],
        '/change_status' => ['IndexController', 'changeStatus'],
        '/ready_all' => ['IndexController', 'readyAll'],
        '/remove_all' => ['IndexController', 'removeAll'],
    ];

    public function goToPage(string $uri): void
    {
        if (isset($_SESSION['user']) && isset($this->protectedPaths[$uri])) {
            [$controller, $method] = $this->protectedPaths[$uri];
        } elseif (!isset($_SESSION['user']) && isset($this->protectedPaths[$uri])) {
            [$controller, $method] = $this->paths['/auth'];
        } elseif (!isset($_SESSION['user']) && isset($this->paths[$uri])) {
            [$controller, $method] = $this->paths[$uri];
        } elseif (isset($_SESSION['user']) && isset($this->paths[$uri])) {
            [$controller, $method] = $this->protectedPaths['/'];
        } else {
            View::render('404');
            http_response_code(404);
            return;
        }

        (new ('Controllers\\' . $controller))->$method();
    }
}