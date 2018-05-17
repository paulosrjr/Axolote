<?php require 'lib/libSys.php'; ?>
<!DOCTYPE html>
<!--[if IE 8]><html class="ie8 login-pf"><![endif]-->
<!--[if IE 9]><html class="ie9 login-pf"><![endif]-->
<!--[if gt IE 9]><!-->
<html class="login-pf">
<!--<![endif]-->
  <head>
    <title>Login - Backups</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href=".img/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-57-precomposed.png">
    <link href="css/patternfly.css" rel="stylesheet" media="screen, print" type="text/css"/>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="../components/html5shiv/dist/html5shiv.min.js"></script>
    <script src="../components/respond/dest/respond.min.js"></script>
    <![endif]-->
    <!-- IE8 requires jQuery and Bootstrap JS to load in head to prevent rendering bugs -->
    <!-- IE8 requires jQuery v1.x -->
    <script src="components/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="js/patternfly.js" type="text/javascript"></script>
  </head>
  <body>
<!--<span id="badge">
        <img src="img/1368379919851664195death-star-2nd-icon.png" alt=""/>
    </span>-->
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div id="brand">
            <!--<img src="img/brand.svg" alt="Enterprise Application">-->
          </div><!--/#brand-->
        </div><!--/.col-*-->
        <div id="loginInfo"></div>
        <div class="col-sm-7 col-md-6 col-lg-5 login">


          <!-- <form class="form-horizontal" role="form">-->
          <div class="form-horizontal" role="form">
            <div class="form-group">
              <label for="inputUsername" class="col-sm-2 col-md-2 control-label">User</label>
              <div class="col-sm-10 col-md-10">
                <input type="text" class="form-control" id="inputUsername" placeholder="" tabindex="1">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword" class="col-sm-2 col-md-2 control-label">Password</label>
              <div class="col-sm-10 col-md-10">
                <input type="password" class="form-control" id="inputPassword" placeholder="" tabindex="2">
              </div>
            </div>
            <div class="form-group">
              <!--<div class="col-xs-8 col-sm-offset-2 col-sm-6 col-md-offset-2 col-md-6">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" tabindex="3"> Lembrar Usuario
                  </label>
                </div>
                <span class="help-block"> Esqueci o <a href="#" tabindex="5">Usuario</a> ou <a href="#" tabindex="6">Senha</a>?</span>
              </div>-->
              <div class="col-xs-4 col-sm-4 col-md-4 submit">
                  <button class="btn btn-primary btn-lg" tabindex="4" id="btnSendLogin">Login</button>
              </div>
            </div>
           </div>
          <!--</form>-->
        </div><!--/.col-*-->
        <div class="col-sm-5 col-md-6 col-lg-7 details">
          <p><strong><!--Bem vindo ao sistema de Backup!--></strong></p>
        </div><!--/.col-*-->
      </div><!--/.row-->
    </div><!--/.container-->
  </body>
<script>
$(document).ready( function() {
         $("#btnSendLogin").click(function(){
            //alert("Value: " + $("#txtName").val());
            $.post("access.php",
                {
                    page: "logon",
                    username: $("#inputUsername").val(),
                    password: $("#inputPassword").val()
                },
            function(data){
                    if(data.indexOf("Success") > -1) {
                        window.location="http://localhost/main.php";
                    }
                    else{
                    $('#loginInfo').html(data);
                    $('#loginInfo').show().delay(25000).hide(1000);
                    }
                });
        });
        });
</script>
</html>
