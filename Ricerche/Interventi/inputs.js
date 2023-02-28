var dati=
    [nomeCont={valore:undefined, htmlID: '#interventi', nome:'interventi', tipo: 1},
        percPag={valore:1, nome:'perc', tipo: 0},
        codChiamata={valore:undefined, htmlID: '#codChiamata', nome:'codChiamata', tipo: 1},
        codData={valore:undefined, htmlID: '#codData', nome:'codData', tipo: 1},
        ModelloMacchina={valore:undefined, htmlID: '#modello', nome:'ModMacc', tipo: 1},
        priorita={valore:1, undefined:'priority', tipo: 0},
        extCodMacc={valore:undefined, nome:'extCodMac',tipo:0},
        isExtern={valore:undefined,nome:'isExternal', tipo: 0}
    ]
/*
var isExternal=false
if(typeof extCodMac!=='undefined')
{dati[3].valore=extCodMac}
*/



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