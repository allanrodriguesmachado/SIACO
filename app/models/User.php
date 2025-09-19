<?php

namespace App\models;

use PDO;

class User extends UserModel
{
    protected static array $self = ["id", "created_at", "created_at"];
    protected static string $entity = "users";

    public function load(int $id, string $columns = "*"): object|false|string|null
    {
        $read = $this->read("SELECT {$columns} FROM " . self::$entity . " WHERE id = :id", "id={$id}");

        return ($this->fail() || !$read->rowCount())
            ? $this->message = "User not found"
            : $read->fetchObject(__CLASS__);
    }

    public function find(string $email, string $columns = "*"): object|false|string|null
    {
        $read = $this->read("SELECT {$columns} FROM " . self::$entity . " WHERE e_mail = :e_mail", "e_mail={$email}");

        return ($this->fail() || !$read->rowCount())
            ? $this->message = "User not found"
            : $read->fetchObject(__CLASS__);
    }

    public function all(int $limit = 2, int $offset = 0, string $columns = "*"):  object|false|string|null|array
    {
        $read = $this->read("SELECT {$columns} FROM " . self::$entity . " LIMIT :limit OFFSET :offset", "limit={$limit}&offset={$offset}");


        return ($this->fail() || !$read->rowCount())
            ? $this->message = "User not found"
            : $read->fetchAll(PDO::FETCH_CLASS,__CLASS__);
    }
}