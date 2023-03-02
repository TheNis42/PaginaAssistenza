<?php
include '../../Header.php';
$rConnect = connetti(false);
$wConnect = connetti(true);
$output = '';
$perc=(isset($_GET["perc"])? $_GET["perc"] : 1);

$codChiamata=(isset($_GET["codChiamata"])? $_GET["codChiamata"] : '%');
$CodData=(isset($_GET["codData"])? $_GET["codData"] : '%');

$maxRows=0;
$priorita=(isset($_GET["priority"])? $_GET["priority"] : 0);
//$priorities = ['T_Macchine.Codice', 'Q_Clienti.Ragione_Sociale', 'T_DettContratti.ID'];

$query = "SELECT TOP 50 
        T_TestChiam.ID, CONVERT(varchar,T_TestChiam.DataChiusura,103) as DataChiusura,T_TestChiam.Flag_chiusura,T_TestChiam.CodChiamata AS codice, CONVERT(varchar,T_TestChiam.DataChiamata,103) AS chiam , T_Macchine.Codice, T_TestChiam.Colore,T_TestChiam.Ncopie,T_TestChiam.CodDifetto,T_TestChiam.DescDifetto,T_TestChiam.CodOsserv,
        T_TestChiam.Note,T_Operatori.Descrizione AS Operatori,T_TempiLav.Minuti AS Tempo, T_TipoCont.Descrizione, T_TestChiam.Promemoria, Q_Clienti.Ragione_Sociale
        FROM T_TestChiam
        LEFT JOIN T_Macchine ON T_Macchine.Codice=T_TestChiam.codMacchina
            LEFT JOIN Q_Clienti ON T_Macchine.CodCliente=Q_Clienti.Codice_Anagrafica
        LEFT JOIN T_Operatori ON T_Operatori.Codice=T_TestChiam.CodTecnico
        LEFT JOIN T_TipoCont ON T_TestChiam.Contr_Tipo=T_TipoCont.Codice
        LEFT JOIN  T_TempiLav ON T_TestChiam.CodTempo= T_TempiLav.Codice
        WHERE  T_TestChiam.CodChiamata IS NOT NULL AND T_TestChiam.CodChiamata LIKE '$codChiamata' AND   IsNull(T_Macchine.Codice,'') LIKE '$codMacchina' 
        $dChiamata $dVendita
        ORDER BY   T_TestChiam.DataChiamata  DESC";
// $query = "SELECT TOP (150*$perc) T_Macchine.Codice, Q_Clienti.Codice_Anagrafica,Q_Clienti.Ragione_Sociale , T_TestContratti.ID, T_DettContratti.FlagAttivo  AS Contratto, T_TipoCont.Descrizione AS Codicee
//              FROM T_Macchine LEFT JOIN Q_Clienti ON T_Macchine.CodCliente=Q_Clienti.Codice_Anagrafica
//               LEFT JOIN T_TestContratti ON T_Macchine.CodCliente=T_TestContratti.CodCliente
//              LEFT JOIN T_DettContratti ON T_TestContratti.ID=T_DettContratti.ID
//              LEFT JOIN T_TipoCont ON T_DettContratti.tipoContratto=T_TipoCont.Codice
//              $codMacchina $cliente $contratti
//              ORDER BY T_Macchine.Codice "
$result = odbc_exec($rConnect, $query);
$nRows = odbc_num_rows($result);
if ($nRows < 150 * $perc)
    $maxRows = 1;
if($nRows > 0)
{
    $output.='<table><thead><tr id="header"><th>Codice Chiamata</th><th>Data Chiamata</th><th>Codice Macchina</th><th>Modello Macchina</th><th>Ncopie</th><th>CodDifetto</th><th>DescDifetto</th><th>CodOsserv</th><th>Note</th><th>CodTecnico</th><th>CodTempo</th></thead></tr>';

    $color=true;
    while($arr=odbc_fetch_array($result)) {
       $pezzi='';
        $res=odbc_exec($rConnect,"SELECT Modello,CodFamiglia FROM T_PConsChiam WHERE IdTest=".$arr['ID']);
        $primo='';
        while ($modelli=odbc_fetch_array($res)) {

            $pezzi .= $modelli['Modello'] != '' ? $primo.$modelli['Modello'] . " " : ($modelli['CodFamiglia']!=''?$primo.$modelli['CodFamiglia']." ":'');
            if($primo=='')
                $primo=', ';
        }
        if($color){
            $output.= "<tr class = 'c1'>";
            $color=false;
        }else{
            $output.= "<tr class = 'c2'>";
            $color=true;
        }

        foreach ($arr as $t) {
            if ($t === $arr['codice'])
                $output .= "<td><a href='../Contratti/index.php?extCodContratti=" . $arr['codice'] . "'>$t</a></td>";

            else

                $output .= "<td>$t</td>";
        }
        $output.= "</tr>";



    }
    echo $output."</table>";
}
else
{
    echo 'Data Not Found';
}

?>



