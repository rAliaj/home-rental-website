<?php 
include 'server.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Kryefaqja</title>
        <link href="cssKreu.css" rel="stylesheet" >
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
                    <li><a class="active" href="#kreu">Kreu</a></li>
                    <li><a href="#rreth">Rreth nesh</a></li>
                    <li><a href="#pronat">Pronat</a></li>
                    <li><a href="#kontakt">Na kontaktoni</a></li>
                    <li ><a id="regjistrim" href="#regjistrim">Regjistrohu</a></li>
                    <!--<li><div id="ikone-kerkimi"><i class="fas fa-search"></i></div></li>-->
                </ul>
            </nav>
            <div id="fushe-kerkimi">
                <input  type="text" placeholder="Kerko ketu" >
            </div>
            <div id="kreu">
                <p id="nj"><mark class="ngjyra"><strong>Prona Jote</strong></mark></p>
                <p id="dy"><mark class="ngjyra"><strong>Privilegji Ynë!</strong></mark></p>
                <div id="kycu">
                    <h3>Hyr</h3>
                    <form method="post" action="kreu.php">
                        <div id="inputet">
                           <label>Email-i</label><br/>
                           <input type="text" name="user" />
                        </div>
                        <div id="inputet">
                            <label>Fjalekalimi</label><br/>
                            <input type="password" name="pas" />
                         </div><?php include 'errors.php'; ?>
                         <div id="btnn"><input id="submit" name="hyr" type="submit" value="Hyr" />
                         <input type="reset" id="reset" value="Fshi" /></div>
                    </form>
                </div>
                <div id="regjistrohu">
                    <h2>Regjistrohu</h2>
                    <form method="post" action="kreu1.php">
                        <div id="inputet">
                            <input id="textt" type="text" name="emri" placeholder="Emri" value="<?php echo $emri ?>" /><label>Emri</label><br/>
                            <input type="text" id="textt" name="mbiemri" placeholder="Mbiemri" value="<?php echo $mbiemri ?>" /><label>Mbiemri</label>
                            <br/><input type="text" id="textt" name="email" placeholder="Email" value="<?php echo $email ?>" /><label>Email</label>
                            <br/><input type="tel" id="textt" name="tel" placeholder="Cel"value="<?php echo $tel ?>" /><label>Cel</label>
                            <br/><input type="password" id="textt" name="fk" placeholder="Fjalekalimi"/><label>Fjalekalimi</label>
                            <br/><input type="password" id="textt" name="fkKonfirm" placeholder="Konfirmo fjalekalimin"/><label>Konfirmo</label>
                        </div><?php include 'errors.php';?>
                        <div><input type="submit" id="sub" name="regj" value="Krijo llogari" />
                        <input type="reset" id="res" value="Fshi" /></div>
                    </form>
                </div>
            </div>
        <main>
            <section id="rreth">
                <h2>Rreth nesh</h2>
                <div id="rreth-nesh">
                <div id="info">
                    Ky eshte nje website qe sherben per dhenien online te informacionit te 
                    apartamenteve me qira. <br/></br/>Me anën e tij cdo person do të ketë mundësinë që 
                    të informohet ne lidhje me apartamentet qe jepen me qira.
                    <br/><br/>Klienti do te mare informacione te detajueshme ne lidhje me cdo apartament si psh: 
                    <span class="kat1">ku ndodhet madhesia e apartamentit cmimi e te tjera<br/>   
                <p class="paragraf">
                    Me përfshirjen dhe përvojën tonë , ne besojmë se mund të ofrojmë 
                    një shërbim gjithëpërfshirës, miqësor për të gjithë te interesuarit.
                </p>
                </div>
            </div>
            </section> 
            <div class="prona"> 
                <h1>Pronat</h1>
                <div id="pronatt">
                <?php
                $conn=mysqli_connect("localhost","root","","db");
                if(!$conn){
                    echo "Error:".mysqli_error($conn);
                }
                $rekordPerFaqe=3;
                $faqe='';
                if(isset($_GET['faqe'])){
                $faqe=$_GET['faqe'];
                }
                else{
                    $faqe=1;
                }
                $filloNga=($faqe-1)*$rekordPerFaqe;

                
                        $query="select * from amartamentet order by rand() limit $filloNga, $rekordPerFaqe";
                        $result=mysqli_query($conn,$query);
                        echo "<div id='pronat'>";
                        while($row=mysqli_fetch_array($result)){
                            echo "<a href='analizPronaVizitor.php?fq=".$row['ID']."'><div id='prona'><h2>".$row['Titulli']."!</h2><br/><img src='pronatFoto/".$row['ID'].".jpg' 
                            width='230px' height='220px' alt='foto'/><br/><h5>".$row['cmimi']."$/muaj.</h5><br/><p> Vendodhja:".$row['zona']."</p></div></a>";
                        }echo "</div>";
                        $qry="select * from amartamentet";
                        $resultt=mysqli_query($conn,$qry);
                        $nrRekordeve=mysqli_num_rows($resultt);
                        $faqeTotale=ceil($nrRekordeve/$rekordPerFaqe);
                        echo "<div id='faqet'>";
                        if($faqe>1){
                            echo '<a id="para" href="kreu.php?faqe='.($faqe-1).'"><<</a>';
                        }
                        for($i=1;$i<=$faqeTotale;$i++)
                        {
                            echo '<a id="aktual" href="kreu.php?faqe='.$i.'">  '.$i.'</a>';
                        }
                        if($i-1>$faqe){
                            echo '<a id="pas" href="kreu.php?faqe='.($faqe+1).'">>></a>';
                        }
                        echo "</div>";
                    ?>
                </div>
                </div>
            <footer id="kontakt">
                <div id="footeri-majtas">
                    <h3>Linket e shpejta</h3>
                    <p>
                        <ul>
                            <li><a href="#kreu">Kreu</a></li>
                            <li><a href="#rreth">Rreth nesh</a></li>
                            <li><a href="#pronat">Pronat</a></li>
                        </ul>
                    </p>
                </div>
                <div id="footeri-djathtas">
                    <h3>Menyrat e kontaktit</h3>
                    <p>Ju mund te na gjeni:</p>
                    <div id="rrjetetsociale">
                    <ul>
                        <li><a href="#"><i class="fas fa-phone"></i></a></li>
                        <li><a href="https://www.facebook.com/xhoanaaliaj/"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="https://www.instagram.com/rexhina.aliaj/"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="https://twitter.com/rexhinaaliaj/"><i class="fab fa-twitter"></i></a></li>
                    </ul>
                    <br/>
                    <h4>Ose ju mundeni te klikoni <a href="mailto:rexhinaaliaj99@gmail.com">ketu </a>per te na derguar nje email.</h4>
                    </div>
                </div>
            </footer>
        </main>
        <script src="script.js"></script>
    </body>
</html>
