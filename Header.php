<?php

function connetti($scrittura)
{
    if ($scrittura) {
        $user = "sa";
        $password = "ViaLibera";
    }
    else{
        $user = "AssLettura";
        $password = "AssLettura";
    }
    return odbc_connect("Driver={SQL Server};Server=Srvcontass;Database=Assistenza", $user, $password);

}

function get_with_control($param)
{return isset($_GET[$param])?$_GET[$param]:null;}
?>