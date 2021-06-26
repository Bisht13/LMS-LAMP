<?php
namespace Controller;

class AddBooks
{
    public function get()
    {
        \Controller\Utils::loggedInAdmin();

        echo \View\Loader::make()->render("templates/addBooks.twig", array());
    }

    public function post()
    {
        \Controller\Utils::loggedInAdmin();

        if(\Controller\Utils::checkVariableSet($_POST['quantity'], $_POST['bookname'])){
            while ($_POST['quantity']--)
            {
                $uuid = \Model\Admin::guidv4();
                \Model\AddBooks::insertBook($uuid, $_POST['bookname']);
            }
        }
        header("Location: admin");
    }
}