<?php
/**
*
*
*
*/
function get_all_rezq_notification($mysql_conn){
    $sql = "SELECT * FROM rezq_notifications";
    $result = mysqli_query($mysql_conn, $sql);
    
    return convert_assoc_array($result);
}

function get_rezq_notification_for_user($mysql_conn, $user){
    $user_id = $user['us_id'];
    $sql = "SELECT * from rezq_notifications where nf_by_users = $user_id";
    $result = mysqli_query($mysql_conn, $sql);

    return $result;
}

function get_rezq_notification_for_user_2($mysql_conn,$user_email){
    $sql = "SELECT * from rezq_notifications where lower(nf_for_users) like '%$user_email%'";
    $result = mysqli_query($mysql_conn, $sql);
    return convert_assoc_array($result);
}


/**
*Inserts into rezq notification
* @param mysql_conn
* @param nf_by_user
* @param nf_for_users
* @param nf_level
* @param nf_subject
* @param nf_body
* @result true or false depending on query success
*/

function insert_rezq_notification($mysql_conn, $nf_by_user, 
                                    $nf_for_users, $nf_level, 
                                    $nf_subject, $nf_body){
            
    $nf_body = addslashes($nf_body);
    $nf_subject = addslashes($nf_subject);
    $sql = "INSERT INTO rezq_notifications VALUES". 
            "(null,$nf_by_user,'$nf_for_users','$nf_level','$nf_subject','$nf_body') ";
    $result = mysqli_query($mysql_conn, $sql);
    echo $sql;
    if(!$result){
        error_log("Error querying database.");
        return false;
    }
    return true;//succeed
}

function update_rezq_nf_by_id($mysql_conn, $id, $nf_by_user, $nf_for_users, 
                                $nf_level,$nf_subject, $nf_body){
     
    $sql = "UPDATE rezq_notification SET ";
    $sql .= !empty($nf_by_user) ? "nf_by_user = '$nf_by_user'": "";
    $sql .= !empty($nf_for_users) ? "nf_for_users = '$nf_for_users'," : "";
    $sql .= !empty($nf_level) ? "nf_level = '$nf_level'," : "";
    $sql .= !empty($nf_subject) ? "nf_subject = $nf_subject" : "";
    $sql .= !empty($nf_body) ? "nf_body = $nf_body" : "";
    $sql .= " WHERE dg_id=$id";

    $result = mysqli_query($mysql_conn, $sql);

    if(!$result){
        echo "fail";
        error_log("Error querying database. - update_rezq_nf_by_id");
        return false;
    }
    return true;//succeed       

}

function update_rezq_nf_level_by_id($mysql_conn, $id, $nf_level){
    $sql = "UPDATE rezq_notification SET (nf_level=$nf_level) WHERE ev_id=$id";
    $result = mysqli_query($mysql_conn, $sql);
    
        if(!$result){
            error_log("Error querying database-rezq_nf.");
            return false;
        }
        return true;//succeed
}

?>