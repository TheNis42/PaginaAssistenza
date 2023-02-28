<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/html">
<head>


    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Chiudi Chiamata</title>
    <link rel="icon" type="image/x-icon" href="../../../images/logo%20favicon.png">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../../navbar.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../tabella.css'>

    <script src='../../../jquery-3.6.3.js'></script>
    <script src="../inputLib.js"></script>
    <script src="inputs.js"></script>
    <script>


        function richiediFam(id,el)
        {
            $.ajax({
                url:"getFamiglia.php",
                method: "get",
                data:{pezzo:el.value},
                success: function (data)
                {$('#fam'+id).html(data)}
            })
        }

        var pezzi=0

        function aggiungiPezzo(){
            pezzi++;
            var pezzo=document.createElement("tr")
            pezzo.innerHTML="<td><input list='pInMag' id='pezzo"+pezzi+"' onchange='richiediFam("+pezzi+",this)'></td><td><input type='number' id='quant"+pezzi+"' value='1'></td><td id='fam"+pezzi+"'></td>"

            document.getElementById('pezzi').appendChild(pezzo)


        }

        function invia()
        {
            var arrPezzi=[]
            for (let i = 1; i <= pezzi; i++) {
                arrPezzi.push({pezzo:document.getElementById('pezzo'+i).value, quant:document.getElementById('quant'+i).value})
            }

            $.ajax({
                url:"upload.php",
                method: "get",
                data:{codCall:document.getElementById('codCall').value,
                    dChiusura:document.getElementById('data').value,
                    note:document.getElementById('note').value,
                    osservazione:document.getElementById('osservazione').options[document.getElementById('osservazione').selectedIndex].value,
                    tecnico:document.getElementById('tecnici').options[document.getElementById('tecnici').selectedIndex].value,
                    tempo:document.getElementById('tempo').options[document.getElementById('tempo').selectedIndex].value,
                    pezzi: arrPezzi
                },
                success: function (data) {
                    $('#prova').html(data)


                }
            })

        }

    </script>
    <style>


        body{
            font-family: Calibri;
        }
    #immagine{
        float: left;
            border: 0;
        }
    #immagine img{
        margin-left: 20px;
    }
        #stampa{
            float: right;
            border: 0;
        }
        #stampa img{
            margin-top: 20px;
            margin-right: 20px;
            width: 100px;
            height: 100px;
            cursor: pointer;
        }
        textarea{
            margin-top: 3px;
            width: 300px;
            height: 80px;
            resize: none;
        }
        .ciccio {
            width: 50%;
            border-color: lightskyblue;

            color: black;
            text-align: center;
            padding: 14px 20px;
            margin: 8px 0;
            font-size: 15pt;
            border-radius: 4px;
        }
        .button3{
            width: 80px;
            height: 40px;
            display:inline-block;
            padding:0.3em 1.2em;

            border-radius:2em;
            box-sizing: border-box;
            text-decoration:none;
            font-family:'Roboto',sans-serif;
            font-weight:300;
            color:#FFFFFF;
            background-color:#4eb5f1;
            text-align:center;
            transition: all 0.2s;
        }
        .button3:hover{
            background-color:#4095c6;
        }
        @media all and (max-width:30em){
            .button3{
                display:block;
                margin:0.2em auto;
            }
        }
        .inputt{
            height: 25px;
            font-size: 12pt;
        }
        .input1{
            width: 55px;
            height: 25px;
            font-size: 12pt;
        }
        .input1:focus {
            border: 4px solid lightskyblue;
        }

        .inputt:focus {
            border: 4px solid lightskyblue;
        }
        .data{
            width: 40%;
            border-color: lightskyblue;
            color: black;
            padding: 14px 20px;
            margin: 8px 0;
            font-size: 14pt;

            border-radius: 4px;
            cursor: pointer;
        }

        table{
            border-collapse: collapse;
            margin: 20px;
            float: left;
            width: 1000px;
        }
         th, table{
             border: 1px solid gray;
             height: 110px;
             margin-top: 40px;
         }

        td{
            text-align: center;
            height: 80px;


        }
        th{
            font-family: Calibri;
            height: 60px;
            background-color: #f0f0f0;
            font-size: 16pt;
            border: 2px solid black;
        }
        .trspecial{
            border: 5px solid red;
        }
        #pezzi{
            margin-top: 188px;
            margin-right: 10px;
            width: 800px;
        }

        #Colore{width: 30px; height: 30px; border: 0px}
    </style>
</head>
<body>
<div id="prova"></div>

<?php
include '../../../Header.php';
$rConnect = connetti(false);
$codCall=get_with_control('codCall');


?>


<form>
        <table border=1>
            <tr>
                <td colspan="4">
                    <div  id="immagine">
                        <img src="../../../images/logo.png">
                    </div>


                    <div  id="stampa" onclick="printRapportino()">
                        <img src="../../../images/favicon%20printer.png">
                    </div>
                </td>
            </tr>
        <tr>
            <th  colspan="2"> Codice Chiamata</th><th  colspan="2"> Data Chiusura</th>

        </tr>
        <tr>
            <td colspan="2"><input type="text" id="codCall" class="ciccio" disabled <?php echo "value='$codCall'"?>></td>
            <td colspan="2"><input type="date" class="data" id="data" <?php echo "value='".date("Y-m-d")."'"?>></td>
        </tr>




        <tr><th colspan="2">Note</th><th>Osservazione</tr>
        <tr><td colspan="2"><textarea name="" id="note" cols="30" rows="6"></textarea></td><td colspan="2">
                <select name="" id="osservazione">

                    <?php
                    $query="SELECT * FROM T_Note";
                    $res=odbc_exec($rConnect,$query);
                    while($arr=odbc_fetch_array($res))
                        echo "<option value='".$arr['Codice']."'>".$arr['Descrizione']."</option>"

                    ?>

                </select>
            </td></tr>



        <tr><th colspan="2">Tecnico</th><th colspan="2">Tempo Lavoro</th></tr>
        <tr id="ultima">
            <td colspan="2"><select name="" id="tecnici"><?php
                    $query="SELECT * FROM T_Operatori";
                    $res=odbc_exec($rConnect,$query);
                    while($arr=odbc_fetch_array($res))
                        echo "<option value='".$arr['Codice']."'>".$arr['Descrizione']."</option>"

                    ?></select></td>
            <td colspan="2"><select name="" id="tempo"><?php
                    $query="SELECT * FROM T_TempiLav";
                    $res=odbc_exec($rConnect,$query);
                    while($arr=odbc_fetch_array($res))
                        echo "<option value='".$arr['Codice']."'>".$arr['Descrizione']."</option>"

                    ?></select></td>
        </tr>

            <tr>
                <td colspan="4">
                <input type="button" value="Invia" class="button3" onclick=window.location.href="../index.php">

                </td>
            </tr>

    </table>
    <table id="pezzi">
        <tr><th>Pezzo<input type="button" value="+" onclick="aggiungiPezzo()"></th><th>Quantità</th><th>Famiglia</th></tr>
    </table>




</form>

<datalist id="pInMag">
    <?php
    $query="SELECT Nome FROM Inventario";
    $res=odbc_exec($rConnect,$query);
    while ($arr=odbc_fetch_array($res))
    echo "<option>".$arr['Nome']."</option>"
    ?>



</datalist>

</body>
</html>
