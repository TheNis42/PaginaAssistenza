

<?php
include "../../Header.php";
$rConn=connetti(false);
$codMac=get_with_control('codMac');
$i=get_with_control('index');
$res=odbc_exec($rConn,"SELECT T_Macchine.Codice FROM T_Macchine WHERE T_Macchine.Codice LIKE '$codMac'");
if(odbc_num_rows($res)>0)
    echo "\"$codMac\" E' GIA' PRESENTE TRA LE MACCHINE <script>errore[$i]=true</script>";
else
    echo "<script>errore[$i]=false</script>";