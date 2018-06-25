<?php
	session_start();
	if(isset($_SESSION['user']))
	{
		header('Location: index.php');
		exit;
	}
	include_once('layout/admin_header.php');
	require_once('lib/User.php') ;
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
			$msg = "Registration successful!" ;
		}
		else{
			$msg = "Registration failed. Please fill the" ;			
		}
	}
 ?>

<section class="unfixed">
	<!-- Jumbotron -->
	<div class="jumbotron">
		<img src="./img/weblogo.png" alt="logo" class="img-responsive" id="logo1"/>
		<h4><?=$msg; ?></h4>
	</div>
</section>

<div class="col-xs-6 col-xs-offset-3" style="border:3px solid #3e8f3e; padding:3em; margin-top:1em; margin-bottom:1em; border-radius:10px">
	<h2 class="form_title">Signup to Tech Auctions</h2>
	<form method="post">
	<div class="form-group">
			<label for="exampleInputEmail1">Full Name :</label>
			<input type="text" class="form-control" name="full_name" id="exampleInputEmail1" placeholder="Full name">
			<div class="error"><?php if(isset($user->error['full_name'])) echo $user->error['full_name']; ?></div>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Email address :</label>
			<input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Email">
			<div class="error"><?php if(isset($user->error['email'])) echo $user->error['email']; ?></div>
		</div>
		<div class="form-group">
			<label for="exampleInputPassword1">Password :</label>
			<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
			<div class="error"><?php if(isset($user->error['password'])) echo $user->error['password']; ?></div>
		</div>
		<input type="submit" name="submit" class="btn btn-default" value="Sign Up">
	</form>
</div>

 <?php
	 include_once('admin/layout/admin_footer.php');
	?>