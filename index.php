<?php 
  session_start(); 

  if (!isset($_SESSION['email'])) {
  	header('location: kreu.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['email']);
  	header("location: kreu.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
</head>
<body>
    <?php  if (isset($_SESSION['email'])){ 
		 header('location: faqjauserit.php');
	 } ?>
</div>
		
</body>
</html>