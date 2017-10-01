<?php
require 'utils.php';
require 'rezq_dogs.php';
require 'resq_user.php';
$mysql_conn = db_connect("localhost","root","","doggo_hackathon");
if(!$mysql_conn){
    echo "<p>failed</p>";
}
echo "Good";

foreach (get_rezq_dogs_by_id($mysql_conn,2) as $row){
    echo "<p>".$row['dg_id'].$row['dg_name'].$row['dg_care_of']."</p>";
}

//var_dump(get_dg_user_by_id($mysql_conn, 2));


$rr = update_rezq_dogs_by_id($mysql_conn, 3, "Matt", "", "", "");

?>
<form action="../controllers/upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="media-file" id="media-file" accept="image/*,video/*"
                           style="display: none">
    <input type="submit" value="Upload Image" name="submit">
</form>