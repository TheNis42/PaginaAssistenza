<html>
<head>
    <style>
        .column {
            width: 45%;
            height: 200px;
            float: left;
            margin: 10px;
        }


        .formCont div table{display: inline}
        th{text-align: left;}
        td{color:grey; text-align: center}
        .formCont {display: flex; flex-direction: row; justify-content: flex-start; align-items: flex-end; gap: 20px}
        .formCont div{}

        input[type=text]{max-width: 120px}

        input{m}
        .avvertimento{height: fit-content; white-space: break-spaces; color: red; font-weight: bold; width: 170px}


    </style>
    <script src='../../../jquery-3.6.3.js'></script>
    <title>Aggiungi Contratto</title>
    <link rel="icon" type="image/x-icon" href="../../../images/logo%20favicon.png">
</head>

<body>
<?php
include '../../../Header.php';
$rConnect = connetti(false);
?>
<script>
    contratti=0;
    datiForm={}
    var codContratto=null;
    var nuovoContratto=false;
    var nuovaMac=[];
    var errore=[];
    var valore=true;
    function passaggio(value)
    {valore=value}
    function controlloInvio(datiID, i)
    {            if(document.getElementById(datiID+i)!==null){
                 Object.assign(datiForm.contratti['cont'+i],{[datiID]:document.getElementById(datiID+i).value})
                }}

    function controlloMacc(i)
    {$.ajax({
        url: "../verifica.php",
        method: "get",
        data: {codMac: document.getElementById('codMac'+i).value, index:i},
        success: function (data) {

                $("#avvertimento" + i).html(data)

        }
    })}

    function invia()
    {
        for (let i = 1; i <= contratti; i++) {
            if(nuovaMac[i] && errore[i]) {
                return false

            }

        }

        datiForm['contratto']=nuovoContratto?{'nuovo':true, 'nome':document.getElementById('nuovoNome').value, 'data':document.getElementById('dataStipulazione').value,
            'desc' : document.getElementById('nuovaDesc').value, 'note' : document.getElementById('nuoveNote').value} : {'nuovo':false, codice:codContratto}
        datiForm['cliente']=document.getElementById('inputCont').value
        datiForm['contratti']={}
        for (let i = 1; i <= contratti; i++) {

            datiForm.contratti['cont'+i]={}
            controlloInvio('tipoC',i)
            controlloInvio('dVendita',i)
            controlloInvio('dFGaranzia',i)
            controlloInvio('dInizio',i)
            controlloInvio('dFine',i)
            controlloInvio('Importo',i)
            controlloInvio('CC',i)
            controlloInvio('codMac',i)
            controlloInvio('ModMac',i)
            controlloInvio('DescMac',i)
                Object.assign(datiForm.contratti['cont'+i],{'nuovaMac':nuovaMac[i]})

                Object.assign(datiForm.contratti['cont'+i],{'FlagMagMac':document.getElementById('FlagMagMac'+i).checked?-1:0})
            controlloInvio('TipoMagMac',i)
        }
        console.log(datiForm)

        $.ajax({
            url:"scriviContr.php",
            method: 'get',
            data: datiForm,
            success:function (data){
                $('#ciao').html(data)
            }
        })
window.location.href="../../Interventi/index.php"    }


    function inserisciCodice(el)
    {       contratti=0;
        $.ajax({
            url:"getContratto.php",
            method:"get",
            data:{cliente:el.value},
            success:function (data)
            {$('#forms').html(data)}
        })
    }


    function togliMac(indexCont,el)
    {
        document.getElementById('lista'+indexCont).style.display='inline'
        el.value = '+ Macchina';
        document.getElementById('mac'+indexCont).innerHTML=""
        el.onclick= function () {aggiungiMac(indexCont, this)};
        document.getElementById('lista'+indexCont).setAttribute('required', '')
        nuovaMac[indexCont]=false

    }

    function aggiungiMac(indexCont,el)
    { el.value = '-';
        nuovaMac[indexCont]=true
        errore[indexCont]=false
        el.onclick= function () {togliMac(indexCont, this)}
        document.getElementById('lista'+indexCont).style.display='none'
        document.getElementById('lista'+indexCont).removeAttribute('required')

        document.getElementById('mac'+indexCont).innerHTML="" +
            "<table>" +
            "<tr><th colspan='5'>Macchina</th></tr>" +
            "<tr><td>Codice Macchina</td><td>Modello Macchina</td><td>Descrizione</td><td>In Magazzino</td><td>Tipo Magazzino</td></tr>" +
            "<tr><td><input type=\"text\" id='codMac"+indexCont+"' onkeyup='controlloMacc("+indexCont+")' required></td>" +
            "<td><input type=\"text\" id='ModMac"+indexCont+"' required></td>" +
            "<td><input type=\"text\" id='DescMac"+indexCont+"'></td>" +
            "<td><input type=\"checkbox\" id='FlagMagMac"+indexCont+"' ></td>" +
            "<td><select id='TipoMagMac"+indexCont+"'>" +
            "<option value='0'>In revisione</option>" +
            "<option value='1'>Demolizione</option>" +
            "<option value='2'>Macchina nuova</option>" +
            "<option value='3'>Revisionata</option>" +
            "<option value='4'>C. Sostituzione</option>" +
            "<option value='5'>C. Visione</option>" +
            "</select></td><td class='avvertimento' id='avvertimento"+indexCont+"'></td></tr>" +

            "</table>"

    }

var visualizzaMac=false;
    function macchinaEsistente(indexCont, el){
        nuovaMac[indexCont]=false
        el.setAttribute('required', '')
        if(!visualizzaMac && el.value!="") {
            document.getElementById("aggiungiM" + indexCont).style.display = 'none';
            $.ajax({
                url: "getMacchina.php",
                method: "get",
                data: {'codMac': el.value, 'index':indexCont},
                success: function (data) {
                    $('#mac' + indexCont).html(data)
                }
            })

        }
        else
        {        document.getElementById("aggiungiM"+indexCont).style.display='inline';
            document.getElementById('mac'+indexCont).innerHTML="";
        }

    }


    function aggiungiCont(){
        contratti++;
        var nuovoCont=document.createElement("div")
        nuovoCont.id="cont"+contratti
        nuovoCont.classList.add('formCont')
        nuovoCont.innerHTML="<div><table>" +
            "<tr><th colspan='7' >Contratto</th> <th class='separet'></th></tr>" +
            "<tr><td>Tipo Contratto</td><td>Data Vendita</td><td>Fine Garanzia</td><td>Inizio Contratto</td><td>Fine Contratto</td><td>Importo</td><td>Costo Copia</td>" +
            "</tr><tr>  <td><select id='tipoC"+contratti+"'>" +
            "<option value=\"0\">Garanzia</option>" +
            "<option value=\"1\">Assistenza</option>" +
            "<option value=\"2\">Pagamento</option>" +
            "<option value=\"3\">Pros. Garanzia</option>" +
            "<option value=\"4\">Noleggio</option>" +
            "<option value=\"5\">Costo copia</option>" +
            "<option value=\"6\">Contratto Speciale</option></select></td>" +

            "<td><input type=\"date\" id='dVendita"+contratti+"' ></td>" +

            "<td><input type=\"date\" id='dFGaranzia"+contratti+"' ></td>" +

            "<td><input type=\"date\" id='dInizio"+contratti+"' ></td>" +

            "<td><input type=\"date\" id='dFine"+contratti+"' ></td>" +

            "<td><input type=\"text\" id='Importo"+contratti+"' ></td>" +

            "<td><input type=\"text\" id='CC"+contratti+"' ></td>" +

            "</tr></table></div> " +
            "<div><table><tr><td><input list='immagazzinate' placeholder='in magazzino' id='lista"+contratti+"' onchange='macchinaEsistente("+contratti+",this)' required> </td>" +


            "<td><input type='button' id='aggiungiM"+contratti+"' value='+ Macchina' onclick='aggiungiMac("+contratti+",this)'></td></tr></table></div>" +
            " <div id='mac"+contratti+"'></div>"

        document.getElementById('contratti').appendChild(nuovoCont)
        document.getElementById('contratti').appendChild(document.createElement("br"))
        document.getElementById('contratti').appendChild(document.createElement("br"))



    }
    
    
    /*
    
$(function(){
$('#inputCont').on('change',function() {
    var opt = $('option[value="'+$(this).val()+'"]');
    alert(opt.length ? opt.attr('id') : 'NO OPTION');
});})*/
</script>


<div id="ciao"></div>

    <form method="get" action="../../Contratti/index.php">

        <input list="contratto" id="inputCont" placeholder="Cliente" onchange="inserisciCodice(this)" required>

        <datalist id="contratto">

           <?php
            $i=0;
           $query="SELECT Q_Clienti.Ragione_Sociale, Q_Clienti.Codice_Anagrafica,T_TestContratti.Codice
            FROM Q_Clienti LEFT JOIN T_TestContratti On Q_Clienti.Codice_Anagrafica=T_Testcontratti.CodCliente WHERE Q_Clienti.Ragione_Sociale IS NOT NULL
         ";
           $res=odbc_exec($rConnect,$query);
           while ($arr=odbc_fetch_array($res))
               echo "<option  value='" . preg_replace("/[^a-zA-Z0-9- *]+/", "", $arr["Codice_Anagrafica"]) . "'>" . preg_replace("/[^a-zA-Z0-9- *]+/", "", $arr['Ragione_Sociale']) . " | " . preg_replace("/[^a-zA-Z0-9- *]+/", "", $arr['Codice'] ). "</option>"

           ?>

        </datalist>

        <div id="codice"></div>
        <div id="forms"></div>


        <input id="bottone" type ="button" onclick="invia()" value="invia">
    </form>
<datalist name='' id='immagazzinate'><?php
    $res=odbc_exec($rConnect,"SELECT T_Macchine.Codice, T_Macchine.CodModello FROM T_Macchine Where T_Macchine.FlagMagazzino=-1 AND T_Macchine.Codice NOT IN 
     (SELECT T_Macchine.Codice as attivi FROM T_Macchine
    LEFT JOIN T_TipoMag ON T_Macchine.TipoMagazzino=T_TipoMag.Codice
    LEFT JOIN T_DettContratti On T_DettContratti.CodMacchina=T_Macchine.Codice WHERE T_DettContratti.FlagAttivo=-1 GROUP BY T_Macchine.Codice)");
    while($arr=odbc_fetch_array($res))
        echo "<option value='".$arr['Codice']."'>".$arr['CodModello']."</option>"


    ?></datalist></td>

<div style="clear: both;"></div>
</body>
</html>


