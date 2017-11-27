<?php
namespace core\sellWatch;


use core\Database;
use core\logic\CRUD as crud;
use \PDO;

include_once ("CRUD.php");
include_once("Database.php");
include_once("sellWatch.php");


class crud_ implements crud{

    private $insert_query           = "INSERT INTO `sellwatch`( name, email, phone, brand, model, price, picture, papers, lastservice, comments) VALUES (:name ,:email ,:phone ,:brand, :model, :price, :picture, :papers, :lastservice, :comments )";

    private $db_object;
    private $db;

    public function __construct()
    {
        $this->db_object = new Database();
        $this->db=$this->db_object->get_db();
    }

    public function create($object)
    {

            $stmt=$this->db->prepare($this->insert_query);
            $stmt->bindValue(":name", $object->getName(), PDO::PARAM_STR);
            $stmt->bindValue(":email", $object->getMail(), PDO::PARAM_STR);
            $stmt->bindValue(":phone", $object->getPhone(), PDO::PARAM_STR);
            $stmt->bindValue(":brand", $object->getBrand(), PDO::PARAM_STR);
            $stmt->bindValue(":model", $object->getModel(), PDO::PARAM_STR);
            $stmt->bindValue(":price", $object->getPrice(), PDO::PARAM_STR);
            $stmt->bindValue(":picture", $object->getPicture(), PDO::PARAM_STR);
            $stmt->bindValue(":papers", $object->getPapers(), PDO::PARAM_STR);
            $stmt->bindValue(":lastservice", $object->getLastService(), PDO::PARAM_STR);
            $stmt->bindValue(":comments", $object->getComments(), PDO::PARAM_STR);

            $stmt->execute();

    }

    public function read($id = -1)
    {

    }

    public function update($object, $id)
    {

    }

    public function delete($id)
    {

    }
}
?>