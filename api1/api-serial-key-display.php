<?php
//Require File Name 
require 'connection.php';
//Create an Blank Array
$response = array(); //Blank Array
$response["data"] = array(); // Two Dim Array Key will be Student

$query = mysqli_query($connection, "SELECT
    `tbl_product`.`pro_name`
    , `tbl_serial_no`.`sn_id`
    , `tbl_serial_no`.`sn_num`
    , `tbl_serial_no`.`sn_sold`
FROM
    `db_vsm`.`tbl_product`
    INNER JOIN `db_vsm`.`tbl_serial_no` 
        ON (`tbl_product`.`pro_id` = `tbl_serial_no`.`pro_id`) ") or die(mysqli_error($connection));

$count = mysqli_num_rows($query);

// check for empty result
if ($count > 0) {
  

    while ($row = mysqli_fetch_array($query)) {
        $tmp = array();

         $tmp["sn_id"] = $row["sn_id"];
         $tmp["pro_name"] = $row["pro_name"];
         $tmp["sn_num"] = $row["sn_num"];
         $tmp["sn_sold"] = $row["sn_sold"];
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