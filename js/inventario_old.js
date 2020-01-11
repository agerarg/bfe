var armaIzquierda=0;
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
				var mostrarItem="";
				setInfo= "setInfo";	
				
				if(itemsCatch[i]['enchant']>0)
					enchant=" +"+itemsCatch[i]['enchant'];
				else
					enchant="";	
				
				if(itemsCatch[i]['SA']==1)
				itemsCatch[i]['Nombre']	= "<spam class=SAname>"+itemsCatch[i]['Nombre']+"</spam>";
					
				 title= itemsCatch[i]['Nombre']+enchant+"|<div class=ComunDesc>"+makeDesc(itemsCatch[i],"<br>")+"</div>";
				 
				if(itemsCatch[i]['armorset']>0)
				{
					 idItemTrue = itemsCatch[i]['armorset'];
					 title+= "<div class=ComunDescSet><div class=SetName>Set "+itemsCatch[i]['Nombre']+"</div><div class=raidDrop>Requiere:<br>"+descArmor[idItemTrue]['req']+"</div>";
					 title+= "<div>Bonus:<br>"+descArmor[idItemTrue]['desc']+"</div></div>";
				}
				
				if(cantidad>1)
					cant_show=cantidad+" ";
				
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
				
				mostrarItem=" <a href='javascript:mostrarEnChat("+itemsCatch[i]['idInventario']+","+'"'+itemsCatch[i]['Nombre']+enchant+'"'+");' alt='Mostrar' title='Mostrar a otros jugadores'><img border='0' src='images/item_ojo.png' width='16' height='16' /></a> ";   

				$("#item_list").append("<div class='itemObj "+fondoparaitem+"' id='objContent"+i+"'><div title='"+title+"' class='item_img "+setInfo+"' id='"+i+"'><img src='images/item/"+itemsCatch[i]['subtipo']+"/"+itemsCatch[i]['imagen']+"' /></div><div class='item_nombre'><spam id='cantid"+i+"'>"+cant_show+"</spam>"+itemsCatch[i]['Nombre']+enchant+"<br><a alt='Use' title='Use' href='javascript:itemDestructor("+i+");'><img border='0' src='images/item_usar.png' width='16' height='16' /></a> "+itemOptions+regalar+mostrarItem+" </div><div class='item_mains'><div class='item_desc'>"+makeDesc(itemsCatch[i]," ")+"</div></div></div>");
				itemsCatch[i]['show'] = true;
				cant_show="";
				i++;
			}
		showItemList();
		$('.setInfo').cluetip({splitTitle: '|',delayedClose: 0});
		$("div.item_img").draggable({ revert: true });
		hoverItems();
		injertoTardio();
}	
function hoverItems()
{
	$('.itemObjOPEN').hover( function(){
				 $(this).css("background-image", "url(images/itemfond3.png)");
			},
			function(){
				 $(this).css("background-image", "url(images/itemfond.png)");
			});
	$('.itemObjSALE').hover( function(){
				 $(this).css("background-image", "url(images/itemfond4.png)");
			},
			function(){
				 $(this).css("background-image", "url(images/itemfond2.png)");
			});
}
function calculoPaginas()
{
	var cant_pags;
	var x;
	$("#item_paginacion").text("");
	cant_pags= ((cantidadItems-2) / 6);
	cant_pags = parseInt(cant_pags);
	if(cantidadItems<=7)
		$("#item_paginacion").text("");
	else
	{
		for (x=0;x<cant_pags+1;x++)
			$("#item_paginacion").append("<a href='javascript:toPagina("+(x)+");'><"+(x+1)+"></a> ");
	}
	if(filtroTxt=='todo')
		$("#tusItems").text("Mis items: "+(cantidadItems-1)+"/200");
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
	var hasta = 6;
	
	if(pagina==0)
	{
		desde = 0;
	}
	else
	{
		hasta = (pagina+1)*6;
		desde = (pagina)*6+1;
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
		title= itemsCatch[id]['Nombre']+enchant+"|<div class=ComunDesc>"+desc+"</div>";
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
// Enchantar armadura
var enchantSelected=0;
function enchantor()
{
	$("#enchantBoxChose").hide();
	$.ajax({
					data: "id="+itemsCatch[enchantSelected]['idInventario']+"&action=poner&parte="+$("#EnchantSector").val(),
					type: "GET",
					dataType: "json",
					url: "json/quipeItem.php",
					success: function(data){
					getItem(data,enchantSelected);
				}
				});
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
			
			title= itemsCatch[id]['Nombre']+enchant+"|<div class=ComunDesc>"+desc+"</div>";
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
				
			$("#slot_"+itemsCatch[id]['tipo']).text("");
			if(itemsCatch[id]['enchant']>0)
						enchant=" +"+itemsCatch[id]['enchant'];
					else
						enchant="";	
			desc=makeDesc(itemsCatch[id],"<br>");
			title= itemsCatch[id]['Nombre']+enchant+"|<div class=ComunDesc>"+desc+"</div>";
			 setInfo= "newInfo";	
			if(itemsCatch[id]['armorset']>0)
			{
				 idItemTrue = itemsCatch[id]['armorset'];
				  title+= "<div class=ComunDescSet><div class=SetName>Set "+itemsCatch[id]['Nombre']+"</div><div class=raidDrop>Requiere:<br>"+descArmor[idItemTrue]['req']+"</div>";
				title+= "<div>Bonus:<br>"+descArmor[idItemTrue]['desc']+"</div></div>";
			}
					
			$("#slot_"+itemsCatch[id]['tipo']).append("<a href='javascript:quitarItem("+id+");'><img border='0' src='images/item/"+itemsCatch[id]['subtipo']+"/"+itemsCatch[id]['imagen']+"' title='"+title+"' class='"+setInfo+"' width='35' height='35' /></a>");	
			if(itemsCatch[id]['hand']==2)
			{
				$("#slot_shield").text("");
				$("#slot_shield").append("<img class='selectedImg' src='images/item/"+itemsCatch[id]['subtipo']+"/"+itemsCatch[id]['imagen']+"' width='35' height='35' />");
			}
			$('.newInfo').cluetip({splitTitle: '|',delayedClose: 0,cursor:'pointer'});
			showItemList();
			
		}
		else
		{
			itemsCatch[id]['show'] = true;
			jAlert(data['error'], 'Error');	
			showItemList();
		}
	}
	else
	{
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
		if(data['manoIzquierda'])
		{
			itemsCatch[id]['tipo']="shield";
			itemsCatch[id]['hand']=1;
			armaIzquierda=1;
		}
		$("#slot_"+itemsCatch[id]['tipo']).text("");
		var desc="";
		var enchant="";
		if(itemsCatch[id]['enchant']>0)
					enchant=" +"+itemsCatch[id]['enchant'];
				else
					enchant="";	
		desc=makeDesc(itemsCatch[id],"<br>");
		title= itemsCatch[id]['Nombre']+enchant+"|<div class=ComunDesc>"+desc+"</div>";
		 setInfo= "newInfo";	
		if(itemsCatch[id]['armorset']>0)
		{
			 idItemTrue = itemsCatch[id]['armorset'];
			  title+= "<div class=ComunDescSet><div class=SetName>Set "+itemsCatch[id]['Nombre']+"</div><div class=raidDrop>Requiere:<br>"+descArmor[idItemTrue]['req']+"</div>";
			title+= "<div>Bonus:<br>"+descArmor[idItemTrue]['desc']+"</div></div>";
		}
				
		$("#slot_"+itemsCatch[id]['tipo']).append("<a href='javascript:quitarItem("+id+");'><img border='0' src='images/item/"+itemsCatch[id]['subtipo']+"/"+itemsCatch[id]['imagen']+"' title='"+title+"' class='"+setInfo+"' width='35' height='35' /></a>");	
		if(itemsCatch[id]['hand']==2)
		{
			$("#slot_shield").text("");
			$("#slot_shield").append("<img class='selectedImg' src='images/item/"+itemsCatch[id]['subtipo']+"/"+itemsCatch[id]['imagen']+"' width='35' height='35' />");
		}
		$('.newInfo').cluetip({splitTitle: '|',delayedClose: 0,cursor:'pointer'});
		showItemList();
	}
}
function itemDestructor(id)
{
	if(itemsCatch[id]['subtipo']=="enchantA")
	{
		enchantSelected = id;
		$("#enchantBoxChose").show();
	}
	else
	if(itemsCatch[id]['subtipo']=="enchantW")
	{
		jConfirm('Quieres mejorar el arma que estas usando?', 'Enchant Item', function(r) {
					if(r)
					{
						itemsCatch[id]['show'] = false;
					showItemList();
			$.ajax({
					data: "id="+itemsCatch[id]['idInventario']+"&action=poner",
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
	else
	{
		itemsCatch[id]['show'] = false;
		showItemList();
			$.ajax({
					data: "id="+itemsCatch[id]['idInventario']+"&action=poner",
					type: "GET",
					dataType: "json",
					url: "json/quipeItem.php",
					success: function(data){
					getItem(data,id);
				}
				});
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
		jAlert('Item given away!');
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
function atr_update(statsNew)
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
		$("#atr_VidaLimit").text("Vida: "+stats['Vida']+" / "+statsNew['VidaLimit']);
		$("#atr_ManaLimit").text("Mana: "+stats['Mana']+" / "+statsNew['ManaLimit']);
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
		jAlert(itemsCatch[id]['Nombre']+" esta en venta por "+data['precio']+" Polvos Astrales.", 'Item en venta');
		showItemList();
		itemsCatch[id]['enVenta']=1;
		hoverItems();
	}
}
function venderItemReal(data,id)
{
	if(data['error']!=0)
		jAlert(data['error'], 'Error');	
	else
	{
		//itemsCatch[id]['show'] = false;
		goldChange(data['gold']);
		itemsCatch[id]['show'] = false;
		showItemList();
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
		$( "#objContent"+id ).css("background-image", "url(images/itemfond.png)");
		hoverItems();
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
			jPrompt('Las ventas estan 5 minutos como minimo \n Cantidad de Polvos Astrales:', '2', 'Vender '+itemsCatch[id]['Nombre'], function(r) {
			if( r ) 
			{
				$.ajax({
								data: "id="+itemsCatch[id]['idInventario']+"&action=vender&price="+r,
								type: "GET",
								dataType: "json",
								url: "json/quipeItem.php",
								success: function(data){
								venderItem(data,id);
							}
							});
			}
			});
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
	atr_update();
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