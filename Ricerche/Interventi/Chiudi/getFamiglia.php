<?php
include "../../../Header.php";
$pezzo=get_with_control('pezzo');
if($pezzo=='')
    echo '';
else{
$rConn=connetti(false);
$query="SELECT Famiglia FROM Inventario WHERE Nome='$pezzo'";
$res=odbc_exec($rConn,$query);
$arr=odbc_fetch_array($res);
echo $arr['Famiglia'];}