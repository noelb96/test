<?php

session_start();
if (isset($_SESSION['watchIdArray']))
{
    unset($_SESSION["watchIdArray"]);
    header("Location: allWatch.php");
}
else
{
    header("Location: allWatch.php");
}