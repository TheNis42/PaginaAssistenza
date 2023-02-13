<?php

function connetti($scrittura)
{
    if ($scrittura) {
        $user = "AssScrittura";
        $password = "AssScrittura";
    }
    else{
        $user = "AssLettura";
        $password = "AssLettura";
    }
    return odbc_connect("Driver={SQL Server};Server=Srvcontass;Database=AssistenzaTest", $user, $password);

}?>