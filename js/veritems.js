var defaultTier=0;
function dontCareFinish(data)
{
	location.href='index.php?sec=inventario';
}
function showTier(tier)
{
	defaultTier=tier;
	checkItems()
}
function quest(id)
{
		$.ajax({
			data: "",
			type: "GET",
			dataType: "json",
			url: "json/dontCare.php?id="+itemsCatch[id]['idItem'],
			success: function(data){
			dontCareFinish(data);
		}
		});
}
function itemlist(data) {
		$("#error").text(data['error']);
		itemsCatch = data.litem;
		var i=0;
		var desc="";
		var setInfo="";
		var title="";
		var idItemTrue=0;
		$("#item_list").text("");
		while(itemsCatch[i])
			{
				var desc="";
				var enchant="";
				var quest="";
				setInfo= "setInfo";	
				
				if(itemsCatch[i]['enchant']>0)
					enchant=" +"+itemsCatch[i]['enchant'];
				else
					enchant="";	
				
				if(itemsCatch[i]['SA']==1)
				itemsCatch[i]['Nombre']	= "<spam class=SAname>"+itemsCatch[i]['Nombre']+"</spam>";
				
				 title= itemsCatch[i]['Nombre']+"|<div class=ComunDesc>Atributos:<br>"+makeDesc(itemsCatch[i],"<br>")+"</div>";
				if(itemsCatch[i]['armorset']>0)
				{
					 idItemTrue = itemsCatch[i]['armorset'];	
					 title+= "<div class=ComunDescSet><div class=SetName>Set "+itemsCatch[i]['Nombre']+"</div><div class=raidDrop>Require:<br>"+descArmor[idItemTrue]['req']+"</div>";
					 title+= "<div>Bonus:<br>"+descArmor[idItemTrue]['desc']+"</div></div>";
				}
				
				var cantidad = itemsCatch[i]['cantidad'];
				var cant_show = "";
				if(cantidad>1)
				cant_show=cantidad+" ";	 
				if(questOn && itemsCatch[i]['tier']==0)
					quest="<br><a href='javascript:quest("+i+");'>Elegir este item</a>";
				else
					quest="";

				$("#item_list").append("<div class='itemObj itemObjOPEN' id='objContent"+i+"'><div class='item_img "+setInfo+"' title='"+title+"' id='"+i+"'><img src='images/item/"+itemsCatch[i]['subtipo']+"/"+itemsCatch[i]['imagen']+"' /></div><div class='item_nombre'>"+cant_show+itemsCatch[i]['Nombre']+enchant+quest+"</div><div class='item_mains'><div class='item_desc'>"+makeDesc(itemsCatch[i]," ")+"</div></div></div>");
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
	cant_pags= ((cantidadItems-2) / 11);
	cant_pags = parseInt(cant_pags);
	if(cantidadItems<=12)
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
	var hasta = 11;
	
	if(pagina==0)
	{
		desde = 0;
	}
	else
	{
		hasta = (pagina+1)*11;
		desde = (pagina)*11+1;
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
	toPagina(0);
}
function checkItems()
	{
		$.ajax({
			data: "",
			type: "GET",
			dataType: "json",
			url: "json/veritems.php?tier="+defaultTier,
			success: function(data){
			itemlist(data);
		}
		});
	}

$(document).ready(function(){						   
	setTimeout ('checkItems()', 1);

});