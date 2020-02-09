<?php
session_start();
$emri=$mbiemri=$email=$tel="";
$errors = array(); 

// lidhja me databazen
$db = mysqli_connect('localhost', 'root', '', 'db');

// regjistrimi userit
if (isset($_POST['regj'])) {
  $emri = $_POST['emri'];
  $mbiemri = $_POST['mbiemri'];
  $tel = $_POST['tel'];
  $email = $_POST['email'];
  $password_1 = $_POST['fk'];
  $password_2 = $_POST['fkKonfirm'];
  if ((empty($emri))||(empty($mbiemri))) { array_push($errors, "Te gjitha fushat jane te detyruara"); }
  if (!preg_match("/^[a-zA-Z]*$/",$emri)) { array_push($errors, "Lejohen vetem shkronja ne fushen emri"); }
  if (!preg_match("/^[a-zA-Z]*$/",$mbiemri)) { array_push($errors, "Lejohen vetem shkronja ne fushen mbiemri"); }
  if(!preg_match("/^[0-9 ]*$/",$tel) &&empty($tel)) { array_push($errors, "Lejohen vetem numra ne fushen tel"); }
  if (!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zAZ]{2,4}$/",$email)) { array_push($errors, "Vendosni nje email te sakte"); }
  if (strlen($password_1)<8) { array_push($errors, "Fjalekalimi duhet te kete minimumi 8 karaktere"); }
  if ($password_1 != $password_2) {
	array_push($errors, "Dy fjalekalimet nuk perputhen");
  }

  $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);{
  if ($user) { // nqse useri ekziston
    if ($user['email'] === $email) {
      array_push($errors, "Email-i ekziston");
    }
  }}
  if (count($errors) == 0) {
  	$password = $password_1;//md5($password_1)

  	$query = "INSERT INTO users (emri,mbiemri,tel,email,password) 
  			  VALUES('$emri','$mbiemri','$tel','$email','$password')";
  	mysqli_query($db, $query);
    $_SESSION['email'] = $email;
  	//$_SESSION['success'] = "You are now logged in";
  	header('location: faqjauserit.php');
  }
}

// ... 
if (isset($_POST['hyr'])) {
    $username = $_POST['user'];
    $password = $_POST['pas'];
  
    if (empty($username)){
        array_push($errors, "Fushat jane te detyruara");
    }
  
    if (count($errors) == 0) {
        $password = $password; //md5($password)
        $query = "SELECT * FROM users WHERE email='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        while($row = mysqli_fetch_assoc($results)){
          if (mysqli_num_rows($results) == 1) {
          $id = $row['IDuser'];
          $email = $row['email'];
          //session_start();
          $_SESSION['id'] = $id;
          $_SESSION['email'] = $email;
          //$_SESSION['success'] = "You are now logged in";
          header('location: faqjauserit.php');
        }else {
            array_push($errors, "Kombinim i gabuar email/fjalekalim");
        }
        }
    }
  }
  
  ?>