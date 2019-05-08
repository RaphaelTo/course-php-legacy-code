<?php declare(strict_types=1);

namespace Projet\ValueObject;

class Account{

    private $email;
    private $pwd;
    private $role;
    private $status;

    public function __construct(string $email = null, string $pwd = null)
    {
        $this->email=strtolower(trim($email));
        $this->pwd= password_hash($pwd, PASSWORD_DEFAULT);
        $this->role = 1;
        $this->status = 0;
    }

    public function Email(): string
    {
        return $this->email;
    }

    public function Pwd(): string
    {
        return $this->pwd;
    }

    public function Role(): int
    {
        return $this->role;
    }

    public function Status(): int
    {
        return $this->status;
    }
}