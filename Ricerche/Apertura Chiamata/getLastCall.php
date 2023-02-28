<?php

include '../../Header.php';
$rConn=connetti(false);
$codMac=get_with_control('codMac');
$query="SELECT TOP 1 CONVERT(DATE,T_TestChiam.DataChiamata) as dChiamata FROM T_TestChiam LEFT JOIN T_Macchine ON T_TestChiam.CodMacchina=T_Macchine.Codice WHERE CodMacchina LIKE '$codMac' ORDER BY DataChiamata Desc";
$res=odbc_exec($rConn,$query);

if(odbc_num_rows($res)>0)
while ($arr=odbc_fetch_array($res))
    echo "
        <td><input id='lastCall' type='date' disabled value='".$arr['dChiamata']."'></td><td><textarea id='promemoria' cols=\"30\" rows=\"5\"></textarea></td>";
else
    echo " <td></td> <td><textarea id='promemoria'  cols=\"30\" rows=\"5\"></textarea></td> ";