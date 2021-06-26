<?php
namespace Controller;
session_start();

class Logout
{
    public function get()
    {
        header("Location: login");
    }

    public function post()
    {
        session_unset();
        session_destroy();
        header("Location: login");
    }
}