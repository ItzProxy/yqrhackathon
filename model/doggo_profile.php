<?php
include 'utlis.php';

//---------------add models--------------------//

//---------------select models-----------------//
/**
* Returns the dog profile by dog id
* @param $mysql_conn
* @param $id
*/
function get_doggo_profile_by_id($mysql_conn, $id){
    $result = mysqli_query($mysql_conn, "SELECT * 
            FROM dog where dog_id=$id;");
    $resultsArr = array();
    while($row = mysqli_fetch_assoc($result)){
        array_push($resultsArr, $row);
    }
    return $resultsArr;
}
/**
* Returns the dog profile by dog name
* @param $mysql_conn
* @param $name
*/
function get_doggo_profile_by_name($mysql_conn, $name){
    $result = mysqli_query($mysql_conn, "SELECT * 
            FROM dog where LOWER(name)=LOWER($name);");
    return convert_assoc_array($result);
}

//---------------delete models-----------------//
/**
* Returns the dog profile by dog name
* @param $mysql_conn
* @param $name
*/
function delete_doggo_profile_by_id($mysql_conn, $id){
    $delete = array();
    $deleteFields = "DELETE FROM DoggoField where dog_id = $id";
    $deleteTimeline = "DELETE FROM Doggo_timeline where dog_id = $id";
    $deleteDog = "DELETE FROM Dog where dog_id = $id";
    $delete.array_push($deleteTimeline);
    $delete.array_push($deleteDog);
    $delete.array_push($deleteFields);
    
    while($d = $delete.array_pop()){
        $result = mysqli_query($mysql_conn, $d);
        if(!result){
            return false; //if one of the 3 deletes don't work, notify user
        }
    }
    return true; //return true if all 3 delets work
}

//---------------update models-----------------//
function doggo_profile_edit_by_id($id, $field){
    $sql = "UPDATE doggofield 
            SET (";
    return 0;
}

function doggo_profile_edit_field($id, $field, $newfield){

}

?>