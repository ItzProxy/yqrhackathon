<?php
    require '../model/utils.php';
    require '../model/rezq_dogs.php';
    require '../model/rezq_dog_details.php';
    require '../model/rezq_events.php';
    if(!isset($_SESSION['user'])){
        page_redirect("login.php");
    }  
    $id = $_GET['id'];
    $conn = db_connect();
    
    $dog = get_rezq_dogs_by_id($conn,$id)[0];
    $details = get_rezq_dog_details_by_id($conn,$id);
    $events = get_events_by_dog($conn,$id);
    
    db_close($conn);
 ?>
<br>
<!--MODALs-->
<div id="notify-urgent" class="modal notifiable">
    <div class="modal-header center" style="background: darkorange">
        <h5>NOTIFY URGENT ISSUE</h5>
        <hr>
        An email will be sent to the admins about the medical issue or emergency 
        <br>
        <img src="img/bell.png">
    </div>
    <a class="modal-action modal-close waves-effect waves-green btn-flat right">
            <i class="material-icons left">close</i>&nbsp;Close
    </a>
    <div class="modal-content center">
        <form method="POST" action="controllers/notify.php">
            <input type="hidden" name="dog" value="<?php echo $dog['dg_id'];?>">
            <div class="row">
                <div class="input-field col s12">
                    <input id="subject" name="subject" type="text" required>
                    <label for="subject">Subject</label>
                </div>
                <div class="input-field col s12">
                    <textarea id="message" name="message" class="materialize-textarea"></textarea>
                    <label for="message">Message</label>
                </div>
                <div class="col s12">
                    <div class="media z-depth-2">
                        <img class="img-preview">
                        <video class="video-preview"></video>
                        <br>
                        <h5 class="help-txt center">Click here to add an image/video</h5>
                    </div>
                    <input type="file" name="media-file" accept="image/*,video/*"
                           style="display: none">
                    <br>
                    <div class="loading" style="color: gray">
                        <i class="material-icons">alarm</i><br>
                        LOADING
                    </div>
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
<div id="add-event" class="modal notifiable">
    <div class="modal-header center" style="background: steelblue">
        <h5>ADD EVENT TO TIMELINE</h5>
        <hr>
        An event will be added to the profile timeline 
        <br>
        <img src="img/add_event.png">
    </div>
    <a class="modal-action modal-close waves-effect waves-green btn-flat right">
            <i class="material-icons left">close</i>&nbsp;Close
    </a>
    <div class="modal-content center">
        <form method="POST" action="">
            <div class="row">
                <div class="input-field col s12">
                    <input id="title" name="title" type="text" required>
                    <label for="title">Title</label>
                </div>
                <div class="input-field col s12">
                    <textarea id="description" name="description" class="materialize-textarea"></textarea>
                    <label for="description">Description</label>
                </div>
                <div class="col s12">
                    <div class="media z-depth-2">
                        <img class="img-preview">
                        <video class="video-preview"></video>
                        <br>
                        <h5 class="help-txt center">Click here to add an image/video</h5>
                    </div>
                    <input type="file" name="media-file" id="media-file" accept="image/*,video/*"
                           style="display: none">
                    <br>
                    <div class="loading" style="color: gray">
                        <i class="material-icons">alarm</i><br>
                        LOADING
                    </div>
                    <br>
                </div>
                <div class="col s12 l6 action-button">
                    <button type="reset" class="action-button btn waves-effect waves-light"
                            style="background: steelblue">
                        <i class="material-icons left">autorenew</i>&nbsp;Clear
                    </button>
                </div>
                <div class="col s12 l6">
                    <button type="submit" class="action-button btn waves-effect waves-light"
                            style="background: steelblue">
                        <i class="material-icons left">add</i>&nbsp;Add Event
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>



<div class="row center dog-action-row">    
    <div class="col s12 l6 m12">
        <a class="btn waves-effect waves-light s12 back1 modal-trigger"
           onclick="$('#add-event').modal('open')">
            <i class="material-icons left">stars</i>
            Add event to timeline
        </a>
    </div>
    <div class="col l6 s12 m12">
        <a class="btn waves-effect waves-light s12 back2 modal-trigger"
           onclick="$('#notify-urgent').modal('open')">
            <i class="material-icons left">announcement</i>
            Notify Urgent Issue
        </a>
    </div>
</div>
<div class="dog-descriptor center z-depth-2 row">
    <div class="img-container valign-wrapper">
        <img src="<?php echo $dog['dg_profile_pic'];?>">
    </div>
    <div class="title">
        <?php echo $dog['dg_name'];?>
    </div>
    <hr>
    <div class="description">
        <?php echo $dog['dg_description'];?> 
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
<div class="dog-details z-depth-2 row center">
    <?php foreach ($details as $detail){ ?>
    <div class="field field-title">
        <?php echo $detail['dg_field']; ?>
    </div>
    <div class="field field-value">
        <?php echo $detail['dg_value']; ?>
    </div>
    <?php } ?>
    <div class="field field-value">
        <a class="btn waves-effect waves-light"><i class="material-icons left">edit</i>
        &nbsp;Add Detail</a>
    </div>
    
</div>
<div class="timeline row">
    <?php foreach($events as $event){ ?>
    <div class="timeline-block alert-block center z-depth-2">
        <?php if($event['ev_type']=='alert'){ ?>
        <div class="alert-bar">
            <img src="img/alarm.png" height="32">
        </div>
        <?php } ?>
        <div class="media">
            <?php if(isset($event['ev_media_type']) && $event['ev_media_type'] == 'image'){?>
            <img src="<?php echo $event['ev_media_path']?>">
            <?php } if(isset($event['ev_media_type']) && $event['ev_media_type'] == 'video'){ ?>
            <video controls>
                <source src="<?php echo $event['ev_media_path']?>" type="video/mp4">
            </video>
            <?php } ?>
        </div>
        <div class="title">
            <?php echo $event['ev_title']?>
        </div>
        <hr>
        <div class="description">
            <?php echo $event['ev_description']?>
        </div>
        <div class="timestamp">
            <small><?php echo $event['ev_time']?></small>
            <a class="btn-floating btn waves-effect waves-light right">
                <i class="material-icons">close</i>
            </a>
        </div>
    </div>
    <br><br>
    <?php } ?>
    
</div>
