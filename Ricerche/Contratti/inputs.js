var dati=
    [nomeCont={valore:'%', htmlID: '#Contratti', nome:'contratti', tipo: 1},
    percPag={valore:1, nome:'perc', tipo: 0},
    cliente={valore:'%', htmlID: '#Cliente', nome:'customer', tipo: 1},
    codMacchina={valore:'%', htmlID: '#Macchina', nome:'codMac', tipo: 1},
    priorita={valore:1, nome:'priority', tipo: 0},
    dataInizio={valore:null, htmlID: '#dataInizio', nome:'dataI', tipo: 2},
    dataFine={valore:null, htmlID: '#dataFine', nome:'dataF', tipo: 2}];

if(typeof extCodMac!=='undefined')//DA CAMBIARE A CONTRATTI
{dati[1].valore=extCodMac}

getInputs(dati,'fetch.php','#tabellaResponsiva');
/*
function modificaGaranzia(Codice)
{document.getElementById(Codice).innerHTML="<select><option>Garanzia</option>" +
"<option>Noleggio</option>"+
"<option>Costo Copia</option>" +
"<option>Pros. Garanzia</option>" +
"<option>Pagamento</option>" +
"<option>Contratto Speciale</option></select>"
document.getElementById(Codice).onclick="";
}*/