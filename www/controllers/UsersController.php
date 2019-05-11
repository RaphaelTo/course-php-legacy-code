<?php
declare(strict_types=1);

namespace Projet\Controller;

use Projet\ValueObject\Identity;
use Projet\ValueObject\Account;
use Projet\Models\Users;
use Projet\Form\Form;
use Projet\Repository\ConnectionRepository;
use Projet\Core\View;
use Projet\Core\Validator;


class UsersController
{
    public function defaultAction(): void
    {
        echo 'users default';
    }

    public function addAction(): void
    {
        $formulaire = new Form();
        $form = $formulaire->getRegisterForm();

        $view = new View('addUser', 'front');
        $view->assign('form', $form);
    }

    public function saveAction(): void
    {
        $formulaire = new Form();

        $form = $formulaire->getRegisterForm();
        $method = strtoupper($form['config']['method']);
        $data = $GLOBALS['_'.$method];

        if ($_SERVER['REQUEST_METHOD'] == $method && !empty($data)) {
            $validator = new Validator($form, $data);
            $form['errors'] = $validator->errors;
            if (empty($errors)) {
                $connection = new ConnectionRepository();
                $user= new Users(new Identity($data['firstname'], $data['lastname']),new Account($data['email'], $data['pwd']));
                $connection->save($user);
            }
        }
        $view = new View('addUser', 'front');
        $view->assign('form', $form);
    }

    public function loginAction(): void
    {
        $formulaire = new Form();
        $form = $formulaire->getLoginForm();
        $method = strtoupper($form['config']['method']);
        $data = $GLOBALS['_'.$method];
        if ($_SERVER['REQUEST_METHOD'] == $method && !empty($data)) {
            $validator = new Validator($form, $data);
            $form['errors'] = $validator->errors;
            if (empty($errors)) {
                $token = md5(substr(uniqid().time(), 4, 10).'mxu(4il');
                // TODO: connexion
            }
        }
        $view = new View('loginUser', 'front');
        $view->assign('form', $form);
    }

    public function forgetPasswordAction(): void
    {
        $view = new View('forgetPasswordUser', 'front');
    }
}
