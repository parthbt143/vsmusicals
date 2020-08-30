
<?php
include 'connection.php';
  
    if((!isset($_GET['page']) || empty($_GET['page']) ) ||(!isset($_GET['did']) || empty($_GET['did']) ) || (!isset($_GET['tbl']) || empty($_GET['tbl']) ) || (!isset($_GET['pk']) || empty($_GET['pk']) ) )  
    {
       
        header("location:index.php") ;  
    }
    $tbl = $_GET['tbl'];
    $did = $_GET['did'];
    $pk = $_GET['pk'];
    $page = $_GET['page'];
    $selectq = mysqli_query($connection, "update $tbl set is_delete='1' where $pk= {$did}") or die(mysqli_error($connection));
    header("location:$page") ;
?>