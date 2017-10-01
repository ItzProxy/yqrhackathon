<?php

function get_rezq_dog_details_by_id($mysql_conn, $id){

    $sql = "SELECT * from rezq_dog_details where dg_id=$id";

    $result = mysqli_query($mysql_conn, $sql);
    
        if(!$result){
            error_log("Error querying database.");
            return false;
        }
        return convert_assoc_array($result);
}

function update_rezq_details_by_field($mysql_conn, $field_name, $new_field_name){
    $sql = "UPDATE rezq_dog_details SET dg_field = $new_field_name 
            WHERE LOWER(dg_field)=LOWER($field_name)";
    $result = mysqli_query($mysql_conn, $sql);
    
        if(!$result){
            error_log("Error updating database.");
            return false;
        }
        return true; //successfully updated database
}

function update_rezq_details_value_by_field($mysql_conn, $field_name, $new_value){
    $sql = "UPDATE rezq_dog_details SET dg_field = $new_field_name 
    WHERE LOWER(dg_field)=LOWER($field_name)";
        $result = mysqli_query($mysql_conn, $sql);

        if(!$result){
            error_log("Error updating database.");
            return false;
        }
        return true; //successfully updated database
}

//function insert_rezq_details_value_field($mysql_conn, $field_name, $value){
//    $sql ="";
//    $check = "SELECT dg_field WHERE LOWER(dg_field) = LOWER($field_name)";
//    if(mysqli_num_rows(mysqli_query($mysql_conn, $check))>0){
//        $sql = 
//    }
//}

?>