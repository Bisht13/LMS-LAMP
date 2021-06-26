<?php
namespace Controller;

class Register
{
    public function get()
    {
        echo \View\Loader::make()->render("templates/register.twig", array());
    }

    public function post()
    {
        if(\Controller\Utils::checkVariableSet($_POST["email"],$_POST["password"], $_POST['confirm_password'])){
            $email = $_POST["email"];
            $password = $_POST["password"];
            $confirm_password = $_POST["confirm_password"];
            if ($password !== $confirm_password)
            {
                echo \View\Loader::make()->render("templates/register.twig", array(
                    "not_same_password" => true,
                ));
            }
            else if (\Model\Register::find($email) !== null)
            {
                echo \View\Loader::make()->render("templates/register.twig", array(
                    "email_exist" => true,
                ));
            }
            else
            {
                $uuid = \Model\Register::guidv4();
                $hash = hash("sha512", $password);
                \Model\Register::create($uuid, $email, $hash);
                echo \View\Loader::make()->render("templates/register.twig", array(
                    "user_added" => true,
                ));
            }
        }else{
            header("Location: register");
        }
    }
}