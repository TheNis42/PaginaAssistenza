<?php
include '../../Header.php';
$wConnect = connetti(true);
$codice = isset($_GET['codice']) ? $_GET['codice'] : -1;
$descrizione = isset($_GET['descrizione']) ? $_GET['descrizione'] : null;
$CodCliente = isset($_GET['codcliente']) ? $_GET['codcliente'] : null;
$CodModello = isset($_GET['codmodello']) ? $_GET['codmodello'] : -1;
$FlagMagazzino = isset($_GET['flagmagazzino']) ? $_GET['flagmagazzino'] : null;
$TipoMagazzino = isset($_GET['tipomagazzino']) ? $_GET['tipomagazzino'] : null;
if($codice != -1 && $CodModello != -1){
    $query = ("INSERT INTO T_Macchine (Codice,Descrizione,CodCliente,CodModello,FlagMagazzino,TipoMagazzino)
					VALUES ('$codice','$descrizione','$CodCliente','$CodModello','$FlagMagazzino','$TipoMagazzino')");

    //$query->bindParam(':descrizione', $codice);
    if($result = odbc_exec($wConnect, $query)){
        echo "Elemento inserito correttamente";
    }else{
        echo"L'elemento non è stato inserito";
    }

    echo "<br><a href='index.php'> Pagina Iniziale </a><br>";
}
else{
    echo "qualcosa è andato storto";
}