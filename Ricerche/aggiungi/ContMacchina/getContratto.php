<?php
include "../../../Header.php";
$Cliente=$_GET['cliente'];
$rConn=connetti(false);
$res=odbc_exec($rConn,"SELECT T_TestContratti.Codice, T_TestContratti.ID,Q_Clienti.Ragione_Sociale FROM T_TestContratti INNER JOIN Q_Clienti On T_Testcontratti.CodCliente=Q_Clienti.Codice_Anagrafica WHERE Q_Clienti.Codice_Anagrafica='$Cliente'");
if(odbc_num_rows($res)>0)
while ($arr=odbc_fetch_array($res)) {
    echo "<table><tr><th>Cliente</th>
            <th>Codice Contratto</th></tr>
            <tr> <td><input type=\"text\" value='" . preg_replace("/[^a-zA-Z0-9- *]+/","",$arr['Ragione_Sociale']) . "' disabled></td>
    <td><input type=\"text\" id='codContratto' name='extCodCont' value=\"" . preg_replace("/[^a-zA-Z0-9- *]+/", "", $arr["Codice"]) . "\" disabled></td></tr></table>
            <br>
            <input type=\"button\" value=\"+ Termini\" onclick='aggiungiCont()'>
<div id='contratti'> </div>
    <script>codContratto=" . $arr['ID'] . " ; nuovoContratto=false</script>
        
    ";


}
else {
    $res=odbc_exec($rConn,"SELECT Q_Clienti.Ragione_Sociale FROM Q_Clienti WHERE Q_Clienti.Codice_Anagrafica='$Cliente'");
    while ($arr=odbc_fetch_array($res))
    echo  "<table><tr><th>Cliente</th><th>Codice Contratto</th><th>Data Stipulazione</th><th>Descrizione</th><th>Note</th>
            <tr> <td><input type=\"text\" value=\"" . preg_replace("/[^a-zA-Z0-9- *]+/", "", $arr['Ragione_Sociale']) . "\" disabled></td>
            <td><input type='text' name='extCodCont' id='nuovoNome' required></td><td><input type='date' id='dataStipulazione' value='".date("Y-m-d")."'></td>
            <td><input type='text' id='nuovaDesc'></td><td><input type='text' id='nuoveNote'></td>
    </tr></table>
            <br>
            <input type=\"button\" value=\"+ Termini\" onclick='aggiungiCont()'><div id='contratti'> </div>
            <script>var nuovoContratto=true</script>
            ";}


