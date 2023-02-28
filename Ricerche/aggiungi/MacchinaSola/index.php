<html>
<head>
    <title>Aggiunta Macchina Singola</title>
    <style>
        td{width: 100px}
        #avvertimento{height: fit-content; white-space: break-spaces; color: red}
        input {

            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 3px solid #ccc;
            -webkit-transition: 0.5s;
            transition: 0.5s;
            outline: none;
        }

        input:focus {
            border: 3px solid #555;
        }
        button

    </style>
    <title>Aggiungi Macchina</title>
    <link rel="icon" type="image/x-icon" href="../../../images/logo%20favicon.png">
</head>
<body>
<script src='../../../jquery-3.6.3.js'></script>
<script>

    function inviaDati(){

if(document.getElementById('avvertimento').innerHTML=='')
{  $.ajax({
    url:"inserisciMacchina.php",
    method: "get",
    data : {codMac: document.getElementById('codMac').value,
        modMac: document.getElementById('modMac').value,
        desc: document.getElementById('desc').value,
        tipo: document.getElementById('tipo').options[document.getElementById('tipo').selectedIndex].value,},
    success: function (data)
    { return true;
       }
})

    }
else return false
    }

    function verifica(el)
        {
            $.ajax({
                url:"../verifica.php",
                method: "get",
                data : {codMac: el.value},
                success: function (data)
                {
                    $("#avvertimento").html(data)}
            })

        }
</script>

<form action=""  onsubmit=" return inviaDati()">


    <table>
        <tr><td>Codice Macchina</td><td>Modello Macchina</td><td>Descrizione</td><td>Tipo Magazzino</td></tr>
        <tr>
            <td><input id="codMac" type="text"  onkeyup="verifica(this)" required></td>
            <td><input id="modMac" type="text" required></td>
            <td><input id="desc" type="text" ></td>
            <td><select id="tipo">
                    <option value='0'>In revisione</option>
                    <option value='1'>Demolizione</option>
                    <option value='2'>Macchina nuova</option>
                    <option value='3'>Revisionata</option>
                    <option value='4'>C. Sostituzione</option>
                    <option value='5'>C. Visione</option>
                    </select></td>
            <td><input type="submit"></td>
        </tr>
        <tr><td id="avvertimento"></td>
        </tr>
    </table>
    
</form>

</body>
</html>
