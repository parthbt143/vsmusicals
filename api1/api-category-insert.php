<?php
require 'connection.php';
$response = array();

if (isset($_POST['cat_name'])) {

    $cat_name = mysqli_real_escape_string($connection,$_POST['cat_name']);

    $query = mysqli_query($connection,"insert into tbl_category (`cat_name`) values('{$cat_name}' ) ") or die(mysqli_error($connection));

    if ($query) {
        $response['flag'] = '1';
        $response["message"] = "Record Inserted ";
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