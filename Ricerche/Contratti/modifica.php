<?php
include "../../Header.php";

$dati=isset($_GET['datiArr'])? $_GET['datiArr']:null;
$tipi=0;
$query="";
if(isset($dati))
foreach ($dati as $i){

 if($i['tipo']==0)
 {
 $query.=
     "UPDATE T_DettContratti
        SET TipoContratto=".$i['value']." WHERE ID=".$i['ID']."; ";
 }
    if($i['tipo']==1)
    {
        $query.=
            "UPDATE T_DettContratti
            SET T_DettContratti.FlagAttivo= '".$i['checked']."' 
            WHERE T_DettContratti.ID='".$i['ID']."'; ";
    };
}
$res="";
$conn=connetti(true);
$res=odbc_exec($conn,$query);
echo  $query;
/*$query="SELECT TOP 150 T_TestContratti.ID, T_TestContratti.Codice,T_DettContratti.CodMacchina,T_TestContratti.Descrizione,CONVERT(DATE,T_DettContratti.DataInizio) AS Inizio , CONVERT(DATE,T_DettContratti.DataFine) AS Fine,
	T_TipoCont.Descrizione AS tCont, T_DettContratti.Importo,T_TestContratti.CodCliente, T_TestContratti.Note,T_DettContratti.FlagAttivo, T_DettContratti.TipoContratto
	FROM T_TestContratti 
	FULL OUTER JOIN T_DettContratti ON T_TestContratti.ID=T_DettContratti.IdTest 
	LEFT JOIN T_TipoCont ON T_DettContratti.TipoContratto=T_TipoCont.Codice ORDER BY T_DettContratti.DataInizio DESC";
$result=odbc_exec($conn,$query);
while ($arr=odbc_fetch_array($result))
{
    foreach ($arr as $t)
{$res.=$t." ";}$res.="<br>";}
echo $res;
*/