<?php
require '../model/utils.php';
require '../model/resq_user.php';

$username = $_POST["username"];
$password = $_POST["password"];

$conn = db_connect();
$user = dg_user_login($conn,$username,$password);
db_close($conn);

if($user){
    $user = $user[0];
    unset($user['us_password']);
    $_SESSION['user'] = $user;
    
    page_redirect("../#!/updates");
}
else{
    page_redirect("../login.php?error=Invalid%20Credentials");
}
    
?>