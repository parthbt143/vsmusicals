<?php
//Require File Name 
require 'connection.php';
//Create an Blank Array
$response = array(); //Blank Array
$response["data"] = array(); // Two Dim Array Key will be Student

$query = mysqli_query($connection, " SELECT
    `tbl_customer`.`cust_photo`
    , `tbl_customer`.`cust_address`
    , `tbl_customer`.`cust_email`
    , `tbl_customer`.`cust_mobile`
    , `tbl_customer`.`cust_gender`
    , `tbl_customer`.`cust_lname`
    , `tbl_customer`.`cust_fname`
    , `tbl_customer`.`cust_id`
    , `tbl_area`.`area_name`
FROM
    `db_vsm`.`tbl_area`
    INNER JOIN `db_vsm`.`tbl_customer` 
        ON (`tbl_area`.`area_id` = `tbl_customer`.`area_id`)") or die(mysqli_error($connection));

$count = mysqli_num_rows($query);

// check for empty result
if ($count > 0) {
  

    while ($row = mysqli_fetch_array($query)) {
        $tmp = array();

         $tmp["cust_id"] = $row["cust_id"];
         $tmp["cust_fname"] = $row["cust_fname"];
         $tmp["cust_lname"] = $row["cust_lname"];
         $tmp["cust_gender"] = $row["cust_gender"];
         $tmp["cust_email"] = $row["cust_email"];
         $tmp["cust_mobile"] = $row["cust_mobile"];
         $tmp["cust_address"] = $row["cust_address"];
         $tmp["area_name"] = $row["area_name"];
         $tmp["cust_photo"] = $row["cust_photo"];
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