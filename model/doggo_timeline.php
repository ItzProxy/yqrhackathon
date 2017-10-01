<?php


/**
 * Returns the doggo_timeline table based on $id
 * @param type $id 
 */
function get_doggo_timeline_by_id($mysql_conn, $dog_id){
    $sql = mysqli_query($mysql_conn, "SELECT * 
                            FROM doggo_timeline where dog_id=$dog_id
                            ORDER BY time DESC");
    $result = mysqli_query($sql);
    if(!$result && !isset($result)){
        return false;
    }
    return true;
}
/**
 * Deletes dog timeline of the dog_id
 * @param type $dog_id
 */
function delete_doggo_timeline_by_dog_id($mysql_conn, $dog_id){
    $sql = "DELETE FROM doggo_timeline WHERE dog_id = $dog_id";
    $result = mysqli_query($sql);
    if(!$result){
        return false;
    }
    return true;
}
/**
 * Returns the doggo_timeline table based on $timeline_id
 * @param $timeline_id
 * @result = true/false if it succeeded or not
 */
function delete_doggo_timeline_by_id($mysql_conn, $timeline_id){
    $sql = "DELETE FROM doggoline where timeline_id=$timeline_id";
    $result = mysqli_query($sql);
    if(!$result){
        return false;
    }
    return true;
}

/**
 * Returns the doggo_timeline table based on $id
 * @param $dog_id 
 * @param $title
 * @param $image_path
 * @param $desc_time
 */
function insert_new_doggo_time_line($mysql_conn, $dog_id, $title, $image_path, $description_timeline){
    $sql = "INSERT INTO doggo_timeline (dog_id, title, image, desc_time, time) VALUES
    ($dog_id, $title, $image_path, $description_timeline, CURRENT_TIMESTAMP())";
    
    $result = mysqli_query($sql);
    if(!$result){
        return false;
    }
    return true;
}


?>