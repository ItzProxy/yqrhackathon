<?php
    require 'model/utils.php';
    if(isset($_SESSION['user'])){
        page_redirect("index.php#!/updates");
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
    
    <body ng-app="MyApp" ng-controller="LoginController">
              
        <br><br>
        <div id="login-container" class="valign-wrapper">
        <div class="container center" >
            <div class="row z-depth-4" id="login-form">
                <form action="controllers/login-ctrl.php" method="POST">
                    <div class="col s12 header">
                        <h5>
                            <i class="material-icons medium">verified_user</i>
                            <br>REZQ-ERS LOGIN
                        </h5>
                    </div>
                    <div class="row">
                        <div class="col s12 error-text center" ng-if="loginError">
                            <br>
                            <i class="material-icons">error_outline</i><br>
                            {{loginError}}
                        </div>
                        <div class="col s1 l2"></div>
                        <div class="col s10 l8 input-field">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="username" name="username" type="email" required>
                            <label for="username">Username</label>
                        </div>
                        <div class="col s1 l2"></div>
                    </div>
                    <div class="row">
                        <div class="col s1 l2"></div>
                        <div class="col s10 l8 input-field">
                            <i class="material-icons prefix">lock</i>
                            <input id="password" name="password" type="password" required>
                            <label for="password">Password</label>
                        </div>
                        <div class="col s1 l2 input-field"></div>
                    </div>                    
                    <div class="col s12 l4"></div>
                    <div class="col s12 l4 input-field">
                        <button class="btn btn-large waves-effect waves-light">
                            Login
                        </button>
                        <br><br>
                    </div>
                    <div class="col s12 l4"></div>
                    <div class="col s12">
                        <a href="" style="color: lightseagreen">Don't have an account? click here</a>
                        <br><br>
                    </div>
                    
                </form>
            </div>            
        </div>
        </div>
        
        <script src="js/angular-app.js"></script>
        <script src="js/controller.js"></script>
        <script src="js/main.js"></script>
    </body>
    
</html>