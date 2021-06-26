<?php
namespace Model;

class AddBooks
{

    public static function insertBook($uuid, $bookname)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("insert into books (uuid, name) values (? , ?)");
        $stmt->execute([$uuid, $bookname]);
    }

}