<?php
  session_start();
  if(isset($_SESSION['user']))
  {
    header('Location: index.php');
    exit;
  }
  require_once('../lib/User.php') ;
  if(isset($_POST['submit']))
  {
    $user = new User();
    $user->email = $_POST['email'] ;
    $user->password = $_POST['password'] ;
    if(!$user->error and $user->login())
    {
      $_SESSION['user'] = $user->email ;
      header('Location:index.php');exit;
    }else {
      echo "<div class='error'>Invalid username or password</div>" ;
    }
  }
  include_once('layout/admin_header.php');
 ?>

 <h2 class="form_title">Signin to Ecom</h2>

<form method="post">

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
    <input type="submit" name="submit" value="Sign In" />
  </div>

</form>

 <?php
   include_once('layout/admin_footer.php');
  ?>
