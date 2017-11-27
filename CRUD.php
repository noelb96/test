<?php
/**
 * Created by PhpStorm.
 * User: noelb
 * Date: 10/8/2017
 * Time: 8:02 PM
 */
namespace core\logic;


interface CRUD
{
    public function create($object);
    public function read($id = -1);
    public function update($object, $id);
    public function delete($id);
}
?>
