<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Contratti</title>
    <link rel="icon" type="image/x-icon" href="../../images/logo%20favicon.png">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../../navbar.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../tabella.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../Ricerca.css'>
<?php
if(isset($_GET["extCodCont"]))
{   $extCodCont=$_GET["extCodCont"];
    echo "<script>var extCodCont='".$extCodCont."'</script>";}



?>
    <script src='../../jquery-3.6.3.js'></script>
    <script src='../inputLib.js'></script>
    <script src='inputs.js'></script>
    <script src='modifica.js'></script>
    <script src='cercaMacchina.js'></script>
    <script src="../../menuLat.js"></script>


</head>
<body>
    <div id="test"></div>
    <ul id="menu">
        <li class="menuTendina"><img src="../../images/logo.png"></li>
        <li class="menuTendina" ><form action="../Macchine/index.php"><input class="scelta" type="submit" value="Macchine">
            </form>
        </li>
        <li class="menuTendina"><form action="../Contratti/index.php"> <input  id="selected" class="scelta" type="submit" value="Contratti">
            </form>
        </li>

        <li class="menuTendina"><form action="../Interventi/index.php"><input class="scelta" type="submit" value="Interventi">
            </form>
        </li>
        <li class="menuTendina"><form action="../Magazzino/index.php"><input class="scelta" type="submit" value="Magazzino">

        </li>
    </ul>


    <div id="content">
        <form action="Contratti.php" method="get">
            <input type="text" id="Contratti" placeholder="Nome Contratto"  <?php echo isset($extCodCont)?"value=".$extCodCont :"" ?>>
            <input type="text" id="Cliente" placeholder="Cliente">
            <input type="text" id="Macchina" placeholder="Codice Macchina">
        
            <label >Da</label>
            <input type="date" id="dataInizio" name="da">
            <label >Al</label>
            <input type="date" id="dataFine" name="a" >
        </form>
        <input type="button" id="bott" onclick="window.location.href='../aggiungi/ContMacchina/index.php'" value="+ Contratto">

        <div id="tabellaResponsiva">

            </div>    </div>
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
