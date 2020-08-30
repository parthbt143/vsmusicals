<?php
//Require File Name 
require 'connection.php';
//Create an Blank Array
$response = array(); //Blank Array
$response["data"] = array(); // Two Dim Array Key will be Student
if(isset($_POST['pro_id'])){
    $pro = $_POST['pro_id'];
    $query = mysqli_query($connection, "SELECT * FROM `tbl_photo` where is_delete = '0' AND pro_id = '{$pro}' ") or die(mysqli_error($connection));
}else{
    

$query = mysqli_query($connection, "SELECT * FROM `tbl_photo` where is_delete = '0' ") or die(mysqli_error($connection));
}
$count = mysqli_num_rows($query);

// check for empty result
if ($count > 0) {
  

    while ($row = mysqli_fetch_array($query)) {
        $tmp = array();

         $tmp["photo_id"] = $row["photo_id"];
         $tmp["pro_id"] = $row["pro_id"];
         $tmp["photo_path"] = $row["photo_path"];
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