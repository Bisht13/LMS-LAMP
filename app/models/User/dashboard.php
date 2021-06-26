<?php
namespace Model;

class Dashboard
{
    public static function findBooks($email)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("select name,count(name) as count from books where (issuedby!=? and issuereq is NULL) or (issuedby is null and issuereq is null) group by name order by name");
        $stmt->execute([$email]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function findUUID($book)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("select uuid from books where name = ? and issuereq is null and issuedby is null LIMIT 1");
        $stmt->execute([$book]);
        $row = $stmt->fetch();
        return $row;
    }

    public static function askCheckout($email, $uuid)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("update books set issuereq = ? where uuid = ?");
        $stmt->execute([$email, $uuid]);
    }
}