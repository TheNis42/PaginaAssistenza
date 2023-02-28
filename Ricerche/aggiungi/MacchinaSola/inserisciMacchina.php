<?php

include "../../../Header.php";
$codMac=get_with_control('codMac');
$modMac=get_with_control('modMac');
$desc=get_with_control('desc');
$tipo=get_with_control('tipo');

/*
echo "<table><tr><th>Cliente</th><th>Nome Contratto</th><th>Tipo Contratto</th><th>Data Vendita</th><th>Data Fine Garanzia</th><th>Data Inizio</th><th>Data Fine</th>
        <th>Importo</th><th>Costo Copia</th><th>Codice Macchina</th><th>Modello</th><th>Descrizione</th><th>Flag</th><th>Tipo</th></tr>";*/
$query = '';

$conn = connetti(true);



                $query .= "INSERT INTO T_Macchine (Codice,CodModello,Descrizione,FlagMagazzino,TipoMagazzino) VALUES ('$codMac','$modMac','$desc',-1,$tipo);";


$conn = connetti(true);
$res = odbc_exec($conn, $query);
