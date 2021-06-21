<?php
namespace Controller;

class AddBooks
{
    public function get()
    {
        session_start();
        if ($_SESSION['logged_in'] && $_SESSION['admin'])
        {
            echo \View\Loader::make()->render("templates/addBooks.twig", array());
        }
        else
        {
            echo \View\Loader::make()
                ->render("templates/login.twig", array());
        }
    }

    public function post()
    {
        if ($_POST['quantity'] == 0)
        {
            $_POST['quantity'] = 1;
        }
        while ($_POST['quantity']--)
        {
            $uuid = \Model\Admin::guidv4();
            \Model\AddBooks::insertBook($uuid, $_POST['bookname']);
        }
        header("Location: admin");
    }
}