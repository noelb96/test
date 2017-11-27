<?php
session_start();

if (isset($_SESSION['userId']))
{
    session_destroy();
    header("Location: homepage.php");
}
else
{
    header("PHP_SELF");
}