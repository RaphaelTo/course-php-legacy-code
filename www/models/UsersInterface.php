<?php declare(strict_types=1);

namespace Projet\Models;

interface UsersInterface
{
    public function getRegisterForm(): array;
    public function getLoginForm(): array;
}