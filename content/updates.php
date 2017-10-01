<?php
    require_once '../model/utils.php';
    require '../model/rezq_notifications.php';
    require '../model/resq_user.php';
    $user = $_SESSION['user'];
   
    
    $conn= db_connect();
    $notifications = get_rezq_notification_for_user_2($conn,$user['us_email']);

    $high_alert = array();
    $normal_nf = array();
    
    foreach ($notifications as $nf){ //sorts the array one for alter and the other for non alerts(events)
        if($nf['nf_level'] == "alert"){
            array_push($high_alert,$nf);
        }
        else{
            array_push($normal_nf,$nf);
        }
    }
    
?>
<br>
<div class="row notification-header alert">
    <i class="material-icons left medium">add_alert</i>&nbsp;URGENT
    <hr>
</div>
<?php foreach($high_alert as $nf){ ?>
    <div class="row notification z-depth-2">    
    <i class="material-icons right">close</i>
    <a href="#!/timeline">
        <?php $nf_user = get_dg_user_by_id($conn,$nf['nf_by_user'])[0];?>
        <span class='user'><?php echo $nf_user['us_first_name']." ".$nf_user['us_last_name']
                ."  -  ".$nf['nf_subject'];?></span>
        <hr>
       <?php echo $nf['nf_body']; ?>
    </a> 
</div>
    <?php } ?>
<div class="row notification-header new">
    <i class="material-icons left medium">grade</i>&nbsp;UPDATES
    <hr>
</div>

<?php foreach($normal_nf as $nf){ ?>
<div class="row notification z-depth-2">    
    <i class="material-icons right">close</i>
    <a href="#!/timeline">
        <?php $nf_user = get_dg_user_by_id($conn,$nf['nf_by_user'])[0];?>
        <span class='user'><?php echo $nf_user['us_first_name']." ".$nf_user['us_last_name']
                ."  -  ".$nf['nf_subject'];?></span>
        <hr>
       <?php echo $nf['nf_body']; ?>
    </a> 
</div>
<?php }
db_close($conn); 
?>