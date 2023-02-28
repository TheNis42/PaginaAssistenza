var dati=
    [nomeCont={valore:undefined, htmlID: '#contratti', nome:'contratti', tipo: 1},
        percPag={valore:1, nome:'perc', tipo: 0},
        cliente={valore:undefined, htmlID: '#clienti', nome:'customer', tipo: 1},
        codMacchina={valore:undefined, htmlID: '#macchine', nome:'codMac', tipo: 1},
        ModelloMacchina={valore:undefined, htmlID: '#modello', nome:'ModMacc', tipo: 1},
        priorita={valore:1, undefined:'priority', tipo: 0}
    ]

if(typeof extCodMac!=='undefined')
{dati[3].valore=extCodMac
}
if(typeof extCliente!=='undefined')
{dati[2].valore=extCliente
}
    getInputs(dati,'fetch.php','#tabellaResponsiva');

function modificaGaranzia(Codice)
{document.getElementById(Codice).innerHTML="<select><option>Garanzia</option>" +
"<option>Garanzia</option>"+
"<option>Noleggio</option>"+
"<option>Costo Copia</option>" +
"<option>Pros. Garanzia</option>" +
"<option>Pagamento</option>" +
"<option>Contratto Speciale</option></select>"
document.getElementById(Codice).onclick=""
}