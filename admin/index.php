<!DOCTYPE html>
<?php
session_start();
if(isset($_POST['login']))
{
	$an=$_POST['aname'];
	$pass=$_POST['apwd'];
	include("dbconnect.php");
	$query="select * from admin where admin_name='$an' AND admin_pass='$pass' ";
	$res=mysql_query($query,$con);
	$arr=mysql_fetch_assoc($res);
	if(mysql_num_rows($res))
	{
		$_SESSION['adminid']=$arr['admin_id'];
		$_SESSION['adminname']=$arr['admin_name'];
		$_SESSION['password']=$arr['admin_pass'];
		header("Location:home.php");
	}
	else
	{
	echo "<script type='text/javascript'>alert('Login Failed');</script>";
	}
	mysql_close($con);
}
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Admin Log in</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin Log in">
    <meta name="author" content="">
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }
    </style>
    <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->
	
      <link rel="icon" href="../assets/ico/default.png">
  </head>

  <body>
    <div class="container-fluid">

      <form class="form-signin" method="post" action="index.php">
        <h2 class="form-signin-heading">Admin sign in</h2>
        <input type="text" class="input-block-level" placeholder="Admin name" name="aname">
        <input type="password" class="input-block-level" placeholder="Password" name="apwd">
        <button class="btn btn-large btn-primary" type="submit" name="login">Log in</button>
      </form>

    </div> <!-- /container-fluid -->

    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap-transition.js"></script>
    <script src="../assets/js/bootstrap-alert.js"></script>    
  </body>
</html>