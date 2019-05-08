<?php
declare(strict_types=1);

namespace Projet\Controller;

use Projet\Models\Users;
use Projet\Repository\ConnectionRepository;
use Projet\Core\View;
use Projet\Core\Validator;
use Projet\ValueObject\Account;
use Projet\ValueObject\Identity;

class UsersController
{
    public function defaultAction(): void
    {
        echo 'users default';
    }

    public function addAction(): void
    {
        $user = new Users();
        $form = $user->getRegisterForm();

        $v = new View('addUser', 'front');
        $v->assign('form', $form);
    }

    public function saveAction(): void
    {
        $user = new Users();
        $form = $user->getRegisterForm();
        $method = strtoupper($form['config']['method']);
        $data = $GLOBALS['_'.$method];

        if ($_SERVER['REQUEST_METHOD'] == $method && !empty($data)) {
            $validator = new Validator($form, $data);
            $form['errors'] = $validator->errors;

            if (empty($errors)) {
                $connection = new ConnectionRepository();
                $user->setIdentity(new Identity($data['firstname'],$data['lastname']));
                //$identity = new Identity($data['firstname'],$data['lastname']);
                //var_dump(new Identity($data['firstname'],$data['lastname']));
                //$account = new Account($data['email'],$data['pwd']);
                //var_dump($identity);
                //$user->setIdentity($identity);
                //$user->setAccount($account);
                $connection->save();

            }
        }
        $v = new View('addUser', 'front');
        $v->assign('form', $form);
    }

    public function loginAction(): void
    {
        $user = new Users();
        $form = $user->getLoginForm();

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
        $v = new View('loginUser', 'front');
        $v->assign('form', $form);
    }

    public function forgetPasswordAction(): void
    {
        $v = new View('forgetPasswordUser', 'front');
    }
}
