<?php
/**
 * Created by PhpStorm.
 * User: noelb
 * Date: 11/24/2017
 * Time: 11:33 PM
 */
session_start();

if (isset($_SESSION['watchIdArray']))
{
    $key = $_GET['key'];
    unset($_SESSION['watchIdArray'][$key]);
    header("Location: allWatch.php");


}
else
{
    header("Location: allWatch.php");
}