<?php

include "../../Header.php";
$wConn=connetti(true);
$data=get_with_control('dataCall');
$codMac=get_with_control('codMac');
$lastCall=get_with_control('lastCall');
$difetto=get_with_control('difetto');
$nCopie=get_with_control('nCopie');
$desc=get_with_control('desc');
$promemoria=get_with_control('promemoria');
$codChiamata=get_with_control('codCall');
$colore=get_with_control('colore');
$tipo=get_with_control('tipo');

$query="SELECT T_Macchine.CodCliente FROM T_Macchine WHERE Codice LIKE '$codMac'";
$res=odbc_exec($wConn,$query);
while ($arr=odbc_fetch_array($res))
{$cliente=$arr['CodCliente'];}

$query="INSERT INTO T_TestChiam (CodChiamata,Contr_Tipo, DataChiamata, CodCliente,CodMacchina,NCopie,CodDifetto,DescDifetto,Flag_chiusura, Promemoria,UltChiam, Colore)
VALUES ('$codChiamata','$tipo',CONVERT(DATE,'$data'),".($cliente=='' || $cliente==null?'NULL':$cliente).",'$codMac',".($nCopie==''?'NULL':$nCopie).",'$difetto','$desc',0,'$promemoria',".(isset($lastCall) && $lastCall!=''?"CONVERT(DATE ,'$lastCall')":'NULL').",$colore);
";
$res=odbc_exec($wConn,$query);
echo $query."<br>".$res;