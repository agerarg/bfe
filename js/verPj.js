var armaIzquierda=0;
const itemsPorPagina=45;
var runaIndex=1;
var limiteRunasCt=0;
var runeSlot=["open","open","open","open","open"];
var runeType=[0,0,0,0,0];
var itemsCatchRuna={};
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
		let openRune = checkRunesSlots();
		let title="";
		title= itemsCatchRuna[i]['Nombre']+"|<div class=ComunDesc>Atributos:<br>"+makeDesc(itemsCatchRuna[i],"<br>")+"</div>";
		$("#runa_"+openRune).text("");
		$("#runa_"+openRune).append("<div><div title='"+title+"' class='item_img' id='runa"+i+"'><img src='images/item/"+itemsCatchRuna[i]['subtipo']+"/"+itemsCatchRuna[i]['imagen']+"' /></div></div>");
		runeSlot[(openRune-1)]="close";
		runeType[(openRune-1)]=itemsCatchRuna[i]['idItem'];
		runaIndex++;
		itemsCatchRuna[i]['usadoPor']=1;
}

function itemlistrunar(data) {
		$("#error").text(data['error']);
		itemsCatchRuna = data.litem;
		var i=0;
		var desc="";
		var setInfo="";
		var title="";
		var idItemTrue=0;
		var itemOptions="";
var romper ="";
		$("#item_list").text("");
		
		while(itemsCatchRuna[i])
			{
				var fondoparaitem =(itemsCatchRuna[i]['enVenta']==0 && itemsCatchRuna[i]['trade']==0)?("itemObjOPEN"):("itemObjSALE");
				var cantidad = itemsCatchRuna[i]['cantidad'];
				var cant_show="";
				var saleTx="";
				var regalar="";
				setInfo= "setInfo";	
				
				
				if(cantidad>1)
					cant_show=cantidad+" ";
				else
				cant_show="";
				 title= cant_show+itemsCatchRuna[i]['Nombre']+"|<div class=ComunDesc>Atributos:<br>"+makeDesc(itemsCatchRuna[i],"<br>")+"</div>";
				 
				if(itemsCatchRuna[i]['armorset']>0)
				{
					 idItemTrue = itemsCatchRuna[i]['armorset'];
					 title+= "<div class=ComunDescSet><div class=SetName>Set "+itemsCatchRuna[i]['Nombre']+"</div><div class=raidDrop>Requiere:<br>"+descArmor[idItemTrue]['req']+"</div>";
					 title+= "<div>Bonus:<br>"+descArmor[idItemTrue]['desc']+"</div></div>";
				}
				
				//$("#item_list").append("<div class='itemObj "+fondoparaitem+"' id='objContent"+i+"'><a href='javascript:itemOptionsSh("+i+");'><div title='"+title+"' class='item_img "+setInfo+"' id='"+i+"'><img src='images/item/"+itemsCatchRuna[i]['subtipo']+"/"+itemsCatchRuna[i]['imagen']+"' /></div></a></div>");

				runaUsada(i);

				i++;
			}
		$('.item_img').cluetip({splitTitle: '|',delayedClose: 0});
}	

function checkRunas()
	{
		$.ajax({
			data: "id="+idPjMirando,
			type: "GET",
			dataType: "json",
			url: "json/verPjRunas.php",
			success: function(data){
				itemlistrunar(data);
		}
		});
	}
$(document).ready(function(){			
	checkRunas();
});
itemOptionsSh = (id)=>{
	runaUsada(id);
}