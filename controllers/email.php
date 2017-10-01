<?php
function send_email($to,$subject,$body){
    shell_exec("java -jar mail.jar \"$to\" \"$subject\" \"$body\"");
}
?>