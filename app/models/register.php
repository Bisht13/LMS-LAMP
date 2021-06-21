<?php
namespace Model;

class Register
{
    public static function create($uuid, $email, $hash)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("INSERT INTO users VALUES (?, ?, ?, 0)");
        $stmt->execute([$uuid, $email, $hash]);
    }

    public static function find($email)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        $row = $stmt->fetch();
        return $row;
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

