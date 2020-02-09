<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Mire se erdhet</title>
        <link href="styleuser.css" rel="stylesheet" >
        
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
                    <li><a href="#pronat">Pronat</a></li>
                    <li><a href="#kontakt">Na kontaktoni</a></li>
                    <!--<li><a href="shporta.php">Shporta</a></li>
                    <li><a href="index.php?logout='1'">Dil</a></li>-->
                    <li ><div id="hyr"><i class="fas fa-user-circle"></i></div></li>
                </ul>
            </nav>
            <div id="kreu">
                <div id="llogari" ><br/>
                    <a style=" text-transform: capitalize;">
                        <?php 
                        $conn=mysqli_connect("localhost","root","","db");
                        session_start();
                        $useri=$_SESSION['email'];
                        $qry="select * from users where email='$useri'";
                        $result=mysqli_query($conn,$qry);
                        while($row=mysqli_fetch_array($result)){
                            echo "".$row['emri']."    ".$row['mbiemri']."";
                        }
                        ?>
                    </a><br/><br/>
                    <a href="personalData.php">Te dhenat personale</a><br/><br/>
                    <a href="shporta.php">Shporta</a><br/><br/>
                    <a href="index.php?logout='1'">Dil</a><br/> <a></a></div>
                <div id="selekt">
                    <form method="post" action="faqjauserit.php">
                        <h1><mark>Gjej pronen qe kerkon.</mark></h1>
                        <select id="zgjidh" name="zgjidh">
                            <option selected></option>
                            <?php $conn=mysqli_connect("localhost","root","","db");
                                $query="select * from zona";
                                $result=mysqli_query($conn,$query);
                                while($row=mysqli_fetch_array($result)){
                                    echo "<option>".$row['zona']."</option>";
                                }?>
                        </select>
                        <input type="submit" id="kerkobtn" name="kerkobtn" value="Kerko"><br/>
                        <input type="button" id="kerkoavanc" value="Kerkim i avacnuar">
                    </form>
                </div>
                <form method="post" action="faqjauserit.php">
                <div id="kerkoshume">
                    <select id="zgjedh" name="zgjedh">
                    <option selected></option>
                    <?php $conn=mysqli_connect("localhost","root","","db");
                                $query="select * from zona";
                                $result=mysqli_query($conn,$query);
                                while($row=mysqli_fetch_array($result)){
                                    echo "<option>".$row['zona']."</option>";
                                }?>
                        </select>
                        <input type="number" name="cmimmin" id="cmimmin" placeholder="Cmimi minimal">
                        <input type="number" name="cmimmax" id="cmimmax" placeholder="Cmimi maksimal"><br/>
                        <input type="number" name="sipmin" id="sipmin" placeholder="Siperfaqe minimale">
                        <input type="number" name="sipmax" id="sipmax" placeholder="Siperfaqe maksimale">
                        <input type="number" id="dhoma" placeholder="Dhoma gjithsej"><br/>
                        <input type="submit" id="kerkoavancc" name="kerkoavanc" value="Kerko">
                </div>
                </form>
            </div>
        <main>
            <section class="prona"> 
                <h1>Pronat me te reja</h1>
                <div id="pronatt">
                <?php
                $conn=mysqli_connect("localhost","root","","db");
                $rekordPerFaqe=3;
                $faqe='';
                if(isset($_GET['faqe'])){
                $faqe=$_GET['faqe'];
                }
                else{
                    $faqe=1;
                }
                $filloNga=($faqe-1)*$rekordPerFaqe; 
                if(isset($_POST["kerkobtn"])){
                    $selekt=$_POST["zgjidh"];
                    $query="select * from amartamentet where zona like '%$selekt%'";
                    $result=mysqli_query($conn,$query);echo "<div id='pronat'>";
                    while($row=mysqli_fetch_array($result)){
                        echo "<a href='analizimipronave.php?fq=".$row['ID']."'><div id='prona'><h2>".$row['Titulli']."!</h2><br/>
                        <img src='pronatFoto/".$row['ID'].".jpg'width='230px' height='220px' alt='foto'/><br/>
                        <a href='shporta.php?rez=".$row['ID']."'>
                        <button id='rezervo'>Shto ne shporte</button></a><h5><h5>
                        ".$row['cmimi']."$/muaj.</h5><br/><p> Vendodhja:".$row['zona']."</p></div></a>";
                    }echo "</div>";}
                    else if(isset($_POST["kerkoavanc"])){
                        $selekt=$_POST["zgjedh"];
                        $cmimmin=$_POST['cmimmin'];
                        $cmimmax=$_POST['cmimmax'];
                        $sipmin=$_POST['sipmin'];
                        $sipmax=$_POST['sipmax'];
                        $query="select * from amartamentet where zona like '%$selekt%' and cmimi>'$cmimmin' and cmimi<'$cmimmax' and siperfaqetotale>'$sipmin' and siperfaqetotale<'$sipmax'";
                        //$query="select * from amartamentet where zona like '%$selekt%'";
                        //$query="select * from amartamentet where zona like '%$selekt%' and cmimi>'$cmimmin' and cmimi<'$cmimmax' and siperfaqe totale>'$sipmin' and siperfaqe totale<'$sipmax'";
                        $res=mysqli_query($conn,$query);echo "<div id='pronat'>";
                        while($row=mysqli_fetch_array($res)){
                            echo "<a href='analizimipronave.php?fq=".$row['ID']."'><div id='prona'>
                            <h2>".$row['Titulli']."!</h2><br/>
                            <img src='pronatFoto/".$row['ID'].".jpg' width='230px' height='220px' alt='foto'/><br/>
                            <a href='shporta.php?rez=".$row['ID']."'>
                            <button id='rezervo'>Shto ne shporte</button></a><h5>
                            <h5>".$row['cmimi']."$/muaj.</h5><br/><p> Vendodhja:".$row['zona']."</p></div></a>";
                        }echo "</div>";}
                    else{
                        $query="select ID,Titulli,cmimi,zona from amartamentet limit $filloNga, $rekordPerFaqe";
                        $result=mysqli_query($conn,$query);echo "<div id='pronat'>";
                        while($row=mysqli_fetch_array($result)){
                            echo "<div id='prona'><a href='analizimipronave.php?fq=".$row['ID']."'>
                            <h2>".$row['Titulli']."!</h2></a><br/><img src='pronatFoto/".$row['ID'].".jpg' width='230px' height='220px' alt='foto'/><br/>
                            <a href='shporta.php?rez=".$row['ID']."'>
                            <button id='rezervo'>Shto ne shporte</button></a><h5>
                            ".$row['cmimi']."$/muaj.</h5><br/><p> Vendodhja:".$row['zona']."</p></div>";
                        }echo "<div id='pronat'>";
                        echo "<p><div id='faqet'>";
                    
                        $qry="select ID,Titulli,cmimi,zona from amartamentet";
                        $resultt=mysqli_query($conn,$qry);
                        $nrRekordeve=mysqli_num_rows($resultt);
                        $faqeTotale=ceil($nrRekordeve/$rekordPerFaqe);
                        /*if($faqe=1){
                            echo '<a href="faqjauserit.php?faqe='.(1).'">Fillimi</a>';
                        }*/
                        if($faqe>1){
                            echo '<a href="faqjauserit.php?faqe='.($faqe-1).'"><<</a>';
                        }
                        for($i=1;$i<=$faqeTotale;$i++)
                        {
                            echo '<a href="faqjauserit.php?faqe='.$i.'">  '.$i.'</a>';
                        }
                        if($i-1>$faqe){
                            echo '<a href="faqjauserit.php?faqe='.($faqe+1).'">>></a>';
                        }
                        /*if($faqe=$faqeTotale){
                            echo '<a href="faqjauserit.php?faqe='.($faqeTotale).'">Fundi</a>';
                        }*/
                        echo "</div></p>";}
                    ?>
                </div>
            </section>
            <footer id="kontakt">
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
        <script src="js.js"></script>
    </body>
</html>
