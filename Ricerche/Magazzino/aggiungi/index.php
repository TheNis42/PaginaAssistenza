<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aggiungi Pezzo</title>
    <link rel="icon" type="image/x-icon" href="../../../images/logo%20favicon.png">
    <script src="../../../jquery-3.6.3.js"></script>
</head>
<body>
<script>

    function invia()
    {$.ajax({
        url:"upload.php",
        method:"get",
        data:{codice:document.getElementById('Codice').value,
        nome:document.getElementById('Nome').value,
            fornitore:document.getElementById('Fornitore').value,
            azienda:document.getElementById('Azienda').options[document.getElementById('Azienda').selectedIndex].value
        },
        success: function (data){

            $('#prova').html(data)
        }
    })}

</script>
<form action="">
    <div id="prova"></div>
    <table>

        <tr>
            <th>Codice</th><th>Nome</th><th>Fornitore</th><th>Azienda</th>
        </tr>
        <tr>
            <td><input type="text" id="Codice"></td>
           <td> <input type="text" id="Nome"></td>
            <td> <input type="text" id="Fornitore"></td>
           <td><select name="" id="Azienda">
                    <option value="1">SNC</option>
                    <option value="2" selected>SRL</option></select></td>
            <td><input type="button" value="invia" onclick="invia()"></td>
        </tr>

    </table>

</form>
</body>
</html>