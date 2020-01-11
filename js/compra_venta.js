const CV_itemShowLimit=72;
function itemlist(data) {
		$("#error").text(data['error']);
		itemsCatch = data.litem;
		var i=0;
		var desc="";
		var setInfo="";
		var title="";
		var idItemTrue=0;
		$("#item_list_CV").text("");
		while(itemsCatch[i])
			{
				var desc="";
				var enchant="";
				setInfo= "setInfo";	
				
				if(itemsCatch[i]['enchant']>0)
					enchant=" +"+itemsCatch[i]['enchant'];
				else
					enchant="";	
				
				if(itemsCatch[i]['SA']==1)
				itemsCatch[i]['Nombre']	= "<spam class=SAname>"+itemsCatch[i]['Nombre']+"</spam>";
				
				let cantidad = itemsCatch[i]['cantidadVenta'];
				let cant_show = "";
				let cu_show="";
				if(cantidad>1)
				{
					cant_show=cantidad+" ";	 
					cu_show=" c/u ";
				}
				let precio="";
				switch(parseInt(itemsCatch[i]['idCurrency']))
				{
					case 618:	
						precio='Precio:'+itemsCatch[i]['precio']+' Corruption <img width="25px" height="25px;" src="images/item/currency/corrupted.png" /> '+cu_show;
					break;
					case 617:	
						precio='Precio:'+itemsCatch[i]['precio']+' Alquimist <img width="25px" height="25px;" src="images/item/currency/convertion.png" /> '+cu_show;
					break;
					case 616:	
						precio='Precio:'+itemsCatch[i]['precio']+' Exodimo <img width="25px" height="25px;" src="images/item/currency/newstat.png" /> '+cu_show;
					break;
					case 615:	
						precio='Precio:'+itemsCatch[i]['precio']+' Upulus <img width="25px" height="25px;" src="images/item/currency/point.png" /> '+cu_show;
					break;
					case 614:	
						precio='Precio:'+itemsCatch[i]['precio']+' Chaos <img width="25px" height="25px;" src="images/item/currency/caos.png" /> '+cu_show;
					break;
					case 613:	
						precio='Precio:'+itemsCatch[i]['precio']+' ReRoll <img width="25px" height="25px;" src="images/item/currency/roll.png" /> '+cu_show;
					break;
					default:
						precio="Precio:"+itemsCatch[i]['precio']+" de oro"+cu_show;
					break;
				}

				 title= "<div>"+cant_show+itemsCatch[i]['Nombre']+"</div><div class=CVinnPr>"+precio+"</div>|<div class=ComunDesc>Atributos:<br>"+makeDesc(itemsCatch[i],"<br>")+"</div>";
				if(itemsCatch[i]['armorset']>0)
				{
					 idItemTrue = itemsCatch[i]['armorset'];	
					 title+= "<div class=ComunDescSet><div class=SetName>Set "+itemsCatch[i]['Nombre']+"</div><div class=raidDrop>Require:<br>"+descArmor[idItemTrue]['req']+"</div>";
					 title+= "<div>Bonus:<br>"+descArmor[idItemTrue]['desc']+"</div></div>";
				}
				//Runa fix
				if(itemsCatch[i]['tipo']==="runa")
					itemsCatch[i]['grado']=itemsCatch[i]['extraLevel'];				
				$("#item_list_CV").append("<div class='itemObj itemObjOPEN' id='objContent"+i+"'><div class='item_img "+setInfo+"' title='"+title+"' id='"+i+"'><a href='javascript:itemOptionsSh("+i+");'><img src='images/item/"+itemsCatch[i]['subtipo']+"/"+itemsCatch[i]['imagen']+"' /></a></div></div>");

				//$("#item_list").append("<div class='itemObj itemObjOPEN' id='objContent"+i+"'><div class='item_img "+setInfo+"' title='"+title+"' id='"+i+"'><img src='images/item/"+itemsCatch[i]['subtipo']+"/"+itemsCatch[i]['imagen']+"' /></div><div class='item_nombre'>"+cant_show+itemsCatch[i]['Nombre']+enchant+"<br><spam class='miniLett'>Por "+itemsCatch[i]['precio']+" Polvos Astrales</spam> <a href='javascript:comprarItem("+i+");' alt='Buy' title='Comprar'><img border='0' src='images/item_sale.png' width='16' height='16' /></a></div><div class='item_mains'><div class='item_desc'>"+makeDesc(itemsCatch[i]," ")+"</div></div></div>");
				itemsCatch[i]['show'] = true;
				i++;
			}
			$('.setInfo').cluetip({splitTitle: '|',delayedClose: 0});
		showItemList();
}	
function calculoPaginas()
{
	var cant_pags;
	var x;
	$("#item_paginacion").text("");
	cant_pags= ((cantidadItems-2) / CV_itemShowLimit);
	cant_pags = parseInt(cant_pags);
	if(cantidadItems<=(CV_itemShowLimit+1))
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
	var hasta = CV_itemShowLimit;
	
	if(pagina==0)
	{
		desde = 0;
	}
	else
	{
		hasta = (pagina+1)*CV_itemShowLimit;
		desde = (pagina)*CV_itemShowLimit+1;
	}
			let gradoSrc = "";
			if(gradoFilter>0 || gradoFilter==itemsCatch[i]['grado'])
				gradoSrc=" de "+gradoFText;
			$("#buscandoCV").text("Buscando: "+filtroTxt+gradoSrc);
		
			while(itemsCatch[i])
			{
				if((gradoFilter==0 || gradoFilter==itemsCatch[i]['grado']) && itemsCatch[i]['show'] && (filtroTxt=='todo' || filtroTxt==itemsCatch[i]['tipo'] || filtroTxt=='misc'))
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
function filtro(que)
{
	filtroTxt=que;
	toPagina(0);
}
function checkItems()
	{
		$.ajax({
			data: "",
			type: "GET",
			dataType: "json",
			url: "json/compraVenta.php",
			success: function(data){
			itemlist(data);
		}
		});
	}
function comprarItemOK(data,id,cant)
{
	if(data['error']!=0)
		jAlert(data['error'], 'Error');	
	else
	{
		if((itemsCatch[id]['cantidad']-cant)<=0)
			itemsCatch[id]['show'] = false;
		else
			itemsCatch[id]['cantidad']=itemsCatch[id]['cantidad']-cant;
			
		checkItems();
		jAlert('Item Comprado!');
		closeOptionUi();
	}
}
function comprarItem(id)
	{
		if(itemsCatch[id]['cantidad']>1)
		{
			jPrompt("Cantidad:", "1", "Cuantos "+itemsCatch[id]['Nombre']+" desea comprar?",   function(r) {  
				if(r)
				{
					var want=parseInt(r);
					if(want<=itemsCatch[id]['cantidad'] && want>0)
					{
						jConfirm('Desea comprar '+r+' '+itemsCatch[id]['Nombre']+' por '+(itemsCatch[id]['Rprecio']*r)+' de oro ?', 'Comprar Item', function(q)				 						{ 
							if(q)
							{
								$.ajax({
								data: "id="+itemsCatch[id]['idInventario']+"&cantidad="+want,
								type: "GET",
								dataType: "json",
								url: "json/comprarItem.php",
								success: function(data){
								comprarItemOK(data,id,want);
							}
							});
							}
						});
					}
					  else
						jAlert('Error: Numero incorrecto!');
				}
			});
		}
		else
		{
			jConfirm('Desea comprar '+itemsCatch[id]['Nombre']+' ?', 'Comprar item', function(r) {
					if(r)
					{					
						$.ajax({
							data: "id="+itemsCatch[id]['idInventario'],
							type: "GET",
							dataType: "json",
							url: "json/comprarItem.php",
							success: function(data){
							comprarItemOK(data,id,1);
						}
						});
					}
				});
		}
	}

$(document).ready(function(){						   
	setTimeout ('checkItems()', 1);
	$('#grados').change(function() {
		gradoFilter=$('#grados').val();
		gradoFText=$('#grados option:selected').text();
		checkItems();
	});
});

closeOptionUi = ()=>{
	$("#showOptionsObj").hide();	
}
itemOpMakeUi = (name,script)=>{
	return "<div class='menuItem' onclick='javascript:"+script+";' alt='"+name+"' title='"+name+"'>"+name+"</div>";
}
itemOptionsSh = (id)=>{
	let itemArr = itemsCatch[id];
	let enchant="";
	$("#IshowIDetail").text("");
	$("#IshowIOptions").text("");
	let cantidad = itemArr['cantidadVenta'];
	let cant_show = "";
	let cu_show="";
	if(cantidad>1)
	{
		cant_show=cantidad+" ";	 
		cu_show=" c/u ";
	}
		let itemOptions="";
		let coinName="";
			switch(parseInt(itemArr['idCurrency']))
			{
				case 613:
					coinName=" ReRoll";
				break;
				case 614:
					coinName=" Chaos";
				break;
				case 615:
					coinName=" Upulus";
				break;
				case 616:
					coinName=" Exodimo";
				break;
				case 617:
					coinName=" Alquimist";
				break;
				case 618:
					coinName=" Corruption";
				break;
			}

	            if(itemArr['idCurrency']==0)
					itemOptions='<div class="CV_precio" >Precio: '+itemArr['precio']+" de oro"+cu_show+'</div>';
				else
					itemOptions='<div class="CV_precio" >Precio: '+itemArr['precio']+coinName+cu_show+'</div>';

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
				
				if(cantidad>1)
					cant_show=cantidad+" ";
				

			itemOptions+='<div class="CV_ComprarBtn">'+itemOpMakeUi("Comprar ","comprarItem("+id+")")+'</div>';	
			$("#IshowIDetail").append('<div class="IItemName" >'+cant_show+itemArr['Nombre']+enchant+'<br><img src="images/item/'+itemArr['subtipo']+"/"+itemArr['imagen']+'" /></div>'+
										'<div>'+title+'</div>');
			$("#IshowIOptions").append('<div class="Iopciones">'+itemOptions+'</div>');						

			$("#showOptionsObj").show("slow");	
}