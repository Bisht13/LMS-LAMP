<?php
namespace Controller;

class Dashboard
{
    public function get()
    {
        session_start();
        if ($_SESSION['logged_in'])
        {
            echo \View\Loader::make()->render("templates/dashboard.twig", array(
                "tableData" => \Model\Dashboard::findBooks($_SESSION['email']) ,
            ));
        }
        else
        {
            echo \View\Loader::make()->render("templates/login.twig", array());
        }
    }

    public function post()
    {
        session_start();
        if ($_POST['checkout'] == "Request Checkout")
        {
            \Model\Dashboard::askCheckout($_SESSION['email'], \Model\Dashboard::findUUID($_POST['book']) ["uuid"]);
            header("Location: dashboard");
        }
    }
}