<?php
namespace Controller;

class Admin
{
    public function get()
    {
        \Controller\Utils::loggedInAdmin();

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

        echo \View\Loader::make()->render("templates/admin.twig", array(
            "tableData" => \Model\Admin::AllBook() ,
            "userData" => \Model\Admin::AllRequests() ,
            "issueData" => $issueData,
        ));
    }
}