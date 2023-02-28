<?php
include "../../../Header.php";
$cod=get_with_control('codice');
$nome=get_with_control('nome');
$azienda=get_with_control('azienda');
$forn=get_with_control('fornitore');

$wConn=connetti(true);

$query="INSERT INTO EntrateUscite (Codice,Fornitore,Nome,Data,CambioQuant,Azienda)
VALUES ('$cod','$forn','$nome',CONVERT(DATE,'".date("Y-m-d h:i:s")."'),1,$azienda); 
INSERT INTO Inventario (Codice,Fornitore,Nome,QuantitaCorrente,Azienda)
VALUES ('$cod','$forn','$nome',1,$azienda);
";

odbc_exec($wConn,$query);

