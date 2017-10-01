<?php
require 'model/utils.php';

session_unset();
session_destroy();

page_redirect("login.php");
?>