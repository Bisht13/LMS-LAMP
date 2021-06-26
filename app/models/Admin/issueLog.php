<?php
namespace Model;

class IssueLog
{

    public static function issueLog()
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("select name,issuedby,issuedon,returnby,fine from books where issuedon is not null");
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }
}