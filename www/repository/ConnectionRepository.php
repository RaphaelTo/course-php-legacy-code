<?php
declare(strict_types=1);

namespace Projet\Repository;

use Projet\Core\View;

class ConnectionRepository implements ConnectionInterface
{
    private $pdo;
    private $table;

    public function __construct()
    {
        try {
            $this->pdo = new \PDO(DBDRIVER.':host='.DBHOST.';dbname='.DBNAME, DBUSER, DBPWD);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (Exception $error) {
            die('Erreur SQL : '.$error->getMessage());
        }
        $this->table = get_called_class();
    }


    public function save(object $object): void
    {
        $dataObject = get_object_vars($object);
        $arrayKey[] = ['id'=> $dataObject['id'] ];
        $arrayValue= [];

        foreach ($dataObject['identity'] as $key => $item) {
            $arrayKey[]=$key;
            $arrayValue[]= $item;
        }
        foreach ($dataObject['account'] as $key => $item){
            $arrayKey[]= $key;
            $arrayValue[]=$item;
        }

        $dataChild = array_diff_key($arrayKey, get_class_vars(get_class()));

        if (!is_null($dataChild[0]['id'])) {
            $sqlUpdate = [];
            foreach ($dataChild as $key => $value) {
                if ('id' != $key) {
                    $sqlUpdate[] = $key.'=:'.$key;
                }
            }
            $sql = 'UPDATE '.$this->table.' SET '.implode(',', $sqlUpdate).' WHERE id=:id';
            $query = $this->pdo->prepare($sql);
            $query->execute($dataChild);
            $view = new View('homepage', 'back');
            header('Location: '. $view->assign('pseudo', 'prof'));
        }

        $dataChild= array_slice($dataChild,1);
        $sql = 'INSERT INTO Users ( '.
            implode(',', $dataChild).') VALUES ( :'.
            implode(',:',$dataChild).')';
        $query = $this->pdo->prepare($sql);
        $arraypush =[
            $dataChild[0] => $arrayValue[0],
            $dataChild[1] => $arrayValue[1],
            $dataChild[2] => $arrayValue[2],
            $dataChild[3] => $arrayValue[3],
            $dataChild[4] => $arrayValue[4],
            $dataChild[5] => $arrayValue[5]
        ];
        $query->execute($arraypush);
        $view = new View('homepage', 'back');
        header('Location: '. $view->assign('pseudo', 'prof'));
    }
}