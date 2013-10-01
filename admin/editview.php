<!DOCTYPE html>
<?php
session_start();
if(empty($_SESSION['adminid']))
header("Location:index.php");
include('dbconnect.php');
$md=$_GET['md'];
$ppid=$_GET['pid'];
	//Edit Propert Start
$r=mysql_query("select * from product WHERE p_id=$ppid ",$con) or die(mysql_error());
$val=mysql_fetch_array($r);
if(isset($_POST['dppic']))
{
	$re=mysql_query("update product set p_img='no_thumb.jpg' WHERE p_id=$ppid",$con) or die(mysql_error());
}
if(isset($_POST['resave']))
{
	$ppic=$val['attachment'];
	$pn=$_POST['pname'];
	$pt=$_POST['type'];
	$ph=$_POST['hno'];
	$plc=$_POST['loc'];
	$pc=$_POST['city'];
	$pst=$_POST['state'];
	$pco=$_POST['country'];
	$pl=$_POST['landmark'];
	$pk=$_POST['kitchen'];
	$pb=$_POST['bedroom'];
	$pba=$_POST['bathroom'];
	$pf=$_POST['facilities'];
	$pp=$_POST['price'];
	$pbu=$_POST['builduparea'];
	$pcv=$_POST['coveragearea'];
	$pa=$_POST['age'];
	$pd=$_POST['description'];
	$upl=$_FILES['f1']['name'];
	$trg="../images/attachments/" . $upl;
	$tmp=$_FILES['f1']['tmp_name'];
	move_uploaded_file($tmp,$trg);
	if($upl=="")
	$query1="update property set pname='$pn', ptypeid=$pt, houseno='$ph', location='$plc', city='$pc', state='$pst', country='$pco', landmark='$pl', kitchen=$pk, bedroom=$pb, bathroom=$pba, facilities='$pf', price=$pp, builduparea=$pbu, coveragearea=$pcv, age=$pa, description='$pd', attachment='$ppic' WHERE pid=$ppid";
	else
	$query1="update property set pname='$pn', ptypeid=$pt, houseno='$ph', location='$plc', city='$pc', state='$pst', country='$pco', landmark='$pl', kitchen=$pk, bedroom=$pb, bathroom=$pba, facilities='$pf', price=$pp, builduparea=$pbu, coveragearea=$pcv, age=$pa, description='$pd', attachment='$upl' WHERE pid=$ppid";
	$x= mysql_query($query1,$con) or die(mysql_error());
	if($x)
		echo "<script type='text/javascript'>alert('Changes Saved');</script>";
}
	// Edit Property End
?>

<html lang="en">
	<head>
		<link href="../assets/css/bootstrap.css" rel="stylesheet">
    	<link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">
    	<link href="../assets/css/docs.css" rel="stylesheet">
    	<link href="../assets/js/google-code-prettify/prettify.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="../assets/css/DT_bootstrap.css">
	</head>
	<body>
	<div class="container-fluid">    <!-- add a fluid , centered layout -->
			<div class="row-fluid">
				<div class="span10 offset1">
					<div class="navbar">
						<div class="navbar-inner">
							<a class="brand" href="home.php">Admin Panel</a>
							<ul class="nav">      <!-- add links to the navbar -->
								<li><a href="home.php">Home</a></li>
								<li><a href="profile.php">Profile</a></li>
								<li><a href="changepassword.php">Change Password</a></li>
								<li><a href="logout.php">Logout</a></li>
							</ul>		<!-- /.nav -->
						</div>      <!-- /.navbar-inner -->
					</div>    <!-- /.navbar -->
		<div class="well">
		<form class="form-horizontal" method="post" action="editview.php?md=<?php echo $md;?> & pid=<?php echo $ppid; ?>" enctype="multipart/form-data">
		<!-- Edit -->
		<?php if($md==1){ ?>
		<ul class="breadcrumb">
		<li><a href="home.php">Home</a> <span class="divider">&raquo;</span></li>
		<li>Edit Property</li>
		</ul>
		<legend>Edit Property</legend>
			<div class="row-fluid">
				<div class="span3">
	        		<p class="text-info">Property Picture</p>
					<a href="../images/attachments/<?php echo $val['attachment']; ?>" class="thumbnail">
					<img class="img-rounded" src="../images/attachments/<?php echo $val['attachment']; ?>" name="ppic" />
					</a>
					<input type="file" name="f1" accept="image/*" title="Change Picture" class="btn btn-link btn-mini"/>
					<input type="submit" name="dppic" value="Delete Photo" class="btn btn-warning btn-mini">
				</div>		<!-- /.span3 -->
				<div class="span7 offset1">
      				<div class="control-group">
	        		<label class="control-label">Property Name</label>
					<div class="controls">
			    	<div class="input-prepend">
					<span class="add-on"><i class="icon-lock"></i></span>
					<input type="text" class="input-xlarge" name="pname" placeholder="Property Name"  value="<?php echo $val['pname']; ?>">
					</div>
					</div>
					</div>		<!-- /.control-group -->
					<div class="control-group">
	        		<label class="control-label">Type</label>
					<div class="controls">
			    	<div class="input-prepend">
					<span class="add-on"><i class="icon-lock"></i></span>
					<input type="number" max="2" min="1" class="input-xlarge" value="<?php echo $val['ptypeid']; ?>" name="type" placeholder="Type">
					</div>
					</div>
					</div>		<!-- /.control-group -->
					<div class="control-group ">
	        		<label class="control-label" for="hno">House No</label>
					<div class="controls">
			    	<div class="input-prepend">
					<span class="add-on"><i class="icon-lock"></i></span>
					<input type="text" class="input-xlarge" name="hno" placeholder="House Number" value="<?php echo $val['houseno']; ?>">
					</div>
					</div>
					</div>     <!-- /.control-group -->
					<div class="control-group ">
	        		<label class="control-label">Sector / Location</label>
					<div class="controls">
			    	<div class="input-prepend">
					<span class="add-on"><i class="icon-lock"></i></span>
					<input type="text" class="input-xlarge" name="loc" placeholder="Sector / Location" value="<?php echo $val['location']; ?>">
					</div>
					</div>
					</div>		<!-- /.control-group -->
					<div class="control-group ">
	        		<label class="control-label">City</label>
					<div class="controls">
			    	<div class="input-prepend">
					<span class="add-on"><i class="icon-lock"></i></span>
					<input type="text" class="input-xlarge" name="city" value="<?php echo $val['city']; ?>" placeholder="City">
					</div>
					</div>
					</div>		<!-- /.control-group -->
					<div class="control-group ">
	        		<label class="control-label">State</label>
					<div class="controls">
			    	<div class="input-prepend">
					<span class="add-on"><i class="icon-lock"></i></span>
					<input type="text" class="input-xlarge" value="<?php echo $val['state']; ?>" name="state" placeholder="State">
					</div>
					</div>
					</div>		<!-- /.control-group -->
					<div class="control-group ">
	        		<label class="control-label">Country</label>
					<div class="controls">
			    	<div class="input-prepend">
					<span class="add-on"><i class="icon-lock"></i></span>
					<input type="text" class="input-xlarge" value="<?php echo $val['country']; ?>" name="country" placeholder="Country">
					</div>
					</div>
					</div>		<!-- /.control-group -->
					<div class="control-group ">
	        		<label class="control-label">Landmark</label>
					<div class="controls">
			    	<div class="input-prepend">
					<span class="add-on"><i class="icon-lock"></i></span>
					<input type="text" class="input-xlarge" value="<?php echo $val['landmark']; ?>" name="landmark" placeholder="Landmark">
					</div>
					</div>
					</div>		<!-- /.control-group -->
					<div class="control-group">
	        		<label class="control-label">Kitchen</label>
					<div class="controls">
			    	<div class="input-prepend">
					<span class="add-on"><i class="icon-lock"></i></span>
					<input type="number" class="input-xlarge" value="<?php echo $val['kitchen']; ?>" name="kitchen" placeholder="Kitchen" min="0" max="8">
					</div>
					</div>
					</div>		<!-- /.control-group -->
					<div class="control-group">
	        		<label class="control-label">Bedroom</label>
					<div class="controls">
			    	<div class="input-prepend">
					<span class="add-on"><i class="icon-lock"></i></span>
					<input type="number" class="input-xlarge" value="<?php echo $val['bedroom']; ?>" name="bedroom" placeholder="Bedroom" min="0" max="10">
					</div>
					</div>
					</div>		<!-- /.control-group -->
					<div class="control-group">
	        		<label class="control-label">Bathroom</label>
					<div class="controls">
			    	<div class="input-prepend">
					<span class="add-on"><i class="icon-lock"></i></span>
					<input type="number" class="input-xlarge" value="<?php echo $val['bathroom']; ?>" name="bathroom" placeholder="Bathroom" min="0" max="8">
					</div>
					</div>
					</div>		<!-- /.control-group -->
					<div class="control-group">
	        		<label class="control-label">Facilities</label>
					<div class="controls">
			    	<div class="input-prepend">
					<span class="add-on"><i class="icon-info-sign"></i></span>
					<input type="text" id="facilities" class="input-xlarge" value="<?php echo $val['facilities']; ?>" name="facilities" placeholder="Facilities">
					</div>
					</div>		
					</div>		<!-- /.control-group -->
					<div class="control-group">
	        		<label class="control-label">Price</label>
					<div class="controls">
			    	<div class="input-prepend input-append">
					<span class="add-on">Rs</span>
					<input class="span5" id="appendedPrependedInput" name="price" type="text" value="<?php echo $val['price']; ?>">
					<span class="add-on">.00</span>
					</div>
					</div>
					</div>		<!-- /.control-group -->
					<div class="control-group">
	        		<label class="control-label">Buildup Area</label>
					<div class="controls">
			    	<div class="input-prepend">
					<span class="add-on"><i class="icon-thumbs-up"></i></span>
					<input type="text" class="input-xlarge" value="<?php echo $val['builduparea']; ?>" name="builduparea" placeholder="Buildup Area">
					<span class="add-on">Sq. m</span>
					</div>
					</div>
					</div>		<!-- /.control-group -->
					<div class="control-group">
	        		<label class="control-label">Coverage Area</label>
					<div class="controls">
			    	<div class="input-prepend">
					<span class="add-on"><i class="icon-thumbs-up"></i></span>
					<input type="text" class="input-xlarge" value="<?php echo $val['coveragearea']; ?>" name="coveragearea" placeholder="Coverage Area">
					<span class="add-on">Sq. m</span>
					</div>
					</div>
					</div>		<!-- /.control-group -->
					<div class="control-group">
	        		<label class="control-label">Age</label>
					<div class="controls">
			    	<div class="input-prepend">
					<span class="add-on"><i class="icon-thumbs-down"></i></span>
					<input type="number" class="input-xlarge" value="<?php echo $val['age']; ?>" name="age" placeholder="Age" min="0" max="15">
					<span class="add-on">Year(s)</span>
					</div>
					</div>
					</div>		<!-- /.control-group -->
					<div class="control-group">
	        		<label class="control-label">Description</label>
					<div class="controls">
			    	<div class="input-prepend">
					<span class="add-on"><i class="icon-info-sign"></i></span>
					<textarea rows="3" name="description"><?php echo $val['description']; ?></textarea>
					</div>
					</div>
					</div>		<!-- /.control-group -->
					<div class="form-actions">
					<button class="btn btn-primary" type="submit" name="resave">Save changes</button>
					<input class="btn btn-warning" type="reset">
					</div>		<!-- /.form-actions -->
				</div>		<!-- /.span7 offset1 -->
					</div>		<!-- row-fluid -->
				
		<?php } ?>
		<!-- Edit End -->
		
		<!-- View -->
		<?php if($md==2){ ?>
		<legend>View Property</legend>
		<div class="row-fluid">
				<div class="span3">
					<a href="../images/attachments/<?php echo $val['attachment']; ?>" class="thumbnail">
					<img class="img-rounded" src="../images/attachments/<?php echo $val['attachment']; ?>" />
					</a>
				</div>		<!-- /.span3 -->
				<div class="span7 offset1">
				</div>
		</div>		<!-- /.row-fluid -->
		<?php } ?>
		<!-- View End -->
		</form>        <!-- /.form-horizontal -->
		<ul class="breadcrumb">
		<li><a href="home.php">Home</a> <span class="divider">&raquo;</span></li>
		<li><a href="editview.php">Edit Property</a></li>
		</ul>
		</div>		<!-- /.well -->
		</div>		<!-- /.span10 offset1 -->
		</div>		<!-- /.row-fluid -->
		</div>		<!-- /.container-fluid -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="../assets/js/jquery.js"></script>
		<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
		<script src="../assets/js/bootstrap-transition.js"></script>
		<script src="../assets/js/bootstrap-modal.js"></script>
		<script src="../assets/js/bootstrap-affix.js"></script>
		<script src="../assets/js/holder/holder.js"></script>
		<script src="../assets/js/google-code-prettify/prettify.js"></script>
    	<script src="../assets/js/application.js"></script>
<?php
mysql_close($con);
?>
	</body>
</html>