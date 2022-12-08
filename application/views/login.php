<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Air Line</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style type="text/css">

	</style>
</head>
<body>

<div class="container">
 <?php $error_msg = $this->session->flashdata('error_msg'); ?> 
  <h3 style="color: red;"><?php if(isset($error_msg)){
	  echo $error_msg;
  } ?></h3> 
<div class="row" style="margin-top:30px">
<form action="<?php echo base_url(); ?>/user_login" method="post">
  <label for="uname">User name:</label><br>
  <input type="text" id="uname" name="uname" placeholder="Enter Username" required><br>
  <label for="password">Password:</label><br>
  <input type="password" id="password" name="password" placeholder="Enter Password" required><br><br>
  <input type="submit" value="Submit">
</form> 

</div>

</div>

</body>
</html>
