<?php
namespace Controller;

class Admin
{
    public function get()
    {
        session_start();
        $issueData = \Model\Admin::issueLog();
        for ($i = 0;$i < sizeof($issueData);$i++)
        {
            $differenceInTime = strtotime(date('Y-m-d H:i:s')) - strtotime($issueData[$i]['returnby']);
            $differenceInDays = round($differenceInTime / (60 * 60 * 24));
            if ($differenceInDays <= 0)
            {
                $issueData[$i]['fine'] = 0;
            }
            else
            {
                $issueData[$i]['fine'] = $differenceInDays;
            }
        }
        if ($_SESSION['logged_in'] && $_SESSION['admin'])
        {
            echo \View\Loader::make()->render("templates/admin.twig", array(
                "tableData" => \Model\Admin::AllBook() ,
                "userData" => \Model\Admin::AllRequests() ,
                "issueData" => $issueData,
            ));
        }
        else
        {
            echo \View\Loader::make()->render("templates/login.twig", array());
        }
    }

    public function post()
    {
        if ($_POST['quantity'] == 0)
        {
            $_POST['quantity'] = 1;
        }
        while ($_POST['quantity']--)
        {
            $uuid = \Model\Admin::guidv4();
            \Model\Admin::insertBook($uuid, $_POST['bookname']);
        }
        header("Location: admin");
    }
}