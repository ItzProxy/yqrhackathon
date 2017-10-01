<?php

require "../model/notification.php";

if(!isset($_SESSION['user'])){
    page_redirect("../login.php");
}

$number = mysql

?>