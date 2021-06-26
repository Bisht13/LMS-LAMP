<?php
namespace Controller;

class IssueLog
{
    public function get()
    {
        \Controller\Utils::loggedInAdmin();

        $issueData = \Model\IssueLog::issueLog();
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

        echo \View\Loader::make()->render("templates/issueLog.twig", array(
            "issueData" => $issueData,
        ));

    }
}