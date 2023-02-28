<?php

include '../../Header.php';
$rConn=connetti(false);
$codMac=get_with_control('codMac');
$query="SELECT TOP 1 T_Macchine.Codice, T_Macchine.CodModello,T_Macchine.CodCliente,CONVERT(DATE,T_DettContratti.DataVendita) AS dVendita, 
       Q_Clienti.Ragione_Sociale AS Cliente, Q_Clienti.Indirizzo, Q_Clienti.Telefono, Q_Clienti.Provincia, T_DettContratti.TipoContratto,
       T_TipoCont.Descrizione AS Tipo FROM T_Macchine LEFT JOIN T_DettContratti ON T_Macchine.Codice=T_DettContratti.CodMacchina
           LEFT JOIN Q_Clienti ON Q_Clienti.Codice_Anagrafica=T_Macchine.CodCliente
           LEFT JOIN T_TipoCont ON T_DettContratti.TipoContratto=T_TipoCont.Codice
                                      WHERE T_Macchine.Codice LIKE '$codMac' AND T_DettContratti.FlagAttivo=-1 ORDER BY DataVendita";
$res=odbc_exec($rConn,$query);
echo "<td><input id='codMac' list=\"macchine\" required onchange=\"getDati(this)\" value='$codMac'></td>";
if(odbc_num_rows($res)>0)
{
while ($arr=odbc_fetch_array($res))
    echo "<script> dataVendita='".$arr['dVendita']."';  clienteCodice=".$arr['CodCliente']."</script>
        <td id='codMod'>".$arr['CodModello']."</td><td id='tipo' name='".$arr['TipoContratto']."'>". $arr['Tipo']."</input></td>
        <td>".$arr['Cliente']."<br>".$arr['Indirizzo']." ".$arr['Provincia']."<br>".$arr['Telefono']."</td>";}
else
{$query="SELECT T_Macchine.CodModello FROM T_Macchine WHERE Codice LIKE '$codMac'";
$res=odbc_exec($rConn, $query);
    if(odbc_num_rows($res)>0)
    while ($arr=odbc_fetch_array($res))
        echo "<td>".$arr['CodModello']."</td><td colspan='2'>NON HA CONTRATTO</td>
        ";
    else
        echo "<td></td><td></td><td></td>";

}