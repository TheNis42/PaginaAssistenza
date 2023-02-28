<?php
include "../../../Header.php";
$rConn=connetti(false);
$codMacchina=get_with_control('codMac');
$index=get_with_control('index');

$res=odbc_exec($rConn,"SELECT T_Macchine.Descrizione,T_Macchine.CodModello,T_Macchine.TipoMagazzino, T_TipoMag.Descrizione as tMag FROM T_Macchine LEFT JOIN T_TipoMag ON T_Macchine.TipoMagazzino=T_TipoMag.Codice
                                                                                                            WHERE T_Macchine.Codice LIKE '$codMacchina' AND T_Macchine.Codice NOT IN (SELECT T_Macchine.Codice as attivi FROM T_Macchine
    LEFT JOIN T_TipoMag ON T_Macchine.TipoMagazzino=T_TipoMag.Codice
    LEFT JOIN T_DettContratti On T_DettContratti.CodMacchina=T_Macchine.Codice WHERE T_DettContratti.FlagAttivo=-1 GROUP BY T_Macchine.Codice)");
while ($arr=odbc_fetch_array($res))
    echo  "<table>
        <tr><th colspan='5'>Macchina</th></tr>
        <tr><td>Codice Macchina</td><td>Modello Macchina</td><td>Descrizione</td><td>In Magazzino</td><td>Tipo Magazzino</td></tr>
        <tr><td><input type=\"text\" disabled id='codMac".$index."' value='$codMacchina'> </td>
        <td><input type=\"text\" disabled id='ModMac".$index."' value='".$arr['CodModello']."'></td>
        <td><input type=\"text\" disabled id='DescMac".$index."'  value='".$arr['Descrizione']."'></td>
        <td><input type=\"checkbox\" id='FlagMagMac".$index."' disabled checked></td>
        <td><select id='TipoMagMac".$index."' disabled>
        <option  value='".$arr['TipoMagazzino']."' selected>".$arr['tMag']."</option>
        </select></td></tr></table>";

/*

*/
