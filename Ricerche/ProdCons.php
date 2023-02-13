<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../navbar.css'>
    <script src='main.js'></script>

</head>
<body>
    <?php
        include '../Header.php';
        $conn=connetti();
    ?>
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
 
    <form>
<label for="chiamate"></label>
<input type="text" list="chiamate">
<datalist name="chiamate" id="chiamate">
   
   <?php 
        $sql = "SELECT TOP 50 T_TestChiam.CodChiamata, T_TestChiam.DataChiamata
        FROM T_TestChiam
        ORDER BY T_TestChiam.ID DESC;";
        $rs = odbc_exec($conn,$sql);

        while($arr = odbc_fetch_array($rs))
          {
        echo '<option value="'.$arr["CodChiamata"].'">'.$arr['DataChiamata'].'</option>';
        }
        ?>

</datalist>
<input type="date">
-
<input type="date">

<input type="text" list="clienti">
<datalist name="clienti" id="clienti" >

<?php
$sql = "SELECT Q_Clienti.*
        FROM Q_Clienti
        ORDER BY Q_Clienti.Ragione_Sociale;";
        $rs = odbc_exec($conn,$sql);

        while($arr = odbc_fetch_array($rs)) {
            
            
                echo '<option value="' . $arr['Ragione_Sociale'] . '">';
          
              
            echo'</option>';
        }
        ?>
</datalist>
    </form>    
</div>
</body>
</html>
