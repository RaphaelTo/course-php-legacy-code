<?php declare(strict_types=1);

namespace Projet\Form;

interface FormInterface
{
    public function getRegisterForm(): array;
    public function getLoginForm(): array;
}