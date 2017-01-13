<?php   
@session_destroy();
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>2016 - SVA Admin Version 1.5 - Login</title>

    <!-- Core CSS - Include with every page -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- SB Admin CSS - Include with every page -->
    <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body>

    <div class="container">
        <div class="row" style="background:url(images/logo-sva.jpg) top center no-repeat">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default" >
                    <div class="panel-heading">
                    	<!--img src="images/logo-sva.jpg" width="227" height="59" alt="logo sva" /-->
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="libreria_php/login.inc.php" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="User" type="text" name="username" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password">
                                </div>
                                <!--div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div-->
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" name="login" value="accedi" class="btn btn-lg btn-success btn-block">Login</button>
<!--via-->                      <!--a href="index.html" class="btn btn-lg btn-success btn-block">Login</a-->
                            </fieldset>
                        </form>
                    </div>
                </div>
				<!--a href="http://svasrl.eu/00_app_resp/login.php"><div style="text-align: center!important; padding:5px;">2014</div></a-->
            </div>
        </div>
    </div>

    <!-- Core Scripts - Include with every page -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="js/sb-admin.js"></script>

</body>

</html>
