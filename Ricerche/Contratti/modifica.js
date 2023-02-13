function modifica()
{cambiaTipo()
    cambiaCheckboxes()
    inModifica=!inModifica

}
var inModifica=false
var initTipo=[]
var tipi=["Garanzia","Noleggio","Costo copia","Pros. Garanzia","Pagamento","Contratto Speciale", "Assistenza"]


function cambiaCheckboxes()
{i=1
    while (cb=document.getElementById('cb'+i))
    {if(inModifica) {
        cb.setAttribute('disabled', '')



    }
    else {
        cb.removeAttribute('disabled')
        cb.onclick=function (){
            if(!confirm("sei sicuro???"))
                cb.getAttribute('checked')==null? cb.removeAttribute('checked'):cb.setAttribute('checked','')
        }


    }
        i++

    }
}
function cambiaTipo()
    {i=1;
        while (tipo=document.getElementById(i))
        {
        if(inModifica)
        {tipo.innerHTML=initTipo[i]
        }
        else
        {initTipo[i]=tipo.innerHTML
            tipoDefault=tipo.innerHTML
               stringaSelect="<select onchange='avviso("+i+",\""+tipoDefault+"\",this)'>"
        for (let j = 0; j < tipi.length; j++) {
            //console.log(tipi[j]+" "+tipo)
            stringaSelect+="<option "+(tipi[j]==tipo.innerHTML?"selected":"")+">"+tipi[j]+"</option>"
        }
                   stringaSelect+="</select>"
    tipo.innerHTML=stringaSelect}
        i++
        }

    }

    function avviso(i,tipoDefault,el)
    {tipo=document.getElementById(i)
        //console.log(i+" "+tipoDefault+" "+el.value)
        tipoSelezionato=tipoDefault
        if(confirm("sicuro?"))
            {tipoSelezionato=el.value
            initTipo[i]=el.value
            }

            stringaSelect="<select onchange='avviso("+i+",\""+tipoSelezionato+"\",this)'>"
            for (let j = 0; j < tipi.length; j++) {
                stringaSelect+="<option "+(tipi[j]==tipoSelezionato?"selected":"")+">"+tipi[j]+"</option>"
            }
            stringaSelect+="</select>"
            tipo.innerHTML=stringaSelect}