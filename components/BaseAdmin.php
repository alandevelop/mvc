<?php

class BaseAdmin
{
    public function __construct()
    {
        $this->check();
    }

    public function check()
    {
        if (!User::isAuth()) {
            header('Location: /user/login');
            throw new Exception();
        }

        if (!User::isCurrentUserAdmin()) {
            Messages::setMessage('Доступ разрешен только для админ пользователей!');
            header('Location: /');
            throw new Exception();
        }
    }
}