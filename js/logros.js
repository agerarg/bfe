LogroShowMundo = (id)=>{
	let name="Descubriste el mapa ";
	id=parseInt(id);
	switch(id)
		{
			case 20:
				name+="Shika!<br> Desbloqueaste Recompensas y ReRoll Item (Más Opciones -> ReRoll Item)!";
			break;
			case 22:
				name+="Mazan y Slajim!<br> Desbloqueaste la Compra/Venta, puedes comprar y vender items de otros jugadores.";
			break;
			case 23:
				name+="Grock, Piwik y Castillo Maggot!<br> Desbloqueaste la Lista Clanes (Más Opciones -> Lista Clanes) puedes unirte a un clan o crearlo!";
			break;
			case 24:
				name+="Abandoned Rift y Moosh!<br> Desbloqueaste la Herreria (Más Opciones -> Herreria) puedes crear items!";
			break;
			case 25:
				name+="Atlans y Forgotten Ground!<br> Desbloqueaste la Runas (Más Opciones -> Runas) ahora podes usar runas!";
			break;
			case 26:
				name+="Morson y Kunkawa!<br> Desbloqueaste la Compra Auras (Más Opciones -> Compra Auras) ahora podes comprar auras locas!";
			break;
			case 27:
				name+="Nhim, Glaciar 1 y Castillo Embolia!<br> Desbloqueaste la Nombre de Arma (Más Opciones -> Nombre de Arma) ahora podes descubrir el nombre de tu arma!";
			break;
			case 30:
				name+="Glaciar 2!";
			break;
			case 31:
				name="Ice Temple y Lair of Cabrium!";
			break;
			case 32:
				name+="Enchanted Valley!";
			break;
			case 93:
				name+="Doom Temple!";
			break;
			case 94:
				name+="Dragon Valley, Void Rift y Castillo Tana!";
			break;
		}
		$("#LogroText").text("");
		$("#LogroText").append(name);
		$("#LogroButton").text("");
		$("#LogroButton").append('<div onclick="location.href='+"'index.php?sec=recompensas';"+'" class="menuItem">Aceptar</div>');
		$("#LogroShow").show("slow");
}