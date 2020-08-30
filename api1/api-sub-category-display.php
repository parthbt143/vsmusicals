<?php
//Require File Name 
require 'connection.php';
//Create an Blank Array
$response = array(); //Blank Array
$response["data"] = array(); // Two Dim Array Key will be Student

$query = mysqli_query($connection, "SELECT
    `tbl_category`.`cat_name`
    , `tbl_sub_category`.`sc_id`
    , `tbl_sub_category`.`sc_name`
FROM
    `db_vsm`.`tbl_category`
    INNER JOIN `db_vsm`.`tbl_sub_category` 
        ON (`tbl_category`.`cat_id` = `tbl_sub_category`.`cat_id`)") or die(mysqli_error($connection));

$count = mysqli_num_rows($query);

// check for empty result
if ($count > 0) {
  

    while ($row = mysqli_fetch_array($query)) {
        $tmp = array();

         $tmp["sc_id"] = $row["sc_id"];
         $tmp["cat_name"] = $row["cat_name"];
         $tmp["sc_name"]= $row["sc_name"];
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