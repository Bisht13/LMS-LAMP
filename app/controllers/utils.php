<?php
namespace Controller;
session_start();

class Utils
{
    public static function loggedInUser()
    {
        if(!($_SESSION['logged_in']))
        {
            header("Location: /login");
        }
    }

    public static function loggedInAdmin()
    {
        if(!($_SESSION['logged_in'] && $_SESSION['admin']))
        {
            header("Location: /login");
        }
    }

    public static function checkVariableSet(...$variables){
        $set = false;
        foreach($variables as $variable) {
            $set |= empty($variable);
        }
        return(!$set);
    }
}