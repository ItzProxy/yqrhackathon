<?php

function get_events_by_dog($mysql_conn,$dog_id){
    $query = "SELECT * FROM rezq_dog_events WHERE ev_dg_id=$dog_id";
    $result = mysqli_query($mysql_conn, $query);
    $result_arr = array();
    while($row = mysqli_fetch_assoc($result)){
        array_push($result_arr, $row);
    }
    return $result_arr;
}

function get_events_by_id($mysql_conn,$event_id){
    $query = "SELECT * FROM rezq_dog_events WHERE ev_id=$event_id";
    $result = mysqli_query($mysql_conn, $query);
    $result_arr = array();
    while($row = mysqli_fetch_assoc($result)){
        array_push($result_arr, $row);
    }
    return $result_arr;
}

function delete_event_by_id($mysql_conn,$event_id){
    $query = "DELETE FROM rezq_dog_events WHERE ev_id=$event_id";
    return mysqli_query($mysql_conn, $query);
}

function insert_event($mysql_conn,$title,$description,$media_path,$media_type
        ,$event_type,$dog_id){
    $time = "Posted on";
    $query = "INSERT INTO rezq_dog_events VALUES(null,'$title','$description','$time',".
            "'$media_type','$media_path','$event_type',$dog_id)";
    return mysqli_query($mysql_conn, $query);
}   

?>