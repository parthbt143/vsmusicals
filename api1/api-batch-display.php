<?php
//Require File Name 
require 'connection.php';
//Create an Blank Array
$response = array(); //Blank Array
$response["data"] = array(); // Two Dim Array Key will be Student

$query = mysqli_query($connection, " SELECT
    `tbl_course`.`course_name`
    , `tbl_employee`.`emp_name`
    , `tbl_batch`.`batch_id`
    , `tbl_batch`.`batch_name`
FROM
    `db_vsm`.`tbl_course`
    INNER JOIN `db_vsm`.`tbl_batch` 
        ON (`tbl_course`.`course_id` = `tbl_batch`.`course_id`)
    INNER JOIN `db_vsm`.`tbl_employee` 
        ON (`tbl_employee`.`emp_id` = `tbl_batch`.`emp_id`)") or die(mysqli_error($connection));

$count = mysqli_num_rows($query);

// check for empty result
if ($count > 0) {
  

    while ($row = mysqli_fetch_array($query)) {
        $tmp = array();

         $tmp["batch_id"] = $row["batch_id"];
         $tmp["batch_name"] = $row["batch_name"];
         $tmp["course_name"] = $row["course_name"];
         $tmp["emp_name"] = $row["emp_name"];
		 //Array Append
        array_push($response["data"], $tmp);
    }
    // success
    $response["flag"] = 1;
    $response["message"] = "$count Record Found";
    // echoing JSON response

} else {
    // success
    $response["flag"] = 0;
    $response["message"] = "No Record Found";
    // echoing JSON response
    
}
//echo "<pre>";
//print_r($response);
echo json_encode($response);