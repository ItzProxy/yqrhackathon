<?php
    require '../model/utils.php';
    if(!isset($_SESSION['user'])){
        page_redirect("login.php");
    }      
    $user = $_SESSION['user'];
?>
<nav id="navbar-main">
    <div class="nav-wrapper">
        <a href="#!" class="brand-logo center">REZQ-ers</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            <li><a href="#!/updates">Updates</a></li>
            <li><a href="#!/dogs">Dogs</a></li>
            <li><a href="#!/people">People</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
        <ul class="side-nav" id="mobile-demo">
            <li><a href="#!/updates">Updates</a></li>
            <li><a href="#!/dogs">Dogs</a></li>
            <li><a href="#!/people">People</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</nav>