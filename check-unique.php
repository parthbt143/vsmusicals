<?php
function checkunique($connection,$tbl,$field,$data){
    $uniqueq = mysqli_query($connection, "select * from {$tbl} where {$field} = '{$data}' AND is_delete='0'") or die(mysqli_error($connection));

    $count = mysqli_fetch_array($uniqueq);

    if ($count > 0) {
        return false;
    } else {
        return true;
    }
};