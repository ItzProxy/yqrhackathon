<?php
/**
* @param $user_email
* @param $user_password
*
*
*/

function dg_user_login($mysql_conn,$user_email, $user_password){
//    $passHash = hash("sha512",$user_password,false);
    $sql = "SELECT * FROM rezq_users WHERE us_email = '$user_email' AND ".
                    "us_password = '$user_password'";

    $result = mysqli_query($mysql_conn,$sql);
    if(!$result){
        error_log("Could not connect to database");
        return false;
    }

    if(mysqli_num_rows($result) <= 0){
        return false; //no data so does not exist with credentials
    }

    return convert_assoc_array($result);
}

function get_dg_user_by_user_mail($mysql_conn, $email){
    $sql = "SELECT * FROM rezq_users WHERE LOWER(us_email) = LOWER('$email')";
    $result = mysqli_query($mysql_conn, $sql);
    var_dump($sql);
    if(!$result){
        error_log("Could not connect to database");
        return false;
    }

    if(mysqli_num_rows($result) <= 0){
        return false; //no data so does not exist with credentials
    }

    return convert_assoc_array($result);
}

function get_dg_user_by_id($mysql_conn, $id){
    $sql = "SELECT * FROM rezq_users WHERE us_id = $id";
    $result = mysqli_query($mysql_conn,$sql);
    if(!$result){
        error_log("Could not connect to database");
        return false;
    }

    if(mysqli_num_rows($result) <= 0){
        return false; //no data so does not exist with credentials
    }

    return convert_assoc_array($result);
}

function update_dg_user_pass_by_id($old_pass, $new_pass, $us_email){
    $user = get_dg_user_by_user_mail($us_email);
    
    if(!$user){
        error_log("Unable to query database or invalid user_email");
        return false;
    }
    $this_id = $user['us_id'];
    if($user['us_password'] == $old_pass){
        $sql = "UPDATE dg_user SET us_password = $new_pass where us_id = $this_id";
        $result = mysqli_query($mysql_conn, $sql);

        if(!$sql){
            return false;
        }
        return true;
    }
}
/**
* Updates the resq_user with information of pre-existing users
* @param $mysql_conn
* @param $id
* @param $us_email
* @param $us_role
* @param $us_first_name
* @param $us_last_name
* @param $us_profile_pic
* @result true or false depending on success
**/
function update_us_user_by_id($mysql_conn, $id, $us_email, $us_role, $us_first_name, $us_last_name, $us_profile_pic){
    $sql = "UPDATE rezq_user SET ";
    $sql .= !empty($us_email) ? "us_email = '$us_email'": "";
    $sql .= !empty($us_role) ? "us_role = '$us_role'," : "";
    $sql .= !empty($us_first_name) ? "us_first_name = '$us_first_name'," : "";
    $sql .= !empty($us_last_name) ? "us_last_name = $us_last_name" : "";
    $sql .= !empty($us_profile_pic) ? "us_profile_pic = $us_profile_pic" : "";
    $sql .= " WHERE us_id=$id";

    $result = mysqli_query($mysql_conn, $sql);
    
        if(!$result){
            echo "fail";
            error_log("Error querying database.");
            return false;
        }
        return true;//succeed
}
function delete_us_user_by_id($mysql_conn,$id){
    //does nothing
}

?>