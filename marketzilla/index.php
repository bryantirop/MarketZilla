<?php
require_once 'sys/conn.php';
require_once 'sys/Control.php';

new Control($mysqli);

?>

<!DOCTYPE html>

<html>
    <head>
        <title>Welcome to Market App</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css">
    </head>
    <body>
        <nav class="navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="javascript:void">Market App</a>
    </div>

  </div>
</nav>
        <br><br>
        <div class="modal-dialog" style="width: 800px !important;">
                <div class="modal-content">
                    <div class="modal-header">
                         <h4 class="modal-title">Login Panel</h4>
                    </div>
                    <div class="modal-body" style="width: 800px !important; height: 400px !important;">
                        
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#usrLog" data-toggle="tab">User Login</a></li>
                            <li><a href="#frmLog" data-toggle="tab">Firm Login</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="usrLog">
                                <br>
                                <form class="form-horizontal" role="form">
                                    <div class="form-group has-feedback">
                                        <label for="usrEmail" class="col-sm-2 control-label">Username</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="usrEmail" placeholder="Type Username or email">
                                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="usrPassword" class="col-sm-2 control-label">Password</label>
                                        <div class="col-sm-7">
                                            <input type="password" class="form-control" id="usrPassword" placeholder="Type Password">
                                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-7">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="usrRem"> Remember me
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <div class="col-sm-offset-2 col-sm-7">
                                            <button type="button" class="btn btn-primary form-control" name="usrLog" id="usrLog">Sign in</button>
                                            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                                            <span class="help-block" name="usrLogResult"></span>
                                        </div>
                                    </div>
                                    </form>
                                
                             </div>
                            <div class="tab-pane" id="frmLog">
                                <br>
                                <form class="form-horizontal" role="form" method="post">
                                    <div class="form-group has-feedback">
                                        <label for="firmID" class="col-sm-2 control-label">Firm ID</label>
                                            <div class="col-xs-6 col-sm-7">
                                                <input type="text" class="form-control" id="firmID" placeholder="Type Firm ID">
                                                <span class="glyphicon glyphicon-tag form-control-feedback"></span>
                                            </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="firmPassCode" class="col-sm-2 control-label">Pass Key</label>
                                        <div class="col-sm-7">
                                            <input type="password" class="form-control" id="firmPassCode" placeholder="Type Pass Key">
                                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <div class="col-sm-offset-2 col-sm-4">
                                            <button type="button" class="btn btn-primary form-control" name="firmLog" id="firmLog">Log in</button>
                                            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                                            <span class="help-block" name="firmLogResult"></span>
                                        </div>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="modal-footer">
                        <p class="text-success">New to marketplace? <a href="signup/">Sign Up here quick!</a></p>
                    </div>
                </div>
            </div>
        
        
        <script type="text/javascript" src="jquery/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="jx/mkappcore.js"></script>
        <script type="text/javascript" src="jx/usrlogin.js"></script>
    </body>
</html>
