<?php
include('dbconnect.php');
$id=$_POST['id'];
mysql_query("delete from category where category_id='$id'") or die(mysql_error());
?>