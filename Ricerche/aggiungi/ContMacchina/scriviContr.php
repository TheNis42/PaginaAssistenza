<?php
include "../../../Header.php";
$contratti=get_with_control('contratti');
$contratto=get_with_control('contratto');
$cliente=get_with_control('cliente');
/*
echo "<table><tr><th>Cliente</th><th>Nome Contratto</th><th>Tipo Contratto</th><th>Data Vendita</th><th>Data Fine Garanzia</th><th>Data Inizio</th><th>Data Fine</th>
        <th>Importo</th><th>Costo Copia</th><th>Codice Macchina</th><th>Modello</th><th>Descrizione</th><th>Flag</th><th>Tipo</th></tr>";*/
$query='';

$conn=connetti(true);
if($contratto['nuovo']=='true')
{
$res=odbc_exec($conn,"INSERT INTO T_TestContratti (Codice, Descrizione,DataStipula,CodCliente,Note,FlagAttivoTest) 
VALUES ('".$contratto['nome']."','".$contratto['desc']."',CONVERT(DATE,'".$contratto['data']."'),'$cliente','".$contratto['note']."',-1)");

$res=odbc_exec($conn,"SELECT TOP 1 T_TestContratti.ID, T_TestContratti.Codice FROM T_TestContratti ORDER BY ID DESC");
 while($arr=odbc_fetch_array($res)) $idContr=$arr['ID'];
    echo $cliente." ".$res;
}
else
    $idContr=$contratto['codice'];

if(isset($contratti))
foreach ($contratti as $cont)
{
    $query .= "INSERT INTO T_DettContratti (IdTest,TipoContratto,DataVendita,DataFineGaranzia,DataInizio,DataFine,Importo,CostoCopia,FlagAttivo" . (isset($cont['codMac']) ? ',CodMacchina' : '') . ")
VALUES (" . $idContr . "," . $cont['tipoC'] . ","
.(isset($cont['dVendita']) && $cont['dVendita']!=''?"CONVERT(DATE,'" . $cont['dVendita'] . "')":'NULL').","
.(isset($cont['dFGaranzia']) && $cont['dFGaranzia']!=''?"CONVERT(DATE,'" . $cont['dFGaranzia'] . "')":'NULL').","
.(isset($cont['dInizio']) && $cont['dInizio']!=''?"CONVERT(DATE,'" . $cont['dInizio'] . "')":'NULL').","
.(isset($cont['dFine']) && $cont['dFine']!=''?"CONVERT(DATE,'" . $cont['dFine'] . "')":'NULL').",'".
$cont['Importo'] . "','" . $cont['CC'] ."',-1". (isset($cont['codMac']) ? ",'" . $cont['codMac']."'" : "") . ");";
if(isset($cont['codMac']) && $cont['codMac']!='')
{if($cont['nuovaMac']=='true')
    $query.="INSERT INTO T_Macchine (Codice,CodModello,Descrizione,CodCliente,FlagMagazzino,TipoMagazzino)
VALUES (".$cont['codMac'].",'".$cont['ModMac']."','".$cont['DescMac']."',".$cliente.",".$cont['FlagMagMac'].",".$cont['TipoMagMac'].");";
else {
    $query.="UPDATE T_Macchine  SET CodCliente=$cliente WHERE Codice LIKE '".$cont['codMac']."' ;";
}}

}
echo $query;
$conn=connetti(true);
$res=odbc_exec($conn,$query);
