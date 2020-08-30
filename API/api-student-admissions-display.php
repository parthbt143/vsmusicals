<?php
//Require File Name 
require 'connection.php';
//Create an Blank Array
$response = array(); //Blank Array
$response["data"] = array(); // Two Dim Array Key will be Student
 if (isset($_POST['email'])){
        $email = mysqli_real_escape_string($connection,$_POST['email']);  
    
$query = mysqli_query($connection, "SELECT
    `tbl_admission`.`adm_id`
    , `tbl_batch`.`batch_name`
    , `tbl_student`.`stud_fname`
    , `tbl_student`.`stud_lname`
    , `tbl_admission`.`fees_remaining`
    , `tbl_admission`.`fees_total`
    , `tbl_admission`.`fees_paid`
FROM
    `db_vsm`.`tbl_admission`
    INNER JOIN `db_vsm`.`tbl_student` 
        ON (`tbl_admission`.`stud_id` = `tbl_student`.`stud_id`)
    INNER JOIN `db_vsm`.`tbl_batch` 
        ON (`tbl_admission`.`batch_id` = `tbl_batch`.`batch_id`) where `tbl_student`.`stud_email`='{$email}' ") or die(mysqli_error($connection));
 }else
 {
     $query = mysqli_query($connection, "SELECT
    `tbl_admission`.`adm_id`
    , `tbl_batch`.`batch_name`
    , `tbl_student`.`stud_fname`
    , `tbl_student`.`stud_lname`
    , `tbl_admission`.`fees_remaining`
    , `tbl_admission`.`fees_total`
    , `tbl_admission`.`fees_paid`
FROM
    `db_vsm`.`tbl_admission`
    INNER JOIN `db_vsm`.`tbl_student` 
        ON (`tbl_admission`.`stud_id` = `tbl_student`.`stud_id`)
    INNER JOIN `db_vsm`.`tbl_batch` 
        ON (`tbl_admission`.`batch_id` = `tbl_batch`.`batch_id`) where `tbl_admission`.`is_delete`=0 ") or die(mysqli_error($connection));
 
 }

$count = mysqli_num_rows($query);

// check for empty result
if ($count > 0) {
 

    while ($row = mysqli_fetch_array($query)) {
        $tmp = array();

         $tmp["adm_id"] = $row["adm_id"];
         $tmp["stud_fname"] = $row["stud_fname"];
         $tmp["stud_lname"] = $row["stud_lname"];
         $tmp["batch_name"] = $row["batch_name"];
         $tmp["fees_remaining"] = $row["fees_remaining"];
         $tmp["fees_paid"] = $row["fees_paid"];
         $tmp["fees_total"] = $row["fees_total"];
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
