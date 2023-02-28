<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Interventi</title>
    <link rel="icon" type="image/x-icon" href="../../images/logo%20favicon.png">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../../navbar.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../tabella.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../Ricerca.css'>

    <script src='../../jquery-3.6.3.js'></script>
    <script src="../inputLib.js"></script>
    <script src="inputs.js"></script>
    <script src="../../menuLat.js"></script>


    <?php
    $extCodMac=null;
    if(isset($_GET["extCodMacchina"]))
    {   $extCodMac=$_GET["extCodMacchina"];
        echo "<script>var extCodMac=".$extCodMac.";</script>";}

    ?>

    <style>
        input[type='color']{
            border: 0; height: 40px; width: 40px;
        }

        .dot{  height: 20px;
            width: 20px;
            border-radius: 50%;
            display: inline-block; margin-left:15px;
            border: 1px solid black;
        }
    </style>



</head>
<body>

<ul id="menu">
    <li class="menuTendina"><img src="../../images/logo.png"></li>
    <li class="menuTendina"><form action="../Macchine/index.php"><input class="scelta" type="submit" value="Macchine">
        </form>
    </li>
    <li class="menuTendina"><form action="../Contratti/index.php"> <input class="scelta" type="submit" value="Contratti">
        </form>
    </li>

    <li class="menuTendina"><form action="../Interventi/index.php"><input class="scelta" id="selected" type="submit" value="Interventi">
        </form>
    </li>
    <li class="menuTendina"><form action="../Magazzino/index.php"><input class="scelta" type="submit" value="Magazzino">

    </li>
</ul>



<div id="content">
    <form action="index.php" method="get">
        <input type="text" id="macchine" placeholder="Codice Macchina">
        <input type="text" id="modello" placeholder="Modello Macchina">
        <input type="text" id="clienti" placeholder="Nome Cliente">
        <input type="text" id="contratti" placeholder="">
        <input id="bott" type="button" onclick="location.href='InserisciMacchina.php'" value="AGGIUNGI MACCHINA">

    </form>

<div id="ipertab">

    <div  id="tabellaResponsiva"></div>
</div>
</div>
<div class="menuTendinaLat">      <div id="treBarre" onclick="menu()">
        <div class="barra" id="b1"></div><div class="barra" id="b2"></div><div class="barra" id="b3"></div></div>
    <div id="menuLaterale">
        <br><br><br><br><br><br><br>
        <ul>
            <li>
                <input type="button" value="Aggiungi Tecnico" onclick="apriTecnici()" id="bott">
                <div id="addTecnici">
                    <label for="">Nome</label>
                    <br>
                    <input type="text" id="Tecnico">
                    <input type="button" value="invia" id="bott" onclick="inviaTecnico()">

                </div>
            </li>
        </ul>

    </div></div>
<div class="footer">
    <p>Powered by Denis Cremonese & Jacopo Benati</p>
</div>
</body>
</html>

