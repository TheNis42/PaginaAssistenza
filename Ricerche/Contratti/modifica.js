function modifica()
    {
        cambiaTipo()
    cambiaCheckboxes()
    inModifica=!inModifica
        inviaAlDB()
}
var inModifica=false
var initTipo=[]
var tipi=["Garanzia", "Assistenza","Pagamento","Pros. Garanzia","Noleggio","Costo copia","Contratto Speciale"]
var initChecked=[]
var dati=[]
function cambiaCheckboxes() {
    i = 1


    while (cb = document.getElementById('cb' + i)) {
        initChecked[i]=this.checked
        if (inModifica) {
            cb.setAttribute('disabled', '')


        } else {
            cb.removeAttribute('disabled')
            cb.addEventListener('click', function (event) {
                console.log(dati)
                if (!confirm("sei sicuro???")) {
                    //console.log(this.getAttribute('checked') == null)

                   // this.getAttribute('checked') == null ? this.removeAttribute('checked') : this.setAttribute('checked', '')

                    event.preventDefault()
                    this.checked=initChecked[i]
                }
                else
                {
                   dati.push({ID:this.getAttribute('name'),tipo:1, checked:this.checked?-1:0})
                }
                initChecked[i]=this.checked
            })


        }
        i++

    }
}


function cambiaTipo()
    {i=1;
        while (tipo=document.getElementById(i))
        {
        if(inModifica)
        {tipo.innerHTML=initTipo[i]}
        else
        {initTipo[i]=tipo.innerHTML
            tipoDefault=tipo.innerHTML
               stringaSelect="<select onchange='avviso("+i+",\""+tipoDefault+"\",\""+tipo.getAttribute('name')+"\",this)'>"
        for (let j = 0; j < tipi.length; j++) {
            //console.log(tipi[j]+" "+tipo)
            stringaSelect+="<option name='"+j+"'"+(tipi[j]==tipo.innerHTML?"selected":"")+">"+tipi[j]+"</option>"
        }
                   stringaSelect+="</select>"
    tipo.innerHTML=stringaSelect}
        i++
        }

    }

    function avviso(i,tipoDefault,idCont,el)
    {tipo=document.getElementById(i)
        //console.log(i+" "+tipoDefault+" "+el.value)
        tipoSelezionato=tipoDefault
        if(confirm("sicuro?"))
            {tipoSelezionato=el.value
            initTipo[i]=el.value
                dati.push({ID:idCont,tipo:0, value:el.options[el.selectedIndex].getAttribute('name')})

            }

            stringaSelect="<select onchange='avviso("+i+",\""+tipoSelezionato+"\",this)'>"
            for (let j = 0; j < tipi.length; j++) {
                stringaSelect+="<option name='"+j+"' "+(tipi[j]==tipoSelezionato?"selected":"")+">"+tipi[j]+"</option>"
            }
            stringaSelect+="</select>"
            tipo.innerHTML=stringaSelect}

function inviaAlDB()
{  $.ajax({
    url:'modifica.php',
    method:"GET",
    data:{'datiArr':dati},
    success:function(data)
    {            $('#test').html(data);

    }
});}