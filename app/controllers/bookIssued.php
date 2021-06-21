<?php
namespace Controller;

class BookIssued
{
    public function get()
    {
        session_start();
        if ($_SESSION['logged_in'])
        {
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
        else
        {
            echo \View\Loader::make()->render("templates/login.twig", array());
        }
    }

    public function post()
    {
        session_start();
        if ($_POST['uuid'] != null)
        {
            \Model\BookIssued::returnBook($_POST['uuid']);
            header("Location: bookIssued");
        }
    }
}