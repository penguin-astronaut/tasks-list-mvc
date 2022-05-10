<?php

namespace Controllers;

use Core\View;

class IndexController {
    public function index()
    {
        View::render('tasks_list');
    }
}