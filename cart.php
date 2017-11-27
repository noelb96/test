<?php
session_start();


if (!isset($_SESSION['watchIdArray'])) {
    $_SESSION['watchIdArray'] = array();
}

if (isset($_POST['i'])){

    $i=$_POST['i'];
    $id=$_POST['id'];
    array_push($_SESSION['watchIdArray'], $id);
    echo $i."ktu".$id;
}else{
    echo "NOT DONE";
}