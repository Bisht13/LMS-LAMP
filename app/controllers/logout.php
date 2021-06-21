<?php
namespace Controller;

class Logout
{
    public function get()
    {
        header("Location: login");
    }

    public function post()
    {
        var_dump($_POST);
        session_start();
        session_unset();
        session_destroy();
        header("Location: login");
    }
}