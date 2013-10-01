<!DOCTYPE html>
<?php
session_start();
if(empty($_SESSION['adminid']))
header("Location:index.php");
include('dbconnect.php');
$md=$_GET['md'];
$oid=$_GET['oid'];
?>
<html>
<head>
		<link href="../assets/css/bootstrap.css" rel="stylesheet"/>
    	<link href="../assets/css/bootstrap-responsive.css" rel="stylesheet"/>
    	<link href="../assets/css/docs.css" rel="stylesheet"/>
    	<link href="../assets/js/google-code-prettify/prettify.css" rel="stylesheet"/>
		<link rel="stylesheet" type="text/css" href="../assets/css/DT_bootstrap.css"/>
</head>
<body>
<div class="container-fluid">
	<div class="row-fluid">
	<div class="span12">
<div class="navbar">
<div class="navbar-inner">
<a class="brand" href="home.php">Welcome Admin</a>
<ul class="nav">
<li><a href="home.php">Home</a></li>
<li><a href="profile.php">Profile</a></li>
<li><a href="changepassword.php">Change Password</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>
</div>
</div>
<?php
if($md==1)
{
?>
<ul class="breadcrumb">
		<li><a href="home.php">Home</a> <span class="divider">&raquo;</span></li>
		<li><a href="home.php">Order Master</a> <span class="divider">&raquo;</span></li>
		<li>Order Details</li>
		</ul>
<table class="table table-bordered">
<thead>
<tr>
	<th>Order ID</th>
	<th>Order Placed By</th>
	<th>Order Date &amp; Time</th>
	<th>Delivery Date &amp; Time</th>
	<th>Delivery Address</th>
</tr>
</thead>
<tbody>
<?php
$res=mysql_query("select * FROM order_master INNER JOIN user ON order_master.user_id=user.user_id WHERE order_id=$oid",$con);
$row=mysql_fetch_array($res);
?>
<tr>
	<td><?php echo $oid; ?></td>
	<td><?php echo $row['user_name']; ?></td>
	<td><?php echo $row['order_date']; ?></td>
	<td><?php echo $row['delivery_date']; ?></td>
	<td><?php echo $row['hno']." ".$row['street']." ".$row['location']." ".$row['city']; ?></td>
</tr>
</tbody>
</table>
<br />
<table class="table table-hover">
<caption><strong><?php $res= mysql_query("select * from order_detail where order_id = $oid",$con);
						      $data = mysql_num_rows($res); 
							  echo "There are  $data Products in this order.";?></strong><hr /></caption>
<thead>
<tr>
<th>Product ID</th>
<th>Product name</th>
<th>Quantity</th>
<th>Price</th>
<th>Total Amount</th>
</tr>
</thead>
<tbody>
	<?php
	$cat= mysql_query("select * from order_detail JOIN product ON order_detail.product_id=product.p_id where order_id=$oid",$con) OR die(mysql_error());
	while($cat1=mysql_fetch_array($cat))
	{
		$id = $cat1['0'];
	?>
<tr class="del3<?php echo $id; ?>">
	<td><?php echo $cat1['0']; ?></td>
	<td><?php echo $cat1['p_name']; ?></td>
	<td><?php echo $cat1['2']; ?></td>
	<td><?php echo "Rs. ".$cat1['3']; ?></td>
	<td><?php $total=$cat1['2'] * $cat1['3']; echo "Rs. ".$total; ?></td>
	</tr>
<?php
}
?>
</tbody>
<tfoot>
		<tr>
			<td><?php $res=mysql_query("select * FROM order_detail WHERE order_id=$oid",$con); $count=0; while($row=mysql_fetch_array($res)){$count++;} echo "Total Products = ".$count; ?></td>
			<td></td>
			<td><?php $res=mysql_query("select * FROM order_detail WHERE order_id=$oid",$con); $sum=0; while($row=mysql_fetch_array($res)){ $sum+=$row['quantity'];} echo "Total Quantity= $sum"; ?></td>
			<td></td>
			<td><?php $res=mysql_query("select * FROM order_detail WHERE order_id=$oid",$con); $sum=0; while($row=mysql_fetch_array($res)){ $sum+=($row['2']*$row['3']);} echo "Total Amount = Rs. $sum"; ?></td>
		</tr>
	</tfoot>
</table>
<?php
}
?>
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
		<script type="text/javascript" charset="utf-8" language="javascript" src="../assets/js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8" language="javascript" src="../assets/js/DT_bootstrap.js"></script>
</div>
</div>
</div>
</body>
</html>