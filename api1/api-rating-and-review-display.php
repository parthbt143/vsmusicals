<?php
//Require File Name 
require 'connection.php';
//Create an Blank Array
$response = array(); //Blank Array
$response["data"] = array(); // Two Dim Array Key will be Student

$query = mysqli_query($connection, " SELECT
    `tbl_customer`.`cust_fname`
    , `tbl_customer`.`cust_lname`
    , `tbl_product`.`pro_name`
    , `tbl_ratings_and_review`.`rating`
    , `tbl_ratings_and_review`.`review`
    , `tbl_ratings_and_review`.`rr_id`
FROM
    `db_vsm`.`tbl_customer`
    INNER JOIN `db_vsm`.`tbl_ratings_and_review` 
        ON (`tbl_customer`.`cust_id` = `tbl_ratings_and_review`.`cust_id`)
    INNER JOIN `db_vsm`.`tbl_product` 
        ON (`tbl_product`.`pro_id` = `tbl_ratings_and_review`.`pro_id`)") or die(mysqli_error($connection));

$count = mysqli_num_rows($query);

// check for empty result
if ($count > 0) {
  

    while ($row = mysqli_fetch_array($query)) {
        $tmp = array();

         $tmp["rr_id"] = $row["rr_id"];
         $tmp["cust_fname"] = $row["cust_fname"];
         $tmp["cust_lname"] = $row["cust_lname"];
         $tmp["pro_name"] = $row["pro_name"];
         $tmp["review"] = $row["review"];
         $tmp["rating"] = $row["rating"];
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