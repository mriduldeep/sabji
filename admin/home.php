<!DOCTYPE html>
<?php
session_start();
if(empty($_SESSION['adminid']))
header("Location:index.php");
include('dbconnect.php');
if(isset($_POST['add']))
{
	$cname=$_POST['cname'];
	$cparent=$_POST['cparent'];
	$cdesc=$_POST['cdesc'];
	$upl=$_FILES['cimg']['name'];
	echo $upl;
	$trg="../images/category/" . $upl;
	$tmp=$_FILES['cimg']['tmp_name'];
	move_uploaded_file($tmp,$trg);
	if($upl=="")
	$query="insert into category values (null,'$cname',$cparent,'$cdesc','no_thumb.jpg')";
	else
	$query="insert into category values (null,'$cname',$cparent,'$cdesc','$upl')";
	mysql_query($query,$con);
}
?>
<html>
<head>
		<link href="../assets/css/bootstrap.css" rel="stylesheet"/>
    	<link href="../assets/css/bootstrap-responsive.css" rel="stylesheet"/>
    	<link href="../assets/css/docs.css" rel="stylesheet"/>
    	<link href="../assets/js/google-code-prettify/prettify.css" rel="stylesheet"/>
		<link rel="stylesheet" type="text/css" href="../assets/css/DT_bootstrap.css"/>
		<title>Welcome Admin</title>
		<script language="javascript" type="text/javascript">
function valid()
{
	if(document.form1.cname.value=="")
	{
		document.form1.cname.focus();
		return false;
	}
}
	</script>
</head>
<body>
	<div class="container-fluid">
	<div class="row-fluid">
	<div class="span12">
<div class="navbar">
<div class="navbar-inner">
<a class="brand" href="home.php">Welcome Admin</a>
<ul class="nav">
<li class="active"><a href="home.php">Home</a></li>
<li><a href="profile.php">Profile</a></li>
<li><a href="changepassword.php">Change Password</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>
</div>
</div>
	<div class="tabbable tabs-right">
<ul class="nav nav-tabs">
<li class="active"><a href="#tab1" data-toggle="tab">Category Master</a></li>
<li><a href="#tab2" data-toggle="tab">Product Master</a></li>
<li><a href="#tab3" data-toggle="tab">Order Master</a></li>
<li><a href="#tab4" data-toggle="tab">User Master</a></li>
<li><a href="#tab5" data-toggle="tab">Accounts Master</a></li>
</ul>
<div class="tab-content">
<div class="tab-pane active" id="tab1">
<table class="table table-hover">
<caption><strong>Category List</strong><hr /></caption>
<thead>
<tr>
<th>Category ID</th>
<th>Category Name</th>
<th>Category Parent</th>
<th>Category Description</th>
<th>Category Image</th>
<th></th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<form method="post" action="home.php" name="form1" onsubmit="return valid();" enctype="multipart/form-data">
<td></td>
<td><input class="input-medium" type="text" name="cname" placeholder="Category Name" /></td>
<td><select class="span11" name="cparent">
	<option value="0" selected="selected">Root</option>
	<?php
	$res=mysql_query("select * FROM category",$con);
	while($rst=mysql_fetch_array($res))
	{
	?>
	<option value="<?php echo $rst['0']; ?>"><?php echo $rst['1']; ?></option>
	<?php
	}
	?>
	</select></td>
<td><input class="input-large" type="text" name="cdesc" placeholder="Description" /></td>
<td><input class="btn-mini" type="file" name="cimg" /></td>
<td><input class=" btn btn-small btn-primary" type="submit" name="add" value="Add" /></td>
<td><input class=" btn btn-small btn-warning" type="reset" /></td>
</form>
</tr>
	<?php
	$cat= mysql_query("select * from category",$con);
	while($cat1=mysql_fetch_array($cat))
	{
		$id = $cat1['0'];	
	?>
<tr class="del<?php echo $id; ?>">
	<td><?php echo $cat1['0']; ?></td>
	<td><?php echo $cat1['1']; ?></td>
	<td><?php echo $cat1['2']; ?></td>
	<td><?php echo $cat1['3']; ?></td>
	<td><img src="../images/category/<?php echo $cat1['4'];?>" alt="<?php echo $cat1['4'];?>" width="45" height="50" /></td>
	<td><button class="btn btn-small btn-warning">Edit</button></td>
	<td><button class="btn btn-small btn-danger" id="<?php echo $id; ?>">Delete</button></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
<div class="tab-pane" id="tab2">
					<div class="tabbable">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab2-1" data-toggle="tab">List Product</a></li>
							<li><a href="#tab2-2" data-toggle="tab">Add New Product</a></li>
							<li><a href="#tab2-3" data-toggle="tab">Offers & Promotions</a></li>
						</ul>		<!-- /.nav nav-tabs -->
					<div class="tab-content">
					<div class="tab-pane active" id="tab2-1">
                    <form class="form-search" method="post" action="">		<!-- Search form -->
					<span class="text-info">Filter By: </span>
                    <select name="cat" class="span2">
                    <option value="0">Category</option>
                    <?php
                    $res=mysql_query("select * from category",$con);
					while($row=mysql_fetch_array($res))
					{
					?>
                    <option><?php echo $row['1']; ?></option>
                    <?php
					}
					?>
                    </select>
                    <select name="sort" class="span2">
                    <option value="0">Sort By</option>
                    <option value="quantity">Availability</option>
                    <option>Price</option>
                    </select>
                    <div class="input-append">
                    <input type="text" name="pname" class="search-query" placeholder="Enter Product Name" title="Enter Product Name"/>
                    <button type="submit" name="search" class="btn btn-primary">Search</button>
                    </div>
                    </form>
					<table class="table table-hover" id="ptable" name="ptable">
				<caption class="lead"><?php $r=mysql_query("select * from product",$con); $pf=mysql_num_rows($r); echo "Total ".$pf. " Products found"; ?></caption>
				<thead>
				<tr>
				<th>Product ID</th>
				<th>Product Name</th>
				<th>Alias name</th>
				<th>Price</th>
				<th>Quantity</th>
				<th></th>
				<th></th>
				<th></th>
				</tr>
				</thead>
				<tbody>
				<?php
				$q=mysql_query("select * from product",$con);
				while($row=mysql_fetch_array($q))
				{
					$id = $row['p_id'];
				?>
				<tr class="del<?php echo $id; ?>">
				<td><?php echo $row['p_id']; ?></td>
				<td><?php echo $row['p_name']; ?></td>
				<td><?php echo $row['p_alias']; ?></td>
				<td><?php echo $row['p_price']; ?></td>
				<td><?php echo $row['p_quantity']; ?></td>
				<td><a href="editview.php?md=1 & pid=<?php echo $id;?>" role="button" class="btn btn-mini btn-primary">Edit</a></td>
				<td><a class="btn btn-mini btn-danger" id="<?php echo $id; ?>">Delete</a></td>
				<td><a href="editview.php?md=2 & pid=<?php echo $id;?>" role="button" class="btn btn-mini btn-info">View</a></td>
				</tr>
				<?php
				}
				?>
				</tbody>
				</table>		<!-- /.table table-hover -->
		
                    </div>
                    <div class="tab-pane" id="tab2-2">
                    <div class="tab-pane" id="tab1-2">
					<div class="well">		<!-- causes the content to appear sunken(grey background) on the page -->
      				<form name="propertyadd" id="propertyadd" class="form-horizontal" method="post" action="home.php" enctype="multipart/form-data">
						<legend>Add New Product</legend>
						<div class="control-group">
	        			<label class="control-label" for="pname">Product ID</label>
						<div class="controls">
			    		<div class="input-prepend">
							<span class="add-on"><i class="icon-lock"></i></span>
							<input type="text" class="input-xlarge" id="pid" name="pid" placeholder="Product ID">
						</div>
						</div>
						</div>          <!-- /.control-group -->
						<div class="control-group">
						<label class="control-label" for="type">Category ID</label>
						<div class="controls">
						<div class="input-prepend">
							<span class="add-on"><i class="icon-lock"></i></span>
							<input type="number" class="input-xlarge" id="cid" name="cid" placeholder="Category ID" max="2" min="1">
						</div>
						</div>
						</div>    		 <!-- /.control-group -->
						<div class="control-group ">
	        			<label class="control-label" for="hno">Name</label>
						<div class="controls">
			    		<div class="input-prepend">
							<span class="add-on"><i class="icon-lock"></i></span>
							<input type="text" class="input-xlarge" id="pname" name="pname" placeholder="Name">
						</div>
						</div>
						</div>     <!-- /.control-group -->
						<div class="control-group">
	        			<label class="control-label" for="price">Price</label>
						<div class="controls">
			    		<div class="input-prepend input-append">
							<span class="add-on">Rs</span>
							<input class="span5" id="price" name="price" type="text">
							<span class="add-on">.00</span>
						</div>
						</div>
						</div>     <!-- /.control-group -->
						<div class="control-group ">
	        			<label class="control-label" for="city">Alias</label>
						<div class="controls">
			    		<div class="input-prepend">
							<span class="add-on"><i class="icon-lock"></i></span>
							<input type="text" class="input-xlarge" id="palias" name="palias" placeholder="Name in Hindi">
						</div>
						</div>
						</div>     <!-- /.control-group -->
						<div class="control-group ">
	        			<label class="control-label" for="state">Quantity</label>
						<div class="controls">
			    		<div class="input-prepend">
							<span class="add-on"><i class="icon-lock"></i></span>
							<input type="text" class="input-xlarge" id="pquantity" name="pquantity" placeholder="Quantity in Stock">
						</div>
						</div>
						</div>     <!-- /.control-group -->
						<div class="control-group ">
	        			<label class="control-label" for="country">Brand</label>
						<div class="controls">
			    		<div class="input-prepend">
							<span class="add-on"><i class="icon-lock"></i></span>
							<input type="text" class="input-xlarge" id="pbrand" name="pbrand" placeholder="Product Brand">
						</div>
						</div>
						</div>     <!-- /.control-group -->
						<div class="control-group ">
	        			<label class="control-label" for="landmark">Status</label>
						<div class="controls">
			    		<div class="input-prepend">
							<span class="add-on"><i class="icon-lock"></i></span>
							<input type="text" class="input-xlarge" id="pstatus" name="pstatus" placeholder="Product Status">
						</div>
						</div>
						</div>     <!-- /.control-group -->
						<div class="control-group">
	        			<label class="control-label" for="description">Description</label>
						<div class="controls">
			    		<div class="input-prepend">
							<span class="add-on"><i class="icon-info-sign"></i></span>
							<textarea name="description" id="description" rows="3"></textarea>
						</div>
						</div>
						</div>     <!-- /.control-group -->
						<div class="control-group">
	        			<label class="control-label" for="ppic">Snapshot</label>
						<div class="controls">
			    		<div class="input-prepend">
							<span class="add-on"><i class="icon-file"></i></span>
							<input type="file" id="ppic" name="ppic" accept="image/*">
						</div>
						</div>
						</div>     <!-- /.control-group -->
						
						
						
						<div class="control-group">
						<label class="control-label"></label>
	      				<div class="controls">
	       					<button type="submit" class="btn btn-success" name="addproperty">Add Product</button>
	      					<a href="javascript:void(0)"><button type="button" class="btn btn-warning">Cancel</button></a>
	      				</div>
						</div>     <!-- /.control-group -->
	  					</form>        <!-- /.form-horizontal -->
   					</div>		<!-- /.well -->
					</div>		<!-- /.tab-pane -->
                    </div>
					<div class="tab-pane" id="tab2-3">
						
							 <table class="table table-hover">
<caption><strong><?php $res= mysql_query("select * from special_offer",$con);
						      $data = mysql_num_rows($res); 
							  echo "Total $data Offers found.";?></strong><hr /></caption>
<thead>
<tr>
<th>Offer ID</th>
<th>Product ID</th>
<th>Product Name</th>
<th>Description</th>
<th>Discount</th>
<th>Offer</th>
<th>Image</th>
<th></th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<form method="post" action="home.php" name="form1" onsubmit="" enctype="multipart/form-data">
<td></td>
<td><input class="input-mini" type="text" name="pid" placeholder="Product ID" /></td>
<td><input class="input-medium" type="text" name="pname" placeholder="Product Name" /></td>
<td><input class="input-large" type="text" name="odesc" placeholder="Description" /></td>
<td><input class="input-small" type="text" name="disc" placeholder="Discount" /></td>
<td><input class="input-small" type="text" name="offer" placeholder="Offer" /></td>
<td><input class="btn-mini" type="file" name="oimg" /></td>
<td><input class=" btn btn-small btn-primary" type="submit" name="add" value="Add" /></td>
<td><input class=" btn btn-small btn-warning" type="reset" /></td>
</form>
</tr>
	<?php
	$cat= mysql_query("select * from special_offer",$con);
	while($cat1=mysql_fetch_array($cat))
	{
		$id = $cat1['0'];	
	?>
<tr class="del<?php echo $id; ?>">
	<td><?php echo $cat1['0']; ?></td>
	<td><?php echo $cat1['1']; ?></td>
	<td></td>
	<td><?php echo $cat1['2']; ?></td>
	<td><?php echo $cat1['3']; ?></td>
	<td><?php echo $cat1['4']; ?></td>
	<td><img src="../images/category/<?php echo $cat1['5'];?>" alt="<?php echo $cat1['5'];?>" width="45" height="50" /></td>
	<td><button class="btn btn-small btn-warning">Edit</button></td>
	<td><button class="btn btn-small btn-danger" id="<?php echo $id; ?>">Delete</button></td>
</tr>
<?php } ?>
</tbody>
</table>
							
						
					</div>
                    </div>
                    </div>
</div>
<div class="tab-pane" id="tab3">
<div class="tabbable">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab3-1" data-toggle="tab">New Orders</a></li>
							<li><a href="#tab3-2" data-toggle="tab">Orders List</a></li>
							<li><a href="#tab3-3" data-toggle="tab">Delivered Orders</a></li>
						</ul>		<!-- /.nav nav-tabs -->
					<div class="tab-content">
					<!-- New Orders-->
					<div class="tab-pane active" id="tab3-1">
					<table class="table table-hover">
<caption><strong><?php $res= mysql_query("select * from order_master where order_status='undelivered'",$con);
						      $data = mysql_num_rows($res); 
							  echo "Total $data Order found.";?></strong><hr /></caption>
<thead>
<tr>
<th>Order ID</th>
<th>User ID</th>
<th>Order Date</th>
<th>Order Price</th>
<th>Order Status</th>
<th>Order Desc</th>
<th>Customer Phone</th>
<th></th>
<th></th>
<th></th>
</tr>
</thead>
<tbody>

	<?php
	$cat= mysql_query("select * from order_master where order_status='undelivered'",$con);
	while($cat1=mysql_fetch_array($cat))
	{
		$id = $cat1['0'];	
	?>
<tr class="del<?php echo $id; ?>">
	<td><?php echo $cat1['0']; ?></td>
	<td><?php echo $cat1['1']; ?></td>
	<td><?php echo $cat1['2']; ?></td>
	<td><?php echo $cat1['4']; ?></td>
	<td><?php echo $cat1['5']; ?></td>
	<td><?php echo $cat1['6']; ?></td>
	<td><?php echo $cat1['7']; ?></td>
	<td><a href="detailadd.php?md=1 & oid=<?php echo $id;?>" class="btn btn-mini btn-info">Details</a></td>
	<td><a href="detailadd.php?md=2 & oid=<?php echo $id;?>" class="btn btn-mini btn-danger">Delete</a></td>
	<td><a href="detailadd.php?md=3 & oid=<?php echo $id;?>"><button class="btn btn-mini btn-success" value="delivered">Delivered</button></a></td>
</tr>
<?php } ?>
</tbody>
</table>
							
					
                    </div><!--New order End-->
					
					<!--Order List-->
<div class="tab-pane" id="tab3-2">
					<table class="table table-hover">
<caption><strong><?php $res= mysql_query("select * from order_master",$con);
						      $data = mysql_num_rows($res); 
							  echo "Total $data Order found.";?></strong><hr /></caption>
<thead>
<tr>
<th>Order ID</th>
<th>User ID</th>
<th>Order Date</th>
<th>Order Price</th>
<th>Order Status</th>
<th>Order Desc</th>
<th>Customer Phone</th>
<th></th>
</tr>
</thead>
<tbody>

	<?php
	$cat= mysql_query("select * from order_master",$con);
	while($cat1=mysql_fetch_array($cat))
	{
		$id = $cat1['0'];	
	?>
<tr class="del<?php echo $id; ?>">
	<td><?php echo $cat1['0']; ?></td>
	<td><?php echo $cat1['1']; ?></td>
	<td><?php echo $cat1['2']; ?></td>
	<td><?php echo $cat1['4']; ?></td>
	<td><?php echo $cat1['5']; ?></td>
	<td><?php echo $cat1['6']; ?></td>
	<td><?php echo $cat1['7']; ?></td>
	<td><a href="detailadd.php?md=1 & oid=<?php echo $id;?>" role="button" class="btn btn-mini btn-info">Details</a></td>
</tr>
<?php } ?>
</tbody>
</table>
							
					
                    </div><!--Order List End-->
					
	<!--Delivered Orders-->				
<div class="tab-pane" id="tab3-3">
					<table class="table table-hover">
<caption><strong><?php $res= mysql_query("select * from order_master where order_status='delivered'",$con);
						      $data = mysql_num_rows($res); 
							  echo "Total $data Order found.";?></strong><hr /></caption>
<thead>
<tr>
<th>Order ID</th>
<th>User ID</th>
<th>Order Date</th>
<th>Order Price</th>
<th>Order Status</th>
<th>Order Desc</th>
<th>Customer Phone</th>
<th></th>
<th></th>
</tr>
</thead>
<tbody>

	<?php
	$cat= mysql_query("select * from order_master where order_status='delivered'",$con);
	while($cat1=mysql_fetch_array($cat))
	{
		$id = $cat1['0'];	
	?>
<tr class="del<?php echo $id; ?>">
	<td><?php echo $cat1['0']; ?></td>
	<td><?php echo $cat1['1']; ?></td>
	<td><?php echo $cat1['2']; ?></td>
	<td><?php echo $cat1['4']; ?></td>
	<td><?php echo $cat1['5']; ?></td>
	<td><?php echo $cat1['6']; ?></td>
	<td><?php echo $cat1['7']; ?></td>
	<td><a href="detailadd.php?md=1 & oid=<?php echo $id;?>" role="button" class="btn btn-mini btn-info">Details</a></td>
	<td><a href="detailadd.php?md=4 & oid=<?php echo $id;?>" role="button" class="btn btn-mini btn-danger">Move to Trash</a></td>
</tr>
<?php } ?>
</tbody>
</table>
							
					
                    </div><!--Delivered Order Ends-->
					</div>
</div>
</div>
<div class="tab-pane" id="tab4">
<table class="table table-hover">
			<caption class="lead"><br /><?php $r=mysql_query("select * from user",$con); $pf=mysql_num_rows($r); echo "Total ".$pf. " User(s) found"; ?></caption>
				<thead>
				<tr>
				<th>User ID</th>
				<th>User Name</th>
				<th>Email</th>
				<th>Mobile</th>
				<th>Address</th>
				<th>Status</th>
				<th></th>
				</tr>
				</thead>
				<tbody>
				<?php
				$query="select * from user";
				$q=mysql_query($query,$con);
				while($row=mysql_fetch_array($q))
				{
					$id = $row['user_id'];
				?>
				<tr>
				<td><?php echo $row['user_id']; ?></td>
				<td><?php echo $row['user_name']; ?></td>
				<td><?php echo $row['user_email']; ?></td>
				<td><?php echo $row['user_mobile']; ?></td>
				<td><?php echo $row['hno'].", ".$row['street'].", ".$row['location'].", ".$row['city']; ?></td>
				<td><?php echo $row['status']; ?></td>
				<td>
					<div class="btn-group" data-toggle="buttons-radio">
					<button type="button" class="btn btn-primary" value="Active">Activate</button>
					<button type="button" class="btn btn-warning">Deactivate</button>
					</div>
				</td>
				</tr>
				
				<?php
				}
				?>
				</tbody>
				</table>
				</div>
				<div class="tab-pane" id="tab5">
				
				</div>
</div>
</div>
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
		<script type="text/javascript">
        $(document).ready( function() {
            $('.btn-danger').click( function() {
                var id = $(this).attr("id");
                if(confirm("Are you sure you want to delete this Member?")){
                    $.ajax({
                        type: "POST",
                        url: "delete_member.php",
                        data: ({id: id}),
                        cache: false,
                        success: function(html){
                            $(".del"+id).fadeOut('slow'); 
                        } 
                    }); 
                }else{
                    return false;}
            });				
        });
    	</script>
	</div>
	</div>
	</div>
</body>
</html>