<?php
namespace Controller;

class Login
{
    public function get()
    {
        session_start();
        if ($_SESSION['logged_in'])
        {
            if ($_SESSION['admin'])
            {
                header("Location: admin");
            }
            else
            {
                header("Location: dashboard");
            }
        }
        else
        {
            echo \View\Loader::make()->render("templates/login.twig", array());
        }
    }

    public function post()
    {
        session_start();
        $_SESSION['logged_in'] = false;
        $email = $_POST["email"];
        if (\Model\Login::find($email) != null)
        {
            $password = $_POST["password"];
            $db_password = \Model\Login::find($email) ["password"];
            if (hash("sha512", $password) == $db_password)
            {
                $_SESSION['uuid'] = \Model\Login::find($email) ["uuid"];
                $_SESSION['email'] = \Model\Login::find($email) ["email"];
                $_SESSION['logged_in'] = true;
                $_SESSION['admin'] = \Model\Login::find($email) ["admin"];
                if ($_SESSION['admin'])
                {
                    header('Location: admin');
                }
                else
                {
                    header('Location: dashboard');
                }
            }
            else
            {
                echo \View\Loader::make()->render("templates/login.twig", array(
                    "wrong_password" => true,
                ));
            }
        }
        else
        {
            echo \View\Loader::make()
                ->render("templates/login.twig", array(
                "wrong_email" => true,
            ));
        }
    }
}