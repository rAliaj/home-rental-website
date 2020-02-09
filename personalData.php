<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Te dhenat personale</title>
        <link href="personalData.css" rel="stylesheet" >
        <script src="https://kit.fontawesome.com/279412094b.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Condensed|Roboto+Mono&display=swap" rel="stylesheet">
        </script>
    </head>
    <body>
            <nav>
                <div id="logo">
                    <i class="fas fa-home"></i>
                </div>
                <ul>
                    <li><a class="active" href="faqjauserit.php">Kreu</a></li>
                    <li><a href="faqjauserit.php">Pronat</a></li>
                    <li><a href="faqjauserit.php">Na kontaktoni</a></li>
                    <!--<li><a href="index.php?logout='1'">Dil</a></li>-->
                    <li ><div id="hyr"><i class="fas fa-user-circle"></i></div></li>
                </ul>
            </nav>
            <div id="kreu">
            <div id="llogari" ><br/>
                    <a href="#">Te dhenat personale</a><br/><br/>
                    <a href="shporta.php">Shporta</a><br/><br/>
                    <a href="index.php?logout='1'">Dil</a><br/><a></a>
            </div>
            <div>
            <?php
                session_start();
                $conn=mysqli_connect("localhost","root","","db");
                $useri=$_SESSION['email'];
                $qry="select * from users where email='$useri'";
                $result=mysqli_query($conn,$qry);
                while($row=mysqli_fetch_array($result)){?>
                    <div id="regjistrohu">
                    <h2>Perditeso te dhenat</h2>
                    <form method="post" action="">
                        <div id="inputet">
                            <input id="textt" type="text" name="emri" value="<?php echo $row['emri']; ?>" /><label>Emri</label><br/>
                            <input type="text" id="textt" name="mbiemri" value="<?php echo $row['mbiemri']; ?>" /><label>Mbiemri</label>
                            <br/><input type="text" id="textt" name="email" value="<?php echo $row['email']; ?>" /><label>Email</label>
                            <br/><input type="tel" id="textt" name="tel" value="<?php echo $row['tel']; ?>" /><label>Cel</label>
                            <br/><input type="password" id="textt" name="fk" /><label>Fjalekalimi</label>
                            <br/><input type="password" id="textt" name="fkKonfirm" /><label>Konfirmo fjalekalimin</label>
                        </div>
                        <div><input type="submit" id="sub" name="perditeso" value="Perditeso te dhenat" /></div>
                    </form>
                </div>
                <?php }
                $emri=$mbiemri=$email=$tel="";
                $errors = array(); 
                if(isset($_POST['perditeso']))
                {   $emri = $_POST['emri'];
                    $mbiemri = $_POST['mbiemri'];
                    $tel = $_POST['tel'];
                    $email = $_POST['email'];
                    $password_1 = $_POST['fk'];
                    $password_2 = $_POST['fkKonfirm'];
                    if ((empty($emri))||(empty($mbiemri))) { echo "<div id='gabime'>Te gjitha fushat jane te detyruara</spam><br>"; }
                    else if (!preg_match("/^[a-zA-Z]*$/",$emri)) { echo "Lejohen vetem shkronja ne fushen emri<br>"; }
                    else if (!preg_match("/^[a-zA-Z]*$/",$mbiemri)) { echo "Lejohen vetem shkronja ne fushen mbiemri<br>"; }
                    else if(!preg_match("/^[0-9 ]*$/",$tel) &&empty($tel)) { echo "Lejohen vetem numra ne fushen tel<br>"; }
                    else if (!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zAZ]{2,4}$/",$email)) { echo "Vendosni nje email te sakte<br>"; }
                    else if (strlen($password_1)<8 && empty($password_1)) { echo "Fjalekalimi duhet te kete minimumi 8 karaktere<br>"; }
                    else if ($password_1 != $password_2) {
                      echo "Dy fjalekalimet nuk perputhen";
                    }
                    /*$user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
                    $result = mysqli_query($conn, $user_check_query);
                    $user = mysqli_fetch_assoc($result);{
                    if ($user) { // nqse useri ekziston
                        if ($user['email'] === $email) {
                        echo "Email-i ekziston";
                        }
                    }*/
                    else{
                        $password = $password_1;//md5($password_1)

                        $qry="UPDATE users SET emri='$emri',mbiemri='$mbiemri',email='$email',
                    tel='$tel',password='$password' WHERE email='$useri'";
                        $rezultat=mysqli_query($conn, $qry);
                        if(!$rezultat){
                            echo "error";
                        }else{
                        $_SESSION['email'] = $email;
                        //$_SESSION['success'] = "You are now logged in";
                        //echo "sukses";
                        header('location: faqjauserit.php');}
                    }}
                    
                
            ?></div>
            </div>
            <script src="js.js"></script>
    </body>
</html>
