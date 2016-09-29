<?php
session_start();
require 'config.php';
//$function = $_GET['function'];
// echo $function;

if (isset($_POST['btnLogin'])) {
  if ( isset($_POST['username']) && isset($_POST['password']) ) {
    
    $sql_check = "SELECT name, 
                         level, 
                         id 
                  FROM users 
                  WHERE 
                       username=? 
                       AND 
                       password=? 
                  LIMIT 1";

    $check_log = $dbconnect->prepare($sql_check);
    $check_log->bind_param('ss', $username, $password);

    $username = $_POST['username'];
    $password = $_POST['password'];

    $userData = mysqli_fetch_array($check_log, MYSQL_ASSOC);

    $_SESSION['name'] = $name = $userData['name'];
    $_SESSION['level'] = $level = $userData['level'];
    $_SESSION['function'] = $function = $userData['function'];

    $check_log->execute();

    $check_log->store_result();

    if ( $check_log->num_rows == 1 ) {
        $check_log->bind_result($name, $level, $id);

        while ( $check_log->fetch() ) {
            $_SESSION['level'] = $level;
            $_SESSION['sess_id']    = $id;
            $_SESSION['name']       = $name;
            $_SESSION['function']       = $function;
            
        }

        $check_log->close();


        header('location: dashboard.php');
        exit();

    } else {
        header('location: login.php?error='.base64_encode('Username and Password Invalid!!!'));
        exit();
    }

   
} else {
    header('location:login.php');
    exit();
}
}
?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Vodafone Ghana Records Management System</title>
    <script src="http://s.codepen.io/assets/libs/modernizr.js" type="text/javascript"></script>
    <link rel="icon" type="icon" href="favicon.ico">

    <link rel="stylesheet" href="css/reset.css">
        <link href="css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/custom.css">

    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css'>

        <link rel="stylesheet" href="css/style.css">
    <style type="text/css">
      * {
  -ms-box-sizing: border-box;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  border: 0;
}
html,
body {
  width: 100%;
  height: 100%;
  background: url(./image/sativa.png) repeat fixed;
  font-family: 'Open Sans', sans-serif;
  font-weight: 200;
}
.login {
  position: relative;
  top: 50%;
  width: 250px;
  display: table;
  margin: -150px auto 0 auto;
  background: #fff;
  border-radius: 4px;
}
.legend {
  position: relative;
  width: 100%;
  display: block;
  background: #FF7052;
  padding: 15px;
  color: #fff;
  font-size: 20px;
}
.legend:after {
  content: "";
  background-image: url(./image/multy-user.png);
  background-size: 100px 100px;
  background-repeat: no-repeat;
  background-position: 152px -16px;
  opacity: 0.06;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  position: absolute;
}
.input {
  position: relative;
  width: 90%;
  margin: 15px auto;
}
.input span {
  position: absolute;
  display: block;
  color: #d4d4d4;
  left: 10px;
  top: 8px;
  font-size: 20px;
}
.input input {
  width: 100%;
  padding: 10px 5px 10px 40px;
  display: block;
  border: 1px solid #EDEDED;
  border-radius: 4px;
  transition: 0.2s ease-out;
  color: #a1a1a1;
}
.input input:focus {
  padding: 10px 5px 10px 10px;
  outline: 0;
  border-color: #FF7052;
}
.submit {
  width: 45px;
  height: 45px;
  display: block;
  margin: 0 auto -15px auto;
  background: #fff;
  border-radius: 100%;
  border: 1px solid #FF7052;
  color: #FF7052;
  font-size: 24px;
  cursor: pointer;
  box-shadow: 0px 0px 0px 7px #fff;
  transition: 0.2s ease-out;
}
.submit:hover,
.submit:focus {
  background: #FF7052;
  color: #fff;
  outline: 0;
}
.feedback {
  position: absolute;
  bottom: -70px;
  width: 100%;
  text-align: center;
  color: #fff;
  background: #2ecc71;
  padding: 10px 0;
  font-size: 12px;
  display: none;
  opacity: 0;
}
.feedback:before {
  bottom: 100%;
  left: 50%;
  border: solid transparent;
  content: "";
  height: 0;
  width: 0;
  position: absolute;
  pointer-events: none;
  border-color: rgba(46, 204, 113, 0);
  border-bottom-color: #2ecc71;
  border-width: 10px;
  margin-left: -10px;
}
    </style>
  </head>

  <body>
<!-- <center><h3>Vodafone Ghana Records Management System</h3></center> -->
<div style="width: 250px;margin: 25px auto -280px auto;">
<?php
    /* handle error */
    if (isset($_GET['error'])) : ?>
        <div class="alert alert-warning alert-dismissible" role="alert" >
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <strong>Warning!</strong> <?=base64_decode($_GET['error']);?>
        </div>
    <?php endif;?></div>
    <form class="login" action="login.php" method="POST">
  
  <fieldset>
    
  	<legend class="legend">Login</legend>
    
    <div class="input">
    	<input type="text" placeholder="Email" name="username" required />
      <span><i class="fa fa-envelope-o"></i></span>
    </div>
    
    <div class="input">
    	<input type="password" placeholder="Password" name="password" required />
      <span><i class="fa fa-lock"></i></span>
    </div>
    
    <button type="submit" class="submit" name="btnLogin"><i class="fa fa-long-arrow-right"></i></button>
    
  </fieldset>
  
  <div class="feedback">
  	login successful <br />
    redirecting...
  </div>
  
</form>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="js/index.js"></script>
        <script src="js/bootstrap.min.js"></script>

    
    
    
  </body>
</html>
