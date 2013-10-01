<!DOCTYPE html>
<?php
session_start();
if(empty($_SESSION['adminid']))
header("Location:index.php");
include('dbconnect.php');
$aid=$_SESSION['adminid'];
$r=mysql_query("select * from admin",$con);
$val=mysql_fetch_array($r);
if(isset($_POST['dapic']))
{
	$re=mysql_query("update admin set attachment='profilephoto.jpg' WHERE aid=$aid",$con);
	if($re){
			header("Location:profile.php");
	}
}
	if(isset($_POST['save']))
{
	$ep=$val['3'];
	$upl=$_FILES['apic']['name'];
	$trg="../images/adminimages/".$upl;
	$tmp=$_FILES['apic']['tmp_name'];
	move_uploaded_file($tmp,$trg);
	$an=$_POST['aname'];
	if($upl=="")
	$re=mysql_query("update admin set adminname='$an', attachment='$ep' WHERE aid=$aid",$con);
	else
	$re=mysql_query("update admin set adminname='$an', attachment='$upl' WHERE aid=$aid",$con);
	if($re){
?>
<script type="text/javascript">alert('Profile Updated')</script>
<?php
}
}
?>
<html lang="en">
<head>
	<link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="../assets/css/docs.css" rel="stylesheet">
    <link href="../assets/js/google-code-prettify/prettify.css" rel="stylesheet">
	<title>Admin Profile</title>	
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
<li class="active"><a href="profile.php">Profile</a></li>
<li><a href="changepassword.php">Change Password</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>
</div>
</div>
				<div class="well">
				<div class="row-fluid">
				<form method="post" action="profile.php" class="form-horizontal" name="editProfile" enctype="multipart/form-data">
				<div class="span2">
				<a href="../images/adminimages/<?php echo $val['3']; ?>" class="thumbnail">
				<img class="img-rounded" src="../images/adminimages/<?php echo $val['3']; ?>" name="apic" />
				</a>
				<input type="file" name="apic" accept="image/*" alt="<?php echo $val['3']; ?>" title="Change Picture" class="btn btn-link btn-mini"/>
				<input type="submit" name="dapic" value="Delete Photo" class="btn btn-warning btn-mini">
				</div>		<!-- /.span2 -->
				<div class="span9 offset1">
					<div class="control-group">
	        		<label class="control-label">Admin Name</label>
					<div class="controls">
			    	<div class="input-prepend">
					<span class="add-on"><i class="icon-lock"></i></span>
					<input type="text" class="input-xlarge" id="aname" name="aname" value="<?php echo $val['1']; ?>">
					</div>
					</div>
					</div>		<!-- /.control-group -->
					<div class="control-group">
	        		<label class="control-label">Admin Password</label>
					<div class="controls">
			    	<div class="input-prepend">
					<span class="add-on"><i class="icon-lock"></i></span>
					<input type="text" class="input-xlarge uneditable-input" id="apass" name="apass" value="<?php echo $val['2']; ?>">
					</div>
					</div>
					</div>		<!-- /.control-group -->
					<div class="control-group">
					<label class="control-label"></label>
	      			<div class="controls">
	       			<button type="submit" class="btn btn-success" name="save">Save</button>
	      			<a href="profile.php"><button type="button" class="btn btn-warning" >Cancel</button></a>
	      			</div>
					</div>		<!-- /.control-group -->
					</div>		<!-- /.span9 offset1 -->
					</form>
					</div>		<!-- /.row-fluid -->
   					</div>		<!-- /.well -->
				<ul class="breadcrumb">
					<li><a href="home.php">Home</a> <span class="divider">&raquo;</span></li>
					<li><a href="profile.php">Profile</a></li>
				</ul>    <!-- /.breadcrumb -->
				</div>		<!-- /.span12 -->
			</div>		<!-- /.span10 offset1 -->
		</div>		<!-- /.row-fluid -->
	</div>		<!-- /.container-fluid -->
	
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap-transition.js"></script>
    <script src="../assets/js/bootstrap-modal.js"></script>
    <script src="../assets/js/bootstrap-dropdown.js"></script>
    <script src="../assets/js/bootstrap-tab.js"></script>
    <script src="../assets/js/bootstrap-button.js"></script>
    <script src="../assets/js/bootstrap-affix.js"></script>
    <script src="../assets/js/holder/holder.js"></script>
    <script src="../assets/js/google-code-prettify/prettify.js"></script>
    <script src="../assets/js/application.js"></script>	
<?php
mysql_close($con);
?>
	</body>
</html>