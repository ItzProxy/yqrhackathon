<?php
    require '../model/utils.php';
    require '../model/resq_user.php';
    require '../model/rezq_dogs.php';
    if(!isset($_SESSION['user'])){
        page_redirect("login.php");
    }  
    $user = $_SESSION['user'];
    
    $conn = db_connect();
    $dogs = array();
    if($user['us_role']=='foster'){
        $dogs = get_rezq_dogs_by_user($conn,$user['us_id']);
    }else{
        $dogs = get_rezq_all_dogs($conn);
    }
    
?>
<br>
<br>
<div class="row notification-header" style="color: teal; opacity: 0.7">
        <i class="material-icons left medium">star</i>&nbsp;DOGS   
        <hr style="background: teal">        
    </div>

    <div class="row">
    <?php foreach ($dogs as $dg){ ?>
        <div class="col s12 l4 m6 user-card center">
            <div class="media z-depth-2" style="background-image: url('<?php echo $dg['dg_profile_pic'];?>');
                 background-size: cover; background-position: center">
            </div>
            <div class="title">
                <?php echo $dg['dg_name'];?>
            </div>
            <a class="btn waves-effect waves-light" href="#!/timeline/<?php echo $dg['dg_id'];?>">
                View Profile</a>
        </div>
    <?php } ?>
    </div>

<?php db_close($conn); ?>