<?php

setcookie("adminid","",time()-3600);
header("location:login.php");
?>