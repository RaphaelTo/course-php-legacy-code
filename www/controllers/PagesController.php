<?php
declare(strict_types=1);

namespace Projet\Controller;

use Projet\Core\View;
use Projet\ValueObject\Identity;

class PagesController
{
    public function defaultAction(): void
    {
        $v = new View('homepage', 'back');
        $v->assign('pseudo', 'prof');
    }
}
