<html>
<head>
    <body>
        <link rel='stylesheet' type='text/css' media='screen' href='../Modifica.css'>
    </body>
</head>
</html>

<?php
include '../../Header.php';
$wConnect = connetti(true);
?>

<style>
    .column {
        width: 45%;
        height: 200px;
        float: left;
        margin: 10px;
    }

</style>


<div class="column">
    <form method="GET" action = 'ScriviMacchina.php'>

        <input type="text" name="codice" placeholder="Cliente" required>
        <input type="text" name="descrizione" placeholder="Descrizione">
        <input type="text" name="codmodello" placeholder="Codice Modello" required>
        <input type="text" name="codcliente" placeholder="Codice Cliente">
        <input type="text" name="flagmagazzino" placeholder="Flag Magazzino">
        <input type="text" name="tipomagazzino" placeholder="Tipo Magazzino">

</div>
<div class="column">
        <input type="text" name="codice" placeholder="Codice" required>
        <input type="text" name="descrizione" placeholder="Descrizione">
        <input type="text" name="codmodello" placeholder="Codice Modello" required>
        <input type="text" name="codcliente" placeholder="Codice Cliente">
        <input type="text" name="flagmagazzino" placeholder="Flag Magazzino">
        <input type="text" name="tipomagazzino" placeholder="Tipo Magazzino">
    <input id="bottone" type ="submit">
    </form>
</div>
<div style="clear: both;"></div>
