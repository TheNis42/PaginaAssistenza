<?php
include '../../Header.php';
$rConnect = connetti(false);
$wConnect = connetti(true);
$output = '';
$perc=(isset($_GET["perc"])? $_GET["perc"] : 1);

$cliente=(isset($_GET["customer"])? $_GET["customer"] : '%');
$contratti=(isset($_GET["contratti"])? $_GET["contratti"] : '%');
$ModelloMacchina=(isset($_GET["ModMacc"])? $_GET["ModMacc"] : '%');
$codMacchina=(isset($_GET["codMac"])? $_GET["codMac"]  : '%');

$maxRows=0;
$priorita=(isset($_GET["priority"])? $_GET["priority"] : 0);
$priorities = ['T_Macchine.Codice', 'Q_Clienti.Ragione_Sociale', 'T_DettContratti.ID'];

 $query = "SELECT TOP (150*$perc) 
            T_Macchine.Codice,T_Macchine.CodModello,T_Macchine.FlagMagazzino, Q_Clienti.Ragione_Sociale ,Q_Clienti.Telefono, Q_Clienti.Indirizzo,Q_Clienti.CAP,Q_Clienti.Localita,
                                                     T_TestContratti.Codice AS NomeContratto         
             FROM T_Macchine 
             LEFT JOIN T_DettContratti ON T_Macchine.Codice=T_DettContratti.CodMacchina
             FULL JOIN T_TestContratti ON T_TestContratti.ID=T_DettContratti.IdTest 
            LEFT JOIN Q_Clienti ON T_TestContratti.CodCliente=Q_Clienti.Codice_Anagrafica
             WHERE T_Macchine.Codice LIKE '$codMacchina' AND   IsNull(T_Macchine.CodModello,'') LIKE '$ModelloMacchina' 
             AND   IsNull(T_TestContratti.Codice,'') LIKE '$contratti' AND  IsNull(Q_Clienti.Ragione_Sociale,'') LIKE '$cliente'
             ORDER BY T_Macchine.Codice ";
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
    $output.="<table><thead><tr id='header'><th class='tabMacchina'>Codice Macchine</th><th class='tabMacchina'>Codice Modello</th><th class='tabMacchina'>Magazzino</th><th class='tabCliente'>Clienti</th><th class='tabCliente'>Telefono</th><th class='tabCliente'>Indirizzo</th><th class='tabCliente'>CAP</th><th  class='tabCliente'>Localita</th><th  class='tabContratto' >ID Contratto</th></thead></tr>";

    $color=true;
    while($arr=odbc_fetch_array($result)) {
        if($color){
            $output.= "<tr class = 'c1'>";
            $color=false;
        }else{
            $output.= "<tr class = 'c2'>";
            $color=true;
        }


                $output .= "               
<td class=\"tabMacchina\">".$arr['Codice']."</td>
<td class=\"tabMacchina\">".$arr['CodModello']."</td>
<td  class='spunta'><input type='checkbox' disabled ".($arr['FlagMagazzino']==-1?"checked":'')." onclick=''></td>
<td class='tabCliente'>".$arr['Ragione_Sociale']."</td>
<td class='tabCliente'>".$arr['Telefono']."</td>
<td class='tabCliente'>".$arr['Indirizzo']."</td>
<td class='tabCliente'>".$arr['CAP']."</td>
<td class='tabCliente'>".$arr['Localita']."</td>
<td  class='tabContratto'><a href='../Contratti/index.php?extCodCont=" . urlencode($arr['NomeContratto']) . "'>".$arr['NomeContratto']."</a></td>
";

        }
        $output.= "</tr>";
        
        
    

        echo $output."</table>";
    }
    else
    {
        echo 'Data Not Found';
    }
    echo"<script>console.log('php: $codMacchina')</script>"
    ?>


