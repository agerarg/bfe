var MONSTER=0;

var monsterShower=new Array();
var monsterActivation=true;
var dungeon=0; 
var toPartu=0;
var objetive=new Array();
var saveMobs=[];
objetive[0]=0;
objetive[1]=0;
objetive[2]=0;
objetive[3]=0;
objetive[4]=0;
objetive[5]=0;
selecionarAllBichos = ()=>{
	var i=0;
	resetSelector();
	var selSomthing=false;
	if(saveMobs)
	{
		while(saveMobs[i])
		{
			if(saveMobs[i]['tipo']==2 && saveMobs[i]['papa']==0)
			{
					selector(saveMobs[i]['id']);
					$("#mob"+i).addClass("backingSlot2");
					selSomthing=true;
			}
			i++;	
		}

		if(!selSomthing)
		{
			i=0;
			while(saveMobs[i])
			{
				if(saveMobs[i]['papa']==1)
				{
						selector(saveMobs[i]['id']);
						$("#mob"+i).addClass("backingSlot2");
				}
				i++;	
			}
		}
	}
	//$(".monster").addClass("backingSlot2");
			
}
function resetSelector()
{
	objetive[0]=0;
	objetive[1]=0;
	objetive[2]=0;
	objetive[3]=0;
	objetive[4]=0;
	objetive[5]=0;
}
function selector(id,elem)
{
	if(partBoludo==5)
		showBoludo("parte8.jpg");
	var i=0;
	for (i = 0; i < 5; i++) { 
		if(objetive[i]==id)
		{
			objetive[i]=0;
			$("#mob"+elem).removeClass("backingSlot2");
			//$("#mostrar").text("Too Mucho 1:"+ objetive[0]+" 2: "+objetive[1]+" 3: "+objetive[2]+" 4: "+objetive[3]+" 5: "+objetive[4]);
			return false;
		}
	}
	for (i = 0; i < 5; i++) { 
		if(objetive[i]==0)
		{
			objetive[i]=id;
			$("#mob"+elem).addClass("backingSlot2");
		//	$("#mostrar").text("Too Mucho 1:"+ objetive[0]+" 2: "+objetive[1]+" 3: "+objetive[2]+" 4: "+objetive[3]+" 5: "+objetive[4]);
			return false;
		}
	}
}
function mob(data) {
		var i=0;
		$("#box").text("");
		var cantidadMobs=0;
		var blockStyle="backingSlot1";
		var champString="";
		var enemyTag="";
		saveMobs=data.mob;
		if(data['dungWave']>0)
			$("#mundoTitle").text("Dungeon ("+data['dungWave']+"/"+data['dungWaveLimit']+")");

		npcShow(mundo);

		if(data.mob)
		{
			while(data.mob[i])
			{
                                         blockStyle="backingSlot1";
					cantidadMobs=1;
					if(data.mob[i]['colored']==4)
					{
							blockStyle="backingSlot2";
					}
					if(data.mob[i]['colored']==3)
					{
							blockStyle="backingSlot3";
					}
					if(data.mob[i]['colored']==1 && data.mob[i]['tipo']==1 && data.mob[i]['tipo']==1)
						blockStyle="backingSlotMorado";
				
					if(data.mob[i]['colored']==2)
						blockStyle="backingSlotRed";
					
					if(data['battle']==1)
					{
						if(data.mob[i]['enemy']==1)
							enemyTag="EnemyClanTag";
						else
							enemyTag="clanTag";
					$("#box").append("<div class='monster "+blockStyle+"' id='mob"+i+"'  align='center' onclick='attack("+data.mob[i]['id']+",false,"+data.mob[i]['tipo']+");' ><img src='images/"+data.mob[i]['foto']+"' width='50' height='50'   class='"+data.mob[i]['atacado']+"' /><br>"+data.mob[i]['nombre']+"<br><div class="+enemyTag+">"+data.mob[i]['clan']+"</div></div>");
					}
					else
					{
                                               if(data.mob[i]['champ']==1)
								champString="<div class='champ'>Champion</div>";
							else
								champString="Lvl: "+data.mob[i]['lvl']+"";
						if(data.mob[i]['tipo']==2 && !singleTargetMob)
						{
								$("#box").append("<div class='monster "+blockStyle+"' onclick='selector("+data.mob[i]['id']+","+i+")' id='mob"+i+"'  align='center'><img src='images/"+data.mob[i]['foto']+"' width='50' height='50'  class='"+data.mob[i]['atacado']+"' /><br>"+data.mob[i]['nombre']+"<br>"+champString+"</div>");						
						}
						else
						{
							$("#box").append("<div class='monster "+blockStyle+"' id='mob"+i+"' onclick='attack("+data.mob[i]['id']+",false,"+data.mob[i]['tipo']+");'  align='center'><img src='images/"+data.mob[i]['foto']+"' width='50' height='50'  class='"+data.mob[i]['atacado']+"' /><br><div class='playerSlot'> "+data.mob[i]['nombre']+"</div>"+champString+"</div>");
						}
						
					}
					// CHECK SELECTED
					var o=0;
					for (o = 0; o < 5; o++) { 
						if(objetive[o]==data.mob[i]['id'])
						{
							$("#mob"+i).addClass("backingSlot2");
						}
					}
					//
					blockStyle="backingSlot1";
					monsterShower[i] = true;
					i++;
			}
		}
		setMundoEvent(data['baina']);
		if(data['baina']==1)
		{
			if(mundo==122)
			{
				location.href='index.php';
			}
			else
			if(mundo==1 || mundo==168 || mundo==169)
			{
				//NADA
			}
			else
			if(data['dungeon']>0)
			{
				dungeon=data['dungeon'];
				jAlert("Instancia terminada", 'Dungeon!',function(r) {
					if(r)
					{
						location.href='index.php?sec=dungeonoff';
					}
				});
			}
			else
			{
				if(data['mapBoss']==1)
				{
					jAlert('Un Boss del mapa salvaje ha aparecido!',"Cuidado!", function(r) {
					if(r)
					{
						//location.href='index.php?sec=mundo&mundo='+mundo+'&'+ Math.floor(Math.random() * 99999999);
						refreshMobs();
					}});
				}
				else
					//location.href='index.php?sec=mundo&mundo='+mundo+'&'+ Math.floor(Math.random() * 99999999);
				refreshMobs();
			}
		}
		showMonsterList();
		
}		
function calculoPaginas()
{
	var cant_pags;
	var x;
	$("#item_paginacion").text("");
	
	cant_pags= ((cantidadItems-2) / monsterCuant);
	cant_pags = parseInt(cant_pags);
	if(cantidadItems<=(monsterCuant+1))
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
	showMonsterList();
}
function showMonsterList()
{
	var i=0;
	var n=1;
	var desde = 0;
	var hasta = monsterCuant;
	
	if(pagina==0)
	{
		desde = 0;
	}
	else
	{
		hasta = (pagina+1)*monsterCuant;
		desde = (pagina)*monsterCuant+1;
	}
			while(monsterShower[i])
			{
					if(desde <= n && hasta >= n )
						$("#mob"+i).show(500);
					else
						$("#mob"+i).hide();	
				n++;		
				i++;
			}
			cantidadItems = n;
			calculoPaginas();
}
function liveMonsters()
{
	//setTimeout ('liveMonsters()', 30000);
	refreshMobs();
}
function refreshMobs()
	{
		$("#box").text("");
		$("#item_paginacion").text("");
		$("#box").append("<br /><br /><br /><div align='center' style='color:#FFFF00'>loading...<br><img src='images/477.gif' /></div>");
		if(javaActivado==1 && monsterActivation==true)
		{
			if(mundo==122)
			{
				$.ajax({
					data: "mundo="+mundo,
					type: "GET",
					dataType: "json",
					url: "json/monsterRanked.php",
					success: function(data){
					mob(data);
				}
				});
			}
			else
			{
				$.ajax({
					data: "mundo="+mundo,
					type: "GET",
					dataType: "json",
					url: "json/monster.php",
					success: function(data){
					mob(data);
				}
				});
			}
		}
	}
function loadmonster(data)
{
	if(monsterActivation==true)
	{
		monstersDeath=0;
		//finalShowMoster();
		//$("#espera").css("display", "none");
	    //$("#listo").css("display", "");
		allowHotKey=true;
		 $('iframe,:focus:not(body)').blur();
 		 window.focus();
		
					$('#monsterName').text("");
					$('#monsterImg').text("");
					var i=0;
					monster_hash=data['hash'];
					if(partBoludo==5)
					bldResponce+=" <br> <a href='javascript:showBoludo("+'"sub_6.jpg"'+")'>Y esa carabera ahi?</a>";
					
					if(data['multy']==1)
					{
						if(partBoludo==5)
							showBoludo("parte10.jpg");
						$('#monsterBody').show("");
						$("#monsterName").append("<h1>Grupo de monstruos</h1>");
						$("#monsterBody").text("");
						if(data.mob)
						{
							while(data.mob[i])
									{
									$("#monsterBody").append("<div class='monster2' align='center'><img src='images/"+data.mob[i]['foto']+"' width='50' height='50' /><br>"+data.mob[i]['nombre']+"<br>"+data.mob[i]['vida']+"</div>");
									i++;
									}
						}
					}
					else
					{	
						toPartu=data.mob['toPartu'];
						$('#monsterAlone').show("");
						$("#monsterBody").text("");
						$('#monsterBody').hide("");
						if(data.mob['tipo']==2)
							$("#monsterName").append("<h1>"+data.mob['nombre']+"");
						else
							$("#monsterName").append("<h1>"+data.mob['nombre']+"</h1>");
						$("#monsterImg").append("<img src='images/"+data.mob['foto']+"' width='50' height='50'  /> ");
						$("#monsterLifeBar").attr("title","Vida: "+data.mob['vida']+"/"+data.mob['vidalimite']);
						lifebar(data.mob['vida'],data.mob['vidalimite'],"monsterVida","monsterDead");
						$('#monsterLifeNumber').text(data.mob['vida']+"/"+data.mob['vidalimite']);
						if(data['infected'])
							$('#monsterWeakness').text(data['infected']);
						else
							$('#monsterWeakness').text("");
							
						if(data.mob['vida']==0 && mundo!=122)
						{
							jAlert("El objetivo ("+data.mob['nombre']+") ya fue derrotado por otra perosna!", 'Upppss!');	
							closeattack();
						}
					}
			
		monsterActivation = false;	 
	}
}
function attack2()
{
	if(objetive[0]>0)
	{
	activationCount();
	$('#monsterAlone').hide("");
	$('#monsterBody').hide("");	
	$('#atacar').show("");
	tipoTarget=2;
	$.ajax({
				data: "que=2&multy=1&id="+objetive[0]+"&id2="+objetive[1]+"&id3="+objetive[2]+"&id4="+objetive[3]+"&id5="+objetive[4],
				type: "GET",
				dataType: "json",
				url: "json/monster.php",
				success: function(data){
				loadmonster(data);
			}
			}); 
	}
	else
	{
		jAlert("Seleccina almenos un enemigo. Haciendo clic en los bichos", 'Elije tu objetivos!');	
	}
}
function attack(id,actual,what)
	{
		$('#monsterAlone').hide("");
		$('#monsterBody').hide("");	
		$('#atacar').show("");
		//$('#footer').text("id="+id+"&que="+what);
			MONSTER=id;
		tipoTarget=what;	
			activationCount();
			if(mundo==122)
			{
				$.ajax({
					data: "id="+id+"&que="+what,
					type: "GET",
					dataType: "json",
					url: "json/monsterRanked.php",
					success: function(data){
					loadmonster(data);
				}
				});
			}
			else
			{
				$.ajax({
				data: "id="+id+"&que="+what,
				type: "GET",
				dataType: "json",
				url: "json/monster.php",
				success: function(data){
				loadmonster(data);
			}
			}); 
			}
	}
function closeattack()
	{
		allowHotKey=false;
		activationCount();
		resetSelector();
		monsterActivation = true;
		$("#atacar").css("display", "none");
		//checkAuras();
		refreshMobs();
		refreshChat();
	}	
$(document).ready(function(){						   
	liveMonsters();
});