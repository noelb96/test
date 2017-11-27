<?php
namespace core;

use \PDO;

class Database
{
    private $DB_USER = "thewatm9_eni";
    private $DB_PASS = "Polo1951,,,";
    private $DB_NAME = "thewatm9_main";
    private $DB_HOST = "162.241.244.59";

    private $db;

    public function __construct(){
        $this->db = new PDO('mysql:host='.$this->DB_HOST.';dbname='.$this->DB_NAME.';charset=utf8' , $this->DB_USER, $this->DB_PASS);
    }

    public function get_db()
    {
        return $this->db;
    }

    public function __destruct()
    {
        $this->db = null;
    }
}
?>