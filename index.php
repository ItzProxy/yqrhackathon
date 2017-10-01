<?php
    require 'model/utils.php';
    if(!isset($_SESSION['user'])){
        page_redirect("login.php");
    }        
?>
<!DOCTYPE html>
<html>    
    <head>
        <!--<base href="/">-->
        <title>REZQ-ERS</title>
        <link rel="manifest" href="manifest.json">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--JS Includes-->
        <script src="js/angular.min.js"></script>
        <script src="js/angular-route.min.js"></script>
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/materialize.min.js"></script>
        <!--CSS Inlcudes-->
        <link rel="stylesheet" href="fonts/montserrat.css" type="text/css">
        <link rel="stylesheet" href="fonts/bungee.css" type="text/css">
        <link rel="stylesheet" href="css/materialize.min.css" type="text/css">
        <link rel="stylesheet" href="css/icon.css" type="text/css">
        <link rel="stylesheet" href="css/main.css" type="text/css">
    </head>
    
    <body ng-app="MyApp" ng-controller="MainController">
              
        <div ng-include="'content/header.php'"></div>
        
        <div class="container" ng-view></div>
        
        <script src="js/angular-app.js"></script>
        <script src="js/controller.js"></script>
        <script src="js/main.js"></script>
    </body>
    
</html>