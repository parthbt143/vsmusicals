<?php
if(!isset($_COOKIE['adminid']))
{
    header("location:login.php");
}
