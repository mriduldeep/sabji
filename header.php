<style>
	div.dropdown-menu
	{
		margin-left: -130px;
		width: 350px;
	}
	div.dropdown-menu > .form-horizontal
	{
		margin-left: -70px;
	}
</style>
	<div class="navbar navbar-inverse yamm navbar-fixed-top" style="top:0px; width: 80%;margin-left: 10%;">
		<div class="navbar-inner">
			<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            	<span class="icon-bar"></span>
            	<span class="icon-bar"></span>
            	<span class="icon-bar"></span>
        	</button>		<!-- /.btn btn-navbar -->
			<div class="nav-collapse collapse">
            	<ul class="nav">
				<li class="active"><a href="index.php"><i class="icon-home"></i> Home</a></li><li class="divider-vertical"></li>
				<li><a href="">Vegetables</a></li><li class="divider-vertical"></li>
				<li><a href="">Fruits</a></li><li class="divider-vertical"></li>
				<li><a href="">Grocery</a></li><li class="divider-vertical"></li>
				<li><a href="">Beverages</a></li><li class="divider-vertical"></li>
				<li><a href="">Household</a></li><li class="divider-vertical"></li>
				<li><a href="">Special Offers</a></li>
				</ul>
				<div class="pull-right">
					<ul class="nav pull-right offset4">
					<?php
					if(empty($_SESSION['username']))
					{
					?>
					<li class="divider-vertical"><a href="register.php">Register</a></li>
			  		<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" style="cursor: pointer;" href="#">Sign In <strong class="caret"></strong></a>
					<div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
					<form method="post" action="index.php" accept-charset="UTF-8" class="form-horizontal">
						<div class="control-group">
							<label class="control-label" for="inputEmail">Email Id</label>
							<div class="controls">
							<input type="text" id="inputEmail" name="inputEmail" placeholder="Email">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="inputPassword">Password</label>
							<div class="controls">
							<input type="password" id="inputPassword" name="inputPassword" placeholder="Password">
							</div>
						</div>
						<div class="control-group">
							<div class="controls">
							<label class="checkbox">
							<input type="checkbox" value="1"> Remember me
							</label>
							<button type="submit" class="btn btn-primary btn-large btn-block" name="signIn" style="margin-left: -55px;">Sign in</button>
							</div>
						</div>
					</form>
					</div>		<!-- /.dropdown-menu -->
					</li>
						<?php
						}
						else
						{
						?>
						<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome, <?php echo $_SESSION['username']; ?> <b class="caret"></b></a>
						<ul class="dropdown-menu">
						<li><a href=""><i class="icon-cog"></i> Preferences</a></li>
						<li><a href=""><i class="icon-envelope"></i> Contact Support</a></li>
						<li class="divider"></li>
						<li><a href="logout.php"><i class="icon-off"></i> Logout</a></li>
						</ul>
						</li>
						<?php
						}
						?>
            	</ul>		<!-- /.nav -->
					</div>
			</div>
		</div>
	</div>
	<div class="navbar" style="position: relative;top: 3px;">
	<div class="navbar-inner">
		<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
		<div class="nav-collapse collapse" id="nav1">
        	<ul class="nav">
			<li><a href="index.php" class="offset1"><img src="images/logo.png"/></a></li>
			<li style="position: relative;top:20px;">Current area of delivery: <strong>Greater Noida</strong></li><li class="divider-vertical"></li>
			<li style="position: relative;top:10px;"><a href="">About Us</a></li><li class="divider-vertical"></li>
			<li style="position: relative;top:10px;"><a href="">Contact Us</a></li><li class="divider-vertical"></li>
			<li style="position: relative;top:10px;"><a href="">FAQs</a></li>
			<li style="position: relative;left: 8%;top: 12px;"><img src="images/cart_top.jpg"/><span><?php echo " item(s) in basket"; ?></span></li>
			<br />
			<li style="top: 15px;position: relative;">
				<form class="form-inline form-search" method="post" action="">
				<div class="input-append">
					<input type="text" placeholder="Search product eg. Potato, Banana" class="search-query input-xxlarge"/>
					<button type="submit" class="btn"><i class="icon-search"></i></button>
				</div>
				</form>
			</li>
			<li style="position: relative;top:25px;left: 100px;"><a href="">My Wishlist</a></li>
			</ul>
		</div>
	</div>
	</div>