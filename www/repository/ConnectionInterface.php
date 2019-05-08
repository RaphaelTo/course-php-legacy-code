<?php declare(strict_types=0);

namespace Projet\Repository;

interface ConnectionInterface{
    public function save(object $object): void;
}
