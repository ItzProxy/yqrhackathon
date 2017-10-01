<?php  
    require '../model/utils.php';
    require '../model/resq_user.php';
    if(!isset($_SESSION['user'])){
        page_redirect("../login.php");
    }
    $user = $_SESSION['user'];
    $user_profile_id = $_GET['id'];
    
    $conn= db_connect();
    $user_profile = get_dg_user_by_id($conn,$user_profile_id)[0];
    db_close($conn); 
    
?>
<div class="dog-descriptor center z-depth-2 row">
    <div class="img-container valign-wrapper">
        <img src="<?php echo $user_profile['us_profile_pic'];?>">
    </div>
    <div class="title">
        <?php echo $user_profile['us_first_name']." ".$user_profile['us_first_name'];?>
    </div>
    <hr>
    <div class="description">
        Hyperactive pupper that loves chewing things that he really should not.
        Currently in foster care with the johnson family. 
    </div>
    <div class="description">
        <a id="edit-profile" class="btn waves-effect waves-light"><i class="material-icons left">edit</i>
        &nbsp;Edit Profile</a>
    </div>
    <div class="description">
        <a class="btn red waves-effect waves-light" id="del-profile">
            <i class="material-icons left">delete</i>&nbsp;
            Remove Profile
        </a>
    </div>
</div>