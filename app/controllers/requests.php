<?php
namespace Controller;

class Requests
{
    public function get()
    {
        session_start();
        if ($_SESSION['logged_in'] && $_SESSION['admin'])
        {
            echo \View\Loader::make()->render("templates/requests.twig", array(
                "userData" => \Model\Requests::AllRequests() ,
            ));
        }
        else
        {
            echo \View\Loader::make()
                ->render("templates/login.twig", array());
        }
    }

    public function post()
    {
        if ($_POST['response'] == "accept")
        {
            \Model\Requests::accept($_POST['name'], \Model\Requests::findUUID($_POST['book'], $_POST['name']) ["uuid"]);
        }
        else if ($_POST['response'] == "decline")
        {
            \Model\Requests::decline(\Model\Requests::findUUID($_POST['book'], $_POST['name']) ["uuid"]);
        }
        header("Location: requests");
    }
}