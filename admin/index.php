<?php
  session_start();
  if(!isset($_SESSION['user']))
  {
    header('Location: signin.php');
    exit;
  }

  include_once('layout/admin_header.php');
 ?>

 <h2 class="form_title">Welcome to Dashboard</h2>

 <nav>
  <ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="product_list.php">Products</a></li>
    <li><a href="category_list.php">Categories</a></li>
    <li><a href="logout.php">Logout</a></li>
  </ul>
 </nav>
<?php
 include_once('layout/admin_footer.php');
?>
