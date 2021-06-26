<?php
namespace Model;

class BookIssued
{
    public static function issuedBooks($email)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("select * from books where issuedby = ?");
        $stmt->execute([$email]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function returnBook($uuid)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("update books set issuedby=null,issuedon=null,returnby=null where uuid= ? ");
        $stmt->execute([$uuid]);
    }
}