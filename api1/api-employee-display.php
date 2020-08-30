<?php
//Require File Name 
require 'connection.php';
//Create an Blank Array
$response = array(); //Blank Array
$response["data"] = array(); // Two Dim Array Key will be Student

$query = mysqli_query($connection, "SELECT
    `tbl_employee`.`emp_id`
    , `tbl_employee`.`emp_name`
    , `tbl_employee`.`emp_gender`
    , `tbl_employee`.`emp_mobile`
    , `tbl_employee`.`emp_address`
    , `tbl_employee`.`emp_photo`
    , `tbl_employee`.`salary`
    , `tbl_designation`.`des_name`
    , `tbl_area`.`area_name`
    
FROM
    `db_vsm`.`tbl_designation`
    INNER JOIN `db_vsm`.`tbl_employee` 
        ON (`tbl_designation`.`des_id` = `tbl_employee`.`des_id`)
    INNER JOIN `db_vsm`.`tbl_area` 
        ON (`tbl_area`.`area_id` = `tbl_employee`.`area_id`) ") or die(mysqli_error($connection));

$count = mysqli_num_rows($query);

// check for empty result
if ($count > 0) {
  

    while ($row = mysqli_fetch_array($query)) {
        $tmp = array();

         $tmp["emp_id"] = $row["emp_id"];
         $tmp["emp_name"] = $row["emp_name"];
         $tmp["emp_gender"] = $row["emp_gender"];
         $tmp["des_name"] = $row["des_name"];
         $tmp["emp_mobile"] = $row["emp_mobile"];
         $tmp["emp_address"] = $row["emp_address"];
         $tmp["area_name"] = $row["area_name"];
         $tmp["salary"] = $row["salary"];
         $tmp["emp_photo"] = $row["emp_photo"];
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