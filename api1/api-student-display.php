`<?php
//Require File Name 
require 'connection.php';
//Create an Blank Array
$response = array(); //Blank Array
$response["data"] = array(); // Two Dim Array Key will be Student

$query = mysqli_query($connection, "SELECT
    `tbl_student`.`stud_id`
    , `tbl_student`.`stud_fname`
    , `tbl_student`.`stud_lname`
    , `tbl_student`.`stud_gender`
    , `tbl_student`.`stud_dob`
    , `tbl_student`.`stud_mobile`
    , `tbl_student`.`stud_email`
    , `tbl_student`.`stud_address`
    , `tbl_area`.`area_name`
FROM
    `db_vsm`.`tbl_area`
    INNER JOIN `db_vsm`.`tbl_student` 
        ON (`tbl_area`.`area_id` = `tbl_student`.`area_id`) ") or die(mysqli_error($connection));

$count = mysqli_num_rows($query);

// check for empty result
if ($count > 0) {
  

    while ($row = mysqli_fetch_array($query)) {
        $tmp = array();

         $tmp["stud_id"] = $row["stud_id"];
         $tmp["stud_fname"] = $row["stud_fname"];
         $tmp["stud_lname"] = $row["stud_lname"];
         $tmp["stud_gender"] = $row["stud_gender"];
         $tmp["stud_dob"] = $row["stud_dob"];
         $tmp["stud_photo"] = $row["stud_photo"];
         $tmp["stud_email"] = $row["stud_email"];
         $tmp["stud_mobile"] = $row["stud_mobile"];
         $tmp["stud_address"] = $row["stud_address"];
         $tmp["area_name"] = $row["area_name"];
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