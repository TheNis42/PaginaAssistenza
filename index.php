<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='navbar.css'>
    <script src='main.js'></script>

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
    <?php
    include 'Header.php';
    $conn=connetti();
    $sql = "SELECT * from Q_Clienti";
    $rs = odbc_exec($conn,$sql);
    
    ?>
<label for="clienti"></label>
<input type="text" list="clienti">
<datalist name="clienti" id="clienti">
    <?php 
        while($arr = odbc_fetch_array($rs))
          {
        echo '<option value="'.$arr["Codice_Anagrafica"].'">';
        $flagTitle=true;
        foreach($arr as $t)
        {if($flagTitle)
            $flagTitle=false;
            else
            echo $t.' ';}
        }?>
</datalist>    
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>
</body>
</html>
