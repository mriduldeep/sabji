<!DOCTYPE html>
<?php
session_start();
if(empty($_SESSION['adminid']))
header("Location:index.php");
include("dbconnect.php");
$aid=$_SESSION['adminid'];
$rq=mysql_query("select * from admin",$con);
$va=mysql_fetch_array($rq);
if(isset($_POST['save']))
{
	$cp=$_POST['currPass'];
	if($cp==$va['2'])
	{
		$np=$_POST['newPass'];
		$cnp=$_POST['cnewPass'];
		if($np==$cnp)
		{
			$query="update admin set admin_pass='$cnp' where admin_id='$aid'";
			$q=mysql_query($query,$con);
			if($q)
			{
			$_SESSION['password']=$cnp;
			?>
			<script type="text/javascript">alert('Password Changed')</script>
			<?php
			}
		}
		else ?> <script type="text/javascript">alert('Password does not Match');</script>
	<?php
	}
	else ?>
	<script type="text/javascript">alert('You have entered wrong current password');</script>
<?php
}
mysql_close($con);
?>

<html lang="en">
<head>
	<link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="../assets/css/docs.css" rel="stylesheet">
    <link href="../assets/js/google-code-prettify/prettify.css" rel="stylesheet">
	<title>Admin Password Change</title>
	</head>
	<body>
		<div class="container-fluid">    <!-- add a fluid , centered layout -->
		<div class="row-fluid">
			<div class="span12">
				<div class="span12">
				 <div class="navbar">
<div class="navbar-inner">
<a class="brand" href="home.php">Welcome Admin</a>
<ul class="nav">
<li><a href="home.php">Home</a></li>
<li><a href="profile.php">Profile</a></li>
<li class="active"><a href="changepassword.php">Change Password</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>
</div>
</div>
				<div class="well">
				<div class="row-fluid">
				
				<div class="span6 offset3">
				
				<form class="form-horizontal" method="post" action="changepassword.php">
				<div class="control-group">
				<label class="control-label" for="currPass">Current password</label>
				<div class="controls">
				<input type="text" id="currPass" placeholder="Current Password" name="currPass">
				</div>
				</div>		<!-- /.control-group -->
				<div class="control-group">
				<label class="control-label" for="newPassword">New Password</label>
				<div class="controls">
				<input type="password" id="newPassword" placeholder="New Password" name="newPass">
				</div>
				</div>		<!-- /.control-group -->
				<div class="control-group">
				<label class="control-label" for="cnewPassword">Confirm New Password</label>
				<div class="controls">
				<input type="password" id="cnewPassword" placeholder="Confirm New Password" name="cnewPass">
				</div>
				</div>		<!-- /.control-group -->
				<div class="control-group">
				<div class="controls">
				<button class="btn btn-success" type="submit" name="save">Save</button>
				<button class="btn btn-warning" type="reset" class="btn">Reset</button>
				</div>
				</div>		<!-- /.control-group -->
				</form>
				</div>		<!-- /.span6 offset3 -->
				</div>		<!-- /.row-fluid -->
				</div>		<!-- /.well -->
				<ul class="breadcrumb">
					<li><a href="home.php">Home</a> <span class="divider">&raquo;</span></li>
					<li><a href="changepassword.php">Change Password</a></li>
				</ul>
			</div>		<!-- /.span12 -->
			</div>		<!-- /.span10 offset1 -->
		</div>		<!-- /.row-fluid -->
		</div>		<!-- /.container-fluid -->
		
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap-transition.js"></script>
    <script src="../assets/js/bootstrap-alert.js"></script>
    <script src="../assets/js/bootstrap-modal.js"></script>
    <script src="../assets/js/bootstrap-dropdown.js"></script>
    <script src="../assets/js/bootstrap-scrollspy.js"></script>
    <script src="../assets/js/bootstrap-tab.js"></script>
    <script src="../assets/js/bootstrap-tooltip.js"></script>
    <script src="../assets/js/bootstrap-popover.js"></script>
    <script src="../assets/js/bootstrap-button.js"></script>
    <script src="../assets/js/bootstrap-collapse.js"></script>
    <script src="../assets/js/bootstrap-carousel.js"></script>
    <script src="../assets/js/bootstrap-typeahead.js"></script>
    <script src="../assets/js/bootstrap-affix.js"></script>
    <script src="../assets/js/holder/holder.js"></script>
    <script src="../assets/js/google-code-prettify/prettify.js"></script>
    <script src="../assets/js/application.js"></script>	
	</body>
</html>