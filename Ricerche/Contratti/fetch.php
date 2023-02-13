<?php
include '../../Header.php';
$rConnect = connetti(false);
$wConnect = connetti(true);
$output = '';
$perc=(isset($_GET["perc"])? $_GET["perc"] : 1);
$dInizio=(isset($_GET["dataI"]) && $_GET["dataI"]!=''? "AND T_DettContratti.DataInizio>=CONVERT(datetime,'".$_GET['dataI']."',120)" : '');
$dFine=(isset($_GET["dataF"]) && $_GET["dataF"]!=''? "AND T_DettContratti.DataFine<=CONVERT(datetime,'".$_GET['dataF']."',120)"  : '');

$cliente=(isset($_GET["customer"])? $_GET["customer"] : '%');
$contratti=(isset($_GET["contratti"])? $_GET["contratti"] : '%');
$codMacchina=(isset($_GET["codMac"])? $_GET["codMac"] : '%');
$maxRows=0;
$priorita=(isset($_GET["priority"])? $_GET["priority"] : 0);
$priorities = ['T_TestContratti.Codice', 'T_TestContratti.CodCliente', 'T_DettContratti.CodMacchina'];

	$query = "SELECT TOP (150*$perc) T_TestContratti.ID, T_TestContratti.Codice,T_DettContratti.CodMacchina,T_TestContratti.Descrizione,CONVERT(DATE,T_DettContratti.DataInizio) AS Inizio , CONVERT(DATE,T_DettContratti.DataFine) AS Fine,
	T_TipoCont.Descrizione AS tCont, T_DettContratti.Importo,T_TestContratti.CodCliente, T_TestContratti.Note,T_DettContratti.FlagAttivo
	FROM T_TestContratti 
	FULL OUTER JOIN T_DettContratti ON T_TestContratti.ID=T_DettContratti.IdTest 
	LEFT JOIN T_TipoCont ON T_DettContratti.TipoContratto=T_TipoCont.Codice
	WHERE T_TestContratti.Codice LIKE '$contratti%' AND T_TestContratti.CodCliente LIKE '$cliente%' AND  T_DettContratti.CodMacchina LIKE '$codMacchina%' $dInizio $dFine 
	ORDER BY T_DettContratti.DataInizio DESC, ".$priorities[$priorita];


$result = odbc_exec($rConnect, $query);
$nRows = odbc_num_rows($result);
if ($nRows < 150 * $perc)
	$maxRows = 1;
if($nRows > 0)
{
	$output .= '
	<table><thead>
                <tr><th class="modifica"><input type="button"  name="modifica" value="✎" onclick="modifica()"></th><th>Codice</th><th>Codice Macchina</th><th>Descrizione</th><th>Data Inizio</th><th>Data Fine</th><th>Tipo Contratto</th><th>Importo</th><th>Cliente</th><th>Note</th><th>Attivo</th></tr>
      
                </thead>
                <tr>
                
    ';
//	<tr><th>Codice</th><th>Codice Macchina</th><th>Descrizione</th><th>Data Inizio</th><th>Data Fine</th><th>Tipo Contratto</th><th>Importo</th><th>Cliente</th><th>Note</th><th>Attivo</th></tr>
$color = true;    $i=0;

    while($arr=odbc_fetch_array($result)) {
    if($color=='c2')
        {
            $color = 'c1';
        }
        else
        {

            $color = 'c2';
        }
        $onClickFunc = "onclick='modificaGaranzia(";
        $onClickFunc .= '"' . $arr['ID'] . '"';
        $onClickFunc .= ")'";
        $i++;

                 $output .= " <td class='modifica'></td>
<td class='$color'>".$arr['Codice']."</td>
<td class='$color'><a href='../Macchine/index.php?extCodMacchina=\"".$arr['CodMacchina']."\"'>".$arr['CodMacchina']."</a></td>
<td class='$color'>".$arr['Descrizione']."</td>
<td class='$color'>".$arr['Inizio']."</td>
<td class='$color'>".$arr['Fine']."</td>
<td class='$color' id='" . $i ."' onclick='(\"" . $i . "\")'>".$arr['tCont']."</td>
<td class='$color'>".$arr['Importo']."</td>
<td class='$color'>".$arr['CodCliente']."</td>
<td class='$color'>".$arr['Note']."</td>
<td class='$color' class='checkbox'><input id='cb".$i."' type='checkbox' disabled ".($arr['FlagAttivo']==-1?"checked":'')." onclick=''></td>";
//$arr['tCont'] ? "id='" . $i .
//                     "' onclick='(\"" . $i . "\")'"
    $output.= "</tr>";

}
	$output .= "</table>";
	echo $output;
}
else
{

    echo 'Data Not Found';
}

?>