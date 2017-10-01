<?php
$file = $_FILE['media-file'];
if(!isset($file)){
    error_log("No file");
    return false;
}
$target_dir = "../";
$target_file = "/doggo".$session_id;
$file_type = pathinfo($file);
switch($file_type['extension']){
    case "jpg":
    case "gif":
    case "png":
        $target_dir .= "img/";
        if($type == "profile"){
            $target_dir .= "profile/";
        }
        else{
            $target_dir .= "dog/";
        }
        $target_dir .= $target_file.$file_type;
        break;
    case "mp4":
        $target_dir .= "videos/".$target_file.$file_type;
        break;
    default:
        echo "No File";
        return false;
        
}
if(move_uploaded_file($file['media-file'],$target_dir)){
    return $target_file;
}
else{
    return false; //messed up
}

?>