<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>INXHINIERI SOFTI</title>
        <style type="text/css">
               #kreu{
            background: rgba(0, 0, 0, 0.2) url("foto/bg4.jpg");
            background-attachment: fixed;
            background-repeat: no-repeat; 
            background-size: cover;
            background-position: center;
            background-position: left;
            height: 100vh;
            display: flex;
            color: black;
                 }
                body{
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            margin: 0;
                    }
                a{
            text-decoration: none;
            color: black;
                }
                nav {
            height:48px; 
            background: rgba(0, 0, 0, 0.2);
            width: 100%;
            margin: 0;
            position: fixed; 
            display: flex;
            justify-content: space-between;
            padding: 0 16px 0 0;
            box-sizing: border-box;
            z-index: 100;
        }
        nav a{
            color: white;
            padding: 0 32px;
            transition: 0.4s;
            font-size: 15.8px;
        }
        nav a:hover{
            text-decoration: none;
            color: red;
        }
        nav ul{
            font-size: 18px;
            display: flex;
            list-style: none;
            justify-content: space-around;
            align-items: center;
            height: 100%;
            margin: 0;
        }
        #hyrr{
            color: white;
            padding: 0 32px;
            cursor: pointer;
            transition: 0.4s;
            font-size: 22px;
        }
        #hyrr:hover{
            font-size: 170%;
        }
        a.active{
            color: rgb(117, 8, 8);
        }
        #logo{
            color: white;
            padding: 0 32px;
            cursor: pointer;
            transition: 0.4s;
            font-size: 40px;
        }
        div #llogarii{
    position: fixed;
    right: 10px;
    top: 49px;
    width: 240px;
    border: 1px solid rgba(0, 0, 0, 0.5);
    border-radius: 10px;
    box-shadow: rgba(0, 0, 0, 0.4);
    background-color: rgba(0, 0, 0, 0.2);
    pointer-events: auto;
    opacity: 1;
    z-index: 50;
}
div #llogarii a{
    color: white;
    padding-left: 50px;
    padding-right: 10px;
    margin-top: 30px;
    font-size: 15px;
}
div #llogarii a:hover{
    text-decoration: none;
    color: red;
}
#rezervimet{
    position: absolute;
    top: 18%;
    left: 5%;
    width: 670px;
    padding: 0px 20px 25px 25px;
    background: rgba(0, 0, 0,0.35);
    box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
    border-radius: 10px;
    color:white;
}
#rezervimet p{
    font-size:26px;
    text-align:center;
}
#titulliprones a{color:white;}
#titulliprones a:hover{color:red;}

        </style>
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
                    <li><a href="personalData.php">Te dhenat personale</a></li>
                    <li><a href="index.php?logout='1'">Dil</a></li>
                    <!--<li><a href="index.php?logout='1'">Dil</a></li>
                    <li ><div id="hyrr"><i class="fas fa-user-circle"></i></div></li>-->
                </ul>
            </nav>
        <main>
        <div id="kreu">
            <?php
                session_start();
                $conn=mysqli_connect("localhost","root","","db");
                //$rekordPerFaqe=1;
                $rez='';
                if(isset($_GET['rez'])){
                $rez=$_GET['rez'];
                $useri=$_SESSION['id'];
                
                $qryShtoshporte="insert into shporta(IDuser,ID) values ('$useri','$rez')";
                $re=mysqli_query($conn,$qryShtoshporte);
                if(!$re){echo "<script type='text/javascript'>alert('PRONA NDODHET NE SHPORTEN TUAJ!!'); window.Location.href='shporta.php';</script>";}
                else echo "<script type='text/javascript'>alert('PRONA U SHTUA ME SUKSES!!'); window.Location.href='shporta.php';</script>";}

                echo "<div id='rezervimet'>";
            $prona="";
            $useri=$_SESSION['id'];
        $query="select ID from shporta where IDuser='$useri'";
        $result=mysqli_query($conn,$query);
        $nr=mysqli_num_rows($result);
        if($nr>0){echo "<p>Ne shporten tuaj ndodhen keto apartamente<p>";
        while($n=mysqli_fetch_array($result)){
            $prona=$n['ID'];
            //echo $prona;
            echo "<div id='titulliprones'>";
            $qry="select * from amartamentet where ID='$prona'";
            $res=mysqli_query($conn,$qry);
            while($n=mysqli_fetch_assoc($res)){
                echo "<a href='analizimipronave.php?fq=".$n['ID']."'>".$n['Titulli']."</a>
                <a style='color:black;' href='shporta.php?fshi=".$n['ID']."'>   ------Fshi------</a><br><br>";
            }
            echo "</div>";
        }}else{ echo "<br>Ne shporten tuaj nuk ndodhet asnje apartament ";}
        
        if(isset($_GET['fshi'])){
            $fshi=$_GET['fshi'];
            $q="delete from shporta where ID='$fshi' and IDuser='$useri'";
            $r=mysqli_query($conn,$q);
            if($r){echo "<script type='text/javascript'>alert('U FSHI ME SUKSES!!');</script>";}
            else{echo "error";}
        }
                ?></div>

            </div>
        </main>
        <script src="js.js"></script>
    </body>
</html>
