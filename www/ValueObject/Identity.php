<?php declare(strict_types=1);

namespace Projet\ValueObject;

class Identity
{
    private $firstname;
    private $lastname;

    public function __construct(string $firstname, string $lastname)
    {
        $this->firstname=$firstname;
        $this->lastname=$lastname;
    }

    public function Firstname(): string
    {
        return $this->firstname;
    }

    public function Lastname(): string
    {
        return $this->lastname;
    }

}