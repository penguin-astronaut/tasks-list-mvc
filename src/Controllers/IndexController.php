<?php

namespace Controllers;

use Core\View;
use Models\Tasks;

class IndexController {
    public function index()
    {
        $tasks = new Tasks();
        $tasksList = $tasks->get($_SESSION['user']);
        View::render('tasks_list', ['error' => $_GET['error'] ?? false, 'tasksList' => $tasksList]);
    }

    public function addTask()
    {
        if ($_REQUEST['method'] !== 'POST') {
            header('Location: /');
        }

        $tasks = new Tasks();
        $res = $tasks->create($_POST['text'] ?? '', $_SESSION['user']);
        $error = '';
        if ($res['status'] === 'error') {
            $error = '?error=' . $res['message'];
        }

        header('Location: /' . $error);
    }

    public function removeTask()
    {
        if (isset($_GET['id'])) {
            $tasks = new Tasks();
            $tasks->remove($_GET['id'], $_SESSION['user']);
        }

        header('Location: /');
    }

    public function changeStatus()
    {
        if (isset($_GET['status'])) {
            $tasks = new Tasks();
            $status = $_GET['status'] === 'ready' ? Tasks::STATUS_READY : Tasks::STATUS_UNREADY;
            $tasks->changeStatus($_GET['id'], $_SESSION['user'], $status);
        }

        header('Location: /');
    }

    public function readyAll()
    {
        $tasks = new Tasks();
        $tasks->readyAll($_SESSION['user']);

        header('Location: /');
    }

    public function removeAll()
    {
        $tasks = new Tasks();
        $tasks->removeAll($_SESSION['user']);

        header('Location: /');
    }
}