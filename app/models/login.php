<?php
namespace Model;

class Login
{
    public static function find($email)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        $row = $stmt->fetch();
        return $row;
    }

}