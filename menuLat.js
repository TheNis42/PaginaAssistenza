var aSchermo=false, b1, b2, b3, menuLaterale, treBarre, content;
function menu()
{



    if(aSchermo)
    {   document.getElementById('b1').style=b1;
       document.getElementById('b2').style=b2;
        document.getElementById('b3').style=b3;
        document.getElementById('menuLaterale').style=menuLaterale;
       document.getElementById('treBarre').style=treBarre;
       document.getElementById('content').style=content

    }
    else
    {
        b1=document.getElementById('b1').style;
        b2=document.getElementById('b2').style;
        b3=document.getElementById('b3').style;
        menuLaterale=document.getElementById('menuLaterale').style;
        content=document.getElementById('content').style;
        treBarre=document.getElementById('treBarre').style;
        document.getElementById('content').style.filter='blur(3px)'
        document.getElementById('menuLaterale').style.right='0'
        document.getElementById('b2').style.transform="translateX(400px)"
        document.getElementById('b1').style.transform="translateY(20px) rotate(-45deg)"
        document.getElementById('b1').style.backgroundColor="#ffc400"
        document.getElementById('b3').style.backgroundColor="#ffc400"

        document.getElementById('b3').style.transform="translateY(-21px) rotate(45deg)"


    }
aSchermo=!aSchermo

}
var tec=false
function apriTecnici()
{
    if(tec){
    document.getElementById('addTecnici').style.display='none';
        document.getElementById('Tecnico').value=""
    }
    else
        document.getElementById('addTecnici').style.display='block';
    tec=!tec
}
function inviaTecnico()
{          $.ajax({
    url:"../scriviTecnico.php",
    method: "get",
    data : {
        Descrizione: document.getElementById('Tecnico').value
    },
    success: function (data)
    {
        $('#test').html(data)
    }
})

    apriTecnici()
}