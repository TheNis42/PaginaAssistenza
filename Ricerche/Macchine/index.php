<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Macchine</title>
    <link rel="icon" type="image/x-icon" href="../../images/logo%20favicon.png">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../../navbar.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../Ricerca.cssicerca.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../Ricerca.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../tabella.css'>
    <script src="../../menuLat.js"></script>

    <?php

    if(isset($_GET["extCodMacchina"]))
    {   $extCodMac=$_GET["extCodMacchina"];
        echo "<script>var extCodMac=".$extCodMac."</script>";}


    if(isset($_GET["extCliente"])){
        $extCliente=$_GET['extCliente'];
        echo "<script>var extCliente=".$extCliente."</script>";}
    ?>

    <script src='../../jquery-3.6.3.js'></script>
    <script src="../inputLib.js"></script>
    <script src="inputs.js"></script>



</head>
<body>

    <ul id="menu">
        <li class="menuTendina"><h1>Interventi</h1>
            <ul>
                <li>Apertura</li>
                <li>Chiusura</li>
                <li>Stampa Rapportini</li>
            </ul>
        </li>
        <li class="menuTendina"><h1>Anagrafiche</h1>
            <ul>
                <li>Macchine</li>
                <li>Contratti</li>
                <li>Difetti</li>
                <li>Osservazioni</li>
                <li>Marche</li>
                <li>Modelli</li>
            </ul>
        </li>
        <li class="menuTendina"><h1>Ricerche</h1>
            <ul>
                <li>Macchine</li>
                <li>Contratti</li>
                <li>Interventi</li>
                <li>Cliente</li>
                <li>Articoli</li>
                <li>Prodotti di consumo</li>
                <li>Interventi totali</li>
                <li>Interventi vecchi</li>
                <li>Contratti per zona</li>
                <li>Magazzino</li>
            </ul>
        </li>
        <li class="menuTendina"><h1>Configurazione</h1>
            <ul>
            <li>Dati aziienda</li>
            <li>Contatori</li>
            </ul>
        </li>
    </ul>

    <div id="content">
        <form action="index.php" method="get">
            <input type="text" id="macchine" placeholder="Codice Macchina" <?php echo isset($extCodMac)?"value=".$extCodMac :"" ?> >
            <input type="text" id="modello" placeholder="Modello Macchina">
            <input type="text" id="clienti" placeholder="Nome Cliente"  <?php echo isset($extCliente)?"value=".$extCliente :"" ?>>
            <input type="text" id="contratti" placeholder="Codice Contratti">
            <input id="bott" type="button" onclick="location.href='../aggiungi/ContMacchina/index.php'" value="+ Contratto Macchina">
            <input id="bott" type="button" onclick="location.href='../aggiungi/MacchinaSola/index.php'" value="+ In Magazzino">

        </form>
    <br>
<div id="tabellaResponsiva">
</div>
</div>
<div class="footer">
    <p>Powered by Denis Cremonese & Jacopo Benati</p>
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
</body>
</html>

