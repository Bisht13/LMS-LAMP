<?php
namespace Controller;

class Requests
{
    public function get()
    {
        \Controller\Utils::loggedInAdmin();

        echo \View\Loader::make()->render("templates/requests.twig", array(
            "userData" => \Model\Requests::AllRequests() ,
        ));
    }

    public function post()
    {
        \Controller\Utils::loggedInAdmin();

        if(\Controller\Utils::checkVariableSet($_POST['response'])){
            if ($_POST['response'] === "accept")
            {
                $date = date('Y-m-d H:i:s');
                $returnDate = date('Y-m-d H:i:s', strtotime($date . ' + 14 days'));
                \Model\Requests::accept($_POST['name'], \Model\Requests::findUUID($_POST['book'], $_POST['name']) ["uuid"], $date, $returnDate);
            }
            else if ($_POST['response'] === "decline")
            {
                \Model\Requests::decline(\Model\Requests::findUUID($_POST['book'], $_POST['name']) ["uuid"]);
            }
        }

        header("Location: requests");
    }
}