<?php

require 'connection.php';

$response = array();



if (isset($_POST['cat_id']) && ($_POST['cat_name']) ) {
    $cat_id = mysqli_real_escape_string($connection, $_POST['cat_id']);
    $cat_name = mysqli_real_escape_string($connection, $_POST['cat_name']);


//Check ID Record is Present or not 
    $selectquery = mysqli_query($connection, "select * from tbl_category where cat_id= {$cat_id}") or die(mysqli_error($connection));
    $count = mysqli_num_rows($selectquery);

	//If Record Present then Fire Update Query
    if ($count > 0) {

        $updatequery = mysqli_query($connection,"update tbl_category set `cat_name`='{$cat_name}' where cat_id='{$cat_id}'") or die(mysqli_error($connection));
        if ($updatequery) {
            $response['flag'] = '1';
            $response["message"] = "Record Updated ";
        } else {
            $response['flag'] = '0';
            $response["message"] = "Error in Query ";
        }
    } else {
        $response['flag'] = '0';
        $response["message"] = "Record Not Found ";
    }
 
}
else {
    $response['flag'] = '0';
    $response["message"] = "Required Field Is Missing ";
}

echo json_encode($response);