start=Date.now()
function getInputs(dati,filePath,IDhtml)
 {$(document).ready(function ()
{
    load_data();
function load_data()
{

    var datas={};
    dati.forEach(element => {
        datas[element.nome]=element.valore});
    $.ajax({
        url:filePath,
        method:"get",
        data:datas,
        success:function(data)
        {
            $(IDhtml).html(data);
        }
   });

}

function getTextInput(textObj, priority=0)
{


    $(textObj.htmlID).on('keyup paste change',function(){
        let search = $(this).val();
        console.log('js: '+search);
        search=search!=''?search+'%':undefined;
        textObj.valore=search
        priorita=priority
        dati['percPag.valore']=1
        load_data()
        setTimeout(function (){ if(Date.now()-start>=800)
                                            load_data()
            },800)
        start=Date.now();

    });
}
function getDateInput(dateObj, priority=0)
{	$(dateObj.htmlID).change(function(){
    let search = $(this).val();
    search=search!=''?search:undefined;
    dateObj.valore=search
    priorita=priority
    dati['percPag.valore']=1
    load_data();
});
}
var i=0;
dati.forEach(element =>{
    console.log(element.tipo)
    if(element.tipo==1) {
        getTextInput(element, i++)
    }if(element.tipo==2)
        getDateInput(element, i++)

})


$('#ipertab').scroll(function() {

var currY = $(this).scrollTop();
var postHeight = $(this).height();
var scrollHeight = $('#tabellaResponsiva').height();
// Current percentual position
var scrollPercent = (currY / (scrollHeight - postHeight)) * 100;
console.log(percPag)
if(scrollPercent>100 )
{dati['percPag.valore']++;
    load_data()
}

});
})}