<?php
namespace Controller;
session_start();

class BookIssued
{
    public function get()
    {
        \Controller\Utils::loggedInUser();

        $userData = \Model\BookIssued::issuedBooks($_SESSION['email']);
        for ($i = 0;$i < sizeof($userData);$i++)
        {
            $differenceInTime = strtotime(date('Y-m-d H:i:s')) - strtotime($userData[$i]['returnby']);
            $differenceInDays = round($differenceInTime / (60 * 60 * 24));
            if ($differenceInDays <= 0)
            {
                $userData[$i]['fine'] = 0;
            }
            else
            {
                $userData[$i]['fine'] = $differenceInDays;
            }
        }
        echo \View\Loader::make()->render("templates/bookIssued.twig", array(
            "userData" => $userData,
        ));
    }

    public function post()
    {
        \Controller\Utils::loggedInUser();

        if(\Controller\Utils::checkVariableSet($_POST['uuid']))
        {
            \Model\BookIssued::returnBook($_POST['uuid']);
        }
        header("Location: bookIssued");
    }
}