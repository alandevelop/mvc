<?php

class UserController
{
    public function actionRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!User::emailExist($_POST['email'])) {
                $user = new User;
                $user->username = $_POST['email'];
                $user->password = $_POST['password'];
                $user->register();
                Messages::setMessage('Вы зарегистрированы. Можете авторизоваться.');
                header('Location: /');
                return true;
            }
            Messages::setMessage('Пользователь с таким email уже существует!');
            header("Refresh:0");
            return true;
        }

        require_once ROOT . '/views/user/register.php';
        return true;
    }

    public function actionLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($user = User::login($_POST['email'], $_POST['password'])) {
                header('Location: /');
                return true;
            }
            Messages::setMessage("Неверное имя пользователя или пароль.");
            header('Refresh: 0');
            return true;
        }

        require_once ROOT . '/views/user/login.php';
        return true;
    }

    public function actionLogout()
    {
        User::logout();
        header('Location: /');
        return true;
    }
}