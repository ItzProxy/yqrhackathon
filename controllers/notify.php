<?php
require 'email.php';
require '../model/utils.php';
require '../model/rezq_notifications.php';

$to= "";
if(isset($_POST['to'])){
    $to = $_POST['to'];
} else{
    $to = "yashghatti@gmail.com";
}
$subject = $_POST['subject'];
$body = $_POST['message'];

$type = "event";
if(isset($_POST["urgent"])&& $_POST["urgent"]=="on"){
    send_email($to,$subject,$body);
    $type = "alert";
}

$conn = db_connect();
insert_rezq_notification($conn,$_SESSION['user']['us_id'],$to,$type,$subject,$body);
db_close($conn);

page_redirect("../#!/people");
//
?>