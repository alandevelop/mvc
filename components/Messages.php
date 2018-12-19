<?php

class Messages
{
    public static function getMessages()
    {
        if (isset($_SESSION['messages'])) {
            $messages = $_SESSION['messages'];
            unset($_SESSION['messages']);
            return $messages;
        }
    }

    public static function setMessage(string $msg)
    {
        $_SESSION['messages'][] = $msg;
    }

    public static function hasMessages()
    {
        if (isset($_SESSION['messages'])) {
            return true;
        }
        return false;
    }
}