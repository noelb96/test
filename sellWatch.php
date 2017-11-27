<?php
namespace core\sellWatch;

class sellWatch
{

    private $id;
    private $name;
    private $email;
    private $phone;
    private $brand;
    private $model;
    private $price;
    private $picture;
    private $papers;
    private $lastservice;
    private $comments;

    public function __construct($id, $name, $email, $phone, $brand, $model, $price, $picture, $papers, $lastservice, $comments){
        $this -> id = $id;
        $this -> name = $name;
        $this -> email = $email;
        $this -> phone = $phone;
        $this -> brand = $brand;
        $this -> model = $model;
        $this -> price = $price;
        $this -> picture = $picture;
        $this -> papers = $papers;
        $this -> lastservice = $lastservice;
        $this -> comments = $comments;
    }

    public function getId(){
        return $this ->id;
    }

    public function setId($id){
        $this-> id = $id;
    }
    public function getName(){
        return $this ->name;
    }

    public function setName($name){
        $this-> name = $name;
    }

    public function getMail(){
        return $this ->email;
    }

    public function setMail($email){
        $this-> email = $email;
    }
    public function getPhone(){
        return $this ->phone;
    }

    public function setPhone($phone){
        $this-> phone = $phone;
    }
    public function getBrand(){
        return $this ->brand;
    }

    public function setBrand($brand){
        $this-> brand = $brand;
    }
    public function getModel(){
        return $this ->model;
    }

    public function setModel($model){
        $this-> model = $model;
    }

    public function getPrice(){
        return $this ->price;
    }

    public function setPrice($price){
        $this-> price = $price;
    }
    public function getPicture(){
        return $this ->picture;
    }

    public function setPicture($picture){
        $this-> picture = $picture;
    }
    public function getPapers(){
        return $this ->papers;
    }

    public function setPapers($papers){
        $this-> papers = $papers;
    }
    public function getLastService(){
        return $this ->lastservice;
    }

    public function setLastService($lastservice){
        $this-> lastservice = $lastservice;
    }
    public function getComments(){
        return $this ->comments;
    }

    public function setComments($comments){
        $this-> comments = $comments;
    }

}
?>