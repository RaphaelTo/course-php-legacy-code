<?php

declare(strict_types=1);

namespace Projet\Models;

use Projet\ValueObject\Account;
use Projet\ValueObject\Identity;

class Users
{
    private $id;
    public $identity;
    public $account;

    public function __construct(Identity $identity, Account $account)
    {
        $this->id = rand(1,500000000);
        $this->identity = $identity;
        $this->account = $account;
    }

    public function setIdentity(Identity $identity): void
    {
        $this->identity = $identity;
    }

    public function setAccount(Account $account): void
    {
        $this->account = $account;
    }

}
