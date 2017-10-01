<?php
    require '../model/utils.php';
    require '../model/resq_user.php';
    require '../model/rezq_dogs.php';
    if(!isset($_SESSION['user'])){
        page_redirect("login.php");
    }  
    $user = $_SESSION['user'];
    
    $conn = db_connect();
    $admins = db_get_users($conn," us_role='admin'");
    $fosterers = db_get_users($conn," us_role='foster' "
            .($user['us_role']=='foster'?" and us_id=".$user['us_id']."":"") );
    
?>
<br>
<div id="notify-modal" class="modal notifiable">
    <div class="modal-header center" style="background: darkorange">
        <h5>SEND A NOTIFICATION</h5>
        <hr>
        An email will be sent to the admin or the user if you select the urgent priority checkbox 
        <br>
        <img src="img/bell.png">
    </div>
    <a class="modal-action modal-close waves-effect waves-green btn-flat right">
            <i class="material-icons left">close</i>&nbsp;Close
    </a>
    <div class="modal-content center">
        <form method="POST" action="controllers/notify.php">
            <div class="row">
                <div class="input-field col s12">
                    <input id="recepient" name="to" type="text" required>
                    <label for="recipient">Recipient</label>
                </div>
                <div class="input-field col s12">
                    <input id="subject" name="subject" type="text" required>
                    <label for="subject">Subject</label>
                </div>
                <div class="input-field col s12">
                    <textarea id="message" name="message" class="materialize-textarea"></textarea>
                    <label for="message">Message</label>
                </div>
                <div class="col s12">
                    <p>
                        <input type="checkbox" id="urgent" name="urgent"/>
                        <label for="urgent">This notification is of <b>urgent priority</b></label>
                    </p>
                    <br>
                </div>
                <div class="col s12 l6 action-button">
                    <button type="reset" class="action-button btn waves-effect waves-light"
                            style="background: darkorange">
                        <i class="material-icons left">autorenew</i>&nbsp;Clear
                    </button>
                </div>
                <div class="col s12 l6">
                    <button type="submit" class="action-button btn waves-effect waves-light"
                            style="background: darkorange">
                        <i class="material-icons left">send</i>&nbsp;Send
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="info z-depth-2" style='background: lightblue; color: steelblue; padding: 10px;'>
    <i class="material-icons left">info_outline</i>
    Click on any user or admin to open a notification box
</div>
<br>
<div class="row notification-header" style="color: teal; opacity: 0.7">
        <i class="material-icons left medium">star</i>&nbsp;ADMINS   
        <button class='btn waves-effect waves-light right'><i class="material-icons left">announcement</i>Notify all admins</button>
        <hr style="background: teal">        
    </div>

    <div class="row">
    <?php foreach ($admins as $usr){ ?>
        <div class="col s12 l4 m6 user-card center" data-email="<?php echo $usr['us_email'];?>">
            <div class="media z-depth-2" style="background-image: url('<?php echo $usr['us_profile_pic'];?>');
                 background-size: cover; background-position: center" data-email="<?php echo $usr['us_email'];?>">
            </div>
            <div class="title">
                <?php echo $usr['us_first_name']." ".$usr['us_last_name'];?>
            </div>
        </div>
    <?php } ?>
    </div>

<div class="row notification-header" style="color: teal; opacity: 0.7">
        <i class="material-icons left medium">account_circle</i>&nbsp;FOSTER CARE   
        <button class='btn waves-effect waves-light right'><i class="material-icons left">announcement</i>Announcement</button>
        <hr style="background: teal">        
    </div>
    
    <div class="row">
    <?php foreach ($fosterers as $usr){
            $dog = get_rezq_dogs_by_user($conn,$usr['us_id']);
            if($dog != NULL){
                $dog = $dog[0];
            }
        ?>
        <div class="col s12 l4 m6 user-card center" data-email="<?php echo $usr['us_email'];?>">
            <div class="media z-depth-2" style="background-image: url('<?php echo $usr['us_profile_pic'];?>');
                 background-size: cover; background-position: center">
            </div>
            <div class="title">
                <?php echo $usr['us_first_name']." ".$usr['us_last_name'];?>
                <hr>               
            </div>            
            <?php // if($dog != NULL){ ?>
            <div class="details">
                Currently fostering - 
                <a href='#!/timeline/<?php echo $dog['dg_id'];?>'><?php echo $dog['dg_name'];?></a>
            </div>
            <? // } ?>
        </div>
    <?php } ?>
    </div>

<?php db_close($conn); ?>