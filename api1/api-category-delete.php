<?php

require 'connection.php';
$response = array();

if (isset($_POST['cat_id']) ) {

    $id = mysqli_real_escape_string($connection,$_POST['cat_id']);
   
    $query = mysqli_query($connection," delete from tbl_category where cat_id='{$id}'") or die(mysqli_error($connection));

    if ($query) {
        $response['flag'] = '1';
        $response["message"] = "Record Deleted ";
    } else {
        $response['flag'] = '0';
        $response["message"] = "Error in Query";
    }
    
} else {
    $response['flag'] = '0';
    $response["message"] = "Required Field Is Missing ";
}

echo json_encode($response);
?>