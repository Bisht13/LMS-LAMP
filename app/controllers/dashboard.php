<?php
namespace Controller;
session_start();

class Dashboard
{
    public function get()
    {
        \Controller\Utils::loggedInUser();
        
        echo \View\Loader::make()->render("templates/dashboard.twig", array(
            "tableData" => \Model\Dashboard::findBooks($_SESSION['email']) ,
        ));
    }

    public function post()
    {
        \Controller\Utils::loggedInUser();

        if ($_POST['checkout'] === "Request Checkout")
        {
            \Model\Dashboard::askCheckout($_SESSION['email'], \Model\Dashboard::findUUID($_POST['book']) ["uuid"]);
        }
        header("Location: dashboard");
    }
}