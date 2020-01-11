var auraErrorMsg = "";
loadNewAuras=(data)=>{
	if(data['error']==0)
	{
		goldChange(data['gold']);
		if(data['auraRowCheck'])
			{
				var i=0;
				while(data.aura[i])
				{
					addAura(data.aura[i]['idSkill'],data.aura[i]['lvl'],data.aura[i]['auraTimeOut'],data.aura[i]['pasive']);
					i++;
				}	
			}
		npcAura(3);
	}
	else
	{
		auraErrorMsg = data['error_msg'];
		npcAura(2);

	}
}
auraBufferAll=(all)=>{
	
	$.ajax({
					data: "all="+all,
					type: "GET",
					dataType: "json",
					url: "json/AuraAllBuff.php",
					success: function(data){
					loadNewAuras(data);
				}
				});
}

npcShow = (id)=>{
	switch(id){
		case 168: 
			$("#box").append('<div class="monster backingNpc" onclick="npcSwordon(0);" align="center" style="display: block;"><img src="images/npc/swordon.jpg" width="50" height="50"><br><div class="playerSlot">Swordon</div></div>');
			$("#box").append('<div class="monster backingNpc" onclick="npcMarkulion(0);" align="center" style="display: block;"><img src="images/npc/markulion.jpg" width="50" height="50"><br><div class="playerSlot">Markulion</div></div>');
			$("#box").append('<div class="monster backingNpc" onclick="npcEnanoide(0);" align="center" style="display: block;"><img src="images/npc/enanoide.jpg" width="50" height="50"><br><div class="playerSlot">Enanoide</div></div>');
		break;
		case 169: 
			$("#box").append('<div class="monster backingNpc" onclick="npcAura(0);" align="center" style="display: block;"><img src="images/npc/aura.jpg" width="50" height="50"><br><div class="playerSlot">Aura</div></div>');
			$("#box").append('<div class="monster backingNpc" onclick="npcGarkalon(0);" align="center" style="display: block;"><img src="images/npc/garkalon.jpg" width="50" height="50"><br><div class="playerSlot">Garkalon</div></div>');
			$("#box").append('<div class="monster backingNpc" onclick="npcZepp(0);" align="center" style="display: block;"><img src="images/npc/zepp.jpg" width="50" height="50"><br><div class="playerSlot">Zepp</div></div>');
		break;

	}
}

npcClose = ()=>{
	$("#npcPlayGround").hide("slow");
}

npcMakeOption=(text,funct,target)=>{
	return '<div class="menuItemNpc" onclick="'+funct+'('+target+')">'+text+'</div>';
}
npcGoTo = (to)=>{
	switch(to)
	{
		case 0:
			location.href="index.php?sec=paragon";
		break;
		case 1:
			location.href="index.php?sec=arma";
		break;
		case 2:
			location.href="index.php?sec=craft&clan=1";
		break;
		case 3:
			location.href="index.php?sec=ReRoll";
		break;
		case 4:
			location.href="index.php?sec=subclass";
		break;
		case 5:
			location.href="index.php?sec=godlevel";
		break;
		case 6:
			location.href="index.php?sec=compra_auras";
		break;
		case 7:
			location.href="index.php?sec=compra_venta";
		break;
		case 8:
			location.href="index.php?sec=habilidades";
		break;
		case 9:
			location.href="index.php?sec=thevoid";
		break;
	}
}

/////////////////////////////////////////////////////////////////////////////////////////////////////

npcZepp = (id)=>{
	var textOut="";
	$("#npcContent").text("");
	$("#npcName").text("Zepp");
	$("#npcImg").attr("src","images/npc/zepp.jpg");
	switch(id)
	{
		case 0:
			$("#npcContent").append('<div class="npcDialogTxt">Hay que detener a los magos a como de lugar.</div>');
			textOut += npcMakeOption("Quien eres?","npcZepp",1);
			textOut += npcMakeOption("como los vamos a detener?","npcZepp",2);
			//textOut += '<div class="menuItemNpc" onclick="npcGoTo(9)">Ir a The Void</div>';
			$("#npcContent").append('<div class="menuHold">'+textOut+'</div>');
			$("#npcPlayGround").show("slow");
		break;
		case 1:
			$("#npcContent").append('<div class="npcDialogTxt">Lidero un grupo de ninjas para restaurar el orden en embolia, igualmente necesitamos ayuda de todos</div>');
			textOut += npcMakeOption("como los vamos a detener?","npcZepp",2);
			textOut += npcMakeOption("Volver","npcZepp",0);
			$("#npcContent").append('<div class="menuHold">'+textOut+'</div>');
		break;
		case 2:
			$("#npcContent").append('<div class="npcDialogTxt">La única forma es buscándolos en un lugar llamado the void donde se esconden y acumulan su poder.</div>');
			textOut += npcMakeOption("Volver","npcZepp",0);
			$("#npcContent").append('<div class="menuHold">'+textOut+'</div>');
		break;
	}
}

npcGarkalon = (id)=>{
	var textOut="";
	$("#npcContent").text("");
	$("#npcName").text("Garkalon");
	$("#npcImg").attr("src","images/npc/garkalon.jpg");
	switch(id)
	{
		case 0:
			$("#npcContent").append('<div class="npcDialogTxt">que manera de cagar gente eh...</div>');
			textOut += npcMakeOption("Quien eres?","npcGarkalon",1);
			
			textOut += '<div class="menuItemNpc" onclick="npcGoTo(7)">Ver la Compra/Venta de Items!</div>';

			$("#npcContent").append('<div class="menuHold">'+textOut+'</div>');
			$("#npcPlayGround").show("slow");
		break;
		case 1:
			$("#npcContent").append('<div class="npcDialogTxt">Soy solo un aldeano tratando de hacer negocios. <br>Me rehúso a ser manipulado por ese Swordon. <br>Todo esto es su culpa. </div>');
			textOut += npcMakeOption("Todo eso es su culpa?","npcGarkalon",2);
			textOut += npcMakeOption("Volver","npcAura",0);
			$("#npcContent").append('<div class="menuHold">'+textOut+'</div>');
		break;
		case 2:
			$("#npcContent").append('<div class="npcDialogTxt">Si el creo las malditas papas mágicas! toda esta guerra absurda es su culpa!</div>');
			textOut += npcMakeOption("Volver","npcGarkalon",0);
			$("#npcContent").append('<div class="menuHold">'+textOut+'</div>');
		break;

	}
}



npcAura = (id)=>{
	var textOut="";
	$("#npcContent").text("");
	$("#npcName").text("Aura");
	$("#npcImg").attr("src","images/npc/aura.jpg");
	switch(id)
	{
		case 0:
			$("#npcContent").append('<div class="npcDialogTxt">Necesitas ayuda?</div>');
			textOut += npcMakeOption("Quien eres?","npcAura",1);
			
			textOut += '<div class="menuItemNpc" onclick="npcGoTo(6)">Necesito buffs!</div>';
			if(NPCauraLvls>0)
			{
				textOut += '<div class="menuItemNpc" onclick="auraBufferAll(0)">Dame todos los buffs!</div>';
				textOut += '<div class="menuItemNpc" onclick="auraBufferAll(1)">Dame todos los buffs menos Wolf Spirit!</div>';
			}
			$("#npcContent").append('<div class="menuHold">'+textOut+'</div>');
			$("#npcPlayGround").show("slow");
		break;
		case 1:
			$("#npcContent").append('<div class="npcDialogTxt">Bueno soy una de las pocas creaciones de Swordon que no se volvieron en contra de Embolia, en su desesperación para combatir las papas mágicas creo durisimos guerreros como el Maestruli, pero al parecer todo ser creado por magia termina del lado enemigo, excepto yo por su puesto. </div>');
			textOut += npcMakeOption("Volver","npcAura",0);
			$("#npcContent").append('<div class="menuHold">'+textOut+'</div>');
		break;
		case 2:
			$("#npcContent").append('<div class="npcDialogTxt">'+auraErrorMsg+'</div>');
			textOut += npcMakeOption("Volver","npcAura",0);
			$("#npcContent").append('<div class="menuHold">'+textOut+'</div>');
		break;
		case 3:
			$("#npcContent").append('<div class="npcDialogTxt">Ahora sientes el poder de las auras!</div>');
			textOut += npcMakeOption("Volver","npcAura",0);
			$("#npcContent").append('<div class="menuHold">'+textOut+'</div>');
		break;
	}
}


npcSwordon = (id)=>{
	var textOut="";
	$("#npcContent").text("");
	$("#npcName").text("Swordon");
	$("#npcImg").attr("src","images/npc/swordon.jpg");
	switch(id)
	{
		case 0:
			$("#npcContent").append('<div class="npcDialogTxt">Por fin la guerra vs las papas termino...</div>');
			textOut += npcMakeOption("que paso?","npcSwordon",1);
			textOut += npcMakeOption("SubClases","npcSwordon",3);
			$("#npcContent").append('<div class="menuHold">'+textOut+'</div>');
			$("#npcPlayGround").show("slow");
		break;
		case 1:
			$("#npcContent").append('<div class="npcDialogTxt">Fue una batalla larga, dura y oscura... <br>Pero finalmente los magos destruyeron todo, ahora el problema son ellos</div>');
			textOut += npcMakeOption("magos?","npcSwordon",4);
			textOut += npcMakeOption("Volver","npcSwordon",0);
			$("#npcContent").append('<div class="menuHold">'+textOut+'</div>');
		break;
		
		case 3:
			$("#npcContent").append('<div class="npcDialogTxt">Cuando seas Nivel 100 podras agregar nuevas habilidades a tu personaje!, tendras que iniciar un nuevo personaje de 0 y al llegar a nivel 100 obtendras una nueva habilidad para tu clase base.</div>');
			textOut += '<div class="menuItemNpc" onclick="npcGoTo(4)">Ver SubClases</div>';
			textOut += npcMakeOption("Volver","npcSwordon",0);
			$("#npcContent").append('<div class="menuHold">'+textOut+'</div>');
		break;
		case 4:
			$("#npcContent").append('<div class="npcDialogTxt">Si hasta destruyeron el banco de embolia, su poder es increible, ahora no se quien los va detener.</div>');
			textOut += npcMakeOption("Volver","npcSwordon",0);
			$("#npcContent").append('<div class="menuHold">'+textOut+'</div>');
		break;
		
	}
}

npcMarkulion = (id)=>{
	var textOut="";
	$("#npcContent").text("");
	$("#npcName").text("Markulion");
	$("#npcImg").attr("src","images/npc/markulion.jpg");
	switch(id)
	{
		case 0:
			$("#npcContent").append('<div class="npcDialogTxt">Debemos defender embolia a como de lugar!</div>');
			textOut += npcMakeOption("Quien eres?","npcMarkulion",1);
			textOut += npcMakeOption("Aprender Habilidades","npcMarkulion",5);
			textOut += npcMakeOption("Habilidades Paragons","npcMarkulion",6);
			textOut += npcMakeOption("God Level","npcMarkulion",4);
			$("#npcContent").append('<div class="menuHold">'+textOut+'</div>');
			$("#npcPlayGround").show("slow");
		break;
		case 1:
			$("#npcContent").append('<div class="npcDialogTxt">Soy uno de los pocos aldeanos que quedaron de la ciudad Embolia! así que dedico mi vida a entrenar los valientes guerreros.</div>');

			textOut += npcMakeOption("que paso en Embolia?","npcMarkulion",2);

			textOut += npcMakeOption("Volver","npcMarkulion",0);
			$("#npcContent").append('<div class="menuHold">'+textOut+'</div>');
		break;
		case 2:
			$("#npcContent").append('<div class="npcDialogTxt">Bueno en un comienzo eramos aldeanos nomadas estábamos al pedo todo el día hasta que descubrimos a Swordon en una casa gigante llena de lujos... <br>  Si, Swordon es un Mago de la Creación, puede crear cualquier cosa que quiera pero luego no puede destruirla.</div>');

			textOut += npcMakeOption("El creo Embolia?","npcMarkulion",3);

			textOut += npcMakeOption("Volver","npcMarkulion",0);
			$("#npcContent").append('<div class="menuHold">'+textOut+'</div>');
		break;
		case 3:
			$("#npcContent").append('<div class="npcDialogTxt">Si, todos los días íbamos a romperle las bolas para que nos creara una ciudad donde vivir dignamente, pero es muy terco y no quería.<br> Hasta que un día se canso y nos creo la ciudad, aunque le puso Embolia para demostrar su frustración.<br>   Igualmente estábamos agradecidos de ese milagro. </div>');

			textOut += npcMakeOption("Volver","npcMarkulion",0);
			$("#npcContent").append('<div class="menuHold">'+textOut+'</div>');
		break;
		case 4:
			$("#npcContent").append('<div class="npcDialogTxt">Una vez que superas Nivel 120 cada nivel que subas te va dar un "God Level" que podras utilizar para mejoar tus habilidades</div>');
			textOut += '<div class="menuItemNpc" onclick="npcGoTo(5)">Ver Mejorar Habilidades</div>';
			textOut += npcMakeOption("Volver","npcMarkulion",0);
			$("#npcContent").append('<div class="menuHold">'+textOut+'</div>');
		break;
		case 5:
			$("#npcContent").append('<div class="npcDialogTxt">Cada 5 niveles recibirás un punto de habilidad que puedes usar para aprender nuevas habilidades</div>');
			textOut += '<div class="menuItemNpc" onclick="npcGoTo(8)">Aprender Habilidad</div>';
			textOut += npcMakeOption("Volver","npcMarkulion",0);
			$("#npcContent").append('<div class="menuHold">'+textOut+'</div>');
		break;
		case 6:
			$("#npcContent").append('<div class="npcDialogTxt">Los Paragons son habilidades pasivas que mejoran tu personaje, para obtener puntos Paragon tienes que realizar Paragon Rifts en la region de Doom.</div>');
			textOut += '<div class="menuItemNpc" onclick="npcGoTo(0)">Ver Paragons</div>';
			textOut += npcMakeOption("Volver","npcMarkulion",0);
			$("#npcContent").append('<div class="menuHold">'+textOut+'</div>');
		break;
	}
}

npcEnanoide = (id)=>{
	var textOut="";
	$("#npcContent").text("");
	$("#npcName").text("Enanoide");
	$("#npcImg").attr("src","images/npc/enanoide.jpg");
	switch(id)
	{
		case 0:
			$("#npcContent").append('<div class="npcDialogTxt">Conoces la regla L?</div>');
			textOut += npcMakeOption("Quien eres?","npcEnanoide",1);
			textOut += '<div class="menuItemNpc" onclick="npcGoTo(2)">Herreria</div>';
			textOut += '<div class="menuItemNpc" onclick="npcGoTo(3)">ReRoll de Items</div>';
			textOut += '<div class="menuItemNpc" onclick="npcGoTo(1)">Nombre de Arma</div>';
			$("#npcContent").append('<div class="menuHold">'+textOut+'</div>');
			$("#npcPlayGround").show("slow");
		break;
		case 1:
			$("#npcContent").append('<div class="npcDialogTxt">Ayudo a Swordon armar su ejercito, no es una tarea facil la lucha eterna contra las papas...</div>');
			textOut += npcMakeOption("Por que estamos luchando contra papas?","npcEnanoide",2);
			textOut += npcMakeOption("Volver","npcEnanoide",0);
			$("#npcContent").append('<div class="menuHold">'+textOut+'</div>');
		break;
		case 2:
			$("#npcContent").append('<div class="npcDialogTxt">Bueno... emmm mejor preguntale a Markulion.</div>');
			textOut += npcMakeOption("Volver","npcEnanoide",0);
			$("#npcContent").append('<div class="menuHold">'+textOut+'</div>');
		break;
	}
}