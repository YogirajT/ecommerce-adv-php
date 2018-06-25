<?php
	session_start();
	if(isset($_SESSION['user']))
	{
		header('Location: index.php');
		exit;
	}
	include_once('layout/admin_header.php');
	require_once('../lib/User.php') ;
	$msg = "";
	if(isset($_POST['submit']))
	{
		$user = new User();
		$user->full_name = $_POST['full_name'] ;
		$user->email = $_POST['email'] ;
		$user->password = $_POST['password'] ;
		if(!$user->error)
		{
			$user->save();
			$msg = "User successfully registered in the db" ;
		}
	}
 ?>

 <h2 class="form_title">Signup to Ecom</h2>

<h4><?=$msg; ?></h4>
<form method="post">
	<div class="row">
		<label for="full_name">Full Name</label>
		<input type="text" name="full_name" id="full_name" />
		<div class="error"><?php if(isset($user->error['full_name'])) echo $user->error['full_name']; ?></div>
	</div>

	<div class="row">
		<label for="emailid">Email</label>
		<input type="email" name="email" id="emailid" />
		<div class="error"><?php if(isset($user->error['email'])) echo $user->error['email']; ?></div>
	</div>

	<div class="row">
		<label for="password">Password</label>
		<input type="password" name="password" id="password" />
		<div class="error"><?php if(isset($user->error['password'])) echo $user->error['password']; ?></div>
	</div>

	<div class="row">
		<input type="submit" name="submit" value="Sign Up" />
	</div>

</form>

 <?php
	 include_once('layout/admin_footer.php');
	?>
