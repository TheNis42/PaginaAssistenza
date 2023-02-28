<?php
include "../../../Header.php";
$wConn=connetti(true);
$codCall=get_with_control('codCall');
$chiusura=get_with_control('dChiusura');
$note=get_with_control('note');
$osservazione=get_with_control('osservazione');
$tecnico=get_with_control('tecnico');
$tempo=get_with_control('tempo');
$pezzi=get_with_control('pezzi');


$query="SELECT ID FROM T_TestChiam WHERE CodChiamata='$codCall'";
$res=odbc_exec($wConn,$query);
$arr=odbc_fetch_array($res);
$id=$arr['ID'];
if(isset($pezzi))
foreach ($pezzi as $p)
    {if($p['pezzo']!=''){
$query="SELECT Nome ,Famiglia FROM Inventario WHERE Nome LIKE '".$p['pezzo']."';";
$res=odbc_exec($wConn,$query);
$arr=odbc_fetch_array($res);
$arr['quant']=$p['quant'];
        $arrPezzi[]=$arr;
    }}



$query="UPDATE T_TestChiam SET Flag_chiusura=-1, CodTempo=$tempo, CodTecnico=$tecnico,Note='$note',CodOsserv='$osservazione', DataChiusura=CONVERT(varchar,'$chiusura',103) WHERE ID=$id;";
if(isset($pezzi))
foreach ($arrPezzi as $p)
$query.="INSERT INTO T_PConsChiam (IdTest,CodFamiglia,Num,Modello) VALUES ($id,'".$p['Famiglia']."',".($p['quant']!=''?$p['quant']:1).",'".$p['Nome']."');";
echo $query;
echo odbc_exec($wConn,$query);