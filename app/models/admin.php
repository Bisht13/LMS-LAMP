<?php
namespace Model;

class Admin
{
    public static function AllBook()
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("select name,count(name) as count from books group by name order by name");
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function AllRequests()
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("select name,issuereq from books where issuereq is not null");
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }
    public static function issueLog()
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("select name,issuedby,issuedon,returnby,fine from books where issuedon is not null");
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function insertBook($uuid, $bookname)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("insert into books (uuid, name) values (? , ?)");
        $stmt->execute([$uuid, $bookname]);
    }

    public static function guidv4($data = null)
    {
        $data = $data ?? random_bytes(16);
        assert(strlen($data) == 16);

        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data) , 4));
    }
}