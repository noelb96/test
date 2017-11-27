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
    private $select_query_all       = "SELECT * FROM `sellwatch` WHERE 1";
    private $select_query           = "SELECT * FROM `sellwatch` WHERE  id=:id";
//    private $select_query_by_type   = "SELECT * FROM `events` WHERE  eventID=:eventID AND type=:type";
//    private $update_query           = "UPDATE `events` SET  name=:name, descr=:descr, path=:path, startTime=:startTime, endTime=:endTime, type=:type WHERE eventID=:eventID";
//    private $delete_query           = "DELETE FROM `events` WHERE eventID=:eventID";


    private $db_object;
    private $db;

    public function __construct()
    {
        $this->db_object = new Database();
        $this->db=$this->db_object->get_db();
    }

    public function create($object)
    {
        $return_array = array(
            "success" =>true,
            "message" => ""
        );
//
//        $validation = new Validate();
//        if(!$validation->eventName($event->getName())){
//            $event->getName();
//            $return_array['success']= false;
//            $return_array['message']= $validation->get_event_name_criteria();
//        }


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
//            return $return_array;

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