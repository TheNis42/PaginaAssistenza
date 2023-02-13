<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../../navbar.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../Ricerca.cssicerca.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../Ricerca.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../tabella.css'>

    <?php
    $extCodMac=null;
    if(isset($_GET["extCodMacchina"]))
    {   $extCodMac=$_GET["extCodMacchina"];
        echo "<script>var extCodMac=".$extCodMac.";</script>";}

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
            <input type="text" id="clienti" placeholder="Nome Cliente">
            <input type="text" id="contratti" placeholder="Codice Contratti">
            <input id="bott" type="button" onclick="location.href='InserisciMacchina.php'" value="AGGIUNGI MACCHINA">

        </form>
    </div>
</body>
</html>
<div id="tabellaResponsiva">
</div>