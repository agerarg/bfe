var armaIzquierda=0;
const itemsPorPagina=45;
var runaIndex=1;
var limiteRunasCt=0;
var runeSlot=["open","open","open","open","open"];
var runeType=[0,0,0,0,0];
checkRuneType = (idItem)=>{
	let i=0;
	while(runeType[i])
	{
		if(runeType[i]==idItem)
				return true;
		i++;
	}
	return false;
}
checkRunesSlots = ()=>{
	let i=0;
		while(runeSlot[i])
		{
			if(runeSlot[i]=="open")
				return (i+1);
			i++;
		}
	return 0;
}
runaUsada= (i)=>{
	if(runaIndex<=5)
	{
		let openRune = checkRunesSlots();
		let title="";
		title= itemsCatch[i]['Nombre']+"|<div class=ComunDesc>Atributos:<br>"+makeDesc(itemsCatch[i],"<br>")+"</div>";
		$("#runa_"+openRune).text("");
		$("#runa_"+openRune).append("<div><a href='javascript:sacarRuna("+runaIndex+","+i+","+openRune+");'><div title='"+title+"' class='item_img' id='runa"+i+"'><img src='images/item/"+itemsCatch[i]['subtipo']+"/"+itemsCatch[i]['imagen']+"' /></div></a></div>");
		runeSlot[(openRune-1)]="close";
		runeType[(openRune-1)]=itemsCatch[i]['idItem'];
		runaIndex++;
		itemsCatch[i]['usadoPor']=1;
		showItemList();
		$('.item_img').cluetip({splitTitle: '|',delayedClose: 0});
	}
	else
		jAlert("Solo 5 items son necesarios!", 'Error');	
		
	if(runaIndex==6)
	{
		$("#retoButton").show("slow");
		$("#retoBox").animate({
			opacity: '0.5'
		},"slow");
	}
}
sacarRuna=(rIndex,ItemI,openRuna)=>{
	runeSlot[openRuna-1]="open";
	runeType[openRuna-1]=0;
	//runeType[openRuna-1]=0;
	$("#runa_"+openRuna).text("");
	itemsCatch[ItemI]['usadoPor']=0;
	runaIndex--;
	showItemList();
	$('.item_img').cluetip({splitTitle: '|',delayedClose: 0});
	
	$("#retoButton").hide("slow");
	$("#retoBox").animate({
		opacity: '1'
	},"slow");
	
}
function itemlist(data) {
		$("#error").text(data['error']);
		itemsCatch = data.litem;
		var i=0;
		var desc="";
		var setInfo="";
		var title="";
		var idItemTrue=0;
		var itemOptions="";
var romper ="";
		$("#item_list").text("");
		
		while(itemsCatch[i])
			{
				var fondoparaitem =(itemsCatch[i]['enVenta']==0 && itemsCatch[i]['trade']==0)?("itemObjOPEN"):("itemObjSALE");
				var cantidad = itemsCatch[i]['cantidad'];
				var cant_show="";
				var enchant="";
				var saleTx="";
				var regalar="";
				setInfo= "setInfo";	
				
				if(itemsCatch[i]['enchant']>0)
					enchant=" +"+itemsCatch[i]['enchant'];
				else
					enchant="";	
				if(cantidad>1)
					cant_show=cantidad+" ";
				else
				cant_show="";
				 title= cant_show+itemsCatch[i]['Nombre']+enchant+"|<div class=ComunDesc>Atributos:<br>"+makeDesc(itemsCatch[i],"<br>")+"</div>";
				 
				if(itemsCatch[i]['armorset']>0)
				{
					 idItemTrue = itemsCatch[i]['armorset'];
					 title+= "<div class=ComunDescSet><div class=SetName>Set "+itemsCatch[i]['Nombre']+"</div><div class=raidDrop>Requiere:<br>"+descArmor[idItemTrue]['req']+"</div>";
					 title+= "<div>Bonus:<br>"+descArmor[idItemTrue]['desc']+"</div></div>";
				}
				
				if(itemsCatch[i]['intradeable']==0)
					regalar = " <a alt='Regalar' title='Regalar' href='javascript:regalar("+i+");'><img border='0' src='images/item_regalar.png' width='16' height='16' /></a>";
				else
					regalar="";
				if(itemsCatch[i]['grado']<=2 || itemsCatch[i]['contable']>0 || itemsCatch[i]['tipo']=="crystal")
					itemOptions="<a href='javascript:vender("+i+",1);' alt='vender a tienda' title='Vender por "+(itemsCatch[i]['grado']*50)+" de oro'><img border='0' src='images/item_sale.png' width='16' height='16' /></a>";
				else if((itemsCatch[i]['forceStats']==0 && itemsCatch[i]['epic']==0) || itemsCatch[i]['intradeable']==1)
                       itemOptions = "<a href='javascript:borrar("+i+");'><img border='0' src='images/romper.png' width='16' height='16' /></a>"; 
				else
				       itemOptions="<a href='javascript:vender("+i+",2);' alt='sale' title='Vender a otros jugadores'><img border='0' src='images/sale.png' width='27' height='16' /></a> <a href='javascript:borrar("+i+");'><img border='0' src='images/romper.png' width='16' height='16' /></a>" ;
				
				$("#item_list").append("<div class='itemObj "+fondoparaitem+"' id='objContent"+i+"'><a href='javascript:itemOptionsSh("+i+");'><div title='"+title+"' class='item_img "+setInfo+"' id='"+i+"'><img src='images/item/"+itemsCatch[i]['subtipo']+"/"+itemsCatch[i]['imagen']+"' /></div></a></div>");
				itemsCatch[i]['show'] = true;
				cant_show="";

				if(itemsCatch[i]['usadoPor']==idPersonaje)
					runaUsada(i);

				i++;
			}
		showItemList();
		$('.item_img').cluetip({splitTitle: '|',delayedClose: 0});
		injertoTardio();
}	

function calculoPaginas()
{
	var cant_pags;
	var x;
	$("#item_paginacion").text("");
	cant_pags= ((cantidadItems-2) / itemsPorPagina);
	cant_pags = parseInt(cant_pags);
	if(cantidadItems<=7)
		$("#item_paginacion").text("");
	else
	{
		for (x=0;x<cant_pags+1;x++)
			$("#item_paginacion").append("<a href='javascript:toPagina("+(x)+");'><"+(x+1)+"></a> ");
	}
}
function toPagina(pag)
{
	pagina=pag;
	showItemList();
}
function showItemList()
{
	var i=0;
	var n=1;
	var desde = 0;
	var hasta = itemsPorPagina;
	
	if(pagina==0)
	{
		desde = 0;
	}
	else
	{
		hasta = (pagina+1)*itemsPorPagina;
		desde = (pagina)*itemsPorPagina+1;
	}
			while(itemsCatch[i])
			{
				if(itemsCatch[i]['usadoPor']==0 && itemsCatch[i]['show'] && (filtroTxt=='todo' || filtroTxt==itemsCatch[i]['tipo'] || filtroTxt=='misc'))
				{
					if(filtroTxt=='misc')
					{
						if(itemsCatch[i]['tipo']=='pot' || itemsCatch[i]['tipo']=='crystal' || itemsCatch[i]['tipo']=='portal' || itemsCatch[i]['tipo']=='enchant' || itemsCatch[i]['tipo']=='material')
						{
							if(desde <= n && hasta >= n )
								$("#objContent"+i).show(500);
							else
								$("#objContent"+i).hide();	
								
							n++;
						}
						else
							$("#objContent"+i).hide();	
					}
					else
					{
						if(desde <= n && hasta >= n )
						$("#objContent"+i).show(500);
					else
						$("#objContent"+i).hide();	
						
					n++;
					}
				}
				else
					$("#objContent"+i).hide();	
				i++;
			}
			cantidadItems = n;
			calculoPaginas();
}
function checkItems()
	{
		$.ajax({
			data: "",
			type: "GET",
			dataType: "json",
			url: "json/myTrash.php?t="+retotier,
			success: function(data){
			itemlist(data);
		}
		});
	}

function injertoTardio()
{
	var id=0;
	var desc="";
	$('.showSetInfo').each(function() {
		id = itemSearch($(this).attr("idItem"));
		desc="";
		var enchant="";
		if(itemsCatch[id]['enchant']>0)
					enchant=" +"+itemsCatch[id]['enchant'];
				else
					enchant="";	
		desc=makeDesc(itemsCatch[id],"<br>");
		title= itemsCatch[id]['Nombre']+enchant+"|<div class=ComunDesc>Atributos:<br>"+desc+"</div>";
		 setInfo= "showSetInfo";	
		if(itemsCatch[id]['armorset']>0)
		{
			 idItemTrue = itemsCatch[id]['armorset'];
			  title+= "<div class=ComunDescSet><div class=SetName>Set "+itemsCatch[id]['Nombre']+"</div><div class=raidDrop>Require:<br>"+descArmor[idItemTrue]['req']+"</div>";
			title+= "<div>Bonus:<br>"+descArmor[idItemTrue]['desc']+"</div></div>";
			 
		}
		$("#slot_"+itemsCatch[id]['tipo']).text("");
		$("#slot_"+itemsCatch[id]['tipo']).append("<a href='javascript:quitarItem("+id+");'><img border='0' src='images/item/"+itemsCatch[id]['subtipo']+"/"+itemsCatch[id]['imagen']+"' title='"+title+"' class='"+setInfo+"' width='35' height='35' /></a>");	
		if(itemsCatch[id]['hand']==2)
		{
			$("#slot_shield").text("");
			$("#slot_shield").append("<img class='selectedImg' src='images/item/"+itemsCatch[id]['subtipo']+"/"+itemsCatch[id]['imagen']+"' width='35' height='35' />");
		}
	});
		$('.showSetInfo').cluetip({splitTitle: '|',delayedClose: 0,cursor:'pointer'});
}

$(document).ready(function(){			
	checkItems();

	if(userLevelp>=40)
		limiteRunasCt++;
	if(userLevelp>=50)
		limiteRunasCt++;
	if(userLevelp>=60)
		limiteRunasCt++;
	if(userLevelp>=70)
		limiteRunasCt++;
	if(userLevelp>=80)
		limiteRunasCt++;	

});


itemOptionsSh = (id)=>{
	runaUsada(id);
	showItemList();
}

goReto = ()=>{
	$("#retoButton").hide();

	let trashItm = "";
	let i=0;
	while(itemsCatch[i])
	{
		if(itemsCatch[i]['usadoPor']===1)
			trashItm+=itemsCatch[i]['idInventario']+","
		i++;
	}
	//alert("json/setReto.php?it="+trashItm+"&tier="+retotier);
	$.ajax({
		data: "it="+trashItm+"&tier="+retotier,
		type: "GET",
		dataType: "json",
		url: "json/setReto.php",
		success: function(data){
		goToReto(data);
	}
	});
}
goToReto = (data)=>{
	if(data['back'])
	{
		location.href='index.php?sec=mundo';
	}
	else
		jAlert("Error", 'Error');	
}