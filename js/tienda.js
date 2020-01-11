function itemlist(data) {
		$("#error").text(data['error']);
		itemsCatch = data.litem;
		var i=0;
		var desc="";
		var setInfo="";
		var title="";
		$("#item_list_tienda").text("");
		while(itemsCatch[i])
			{
				var desc="";
				
				
				setInfo= "setInfo";	
				 title= itemsCatch[i]['Nombre']+"|<div class=ComunDesc>Atributos:<br>"+makeDesc(itemsCatch[i],"<br>")+"</div>";
				if(itemsCatch[i]['armorset']>0)
				{
					 idItemTrue = itemsCatch[i]['armorset'];	
					 title+= "<div class=ComunDescSet><div class=SetName>Set "+itemsCatch[i]['Nombre']+"</div><div class=raidDrop>Requires:<br>"+descArmor[idItemTrue]['req']+"</div>";
					 title+= "<div>Bonus:<br>"+descArmor[idItemTrue]['desc']+"</div></div>";
				}
				
				$("#item_list_tienda").append("<div class='itemObj itemObjOPEN' id='objContent"+i+"'><div title='"+title+"' class='"+setInfo+" item_img' id='"+i+"'><img src='images/item/"+itemsCatch[i]['subtipo']+"/"+itemsCatch[i]['imagen']+"' /></div><div class='item_nombre'>"+itemsCatch[i]['Nombre']+"<br><spam class='miniLett'>Cost "+itemsCatch[i]['precio']+" Oro</spam> <a href='javascript:comprarItem("+i+");' alt='Comprar' title='Comprar'><img border='0' src='images/item_sale.png' width='16' height='16' /></a></div><div class='item_mains'><div class='item_desc'>"+makeDesc(itemsCatch[i]," ")+"</div></div></div>");
				itemsCatch[i]['show'] = true;
				i++;
				
			}
			$('.setInfo').cluetip({splitTitle: '|',delayedClose: 0});
			$('.itemObjOPEN').hover( function(){
				 $(this).css("background-image", "url(images/itemfond3.png)");
			},
			function(){
				 $(this).css("background-image", "url(images/itemfond.png)");
			});
		showItemList();
}	
function calculoPaginas()
{
	var cant_pags;
	var x;
	$("#item_paginacion").text("");
	cant_pags= ((cantidadItems-2) / 8);
	cant_pags = parseInt(cant_pags);
	if(cantidadItems<=9)
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
	var hasta = 8;
	
	if(pagina==0)
	{
		desde = 0;
	}
	else
	{
		hasta = (pagina+1)*8;
		desde = (pagina)*8+1;
	}
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
function checkItems()
	{
		$.ajax({
			data: "",
			type: "GET",
			dataType: "json",
			url: "json/tienda.php",
			success: function(data){
			itemlist(data);
		}
		});
	}
function comprarItemOK(data,id)
{
	if(data['error']!=0)
		jAlert(data['error'], 'Error');	
	else
	{
		showItemList();
		jAlert('Item comprado!');
		goldChange(data['gold']);
	}
}
function comprarItem(id)
	{
		if(itemsCatch[id]['contable']==0)
		{
			jConfirm('Quieres comprar '+itemsCatch[id]['Nombre']+' ?', 'Comprar item', function(r) {
					if(r)
					{
							$.ajax({
								data: "id="+itemsCatch[id]['idTienda']+"&boludo="+partBoludo,
								type: "GET",
								dataType: "json",
								url: "json/comprarItemTienda.php",
								success: function(data){
								comprarItemOK(data,id);
							}
							});
					}
				});
		}
		else
		{
			jPrompt("Cantidad:", "1", "Cuantos "+itemsCatch[id]['Nombre']+" quieres comprar?",   function(r) {  
				if(r)
				{
					var want=parseInt(r);
						jConfirm('Quieres comprar '+r+' '+itemsCatch[id]['Nombre']+' por '+(itemsCatch[id]['precio']*r)+' de oro?', 'Comprar item', function(q)				 						{ 
							if(q)
							{
								$.ajax({
								data: "id="+itemsCatch[id]['idTienda']+"&cantidad="+want,
								type: "GET",
								dataType: "json",
								url: "json/comprarItemTienda.php",
								success: function(data){
								comprarItemOK(data,id);
							}
							});
							}
						});
				}
			});
		}
	}