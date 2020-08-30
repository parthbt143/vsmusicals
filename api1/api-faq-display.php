<?php
//Require File Name 
require 'connection.php';
//Create an Blank Array
$response = array(); //Blank Array
$response["data"] = array(); // Two Dim Array Key will be Student

$query = mysqli_query($connection, " SELECT
    `tbl_faq`.`faq_id`
    , `tbl_product`.`pro_name`
    , `tbl_faq`.`faq_que`
    , `tbl_faq`.`faq_ans`
FROM
    `db_vsm`.`tbl_product`
    INNER JOIN `db_vsm`.`tbl_faq` 
        ON (`tbl_product`.`pro_id` = `tbl_faq`.`pro_id`)") or die(mysqli_error($connection));

$count = mysqli_num_rows($query);

// check for empty result
if ($count > 0) {
  

    while ($row = mysqli_fetch_array($query)) {
        $tmp = array();

         $tmp["faq_id"] = $row["faq_id"];
         $tmp["pro_name"] = $row["pro_name"];
         $tmp["faq_que"] = $row["faq_que"];
         $tmp["faq_ans"] = $row["faq_ans"];
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