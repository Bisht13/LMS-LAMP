<?php
namespace Model;

class Requests
{

    public static function AllRequests()
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("select name,issuereq from books where issuereq is not null");
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function findUUID($bookname, $email)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("select uuid from books where name=? and issuereq= ? LIMIT 1");
        $stmt->execute([$bookname, $email]);
        $row = $stmt->fetch();
        return $row;
    }

    public static function accept($email, $uuid, $date, $returnDate)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("update books set issuereq=null,issuedby=?,issuedon=?,returnby=? where uuid=?;");
        $stmt->execute([$email, $date, $returnDate, $uuid]);
    }

    public static function decline($uuid)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("update books set issuereq=null where uuid=?");
        $stmt->execute([$uuid]);
    }
}