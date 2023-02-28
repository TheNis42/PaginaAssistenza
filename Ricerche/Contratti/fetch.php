<?php
include '../../Header.php';
$rConnect = connetti(false);
$wConnect = connetti(true);
$output = '';
$perc=(isset($_GET["perc"])? $_GET["perc"] : 1);
$dInizio=(isset($_GET["dataI"]) && $_GET["dataI"]!=''? "AND T_DettContratti.DataFine>=CONVERT(datetime,'".$_GET['dataI']."',120)" : '');
$dFine=(isset($_GET["dataF"]) && $_GET["dataF"]!=''? "AND T_DettContratti.DataFine<=CONVERT(datetime,'".$_GET['dataF']."',120)"  : '');

$cliente=(isset($_GET["customer"])? $_GET["customer"] : '%');
$contratti=(isset($_GET["contratti"])? $_GET["contratti"] : '%');
$codMacchina=(isset($_GET["codMac"])? $_GET["codMac"] : '%');
$maxRows=0;
$priorita=(isset($_GET["priority"])? $_GET["priority"] : 0);
$priorities = ['T_TestContratti.Codice', 'T_TestContratti.CodCliente', 'T_DettContratti.CodMacchina'];

	$query = "SELECT TOP (150*$perc) T_DettContratti.ID, T_TestContratti.Codice,T_DettContratti.CodMacchina,T_TestContratti.Descrizione ,CONVERT(varchar,T_DettContratti.DataVendita, 103) AS Vendita , CONVERT(varchar,T_DettContratti.DataFineGaranzia,103) AS Garanzia,CONVERT(varchar,T_DettContratti.DataInizio,103) AS Inizio , CONVERT(varchar,T_DettContratti.DataFine,103) AS Fine,
	T_TipoCont.Descrizione AS tCont, T_DettContratti.Importo,Q_Clienti.Ragione_Sociale AS nCliente, T_TestContratti.Note,T_DettContratti.FlagAttivo
	FROM T_TestContratti 
	FULL OUTER JOIN T_DettContratti ON T_TestContratti.ID=T_DettContratti.IdTest 
	LEFT JOIN T_TipoCont ON T_DettContratti.TipoContratto=T_TipoCont.Codice
	LEFT JOIN Q_Clienti ON T_TestContratti.CodCliente=Q_Clienti.Codice_Anagrafica
	WHERE T_TestContratti.Codice LIKE '$contratti' AND  IsNull(Q_Clienti.Ragione_Sociale,'') LIKE '$cliente' AND   IsNull(T_DettContratti.CodMacchina,'') LIKE '$codMacchina' $dInizio $dFine 
	ORDER BY T_DettContratti.CodMacchina ASC ";


$result = odbc_exec($rConnect, $query);
$nRows = odbc_num_rows($result);
if ($nRows < 150 * $perc)
	$maxRows = 1;
if($nRows > 0)
{

//	<tr><th>Codice</th><th>Codice Macchina</th><th>Descrizione</th><th>Data Inizio</th><th>Data Fine</th><th>Tipo Contratto</th><th>Importo</th><th>Cliente</th><th>Note</th><th>Attivo</th></tr>
$color = 'c1';    $i=0;

    $output .= '
	<table><thead>
                <tr ><th class="modifica"><input  type="button"  name="modifica" value="✎" onclick="modifica()"></th><th>Codice</th><th>Codice Macchina</th><th>Descrizione</th><th>Data Vendita</th><th>Data Fine Garanzia</th><th>Data Inizio</th><th>Data Fine</th><th>Tipo Contratto</th><th>Importo</th><th>Cliente</th><th>Note</th><th>Attivo</th></tr>
      
                </thead>
                
    ';

    while($arr=odbc_fetch_array($result)) {
        if($color=='c2')
        {
            $color = 'c1';
        }
        else
        {

            $color = 'c2';
        }
        $output.="<tr class='$color'>";

        $onClickFunc = "onclick='modificaGaranzia(";
        $onClickFunc .= '"' . $arr['ID'] . '"';
        $onClickFunc .= ")'";
        $i++;

                 $output .= " <td class='modifica'></td>
<td >".$arr['Codice']."</td>
<td ><a href='../Macchine/index.php?extCodMacchina=\"".$arr['CodMacchina']."\"'>".$arr['CodMacchina']."</a></td>
<td>".$arr['Descrizione']."</td>
<td >".$arr['Vendita']."</td>
<td >".$arr['Garanzia']."</td>
<td >".$arr['Inizio']."</td>
<td >".$arr['Fine']."</td>
<td  id='" . $i ."' name='".$arr['ID']."'>".$arr['tCont']."</td>
<td >".$arr['Importo']."</td>
<td><a href='../Macchine/index.php?extCliente=\"".urlencode($arr['nCliente']) ."\"'>".$arr['nCliente']."</a></td>
<td >".$arr['Note']."</td>
<td class='spunta'><input name='".$arr['ID']."' id='cb".$i."' type='checkbox' disabled ".($arr['FlagAttivo']==-1?"checked":'')." onclick=''></td>";
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