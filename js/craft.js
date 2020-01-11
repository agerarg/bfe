function itemlist(data) {
		//$("#error").text(data['error']);
if(!data['error'])
{
		itemsCatch = data.litem;
		var i=0;
		var desc="";
		var setInfo="";
		var title="";
		$("#questBar").text("");
		if(itemsCatch)
		while(itemsCatch[i])
			{
				var desc="";
				
				
				desc=makeDesc(itemsCatch[i],"<br>");
				setInfo= "setInfo";	
				 title= itemsCatch[i]['Nombre']+"|<div class=ComunDesc>Atributos:<br>"+desc+"</div>";
				if(itemsCatch[i]['armorset']>0)
				{
					 idItemTrue = itemsCatch[i]['armorset'];	
					 title+= "<div class=ComunDescSet><div class=SetName>Set "+itemsCatch[i]['Nombre']+"</div><div class=raidDrop>Requiere:<br>"+descArmor[idItemTrue]['req']+"</div>";
					 title+= "<div>Bonus:<br>"+descArmor[idItemTrue]['desc']+"</div></div>";
				}
				
				$("#questBar").append("<div id='objContent"+i+"' class='questBar'><div title='"+title+"' class='"+setInfo+" monstListImg'><img src='images/item/"+itemsCatch[i]['subtipo']+"/"+itemsCatch[i]['imagen']+"' /></div><div class='craftListName'><a href='javascript:verCraft("+itemsCatch[i]['idCraft']+");'>"+itemsCatch[i]['Nombre']+"</a></div><div >Costo: "+itemsCatch[i]['cost']+" de oro<br />Tipo: "+itemsCatch[i]['subtipo']+" / Lvl: "+itemsCatch[i]['Nivel']+"</div></div></div>");
				
				
				itemsCatch[i]['show'] = true;
				i++;
				
			}
			$('.monstListImg').cluetip({splitTitle: '|',delayedClose: 0});
		showItemList();
}
else
{
$("#questBar").text(data['error']);
}
}	
function calculoPaginas()
{
	var cant_pags;
	var x;
	$("#item_paginacion").text("");
	cant_pags= ((cantidadItems-2) / 10);
	cant_pags = parseInt(cant_pags);
	if(cantidadItems<=11)
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
	var hasta = 10;
	
	if(pagina==0)
	{
		desde = 0;
	}
	else
	{
		hasta = (pagina+1)*10;
		desde = (pagina)*10+1;
	}
	if(itemsCatch)
			while(itemsCatch[i])
			{
				if(itemsCatch[i]['show'] && (filtroTxt=='todo' || filtroTxt==itemsCatch[i]['tipo'] || filtroTxt=='misc'))
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
function filtro(que)
{
	filtroTxt=que;
	pagina=0;
	showItemList();
}
function volverLista()
{
	$("#overallList").fadeIn(1000);
	$("#verCraftLoco").hide();
}
function checkItems()
	{
			$("#questBar").append("<img src='images/477.gif' />");
		$.ajax({
			data: "runz="+runz+"&grade="+gradoOverall,
			type: "GET",
			dataType: "json",
			url: "json/craftList.php",
			success: function(data){
			itemlist(data);
		}
		});
	}
function resultCrear(data)
{
	$("#verCraftLoco").hide();
	$("#LoadingCraft").show();
	setTimeout(function() {
     if(data['creado']==1)
		{
			jAlert(selectedName+" fue creado!", 'Creando '+selectedName);
			goldChange(data['gold']);

			if(data['masterWork']==1)
			{
			    var mostrarItemId=data['itemID'];
				var msg = "Obra Maestra";
				socket.emit('chatMsg', {"party": 0,"charimage": charimage, "usuario": userNombre, "msg": msg, "odin": true, "item": mostrarItemId,"itemName": selectedName});
			
				$.ajax({
									data: {party: 0,charimage:charimage, name: userNombre, msg: msg, item: mostrarItemId, itemName: selectedName, odin: 1  },
									type: "POST",
									dataType: "json",
									url: "json/newChatSend.php"
								});
			}

			refreshChat();
		}
		else
		{
 if(data['customError'])
jAlert($data['error'], 'ERROR');
else
			jAlert("No tienes los items necesarios!", 'Creando '+selectedName);
		}
		 $("#LoadingCraft" ).fadeOut(2000, function() {
			$("#verCraftLoco").fadeIn(1000);
	  });
}, 2000);
}
function crearItem(id)
{
	jConfirm('Estas seguro de crear '+selectedName+'? Esto va borrar todos los items de la lsita', 'Crear item', function(r) {
				if(r)
				{
					//alert("id="+id+"&mundo="+mundoOverall+"&runz="+runz+"&grade="+gradoOverall);
					$.ajax({
						data: "id="+id+"&mundo="+mundoOverall+"&runz="+runz+"&grade="+gradoOverall,
						type: "GET",
						dataType: "json",
						url: "json/craftCrear.php",
						success: function(data){
						resultCrear(data);
					}
					});
				}
			});
}
function showCraftItem(data,id)
{
	$("#verCraftLoco").hide();
	$("#verCraftLoco").text("");
	$("#verCraftLoco").append("<div align='center'><a href='javascript:volverLista()'>Volver a la lista</a></div>");
	
	$("#verCraftLoco").append("<div class='monstFill'><div><img src='images/item/"+data['IMG']+"' /></div><div>"+data['NOMBRE']+"</div><div class='costo'>Costo de creacion: "+data['COSTO']+" oro</div></div>");
	
	
	$("#verCraftLoco").append("Requiere los siguientes items:");
		var i=0;
		var desc="";
		var setInfo="";
		var title="";
		var itemsReq = new Array();
		itemsReq = data.litem;
		while(itemsReq[i])
			{
				$("#verCraftLoco").append("<div class='questBar'><div class='monstListImg'><img src='images/item/"+itemsReq[i]['subtipo']+"/"+itemsReq[i]['imagen']+"'/></div><div class='craftListName'>"+itemsReq[i]['nombre']+"<br /></div><div >Cantidad: "+itemsReq[i]['cantidad']+"<br />Posees: "+itemsReq[i]['HAVE']+"</div></div>  ");
				i++;
			}
		selectedName=data['NOMBRE'];
	$("#verCraftLoco").append("<div class='crearButton' align='center'><input onclick='crearItem("+id+")' value='Crear "+data['NOMBRE']+"'  type='submit'></div>");		
	$("#verCraftLoco").fadeIn(1000);
}
function verCraft(id)
	{
		$("#overallList").hide();
		$("#verCraftLoco").text("");
		$("#verCraftLoco").append("<img src='images/477.gif' />");
		$("#verCraftLoco").fadeIn(1000);
		$.ajax({
			data: "id="+id+"&mundo="+mundoOverall+"&runz="+runz+"&grade="+gradoOverall,
			type: "GET",
			dataType: "json",
			url: "json/craftVer.php",
			success: function(data){
			showCraftItem(data,id);
		}
		});
	}