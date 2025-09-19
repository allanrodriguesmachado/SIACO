<?php

namespace App\models;

use App\database\Connnect;
use PDOException;
use stdClass;

abstract class UserModel
{
    protected ?object $data;
    protected ?PDOException $fail = null;
    protected ?string $message;

    public function __set(string $name, $value): void
    {
       if (empty($this->data)) {
           $this->data = new StdClass();
       }

       $this->data->$name = $value;
    }
    public function __get(string $name)
    {
        return ($this->data->$name ?? null);
    }

    public function __isset(string $name): bool
    {
        return isset($this->data->$name);
    }

    public function data(): ?object
    {
        return $this->data;
    }

    public function fail(): ?PDOException
    {
        return $this->fail;
    }

    public function message(): ?string
    {
        return $this->message;
    }

    protected function read(string $select, string $params)
    {
        try {
            $stmt = Connnect::getInstance();
            $pdo_stmt = $stmt->prepare($select);
            parse_str($params, $bound_params);
            $pdo_stmt->execute($bound_params);
            return $pdo_stmt;
        }catch (PDOException $exception) {
            $this->fail = $exception->getMessage();
        }
    }
}

