<?php
declare(strict_types=1);

namespace Projet\Controller;

use Projet\Core\View;
use Projet\ValueObject\Identity;

class PagesController
{
    public function defaultAction(): void
    {
        $view = new View('homepage', 'back');
        $view->assign('pseudo', 'prof');
    }
}
