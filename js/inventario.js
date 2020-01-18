var armaIzquierda=0;
var idVentaSelect=0;
const itemsPorPagina=45;
var doIdInventario=0;
var thereIsDerW=0;
function statsGonnaChange()
{
	 $("#inv_stats").css('color', 'yellow');
	 setTimeout(function() {
			$("#inv_stats").css('color', 'white');
		}, 2000);
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
				i++;
			}
		showItemList();
		$('.setInfo').cluetip({splitTitle: '|',delayedClose: 0});
		$("div.item_img").draggable({ revert: true });
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
	if(filtroTxt=='todo')
		$("#tusItems").text("Mis items: "+(cantidadItems-1)+"/"+I_itemLimit);
	else
		$("#tusItems").text("Mostrando: "+(cantidadItems-1));
}
function toPagina(pag)
{
	pagina=pag;
	showItemList();
}
function filtro(que)
{
	filtroTxt=que;
	pagina=0;
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
						if(itemsCatch[i]['tipo']=='currency' || itemsCatch[i]['tipo']=='pot' || itemsCatch[i]['tipo']=='crystal' || itemsCatch[i]['tipo']=='portal' || itemsCatch[i]['tipo']=='enchant' || itemsCatch[i]['tipo']=='material')
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
			url: "json/myItems.php",
			success: function(data){
			itemlist(data);
		}
		});
	}
function stopTouched(id)
{
	$("#atr_"+id).removeClass("statTouched");
}
function statTouched(id)
{
	$("#atr_"+id).addClass("statTouched");
	setTimeout ('stopTouched("'+id+'")', 1000);
}
function injertoTardio()
{
	let i=0;
	while(itemsCatch[i])
	{
		if(itemsCatch[i]['usadoPor']==idPersonaje)
			setUsedItems(i);
		i++;
	}
	$('.newInfo').cluetip({splitTitle: '|',delayedClose: 0,cursor:'pointer'});
	showItemList();
	}
// Enchantar armadura
var enchantSelected=0;
function enchantor()
{
	
	//alert("id="+itemsCatch[enchantSelected]['idInventario']+"&action=poner&parte="+$("#toEnchantSelected").val());
	$("#ItemEnchantInv").hide();
	$.ajax({
					data: "id="+itemsCatch[enchantSelected]['idInventario']+"&action=poner&parte="+$("#toEnchantSelected").val(),
					type: "GET",
					dataType: "json",
					url: "json/quipeItem.php",
					success: function(data){
					getItem(data,enchantSelected);
				}
				});

}
setUsedItems=(id)=>
{
	
		var desc="";
		var enchant="";
		if(itemsCatch[id]['enchant']>0)
					enchant=" +"+itemsCatch[id]['enchant'];
				else
					enchant="";	
		desc=makeDesc(itemsCatch[id],"<br>");
		title= itemsCatch[id]['Nombre']+enchant+"|<div class=ComunDesc>Atributos:<br>"+desc+"</div>";
		 setInfo= "newInfo";	
		if(itemsCatch[id]['armorset']>0)
		{
			 idItemTrue = itemsCatch[id]['armorset'];
			  title+= "<div class=ComunDescSet><div class=SetName>Set "+itemsCatch[id]['Nombre']+"</div><div class=raidDrop>Requiere:<br>"+descArmor[idItemTrue]['req']+"</div>";
			title+= "<div>Bonus:<br>"+descArmor[idItemTrue]['desc']+"</div></div>";
		}
		if(itemsCatch[id]['tipo']=="W")
		{
			if(canEquipeHands)
			{
				if(itemsCatch[id]['manoDerecha']==1)
				{
					thereIsDerW=1;
					$("#slot_shield").text("");
					$("#slot_shield").append("<a href='javascript:quitarItem("+id+");'><img border='0' src='images/item/"+itemsCatch[id]['subtipo']+"/"+itemsCatch[id]['imagen']+"' title='"+title+"' class='"+setInfo+"' width='35' height='35' /></a>");	
				}
				if(itemsCatch[id]['manoIzquierda']==1)	
				{	
					$("#slot_W").text("");
					$("#slot_"+itemsCatch[id]['tipo']).append("<a href='javascript:quitarItem("+id+");'><img border='0' src='images/item/"+itemsCatch[id]['subtipo']+"/"+itemsCatch[id]['imagen']+"' title='"+title+"' class='"+setInfo+"' width='35' height='35' /></a>");	
				}
			}
			else
			{
				$("#slot_W").text("");
					$("#slot_"+itemsCatch[id]['tipo']).append("<a href='javascript:quitarItem("+id+");'><img border='0' src='images/item/"+itemsCatch[id]['subtipo']+"/"+itemsCatch[id]['imagen']+"' title='"+title+"' class='"+setInfo+"' width='35' height='35' /></a>");	
			}

			if(itemsCatch[id]['hand']==2)
			{
				$("#slot_W").text("");
				$("#slot_"+itemsCatch[id]['tipo']).append("<a href='javascript:quitarItem("+id+");'><img border='0' src='images/item/"+itemsCatch[id]['subtipo']+"/"+itemsCatch[id]['imagen']+"' title='"+title+"' class='"+setInfo+"' width='35' height='35' /></a>");	
				$("#slot_shield").text("");
				$("#slot_shield").append("<img class='selectedImg' src='images/item/"+itemsCatch[id]['subtipo']+"/"+itemsCatch[id]['imagen']+"' width='35' height='35' />");
			}
		}
		else
		{
			$("#slot_"+itemsCatch[id]['tipo']).text("");
			$("#slot_"+itemsCatch[id]['tipo']).append("<a href='javascript:quitarItem("+id+");'><img border='0' src='images/item/"+itemsCatch[id]['subtipo']+"/"+itemsCatch[id]['imagen']+"' title='"+title+"' class='"+setInfo+"' width='35' height='35' /></a>");	
		}
} 
function getItem(data,id)
{
	var setInfo="";
	var title="";

	if(data['error']!=0)
	{  
                
                if(data['pet']==1)
                {
if(data['newPeto']==1)
{
jAlert(data['error'], 'Error');	
}
else
{
                  jConfirm(data['error'], 'Adoptar Mascota', function(r) {
		if(r)
		{
                  jPrompt("Que nombre quieres que tenga?", '', 'Adoptar Mascota', function(q) {
		if( q ) 
		{
			$.ajax({
							data: "id="+itemsCatch[id]['idInventario']+"&action=poner&petName="+q,
							type: "GET",
							dataType: "json",
							url: "json/quipeItem.php",
							success: function(data){
							getItem(data,id);
						}
						});
		}
		});
}
		});
}
                }
                else
		if(data['newSA']==1)
		{
			
			var desc="";
				var enchant="";
				atr_update(data['newstats']);
				id= itemSearch(data["itemIdRe"]);
				
				itemsCatch[id]['SA']=1;
				itemsCatch[id]['SAchar']=data['newSAchar'];
				itemsCatch[id]['Nombre']	= "<spam class=SAname>"+itemsCatch[id]['Nombre']+"</spam>";
			
			$("#slot_"+itemsCatch[id]['tipo']).text("");
			
			if(itemsCatch[id]['enchant']>0)
						enchant=" +"+itemsCatch[id]['enchant'];
					else
						enchant="";	
			
			desc=makeDesc(itemsCatch[id],"<br>");
			
			title= itemsCatch[id]['Nombre']+enchant+"|<div class=ComunDesc>Atributos:<br>"+desc+"</div>";
			 setInfo= "newInfo";	
			
			$("#slot_"+itemsCatch[id]['tipo']).append("<a href='javascript:quitarItem("+id+");'><img border='0' src='images/item/"+itemsCatch[id]['subtipo']+"/"+itemsCatch[id]['imagen']+"' title='"+title+"' class='"+setInfo+"' width='35' height='35' /></a>");	
			if(itemsCatch[id]['hand']==2)
			{
				$("#slot_shield").text("");
				$("#slot_shield").append("<img class='selectedImg' src='images/item/"+itemsCatch[id]['subtipo']+"/"+itemsCatch[id]['imagen']+"' width='35' height='35' />");
			}
			$('.newInfo').cluetip({splitTitle: '|',delayedClose: 0,cursor:'pointer'});
			showItemList();
		
		}else
		if(data["ItemEnchant"]==1)
		{
			itemsCatch[id]['cantidad']--;
			itemOptionsSh(id);
			
			if(data["ItemRisky"]==1)
			{
				
				if(data["ItemSuccses"]==1)
				{
					$("#Wpower").text(data["EnchantCount"]);
					$("#enchantBoxSucces").fadeIn(3000);
					setTimeout(function(){
						$("#enchantBoxSucces").fadeOut(3000);
						},5000);
				}
				else
				{
					$("#enchantBoxFail").fadeIn(1000);
					setTimeout(function(){
						$("#enchantBoxFail").fadeOut(2000);
						},5000);
				}
			}
			else
			{
				jAlert(data['error'], 'Mensaje');	
			}
			if(itemsCatch[id]['cantidad']>1)
			{
				itemsCatch[id]['show'] = true;
				itemsCatch[id]['cantidad']=itemsCatch[id]['cantidad']-1;
				$("#cantid"+id).text(itemsCatch[id]['cantidad']+" ");
				showItemList();
			}
			atr_update(data['newstats']);
				var desc="";
				var enchant="";
				id= itemSearch(data["itemIdRe"]);
				itemsCatch[id]['enchant']=data['enchantCount'];
				
			if(itemsCatch[id]['enchant']>0)
						enchant=" +"+itemsCatch[id]['enchant'];
					else
						enchant="";	
			desc=makeDesc(itemsCatch[id],"<br>");
			title= itemsCatch[id]['Nombre']+enchant+"|<div class=ComunDesc>Atributos:<br>"+desc+"</div>";
			 setInfo= "newInfo";	
			if(itemsCatch[id]['armorset']>0)
			{
				 idItemTrue = itemsCatch[id]['armorset'];
				  title+= "<div class=ComunDescSet><div class=SetName>Set "+itemsCatch[id]['Nombre']+"</div><div class=raidDrop>Requiere:<br>"+descArmor[idItemTrue]['req']+"</div>";
				title+= "<div>Bonus:<br>"+descArmor[idItemTrue]['desc']+"</div></div>";
			}
					
			if(itemsCatch[id]['tipo']=="W")
			{
				if(data['manoDerecha'])
				{
					thereIsDerW=1;
					$("#slot_shield").text("");		
					$("#slot_shield").append("<a href='javascript:quitarItem("+id+");'><img border='0' src='images/item/"+itemsCatch[id]['subtipo']+"/"+itemsCatch[id]['imagen']+"' title='"+title+"' class='"+setInfo+"' width='35' height='35' /></a>");	
				}
				else
				{
					$("#slot_W").text("");		
					$("#slot_W").append("<a href='javascript:quitarItem("+id+");'><img border='0' src='images/item/"+itemsCatch[id]['subtipo']+"/"+itemsCatch[id]['imagen']+"' title='"+title+"' class='"+setInfo+"' width='35' height='35' /></a>");	
				}
				if(itemsCatch[id]['hand']==2)
				{
					$("#slot_shield").text("");
					$("#slot_shield").append("<img class='selectedImg' src='images/item/"+itemsCatch[id]['subtipo']+"/"+itemsCatch[id]['imagen']+"' width='35' height='35' />");
				}
			}
			else
			{
				$("#slot_"+itemsCatch[id]['tipo']).text("");
				$("#slot_"+itemsCatch[id]['tipo']).append("<a href='javascript:quitarItem("+id+");'><img border='0' src='images/item/"+itemsCatch[id]['subtipo']+"/"+itemsCatch[id]['imagen']+"' title='"+title+"' class='"+setInfo+"' width='35' height='35' /></a>");	
			}
			$('.newInfo').cluetip({splitTitle: '|',delayedClose: 0,cursor:'pointer'});
			showItemList();
			
		}
		else
		{


			switch(data['itemTipo'])
			{
				case 'stone':
					id= itemSearch(data["itemIdRe"]);
					itemsCatch[id]['cantidad']=data['Cantidad'];

					itemOptionsSh(id);

					if(data['updateAttr'])
					{
						reloadInventory();
						atr_update();
					}
					jAlert(data['error'], 'Error');	
					showItemList();
				break;
				default:
					if(data['updateAttr'])
					{
						reloadInventory();
						atr_update();
						closeOptionUi();
					}
					else
						itemsCatch[id]['show'] = true;


					jAlert(data['error'], 'Error');	
					showItemList();
				break;
			}
			
		}
	}
	else
	{
		if(data['someMsg'])
			jAlert(data['msg'], 'Mensaje');	

		atr_update(data['newstats']);
		itemsCatch[id]['show'] = false;
		var setInfo="";
		var title="";
		var idItemTrue=0;
		$("#"+id).hide();
		//openClosedSlots(itemsCatch[id]['tipo']);
		
		if(data['auraCheck'])
		{
			var p=0;
			while(data.aura[p])
			{
				addAura(data.aura[p]['idSkill'],data.aura[p]['lvl'],0,1);
				p++;
			}
		}
		if(itemsCatch[id]['manoDerecha']==1)
		{
			
		}
		var desc="";
		var enchant="";
		if(itemsCatch[id]['enchant']>0)
					enchant=" +"+itemsCatch[id]['enchant'];
				else
					enchant="";	
		desc=makeDesc(itemsCatch[id],"<br>");
		title= itemsCatch[id]['Nombre']+enchant+"|<div class=ComunDesc>Atributos:<br>"+desc+"</div>";
		 setInfo= "newInfo";	
		if(itemsCatch[id]['armorset']>0)
		{
			 idItemTrue = itemsCatch[id]['armorset'];
			  title+= "<div class=ComunDescSet><div class=SetName>Set "+itemsCatch[id]['Nombre']+"</div><div class=raidDrop>Requiere:<br>"+descArmor[idItemTrue]['req']+"</div>";
			title+= "<div>Bonus:<br>"+descArmor[idItemTrue]['desc']+"</div></div>";
		}
		if(itemsCatch[id]['tipo']=="W")
		{
			if(data['manoDerecha'])
			{
				thereIsDerW=1;
				$("#slot_shield").text("");		
				$("#slot_shield").append("<a href='javascript:quitarItem("+id+");'><img border='0' src='images/item/"+itemsCatch[id]['subtipo']+"/"+itemsCatch[id]['imagen']+"' title='"+title+"' class='"+setInfo+"' width='35' height='35' /></a>");	
			}
			else
			{
				$("#slot_W").text("");		
				$("#slot_W").append("<a href='javascript:quitarItem("+id+");'><img border='0' src='images/item/"+itemsCatch[id]['subtipo']+"/"+itemsCatch[id]['imagen']+"' title='"+title+"' class='"+setInfo+"' width='35' height='35' /></a>");	
			}
			if(itemsCatch[id]['hand']==2)
			{
				$("#slot_shield").text("");
				$("#slot_shield").append("<img class='selectedImg' src='images/item/"+itemsCatch[id]['subtipo']+"/"+itemsCatch[id]['imagen']+"' width='35' height='35' />");
			}
		}
		else
		{
			$("#slot_"+itemsCatch[id]['tipo']).text("");
			$("#slot_"+itemsCatch[id]['tipo']).append("<a href='javascript:quitarItem("+id+");'><img border='0' src='images/item/"+itemsCatch[id]['subtipo']+"/"+itemsCatch[id]['imagen']+"' title='"+title+"' class='"+setInfo+"' width='35' height='35' /></a>");	
		}
		
		$('.newInfo').cluetip({splitTitle: '|',delayedClose: 0,cursor:'pointer'});
		showItemList();
	}
}
function itemDestructor(id,mano=0)
{

	if(itemsCatch[id]['subtipo']=="pot")
	{
		doIdInventario=id;
		$("#pocionTitle").text("Pocion: "+itemsCatch[id]['Nombre']);
		$("#ItemPotionsInv").show();
	}
	else
	if(itemsCatch[id]['subtipo']=="currency")
	{
		let curr=false;
		let currName="";
		let currImg="";
		switch(parseInt(itemsCatch[id]['idItem']))
		{
			case 614:
				curr=true;
				currName="Chaos";
				currImg="caos";
			break;
			case 616:
				curr=true;
				currName="Exodimo";
				currImg="newstat";
			break;
			case 617:
				curr=true;
				currName="Alquimist";
				currImg="convertion";
			break;
			case 618:
				curr=true;
				currName="Corruption";
				currImg="corrupted";
			break;
			case 615:
			doIdInventario=id;
				doUsar();
			break;
		}

		if(curr)
		{
			doIdInventario=id;
			$("#op_arma").show();
			$("#DoSelected").val('W');
			$("#ItemSelectorInv").show();
			$("#ItemSelectTitle").text("Usar: "+currName);
			$("#ItemSelectTitle").append('<br><img src="images/item/currency/'+currImg+'.png" />');
		}
		else
			jAlert("Item inusable!", 'Error');	
	}
	else
	if(itemsCatch[id]['subtipo']=="enchantA")
	{
		enchantSelected = id;
		$("#ItemEnchantInv").show();
		$("#ItemEnchantTitle").text("Elegi la parte que queres mejorar:");
	}
	else
	if(itemsCatch[id]['subtipo']=="enchantW")
	{

		switch(mano)
		{
			case 0:
				txtw="Quieres mejorar el arma que estas usando?";
			break;
			case 1:
				txtw="Quieres mejorar el arma izquierda?";
			break;
			case 2:
				txtw="Quieres mejorar el arma derecha?";
			break;
		}


		jConfirm(txtw, 'Enchant Item', function(r) {
					if(r)
					{
						itemsCatch[id]['show'] = false;
					showItemList();
			$.ajax({
					data: "id="+itemsCatch[id]['idInventario']+"&action=poner&mano="+mano,
					type: "GET",
					dataType: "json",
					url: "json/quipeItem.php",
					success: function(data){
					getItem(data,id);
				}
				});
					}
		});
	}
	else if(itemsCatch[id]['subtipo']=="stone")
	{
		
			jPrompt("Cuantas piedras queres tiarle al arma?", '1', 'Piedras de Elemento', function(q) {
			if( q ) 
			{
				//alert("id="+itemsCatch[id]['idInventario']+"&action=poner&mano="+mano+"&cantidadStones="+q);
				if(itemsCatch[id]['cantidad']>=q)
				{
					$.ajax({
						data: "id="+itemsCatch[id]['idInventario']+"&action=poner&mano="+mano+"&cantidadStones="+q,
						type: "GET",
						dataType: "json",
						url: "json/quipeItem.php",
						success: function(data){
						getItem(data,id);
					}
					});
				}
				else
					jAlert('No tienes suficientes piedras!');
			}
			});


	
	}
	else
	{
		itemsCatch[id]['show'] = false;
		showItemList();
		//alert("json/quipeItem.php?id="+itemsCatch[id]['idInventario']+"&action=poner");
			$.ajax({
					data: "id="+itemsCatch[id]['idInventario']+"&action=poner&mano="+mano,
					type: "GET",
					dataType: "json",
					url: "json/quipeItem.php",
					success: function(data){
					getItem(data,id);
				}
				});
				closeOptionUi();		
	}
}

function itemSearch(idSr)
{
	var i=0;
	while(itemsCatch[i])
			{
				if(itemsCatch[i]['idInventario']==idSr)
				{
					return i;
					break;
				}
				i++;
			}
}
function quitarItemStarted(idSr)
{
	var id;
	id = itemSearch(idSr);
	itemsCatch[id]['usadoPor']=0;
	quitarItem(id);
}
/*function openClosedSlots(tipo)
{
	slotMaster[tipo]=(slotMaster[tipo]==true)?(false):(true);
}*/
function sacarItem(data,id)
{
	if(data['error']!=0)
	{
		jAlert(data['error'], 'Error');	
		itemsCatch[id]['show'] = false;
		itemsCatch[id]['usadoPor'] = 1;
		$("#"+id).hide();
		showItemList();
	}
	else
	{
		if(data['manoDerecha']==1)
		{
			$("#slot_shield").text("");
			thereIsDerW=0;
		}
		else
			$("#slot_"+itemsCatch[id]['tipo']).text("");

		 $(document).trigger('hideCluetip');
		$("#slot_"+itemsCatch[id]['tipo']).append("<img src='images/blank.gif' width='35' height='35' />");
		if(data['auraCheck'])
		{
			var p=0;
			while(data.aura[p])
			{
				CANTIDAD_AURAS--;
				aurasSearcherAndDestroy(data.aura[p]['idSkill']);
				p++;
			}
			var x=0;
			
		}
		atr_update(data['newstats']);
	}		
}
function quitarItem(id)
{
	itemsCatch[id]['show'] = true;
	itemsCatch[id]['usadoPor'] = 0;
	$("#"+id).fadeIn();
	$.ajax({
				data: "id="+itemsCatch[id]['idInventario']+"&action=sacar",
				type: "GET",
				dataType: "json",
				url: "json/quipeItem.php",
				success: function(data){
				sacarItem(data,id);
			}
			});
	showItemList();
	if(itemsCatch[id]['manoDerecha'] && armaIzquierda)
	{
		itemsCatch[id]['hand']=1;
	}
	/*if(itemsCatch[id]['hand']==2)
	{
		$("#slot_shield").text("");
		$("#slot_shield").append("<img src='images/blank.gif' width='35' height='35' />");
	}*/
}
function borrarItem(data,id)
{
	if(data['error']!=0)
		jAlert(data['error'], 'Error');	
	else
	{
		itemsCatch[id]['show'] = false;
		showItemList();
		refreshChat();
		closeOptionUi();
		jAlert('Item Roto!');
	}
}
function regalarItem(data,id)
{
	if(data['error']!=0)
		jAlert(data['error'], 'Error');	
	else
	{
		if(itemsCatch[id]['contable']==0)
		{
			itemsCatch[id]['show'] = false;
			showItemList();
		}
		else
			checkItems();	
		jAlert('Item regalado satisfactoriamente!');
	}
}
function regalar(id)
{
	if(itemsCatch[id]['contable']==1)
	{
		jPrompt('Cuantos items queres enviar?', '', 'Gift '+itemsCatch[id]['Nombre'], function(q) {
		if( q ) 
		{
			jPrompt('A quien le vas a dar estos items?', '', 'Regalar '+itemsCatch[id]['Nombre'], function(r) {
			if( r ) 
			{
			$.ajax({
							data: "id="+itemsCatch[id]['idInventario']+"&action=regalar&tal="+r+"&cant="+q,
							type: "GET",
							dataType: "json",
							url: "json/quipeItem.php",
							success: function(data){
							regalarItem(data,id);
						}
						});
			}
		});
		}
		});
	}
	else
	{
	jPrompt('A quien le vas a dar este item?', '', 'Regalar '+itemsCatch[id]['Nombre'], function(r) {
		if( r ) 
		{
			$.ajax({
							data: "id="+itemsCatch[id]['idInventario']+"&action=regalar&tal="+r,
							type: "GET",
							dataType: "json",
							url: "json/quipeItem.php",
							success: function(data){
							regalarItem(data,id);
						}
						});
		}
		});
	}
}
function regalarOroResponce(data)
{
	if(data['error'])
		jAlert(data['error'], 'Error');	
}
function regalarOro()
{
		jPrompt('cuanto oro quieres enviar?', '', 'Regalar oro', function(q) {
		if( q ) 
		{
			jPrompt('A quien le vas a dar este oro?', '', 'Regalar oro', function(r) {
			if( r ) 
			{
						$.ajax({
							data: "tal="+r+"&cant="+q,
							type: "GET",
							dataType: "json",
							url: "json/regalarGold.php",
							success: function(data){
							regalarOroResponce(data);
						}
						});
			}
		});
		}
		});
	
}
function borrar(id)
{
	jConfirm('Estas seguro de romper '+itemsCatch[id]['Nombre']+'?\n este item le dara un Craft del grado que corresponda.', 'ROMPER ITEM', function(r) {
				if(r)
				{
					$.ajax({
						data: "id="+itemsCatch[id]['idInventario']+"&action=borrar",
						type: "GET",
						dataType: "json",
						url: "json/quipeItem.php",
						success: function(data){
						borrarItem(data,id);
					}
					});
				}
	});
}
function atr_update(statsNew=false)
{
	if(statsNew)
	{
		statsGonnaChange();
		destroyArmor();
		if(statsNew['someSet'])
		{
			var i=1;
			while(statsNew['SET_UP'][i])
			{
				if(statsNew['SET_UP'][i]['valid'])
					setArmor(statsNew['SET_UP'][i]['id'],statsNew['SET_UP'][i]['nombre'],statsNew['SET_UP'][i]['img']);
				i++;
			}
		}
		if(statsNew['nameWeapon']==1)
			$("#nombreArma").show(500);
		else
			$("#nombreArma").hide(500);
		$("#atr_VidaLimit").text("Vida: "+statsNew['VidaLimit']);
		$("#atr_ManaLimit").text("Mana: "+statsNew['ManaLimit']);
		$("#atr_Ataque").text("Ataque: "+statsNew['Ataque']);
		$("#atr_AtaqueMagico").text("Ataque Magico: "+statsNew['AtaqueMagico']);
		$("#atr_Defensa").text("Defensa: "+statsNew['Defensa']);
		$("#atr_DefensaMagica").text("Defensa Magica: "+statsNew['DefensaMagica']);
		$("#atr_Critico").text("Critico: "+statsNew['Critico']+"%");
		$("#atr_PC").text("PC: "+statsNew['PC']+"%");
		$("#atr_CriticoMagico").text("Critico Magico: "+statsNew['CriticoMagico']+"%");
		$("#atr_PCMagico").text("PCM: "+statsNew['PCMagico']+"%");
		$("#atr_atkSpeed").text("Vel. de Ataque: "+statsNew['PSpeed']+"seg");
		$("#atr_castSpeed").text("Vel. de Casteo: "+statsNew['CSpeed']+"seg");
		
		$("#atr_hpRegen").text("Reg Vida: "+statsNew['HpRegen']);
		$("#atr_mpRegen").text("Reg Mana: "+statsNew['MpRegen']);
		
		$("#atr_elemento").text("Elemento: "+statsNew['elemAttack']);
		$("#atr_elementodmg").text("Daño elemental: "+statsNew['elemDmg']);
		
		$("#atr_baseDps").text("Item Power: "+statsNew['baseDPS']);
		
		
		$("#atr_Evasion").text("Evasion Chance: "+statsNew['evasion']+"%");
		
		$("#atr_ResFire").text("Res Fire: "+statsNew['ResFire']+"%("+statsNew['ResFireFull']+"%)");
		$("#atr_ResWater").text("Res Water: "+statsNew['ResWater']+"%("+statsNew['ResWaterFull']+"%)");
		$("#atr_ResEarth").text("Res Earth: "+statsNew['ResEarth']+"%("+statsNew['ResEarthFull']+"%)");
		$("#atr_ResWind").text("Res Wind: "+statsNew['ResWind']+"%("+statsNew['ResWindFull']+"%)");
		$("#atr_ResDark").text("Res Dark: "+statsNew['ResDark']+"%("+statsNew['ResDarkFull']+"%)");
		$("#atr_ResHoly").text("Res Holy: "+statsNew['ResHoly']+"%("+statsNew['ResHolyFull']+"%)");

		if(statsNew['VidaLimit']<stats['Vida'])
			stats['Vida']=statsNew['VidaLimit'];
		userVida=stats['Vida'];
		userVidaLimit=statsNew['VidaLimit'];
		userVidaUpdate();
		if(statsNew['ManaLimit']<stats['Mana'])
			stats['Mana']=statsNew['ManaLimit'];
		userMana=stats['Mana'];
		userManaLimit=statsNew['ManaLimit'];
		userManaUpdate();
	}
	else
	{
		$.ajax({
			data: "",
			type: "GET",
			dataType: "json",
			url: "json/getMyStats.php",
			success: function(data){
				atr_update(data);
		}
		});
	}
}
function venderItem(data,id)
{
	if(data['error']!=0)
		jAlert(data['error'], 'Error');	
	else
	{
		//itemsCatch[id]['show'] = false;
		$( "#objContent"+id ).removeClass("itemObjOPEN");
		$( "#objContent"+id ).addClass("itemObjSALE");
		jAlert(itemsCatch[id]['Nombre']+" esta en venta!", 'Item en venta');
		showItemList();
		itemsCatch[id]['enVenta']=1;
		hoverItems();
		refreshChat();
		closeOptionUi();
		I_ventasCount++;
		closeVentaWin();
	}
}
function venderItemReal(data,id)
{
	if(data['error']!=0)
		jAlert(data['error'], 'Error');	
	else
	{
		jAlert("Item Vendido!", 'Venta');
		goldChange(data['gold']);
		itemsCatch[id]['show'] = false;
		showItemList();
		refreshChat();
		closeOptionUi();
	}
}
function cancelarItem(data,id)
{
	if(data['error']!=0)
		jAlert(data['error'], 'Error');	
	else
	{
		$( "#objContent"+id ).removeClass("itemObjSALE");
		$( "#objContent"+id ).addClass("itemObjOPEN");
		itemsCatch[id]['enVenta']=0;
		hoverItems();
		refreshChat();
		closeOptionUi();
		I_ventasCount--;
	}
}
function vender(id,tipo)
{
	if(tipo==1 && itemsCatch[id]['contable']==0)
	{
		var precio=(itemsCatch[id]['grado']*50)
		jConfirm('quiere vender '+itemsCatch[id]['Nombre']+' a '+precio+' de oro?', 'Vender item', function(r) {
					if(r)
					{
						$.ajax({
							data: "id="+itemsCatch[id]['idInventario']+"&action=venderReal",
							type: "GET",
							dataType: "json",
							url: "json/quipeItem.php",
							success: function(data){
							venderItemReal(data,id);
						}
						});
					}
		});
	}
	else
	{
		
		if(itemsCatch[id]['enVenta']==0)
		{
			let cuantosVenta=1;	
			$("#ventaMoneda").val(0);
			$("#ventaCant").val(1);
			$("#VentaCantidadui").hide();	
			if(itemsCatch[id]['contable']==1)
			{
				$("#VentaCantidadui").show();	
				$("#ventaPrecioTExt").text("Precio c/u:");
			}
			else
			{
				$("#ventaPrecioTExt").text("Precio:");
			}
			$("#ventaLimiteitor").text('Limite: '+I_ventasCount+'/'+I_ventasLimit)
			$("#VentaTitleI").text('Vender '+itemsCatch[id]['Nombre']);
			idVentaSelect=id;
			$("#VentaDeItem").show();	

		}
		else
		{
				jConfirm('Quieres cancelar la venta de '+itemsCatch[id]['Nombre']+' ?', 'Cancelar venta', function(r) {
					if(r)
					{
						$.ajax({
							data: "id="+itemsCatch[id]['idInventario']+"&action=cancelar",
							type: "GET",
							dataType: "json",
							url: "json/quipeItem.php",
							success: function(data){
							cancelarItem(data,id);
						}
						});
					}
		});
		}
	}
}
$(document).ready(function(){			
	checkItems();

   $( "#slot_armor" ).droppable({
			accept: "div.item_img",
			drop: function( event, ui ) {
				if(itemsCatch[ui.draggable.attr('id')]['tipo']=="armor")
				{
					itemDestructor(ui.draggable.attr('id'));
				}
			}
		});
	$( "#slot_W" ).droppable({
			accept: "div.item_img",
			drop: function( event, ui ) {
				if(itemsCatch[ui.draggable.attr('id')]['tipo']=="W")
				{
					itemDestructor(ui.draggable.attr('id'));
				}
			}
		});	
	$( "#slot_foots" ).droppable({
			accept: "div.item_img",
			drop: function( event, ui ) {
				if(itemsCatch[ui.draggable.attr('id')]['tipo']=="foots")
				{
					itemDestructor(ui.draggable.attr('id'));
				}
			}
		});	
	$( "#slot_rings" ).droppable({
			accept: "div.item_img",
			drop: function( event, ui ) {
				if(itemsCatch[ui.draggable.attr('id')]['tipo']=="rings")
				{
					itemDestructor(ui.draggable.attr('id'));
				}
			}
		});		
	$( "#slot_shield" ).droppable({
			accept: "div.item_img",
			drop: function( event, ui ) {
				if(itemsCatch[ui.draggable.attr('id')]['tipo']=="shield")
				{
					itemDestructor(ui.draggable.attr('id'));
				}
			}
		});	
	$( "#slot_gloves" ).droppable({
			accept: "div.item_img",
			drop: function( event, ui ) {
				if(itemsCatch[ui.draggable.attr('id')]['tipo']=="gloves")
				{
					itemDestructor(ui.draggable.attr('id'));
				}
			}
		});		
	$( "#slot_head" ).droppable({
			accept: "div.item_img",
			drop: function( event, ui ) {
				if(itemsCatch[ui.draggable.attr('id')]['tipo']=="head")
				{
					itemDestructor(ui.draggable.attr('id'));
				}
			}
		});		
	$( "#slot_necklace" ).droppable({
			accept: "div.item_img",
			drop: function( event, ui ) {
				if(itemsCatch[ui.draggable.attr('id')]['tipo']=="necklace")
				{
					itemDestructor(ui.draggable.attr('id'));
				}
			}
		});	
});
reloadInventory=()=>{
	checkItems();
}
//NEW STAFF
closeOptionUi = ()=>{
	$("#showOptionsObj").hide();	
}
itemOpMakeUi = (name,script)=>{
	return "<div class='menuItem' onclick='javascript:"+script+";' alt='"+name+"' title='"+name+"'>"+name+"</div>";
}
itemOptionsSh = (id)=>{
	let itemArr = itemsCatch[id];
	let cantidad=0;
	let enchant="";
	let cant_show="";
	let title="";
	$("#IshowIDetail").text("");
	$("#IshowIOptions").text("");
				let itemOptions="";
				if((1==itemArr['hand'] && canEquipeHands && itemArr['tipo']=="W") || (itemArr['subtipo']=="enchantW" || itemArr['subtipo']=="stone") && thereIsDerW==1 )
					itemOptions=itemOpMakeUi("Usar en Izquierda","itemDestructor("+id+",1)")+itemOpMakeUi("Usar en Derecha ","itemDestructor("+id+",2)");	
				else
					itemOptions=itemOpMakeUi("Usar ","itemDestructor("+id+")");	
				let itemOptions2="";
				if(itemArr['enchant']>0)
					enchant=" +"+itemArr['enchant'];
				else
					enchant="";	
				
				 title= "<div class=ComunDesc>Atributos:<br>"+makeDesc(itemArr,"<br>")+"</div>";
				 
				if(itemArr['armorset']>0)
				{
					 idItemTrue = itemArr['armorset'];
					 title+= "<div class=ComunDescSet><div class=SetName>Set "+itemArr['Nombre']+"</div><div class=raidDrop>Requiere:<br>"+descArmor[idItemTrue]['req']+"</div>";
					 title+= "<div>Bonus:<br>"+descArmor[idItemTrue]['desc']+"</div></div>";
				}
				cantidad=itemArr['cantidad'];
				if(cantidad>1)
					cant_show=cantidad+" ";
				else
					cant_show="";
				if(itemArr['intradeable']==0)
					itemOptions2+=itemOpMakeUi("Regalar","regalar("+id+")"); 
				
				if(itemArr['tipo']!="runa" && itemArr['grado']<=2 && itemArr['contable']==0)
					itemOptions+=itemOpMakeUi("Vender a "+(itemArr['grado']*50),"vender("+id+",1)");
				else
				 {
					if(itemArr['enVenta']==0)
						itemOptions+=itemOpMakeUi(" Vender ","vender("+id+",2)");
					else
					itemOptions+=itemOpMakeUi("Cancelar Venta","vender("+id+",2)");
				 }
				if(itemArr['grado']>=3)
					   itemOptions+=itemOpMakeUi("Romper ","borrar("+id+")");
			
			itemOptions2+=itemOpMakeUi("Mostrar en chat","mostrarEnChat("+itemArr['idInventario']+","+'"'+itemArr['Nombre']+enchant+'"'+")"); 
				 
			$("#IshowIDetail").append('<div class="IItemName" >'+cant_show+itemArr['Nombre']+enchant+'<br><img src="images/item/'+itemArr['subtipo']+"/"+itemArr['imagen']+'" /></div>'+
										'<div>'+title+'</div>');
			$("#IshowIOptions").append('<div class="Iopciones">'+itemOptions+'</div>');						
			$("#IshowIOptions").append('<div class="Iopciones">'+itemOptions2+'</div>');		
			$("#showOptionsObj").show("slow");	
}

// VENTA CV
closeVentaWin = ()=>{
	$("#VentaDeItem").hide();
	$("#VentaCantidadui").hide();

}
doVenta = ()=>{
	let id= idVentaSelect;
	let precio = $("#ventaPrecio").val();
	let cant = $("#ventaCant").val();
	let moneda = $("#ventaMoneda").val();
	$.ajax({
		data: "id="+itemsCatch[id]['idInventario']+"&action=vender&price="+precio+"&cantidad="+cant+"&moneda="+moneda,
		type: "GET",
		dataType: "json",
		url: "json/quipeItem.php",
		success: function(data){
		venderItem(data,id);
	}
	});
}

// DOING SHIT
closeDo =()=>{
	$("#ItemSelectorInv").hide();
	$("#ItemEnchantInv").hide();
	$("#ItemPotionsInv").hide();
}
doEnchant=()=>{
	enchantor();
}
doUsar=()=>{

		let id=doIdInventario;
		//alert("json/quipeItem.php?id="+itemsCatch[id]['idInventario']+"&action=currency&focus="+$("#DoSelected").val());
		$.ajax({
			data: "id="+itemsCatch[id]['idInventario']+"&action=currency&focus="+$("#DoSelected").val(),
			type: "GET",
			dataType: "json",
			url: "json/quipeItem.php",
			success: function(data){
			doUsarDone(data,id);
		}
		});
	
}	
doUsarDone=(data,id)=>{
	jAlert(data['error'],"Item info!");
	reloadInventory();
	atr_update();
	closeDo();
	closeOptionUi();
}

showLimpieza=()=>{
	$("#INVlimpiarSelector").show("slow");

}
limpiezaDone=()=>{
	checkItems();
	refreshChat();
	closeCST("INVlimpiarSelector");
}
doLimpieza=()=>{
	var legWar="";
	var legOn=0;
	if($('#destruirLeg:checked').val()==1)
	{
		legWar=" Incluyendo todas las Legendarias";
		legOn=1;
	}
	
	jConfirm('Estas seguro de eliminar todos los items del grado seleccionado'+legWar+'?', 'ELIMINAR ITEMS', function(r) {
		if(r)
		{
			$.ajax({
				data: "grado="+$("#LimpiezaItms").val()+"&leg="+legOn,
				type: "GET",
				dataType: "json",
				url: "json/limpieza.php",
				success: function(){
				limpiezaDone();
			}
			});
		}
});
}
closeCST=(elem)=>{
	$("#"+elem).hide();
}

cleanPotNames = (newName)=>{
	for(let i=0;i<6;i++)
	{
		if($("#pot_sel_"+i).text()==newName)
			{
				$("#pot_sel_"+i).text("Espacio vacio");
			}
	}
}
potionEquiped = ()=>{
	reloadInventory();
}
potionReseterDone=()=>{
	for(let i=0;i<6;i++)
	{
		$("#pot_sel_"+i).text("Espacio vacio");
	}
	reloadInventory();
}
doResetPot = ()=>{
	$.ajax({
		data: "",
		type: "GET",
		url: "json/potReseter.php",
		success: function(data){
			potionReseterDone();
		}
	});
	closeDo();
	closeOptionUi();
}
doEquiparPot = ()=>{
	let id = doIdInventario;
	let select = $("#potionPosition").val();
	let name = itemsCatch[id]['Nombre'];
	cleanPotNames(name);
	$("#pot_sel_"+select).text(name);
	$.ajax({
		data: "id="+itemsCatch[id]['idInventario']+"&slot="+select,
		type: "GET",
		url: "json/equiparPot.php",
		success: function(data){
			potionEquiped();
		}
	});
	closeDo();
	closeOptionUi();
}