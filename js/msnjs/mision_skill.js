var skillActivation = new Array();
var currentMonsterLife=0;
function closeattack()
{
}
function randomNum(num)
	{
		var  m = Math.floor(Math.random()*num);		
		return m;
	}
function NpcSTFU()
{
	$("#dialogType").hide(1000);
}	
function skilltimer(time)
{
	
	$("#espera").css("display", "");
	$("#listo").css("display", "none");
	fkingCountDown('turnotime',time,"attack",0);
}
function loadMonster(data)
{
	if(data['error']==0)
	{
		currentMonsterLife=1;
		$("#channel").fadeOut(500,function() {
			$("#attackbox").show(500);
			$("#barradelbicho").show(500);
			lifebar2(data['Vida'],data['VidaLimit'],"monsterVida","monsterDead");
			$('#monsterLifeNumber').text(data['Vida']+"/"+data['VidaLimit']);
		});
	}
	else
		alert("error interno en setup de enemigo.");
}
function closeMonster()
{
	$("#attackbox").fadeOut(500,function() {
		$("#channel").show(500);
		$("#barradelbicho").fadeOut(500);
	});
}
////////////////////////////////////////////
function resultados(data,id,time)
{
	if(data['error'])
	{
		$('#monsterResult').hide();
		jAlert(data['error'], 'Error');	
	}
	else
	{
		if(data['monsterLife']==0)
			currentMonsterLife=0;
		else
			currentMonsterLife=1;
		$('#monsterResult').text("");
			
		skillActivation[id] = true;
		var cooldowndat = parseInt(data['newCoolDown'])+2;
		var danodelpj = parseInt(data['danodelpj']);
		fkingCountDown('skill_'+id,cooldowndat,"skill",id);		
		$('#skill_'+id).addClass("skill_cooldown");
		
			$('#monsterResult').hide();
			$("#monsterResult").append(data['info']);
			if(data['counter'])
				$("#monsterResult").append("<br>"+data['counter']);
			
				skilltimer(5);
			
			$('#monsterResult').show(500,function() {

				lifebar2(data['monsterLife'],data['monsterLifeLimit'],"monsterVida","monsterDead");
				$('#monsterLifeNumber').text(data['monsterLife']+"/"+data['monsterLifeLimit']);
				//reacciones al daño
				NpcSTFU();
				backDialogos(data['target'],data['monsterLife'],danodelpj);
				//	
				if(data['bloodShitComing'])
					if(data['auraAcumulator'])
						$("#auraId"+data['acumuleitorId']).text(data['auraAcumulator']);
					else
						$("#auraId"+data['acumuleitorId']).text("0");
					
				if(data['infected'])
					$('#monsterWeakness').text(data['infected']);
				else
					$('#monsterWeakness').text("");
					
					userVida=data['userLife'];
					userVidaLimit=data['userLifeLimit'];
					setTimeout ('userVidaUpdate()', 1000);
					userMana=data['userMana'];
					userManaLimit=data['userManaLimit'];
					setTimeout ('userManaUpdate()', 1000);
					
				if(data['muerto'])
					window.location = "index.php";

				if(data['auraCheck'])
					addAura(data['auraNombre'],data['auraImagen'],data['auraTimeOut'],data['idSkill'],0);
				
				
			});
	}
}
function useskill(id,time)
	{
			$.ajax({
				data: "skill="+id,
				type: "GET",
				dataType: "json",
				url: "json/misiones/attack_misoin.php",
				success: function(data){
				resultados(data,id,time);
			}
			});
	}
function addOpcion(code,texto,cara,visible)
{
	var extracto = new Array ();
	extracto['texto'] = texto;
	extracto['imagen'] = cara;
	extracto['visible'] = visible;
	opciones[code] = extracto;
}
function NpcDialog(txt)
{
	$('#dialogType').text("");
	$("#dialogType").fadeOut(500,function() {
			$('#dialogType').text("");
			setTimeout(function() {
				 $('#dialogType').text(txt);
				  $("#dialogType").show(500);
			}, 100);

	 });
}
function showOpciones()
{
	var i=0;
	$('#channel').text("");
	$('#channel').hide();
	while(opciones[i])
	{
		var vision="";
		if(opciones[i]['visible']==0)
			vision="nomostrar";
		$("#channel").append("<div class='"+vision+"' id='jdialogo"+i+"' >"+
       "<div class='option'>"+
            "<div class='optImg'><img src='images/mision/faces/"+opciones[i]['imagen']+".png' /></div>"+
            "<div class='optTxt'><a href='javascript:respuestaMasta("+i+");'>"+opciones[i]['texto']+"</a></div>"+
       "</div>"+
       "<div class='dialdivisor'><img src='images/blank.gif' width='1' height='1' /></div>"+
    "</div>");
		i++;
	}
	setTimeout(function() {
				  $("#channel").show(500);
			}, 3000);
}
function cambiarNpc(img)
{
	$('#alien').css('background-image', 'url("images/mision/npcs/'+img+'.png")');
}
function starBattle(id)
{
	$.ajax({
				data: "id="+id,
				type: "GET",
				dataType: "json",
				url: "json/misiones/setup.php",
				success: function(data){
				loadMonster(data);
			}
			});
}
function misionFinalizada(data)
{
	if(data["error"]==0)
	{
		if(data['expUp'])
			userExp=userExp+parseInt(data['expUp']);
		setTimeout ('userExpUpdate()', 1000);
		
		if(data['oroChange'])
			goldChange(data['oroChange']);
					
		jAlert('Mision Completa! '+data['info']+'', 'Felicidades!', function() {
			window.location = "index.php";
		});	
	}
	else
	{
		jAlert('error en comprobacion de datos, misoin cancelada', 'ERROR!', function() {
			window.location = "index.php";
		});	
	}
}
function finishim()
{
	$.ajax({
				data: "",
				type: "GET",
				dataType: "json",
				url: "json/misiones/final.php",
				success: function(data){
				misionFinalizada(data);
			}
			});
}
function mostrarUno(id)
{
	setTimeout(function() {
				  $("#jdialogo"+id).show(1000);
			}, 2000);	
}
function ocultarTodo()
{
	var i=0;
	while(opciones[i])
	{
		$("#jdialogo"+i).hide();
		i++;
	}
}