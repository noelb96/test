<?php

session_start();

if (isset($_SESSION['watchIdArray']))
{
    $key = $_GET['key'];
    unset($_SESSION['watchIdArray'][$key]);
    header("Location: produkti.php?watchId=".$_GET['watchId']);


}
else
{
    header("Location: allWatch.php");
}