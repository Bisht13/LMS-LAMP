<?php
require __DIR__ . "/../vendor/autoload.php";

Toro::serve(array(
    "/" => "\Controller\Login",
    "/register" => "\Controller\Register",
    "/login" => "\Controller\Login",
    "/admin" => "\Controller\Admin",
    "/dashboard" => "\Controller\Dashboard",
    "/logout" => "\Controller\Logout",
    "/bookIssued" => "\Controller\BookIssued",
    "/addBooks" => "\Controller\AddBooks",
    "/requests" => "\Controller\Requests",
    "/issueLog" => "\Controller\IssueLog",
));