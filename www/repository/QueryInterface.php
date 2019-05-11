<?php declare(strict_types=1);

namespace Projet\Repository;

interface QueryInterface{
    public function setId(int $id): void;
    public function getOneBy(array $where, bool $object = false): array;
}