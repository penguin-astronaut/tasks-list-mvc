<?php

namespace Controllers;

use Core\View;
use Models\Users;

class AuthController
{
    public function index()
    {
        $error = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $users = new Users();
            $res = $users->checkUser($_POST['login'] ?? '', $_POST['password'] ?? '');

            if ($res['status'] === 'success') {
                $_SESSION['user'] = $res['user_id'];
                header('Location: /');
                die;
            } elseif ($res['code'] === Users::STATUS_USER_NOT_FOUND) {
                $res = $users->create($_POST['login'] ?? '', $_POST['password'] ?? '');

                if ($res['status'] === 'success') {
                    $_SESSION['user'] = $res['user_id'];
                    header('Location: /');
                    die;
                }

                $error = $res['message'];
            } elseif ($res['code'] === Users::STATUS_ERROR_PASSWORD) {
                $error = 'password incorrect';
            }
        }

        View::render('auth', ['error' => $error]);
    }
}