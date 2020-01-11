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
				setInfo= "setInfo";	
				var cantiMat="";
				itemsCatch[i]['enTrade'] = false;
					
				if(itemsCatch[i]['intradeable']==0 && itemsCatch[i]['usadoPor']==0 && itemsCatch[i]['enVenta']==0 )	
				itemsCatch[i]['show'] = true;
				else
				itemsCatch[i]['show'] = false;
				
				if(itemsCatch[i]['enchant']>0)
					enchant=" +"+itemsCatch[i]['enchant'];
				else
					enchant="";	
				
				if(itemsCatch[i]['SA']==1)
				itemsCatch[i]['Nombre']	= "<spam class=SAname>"+itemsCatch[i]['Nombre']+"</spam>";
				if(itemsCatch[i]['contable']==1)
			   	{
					cantiMat = itemsCatch[i]['cantidadTrade'];	
				}
				 title= " "+itemsCatch[i]['Nombre']+enchant+"|<div class=ComunDesc>Atributos:<br>"+makeDesc(itemsCatch[i],"<br>")+"</div>";
				 
				if(itemsCatch[i]['armorset']>0)
				{
					 idItemTrue = itemsCatch[i]['armorset'];
					 title+= "<div class=ComunDescSet><div class=SetName>Set "+itemsCatch[i]['Nombre']+"</div><div class=raidDrop>Requiere:<br>"+descArmor[idItemTrue]['req']+"</div>";
					 title+= "<div>Bonus:<br>"+descArmor[idItemTrue]['desc']+"</div></div>";
				}
				
				if(cantidad>1)
					cant_show=cantidad+" ";
				
				$("#item_list").append("<div class='itemObj "+fondoparaitem+"' id='objContent"+i+"'><div title='"+title+"' class='item_img "+setInfo+"' id='"+i+"'><img src='images/item/"+itemsCatch[i]['subtipo']+"/"+itemsCatch[i]['imagen']+"' /></div><div class='item_nombre'><spam id='cantid"+i+"'>"+cant_show+"</spam>"+itemsCatch[i]['Nombre']+enchant+"<br><a alt='Use' title='Use' href='javascript:itemDestructor("+i+");'><img border='0' src='images/item_usar.png' width='16' height='16' /></a></div><div class='item_mains'><div class='item_desc'>"+makeDesc(itemsCatch[i]," ")+"</div></div></div>");
				
				$("#myitems").append("<div class='tradeableItem GTFO' title='"+title+"' id='traden"+i+"'><div id='canti"+i+"' class=cantidadTrade>"+cantiMat+"</div><a href='javascript:quitarItem("+i+");'><img border='0' src='images/item/"+itemsCatch[i]['subtipo']+"/"+itemsCatch[i]['imagen']+"' width='35' height='35' /></a></div>");
				
				cant_show="";
				i++;
			}
		showItemList();
		$('.setInfo').cluetip({splitTitle: '|',delayedClose: 0});
		$('.tradeableItem').cluetip({splitTitle: '|',delayedClose: 0});
		$("div.item_img").draggable({ revert: true });
		hoverItems();
		itemsReady();
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
function otherItem(data)
{
		elOtroItemsCatch = data.litem;
		var i=0;
		if(data['close']==1)
		{
			jAlert("La transferencia de items ya fue realizada!", "Listo!",function(){
						window.location = "index.php?sec=inventario";
				});
		}
		else
		{
			$("#herGold").text(goldShowSet(data['oro']));
			$("#hisitems").text("");
				var i=0;
		var desc="";
		var setInfo="";
		var title="";
		var idItemTrue=0;
		var itemOptions="";
var romper ="";
			if(elOtroItemsCatch)
			{
				while(elOtroItemsCatch[i])
					{
						//$("#hisitems").append("<div class='tradeableItem' id='traden"+i+"'>'<a href='javascript:quitarItem("+i+");'><img border='0' src='images/item/"+elOtroItemsCatch[i]['imagen']+"' width='35' height='35' /></a></div>");
					
						if(elOtroItemsCatch[i]['enchant']>0)
					enchant=" +"+elOtroItemsCatch[i]['enchant'];
				else
					enchant="";	
				var cantiMat="";
				if(elOtroItemsCatch[i]['contable']==1)
			   	{
					cantiMat = elOtroItemsCatch[i]['cantidadTrade'];	
				}
				if(itemsCatch[i]['SA']==1)
				elOtroItemsCatch[i]['Nombre']	= "<spam class=SAname>"+elOtroItemsCatch[i]['Nombre']+"</spam>";
					
				 title= elOtroItemsCatch[i]['Nombre']+enchant+"|<div class=ComunDesc>Atributos:<br>"+makeDesc(elOtroItemsCatch[i],"<br>")+"</div>";
				 
				if(elOtroItemsCatch[i]['armorset']>0)
				{
					 idItemTrue = elOtroItemsCatch[i]['armorset'];
					 title+= "<div class=ComunDescSet><div class=SetName>Set "+elOtroItemsCatch[i]['Nombre']+"</div><div class=raidDrop>Requiere:<br>"+descArmor[idItemTrue]['req']+"</div>";
					 title+= "<div>Bonus:<br>"+descArmor[idItemTrue]['desc']+"</div></div>";
				}
				
				$("#hisitems").append("<div onclic='javascript:quitarItem("+i+")' title='"+title+"' class='delOtro item_img "+setInfo+"' id='"+i+"'><div class=cantidadTrade>"+cantiMat+"</div><img src='images/item/"+elOtroItemsCatch[i]['subtipo']+"/"+elOtroItemsCatch[i]['imagen']+"' /></div>");
					
					
						i++;
					}
					$('.delOtro').cluetip({splitTitle: '|',delayedClose: 0});
			}
			if(data['estado']==1&&estadoTrade==1)
			{
					estadoTrade=2;
					crearBoton();
			}
			if(data['estado']==2&&estadoTrade==1)
			{
				estadoTrade=3;
					crearBoton();
			}
		}
}
function checkOtherItems()
{
	$.ajax({
			data: "",
			type: "GET",
			dataType: "json",
			url: "json/trade_other.php",
			success: function(data){
			otherItem(data);
		}
		});
	setTimeout(function() {
      checkOtherItems();
}, 5000);	
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
	$("#tusItems").text("Tus ítems: "+(cantidadItems-1)+"/200");
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
	if(itemsCatch)
	{
			while(itemsCatch[i])
			{
				if(itemsCatch[i]['show'] && itemsCatch[i]['trade']==0)
				{
					if(desde <= n && hasta >= n )
						$("#objContent"+i).show(500);
					else
						$("#objContent"+i).hide();	
						
					n++;
				}
				else
					$("#objContent"+i).hide();	
				i++;
			}
	}
			cantidadItems = n;
			calculoPaginas();
			crearBoton();
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

function addMyItems(id)
{
	cantidadTrade++;
	var rlid=itemSearch(id);
	$("#traden"+rlid).fadeIn(500);
	//$("#"+rlid).hide(500);
}
function getItem(id)
{
	if(estadoTrade==0)
	{
		if(itemsCatch[id]['contable']==1)
		{
			jPrompt('cuantos items quiere tradear?', '', 'TRADE CANTIDADES', function(q) {
			if( q ) 
			{
				q=parseInt(q);
				if(q<=itemsCatch[id]['cantidad'] && q>0)
				{
					itemsCatch[id]['show'] = false;
			        itemsCatch[id]['cantidadTrade'] = q;
					itemsCatch[id]['enTrade'] = true;
					$("#canti"+id).text(q);
					cantidadTrade++;
					$("#"+id).hide();
					
					$("#traden"+id).fadeIn(500);
									
					/*test*/	
					showItemList();
				}
				else
				 jAlert("Cantidad incorrecta", 'Error');	
			}
			});
		}
		else
		{
			itemsCatch[id]['show'] = false;
			
			itemsCatch[id]['enTrade'] = true;
			
			cantidadTrade++;
			$("#"+id).hide();
			
			$("#traden"+id).fadeIn(500);
							
			/*test*/	
			showItemList();
		}
	}
	else
	{
		jAlert("Debe cancelar el trade para poder cambiar los items que ofrece", 'Error');	
	}
}
function itemDestructor(id)
{
	if(cantidadTrade<20)
	{
		getItem(id);
	}
	else
		jAlert("No se pueden poner mas items en trade", 'Error');	
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
function tradeRespon(data)
{
	if(data['error'])
		jAlert(data['error'], 'Error');
	else
	{
		jAlert('Listo! items enviados!', 'Trade');
	}

}
function enviarTrade()
{
	var todo="";
	var cuantis="";
	var i=0;
	if(itemsCatch)
	while(itemsCatch[i])
			{
				if(itemsCatch[i]['enTrade'])
				{
			  	  todo+=""+itemsCatch[i]['idInventario']+",";
				  cuantis+="&id"+itemsCatch[i]['idInventario']+"="+itemsCatch[i]['cantidadTrade'];
				}
				i++;
			}
			//$('#footer').text("json/rade.php?process="+todo+"&act=agregar&oro="+oroGuardado+cuantis);
	$.ajax({
			data: "process="+todo+"&act=agregar&oro="+oroGuardado+cuantis,
			type: "GET",
			dataType: "json",
			url: "json/trade.php",
			success: function(data){
			tradeRespon(data);
		}
		});
}
function quitarItem(id)
{
	if(estadoTrade==0)
	{
		itemsCatch[id]['show'] = true;
		$("#"+id).show();
		$("#traden"+id).fadeOut( 300);
		itemsCatch[id]['enTrade'] = false;
		cantidadTrade--;
		showItemList();
	}
	else
		jAlert("Debe cancelar el trade para poder cambiar los items que ofrece", 'Error');
}
function accionar()
{
	if(estadoTrade==0)
	{
		enviarTrade();
		estadoTrade=1;
		crearBoton();
	}
	else
		jAlert("Debe cancelar el trade para poder cambiar los items que ofrece", 'Error');
		
}
function tradeFin(data)
{
	if(data['error'])
		jAlert(data['error'], 'Error');
	else
	{
		estadoTrade=3;
		crearBoton();
		jAlert(data['info'], "Listo!",function(){
				if(data['close'])
				{
					window.location = "index.php?sec=inventario";
				}
			});
	}
}
function efectivoTrade()
{
	$('#footer').text("json/trade.php?act=comfirmar");
	$.ajax({
			data: "act=comfirmar",
			type: "GET",
			dataType: "json",
			url: "json/trade.php",
			success: function(data){
			tradeFin(data);
		}
		});
}
function crearBoton()
{
	$('#botonTrade').removeClass();
	switch(estadoTrade)
	{
		case 0:
			$('#botonTrade').click(function() {accionar();
			});
			$('#botonTrade').addClass("Tofertar");
		break;
		case 1:
			$('#botonTrade').click(function() {
			}).addClass("TofertarBlock");
		break;
		case 2:
			$('#botonTrade').click(function() {efectivoTrade();
			}).addClass("Taceptar");
		break;
		case 3:
			$('#botonTrade').click(function() {
			}).addClass("ToaceptarBlock");
		break;
	}
	$('#botonTrade').hover(function() {
	$	(this).css('cursor','pointer');
	}, function() {
		$(this).css('cursor','auto');
	});

}
function goldTrader(g)
{
	if(estadoTrade==0)
	{
		g=parseInt(g);
		if(g>0)
		{
			if(g<1)
				jAlert('El monto de oro tiene que ser mayor a 1', 'Error');
			else if(g>userOro)
				jAlert('No tienes suficiente oro', 'Error');
			else
			{
				
				$("#myFkingGold").text(goldShowSet(g));
				
				oroGuardado=g;
			}
		}
	}
	else
		jAlert('Ya aceptaste enviar este oro, no se puede cambiar', 'Error');
}
function cancelarTradeSh(data)
{
	if(data['error'])
		jAlert(data['error'], 'Error');
	else
	{
		jAlert("Se ah cancelado la transferencia!", "Transferencia cancelada!",function(){
						window.location = "index.php?sec=inventario";
				});
	}
}
function cancelarTodo()
{
	$.ajax({
			data: "",
			type: "GET",
			dataType: "json",
			url: "json/tradeCancel.php",
			success: function(data){
			cancelarTradeSh(data);
		}
		});
}
$(document).ready(function(){						   
	checkItems();
	
   $( "#myitems" ).droppable({
			accept: "div.item_img",
			drop: function( event, ui ) {
					itemDestructor(ui.draggable.attr('id'));
			}
		});	
	$('#poniendoGuita').hover(function() {
	$	(this).css('cursor','pointer');
	}, function() {
		$(this).css('cursor','auto');
	});
	$('#botonCancel').click(function() {
		
		jConfirm('Esta seguro de cancelar la transferencia?', 'Cancelar Transferencia', function(r) {
    			if(r)
					cancelarTodo();});
		});
		
		
		
	$('#poniendoGuita').click(function() {
	if(estadoTrade==0)
	{
	jPrompt('cuanto oro desea transferir?', '0', 'Transferencia de oro', function(r) {
   				 goldTrader(r);
});}
	else
		jAlert('Ya aceptaste enviar este oro, no se puede cambiar', 'Error');
			});		
});