<?php

include "../../Header.php";
$id=get_with_control('id');
$cambio=get_with_control('cambio');
$dest=get_with_control('dest');

$wConn = connetti(true);

$query="SELECT Codice, Fornitore, Nome, (QuantitaCorrente+($cambio)) AS QC, Azienda FROM dbo_Inventario WHERE ID=$id";
$res=odbc_exec($wConn,$query);
$arr=odbc_fetch_array($res);
$cod=$arr['Codice'];
$forn=$arr['Fornitore'];
$nome=$arr['Nome'];
$quantita=$arr['QC'];
$azienda=$arr['Azienda'];

$query = "INSERT INTO EntrateUscite (Codice,Fornitore,Nome,Data,CambioQuant,Azienda".($cambio<0?",Locazione":"")." )
VALUES ('$cod','$forn','$nome',CONVERT(DATE,'" . date("Y-m-d h:i:s") . "'),$cambio,$azienda ".($cambio<0?",'$dest'":"")."); 
UPDATE dbo_Inventario SET QuantitaCorrente=$quantita WHERE ID=$id;
";

echo odbc_exec($wConn, $query);

