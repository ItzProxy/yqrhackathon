<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
session_start();

//set_exception_handler("exception_handler");
//set_error_handler("exception_handler");
/**
 * Redirects to a page within the current domain
 * @param type $location - Name of the page
 */
function page_redirect($location){
    echo "<script>window.location.href='$location'</script>";
}
/**
 * Returns a mysqli_connection_object
 * @param type $host
 * @param type $username
 * @param type $password
 * @param type $dbname
 * @return type
 */
function db_connect($host = "localhost"
        ,$username = "root"
        ,$password = ""
        ,$dbname = "doggo_hackathon"){
    return mysqli_connect($host, $username, $password, $dbname);
}
/**
 * Retrieves a user row including the details
 * @param type $mysql_conn
 * @param type $where - Where condition without the keyword where
 */
function db_get_users($mysql_conn,$where=""){
    $sql = "SELECT userid, firstname, lastname, email, birthdate, gender, profile_pic "
    ."FROM hearmeout_users NATURAL JOIN hearmeout_user_details ";
    if(strlen(trim($where)) > 0){
        $sql .= "WHERE $where";
    }
    $result = mysqli_query($mysql_conn, $sql);
    $users = array();
    while($user = mysqli_fetch_assoc($result)){
        array_push($users, $user);
    }
    return $users;
}
/**
 * Get a specific user by ID
 * @param type $mysql_conn
 * @param type $userid
 */
function db_get_user_by_id($mysql_conn,$userid){
    $result = db_get_users($mysql_conn,"userid=$userid");
    $result = count($result) > 0? $result[0] : $result;
    return $result;
}

/**
 * Inserts a new user into two tables and returns the most recently created user
 * @param type $mysql_conn
 * @param type $firstname
 * @param type $lastname
 * @param type $email
 * @param type $password
 * @param type $birthdate
 * @param type $gender
 * @param string $profile_pic
 */
function db_insert_user($mysql_conn, $firstname, $lastname, $email, $password
        , $birthdate, $gender, $profile_pic=""){
    $result = array("type"=>"","message"=>"");
//    $firstname = addslashes($firstname);
//    $lastname = addslashes($lastname);
    $password = hash("sha512",$password);
    if(strlen(trim($profile_pic)) == 0){
        $profile_pic = "images/profiles/default_".strtolower($gender).".png";
    }
    if(count(db_get_users($mysql_conn,"email=\"$email\"")) > 0){
        $result["type"] = "error";
        $result["message"] = "Account with email Id $email already exists";
        return $result;
    }
    //Insert into the users table
    $sql = "INSERT INTO hearmeout_users "
            . "VALUES(null, \"$email\" , \"$password\" ,\"USER\")";
    mysqli_query($mysql_conn, $sql);
//    $stmt = mysqli_prepare($mysql_conn, $sql);
//    $stmt->bind_param("ss", $email,$password);
//    $stmt->execute();
    
    //Insert into th user_details table
    $sql = "INSERT INTO hearmeout_user_details "
            . "VALUES( (SELECT max(userid) FROM hearmeout_users),"
            . "'$firstname','$lastname','$email','$birthdate','$profile_pic','$gender')";
    mysqli_query($mysql_conn, $sql);
//    $stmt = mysqli_prepare($mysql_conn, $sql);
//    $stmt->bind_param("sssss",$firstname,$lastname,$email,$birthdate,$gender);
//    $stmt->execute();
    //fetch the most recent insert and return it
    $result["type"] = "success";
    $result["message"] = "User account successfully created";
    $result_list = db_get_users($mysql_conn,"userid=(SELECT max(userid) FROM hearmeout_users)");
    $result["user"] = $result_list[0];
    return $result;
}
/**
 * Deletes the user from the database
 * @param type $mysql_conn
 * @param type $userid
 */
function db_delete_user($mysql_conn,$userid,$password){
    $password = hash("sha512", $password);
    $sql = "DELETE FROM hearmeout_users WHERE userid=$userid"
            . " AND userpass=\"$password\" ";
    mysqli_query($mysql_conn, $sql);
//    echo $sql;
    if(mysqli_affected_rows($mysql_conn) > 0){
        mysqli_query($mysql_conn,"DELETE FROM hearmeout_user_details"
                . " WHERE userid=$userid");
        mysqli_query($mysql_conn,"DELETE FROM hearmeout_posts"
                . " WHERE userid=$userid");
        mysqli_query($mysql_conn,"DELETE FROM hearmeout_likes"
                . " WHERE user_id=$userid");
        mysqli_query($mysql_conn,"DELETE FROM hearmeout_dislikes"
                . " WHERE user_id=$userid");
        mysqli_query($mysql_conn,"DELETE FROM hearmeout_favorites"
                . " WHERE user_id=$userid");
        mysqli_query($mysql_conn,"DELETE FROM hearmeout_comments"
                . " WHERE user_id=$userid");
        return true;
    }else{
        return false;
    }
}
/**
 * Changes the user deatils in hearmeout_users and hearmeout_user_details table
 * @param type $mysql_conn
 * @param type $userid
 * @param type $firstname
 * @param type $lastname
 * @param type $email
 * @param type $birthdate
 * @param type $gender
 */
function db_update_user_details($mysql_conn, $userid, $firstname, $lastname
        ,$email ,$birthdate ,$gender ){
    mysqli_query($mysql_conn, "UPDATE hearmeout_user_details "
            . "SET firstname='$firstname', lastname='$lastname', email='$email', "
            . "birthdate='$birthdate', gender='$gender' "
            . "WHERE userid=$userid");
    $result1 = mysqli_affected_rows($mysql_conn)>0;
    mysqli_query($mysql_conn, "UPDATE hearmeout_users "
            . "SET username='$email' "
            . "WHERE userid=$userid");
    $result2 = mysqli_affected_rows($mysql_conn)>0;
    if($result1 || $result2){
        return true;
    }else{
        return false;
    }
}
/**
 * Changes the password in hearmeout_users table
 * @param type $mysql_conn
 * @param type $userid
 * @param type $old_pass
 * @param type $new_pass
 */
function db_change_user_password($mysql_conn,$userid,$old_pass,$new_pass){
    $old_pass = hash("sha512",$old_pass);
    $new_pass = hash("sha512",$new_pass);
    $result = mysqli_query($mysql_conn, "SELECT * FROM hearmeout_users "
            . "WHERE userpass='$old_pass' and userid='$userid'");
    if(mysqli_num_rows($result) > 0){
        mysqli_query($mysql_conn, "UPDATE hearmeout_users SET userpass='$new_pass' "
                . "WHERE userid=$userid");
        return true;
    }else{
        return false;
    }
}
/**
 * Changes the profile picture of the user
 * @param type $mysql_conn
 * @param type $userid
 * @param type $new_path
 * @return type
 */
function db_change_profile_pic($mysql_conn,$userid,$new_path){
    return mysqli_query($mysql_conn, "UPDATE hearmeout_user_details SET profile_pic='$new_path' "
            . "WHERE userid='$userid'");
}
/**
 * Close the mysqli connection
 * @param type $mysqli_conn
 */
function db_close($mysqli_conn){
    mysqli_close($mysqli_conn);
}
/**
 * Get the page value in $_SERVER["HTTP_REFERER"] path
 */
function get_referer_page($default="posts.php"){
    if(!isset($_SERVER["HTTP_REFERER"])){
        return $default;
    }    
    $path = explode("/", $_SERVER["HTTP_REFERER"]);
    return $path[count($path)-1];
    
}
/**
 * Filters all the hashtags as searchable links
 * @param type $content
 */
function hashtagify($content){
    $pattern = '/([^&]#\w+)/i';
    $replacement = '<a onclick="searchPosts(\'${1}\')">${1}</a>';
    return preg_replace($pattern, $replacement, $content);
}
/**
 * Highlights words in a 
 * @param type $content
 * @param type $words
 */
function highlight($content, $words){
    $words = array_unique($words);
    foreach($words as $word){
        $pattern = '/('.$word.')/i';
        $replacement = '<span class="hl-text"> $1 </span>';
        $content = preg_replace($pattern, $replacement, $content);
    }
    return $content;
}
/**
 * If user is not logged in page_redirect is called
 * @param type $location
 */
function redirect_if_not_logged_in($location="index.php#login-form"){
    if(!isset($_SESSION["user"])){
        send_response_code(401);
        page_redirect($location);
    }
}
/**
 * 5.3 workaround for http_response_code()
 * @param type $code
 */
function send_response_code($code){
    header('Temporary-Header: True', true, $code);
    header_remove('Temporary-Header');
}
/**
 * Builds a url from the $_SERVER["REQUEST_URI"] attribute
 */
function build_page_url($page=1){
//    $url = "http://localhost/hearmeout/search.php?type=keyword&search=a&page=2";
    $url = $_SERVER["REQUEST_URI"];
    if(strpos($url,"page=")){
        $pattern = '/page=\d+/i';
        $replacement = "page=$page";
        $url = preg_replace($pattern, $replacement, $url);
    }else if(strpos($url,"?")){
        $url .= "&page=$page"; 
    }else{
        $url .= "?page=$page"; 
    }
    return $url;
}
/**
 * Redirects to 500.html incase of an error
 */
function exception_handler(){
    page_redirect("http://www2.cs.uregina.ca/~ghatti2y/project/500.html");
}
?>