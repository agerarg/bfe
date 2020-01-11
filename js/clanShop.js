comprarItemOK = (data)=>{
	if(data['error'])
	{
		jAlert('Error: '+data['error']+"!");
	}
	else
	{
		jAlert('Caja comprada!');
		$("#myHonor").text("Honor en clan: "+data['currHonor'])
	}
}
comprarMaterial = (id)=>{
	item1Imp
	var name="";
	switch(id)
	{
		case 1:
		name="Raid Key";
		break;
	}
	var cantidad = $("#item1Imp").val();
	jConfirm('Deseas comprar '+cantidad+' '+name+'?', 'Material de Clan', function(r) {
				if(r)
				{
					$.ajax({
						data: "material=1&id="+id+"&cantidad="+cantidad,
						type: "GET",
						dataType: "json",
						url: "json/clanShopComprar.php",
						success: function(data){
						comprarItemOK(data);
					}
					});
				}
		});
}
comprarCaja = (tier,level)=>{
	jConfirm('Deseas comprar esta caja nivel '+(tier+7)+'?', 'Cajas de Clan', function(r) {
				if(r)
				{
					$.ajax({
						data: "tier="+tier+"&level="+level,
						type: "GET",
						dataType: "json",
						url: "json/clanShopComprar.php",
						success: function(data){
						comprarItemOK(data);
					}
					});
				}
		});
}

showClanBox = (tier)=>{
	$("#boxesInClan").text("");
	let price = 0;
	let Name="";
	switch(tier)
	{
		case 1:
			price = 2;
			Name= "Nivel 8: (Grado S)";
		break;
		case 2:
			price = 5;
			Name= "Nivel 9: (Grado X)";
		break;
		case 3:
			price = 10;
			Name= "Nivel 10: (Grado Y)";
		break;
		case 4:
			price = 1;
			Name= "Materiales";
		break;
	}
	if(tier==4)
	{
		$("#boxesInClan").append('<div class="boxClanStorMat">'+
		'<div class=""><img width="20%" src="images/boxes/raidkey.png"></div>'+
		'<div class=""> Raid Key Costo: 1 de honor  </div>'+
		'<div class=""> Cantidad <input id="item1Imp" class="clanDInputer" value="1" type="text" name="item1Imp"> <button onClick="comprarMaterial(1)" class="chatEnvio">Comprar</button> </div>'+
	  '</div>');
	}else
	for(let i=1;i<=3;i++)
	{
		$("#boxesInClan").append('<div onClick="comprarCaja('+tier+','+i+')" class="boxClanStor">'+
		'<div class="boxClanImg"><img width="35%" src="images/boxes/tier'+i+'_close.png"></div>'+
		'<div class="boxClanGrad"> '+Name+' Costo: '+parseInt(price*i)+' de honor</div>'+
	  '</div>');
	}
}

$( document ).ready(function() {
    showClanBox(4);
});