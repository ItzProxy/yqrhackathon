<?php
/**
* @param $id
* @return type array
*/

function get_rezq_all_dogs($mysql_conn){
    $sql = "SELECT * from rezq_dogs";
    $result = mysqli_query($mysql_conn, $sql);

    if(!$result){
        error_log("Error querying database.");
        return false;
    }
    return convert_assoc_array($result);
}

function get_rezq_dogs_by_user($mysql_conn,$user){
    $sql = "SELECT * from rezq_dogs WHERE dg_care_of=$user";
    $result = mysqli_query($mysql_conn, $sql);

    if(!$result){
        error_log("Error querying database.");
        return false;
    }
    return convert_assoc_array($result);
}

function get_rezq_dogs_by_id($mysql_conn,$id){
    $sql = "SELECT * from rezq_dogs WHERE dg_id=$id";
    $result = mysqli_query($mysql_conn, $sql);

    if(!$result){
        error_log("Error querying database.");
        return false;
    }
    return convert_assoc_array($result);
}

function get_rezq_dogs_by_name($mysql_conn, $name){
    $sql = "SELECT * from rezq_dogs WHERE dg_name=$name";
    $result = mysqli_query($mysql_conn, $sql);

    if(!$result){
        error_log("Error querying database.");
        return false;
    }
    return convert_assoc_array($result);
}

function update_rezq_dogs_by_id($mysql_conn, $id, $dg_name, $dg_description,$dg_profile_pic, $dg_care_of){
    
    $sql = "UPDATE rezq_dogs SET ";
    $sql .= !empty($dg_name) ? "dg_name = '$dg_name'": "";
    $sql .= !empty($dg_description) ? "dg_description = '$dg_description'," : "";
    $sql .= !empty($dg_profile_pic) ? "dg_profile_pic = 'urlencode($dg_profile_pic)'," : "";
    $sql .= !empty($dg_care_of) ? "dg_care_of = $dg_care_of" : "";
    $sql .= " WHERE dg_id=$id";

    $result = mysqli_query($mysql_conn, $sql);

    if(!$result){
        echo "fail";
        error_log("Error querying database.");
        return false;
    }
    return true;//succeed
}

function delte_rezq_dogs_by_id($mysql_conn, $id){
    $sql = "DELETE from rezq_dogs where dg_id=$id";
}
?>