var disableBoludo=false;
var bldResponce="";
var claseBoludo="";
var boludoForever=false;
$(document).ready(function(){	
	switch(partBoludo)
	{
		case 1:
			claseBoludo="parte1.jpg";
			bldResponce+="<br> <a href='javascript:showBoludo("+'"sub_1.jpg"'+")'>Me parece un mal educado</a>";
		break;
		case 2:
			claseBoludo="parte2.jpg";
			bldResponce+=" <br> <a href='javascript:showBoludo("+'"sub_2.jpg"'+")'>Le parece bien hacer tutoriales de esta manera?</a>";
		break;
		case 3:
			claseBoludo="parte5.jpg";
			bldResponce+=" <br> <a href='javascript:showBoludo("+'"sub_3.jpg"'+")'>Ya me ta rompiendo las pelotas esto</a>";
			bldResponce+=" <br> <a href='javascript:boluResponc("+'"sub_5.jpg"'+","+'"Esa es forma de tratar a una dama?"'+");showBoludo("+'"sub_4.jpg"'+")'>Pero yo soy una chica...</a>";
		break;
		case 4:
			claseBoludo="parte6.jpg";
		break;
		case 5:
			claseBoludo="parte7.jpg";
		break;
		case 6:
			claseBoludo="";
			disableBoludo=true;
		break;
		case 7:
			claseBoludo="parte11.jpg";
		break;
		case 8:
			claseBoludo="parte12.jpg";
		break;
		case 9:
			claseBoludo="parte6.jpg";
		break;
		case 10:
			claseBoludo="";
			disableBoludo=true;
		break;
		case 11:
			claseBoludo="parte13.jpg";
		break;
		case 12:
			claseBoludo="parte14.jpg";
			bldResponce+=" <br> <a href='javascript:showBoludo("+'"sub_7.jpg"'+")'>1 punto cada 10 niveles es muy poco?</a>";
		break;
		case 13:
			claseBoludo="";
			disableBoludo=true;
		break;
		case 14:
			claseBoludo="parte15.jpg";
		break;
		case 15:
			claseBoludo="parte16.jpg";
			bldResponce+=" <br> <a href='javascript:showBoludo("+'"sub_8.jpg"'+")'>y si soy mago y compro una heavy?</a>";
		break;
		case 16:
			claseBoludo="parte17.jpg";
		break;
		case 17:
			claseBoludo="parte18.jpg";
			bldResponce+=" <br> <a href='javascript:showBoludo("+'"sub_9.jpg"'+")'>y esa moneda que es?</a>";
			bldResponce+=" <br> <a href='javascript:showBoludo("+'"sub_10.jpg"'+")'>y eso que dice sale que es?</a>";
			bldResponce+=" <br> <a href='javascript:showBoludo("+'"sub_11.jpg"'+")'>y la cruz que hace?</a>";
			bldResponce+=" <br> <a href='javascript:showBoludo("+'"sub_12.jpg"'+")'>y el regalito que es?</a>";
			boludoForever=true;
		break;
		case 18:
			claseBoludo="";
			disableBoludo=true;
		break;
		case 19:
			claseBoludo="parte19.jpg";
			bldResponce+=" <br> <a href='javascript:showBoludo("+'"sub_13.jpg"'+")'>por que estas chiquito?</a>";
		break;
		case 20:
			claseBoludo="";
			disableBoludo=true;
		break;
		case 21:
			claseBoludo="parte21.jpg";
		break;
		default:
			claseBoludo="";
			disableBoludo=true;
		break;
	}
	showBoludo(claseBoludo);
});
function boluResponc(img,tex)
{
	bldResponce+='<br> <a href="javascript:showBoludo('+"'"+img+"'"+')">'+tex+'</a>';
}
function tomatelatedije()
{
	closeLightbox();
}
function desactivarAtendedor()
{
    closeLightbox();
    window.location = "index.php?sec=tomatelaTeDije";
}
function showBoludo(img)
{
	if(!disableBoludo)
		lightbox('<img src="images/tutorial/'+img+'" alt="ERROR EN ATENDEDOR DE BOLUDOS" /><div class="bldResponce"><a href="javascript:tomatelatedije()">Continuar</a>'+bldResponce+'<br><a href="javascript:desactivarAtendedor()">Desactivar tutorial.</a></div>');
	if(!boludoForever)
		bldResponce="";
}