var skillActivation = new Array();
var manaPotion=0;
var lifePotion=0;
var boludo=0;
var monstersDeath=0;
//skillActivation[id] = false;
function finalShowMoster()
{
	if(monstersDeath==1 && autoCloseDeath==1)
	{
		$("#esperaIn").hide();
	}
	else
	{
		$("#esperaIn").show();
		$("#espera").css("display", "none");
	    $("#listo").css("display", "");
	}
}
function randomBetween(min, max) {
    if (min < 0) {
        return min + Math.random() * (Math.abs(min)+max);
    }else {
        return min + Math.random() * max;
    }
}
function truncate(_value)
{
  if (_value<0) return Math.ceil(_value);
  else return Math.floor(_value);
}
function skilltimer(time)
{
	
	$("#espera").fadeIn();
	$("#listo").fadeOut();
	fkingCountDown('turnotime',time,"attack",0);
}
function resultados(data,id,time)
{
	$('#loadSkill').hide();

       if(data['changeAvatar'])
	{
          $("#pj_img").text("");
          $("#pj_img").append("<img src='images/clases/"+data['changeAvatar']+".jpg' />");
        }
	if(data['antiBot'])
		wildAntiBot(); // AntiBot.js
		if(data['auraCheck'])
				addAura(data.aura['idSkill'],data.aura['lvl'],data.aura['auraTimeOut'],0);
		if(data['auraCheckPasive'])
				addAura(data.aura['idSkill'],data.aura['lvl'],data.aura['auraTimeOut'],1);
		if(data['auraRowCheck'])
		{
			var i=0;
			while(data.aura[i])
			{
				addAura(data.aura[i]['idSkill'],data.aura[i]['lvl'],data.aura[i]['auraTimeOut'],data.aura[i]['pasive']);
				i++;
			}	
		}
		
	if(data['recetSkillCd'])
	{
                if(data['isPvp'])
                  window.location.replace("index.php?sec=mundo&mundo="+data['mundo']+"&target="+data['enemyPlayerId']+"");
                else
                {
                  if(singleTargetMob)
                     window.location.replace("index.php?sec=mundo&mundo="+data['mundo']+"&target="+MONSTER+"&bicho=1&multy=0");
                  else
		    window.location.replace("index.php?sec=mundo&mundo="+data['mundo']+"&target=0&id="+objetive[0]+"&id2="+objetive[1]+"&id3="+objetive[2]+"&id4="+objetive[3]+"&id5="+objetive[4]+"&bicho=1&multy=1");
               }
		
	}	
	if(data['updateAuras']==1)
	{
		checkAuras();
	}
	if(data['error'])
	{
		$('#monsterResult').hide();
		jAlert(data['error'], 'Error');	
		closeattack();
		if(data['gold'])
			goldChange(data['gold']);
		if(data['exp'])
		{
			userExp=data['exp'];
			setTimeout ('userExpUpdate()', 1000);
		}
		$("#listo").show();
		$('#loadSkill').hide();
	}
	else
	{
		activar();
		if(data['monsterLife']==0)
			currentMonsterLife=0;
		else
			currentMonsterLife=1;
		$('#monsterResult').text("");
		
		/*if(data['player'])
			jAlert(data['player'], 'asd');	*/
		//BOLUDO IS COMING
		disableBoludo=true;
		skillActivation[id] = true;
		var cooldowndat = parseInt(data['newCoolDown']);
		fkingCountDown('skill_'+id,cooldowndat,"skill",id);		
		$('#skill_'+id).addClass("skill_cooldown");
		
			$('#monsterResult').hide();
			$("#monsterResult").append(data['info']);
			if(data['counter'])
				$("#monsterResult").append("<br>"+data['counter']);
			if(data['isPvp'])
			{
				MaloId = data['MaloId'];
				attackAviser(MaloId);
			}
			
				skilltimer(data['attackCooldown']);
			if(data['monsterCasting'] && partyId>0)
				socket.emit('heyWakeUp',{"party": partyId});

			$('#monsterResult').show(500,function() {
				if(data['monsterLife']<0)
					$('#monsterLifeNumber').text("Muerto");
				else
					$('#monsterLifeNumber').text(data['monsterLife']+"/"+data['monsterLifeLimit']);

				lifebar(data['monsterLife'],data['monsterLifeLimit'],"monsterVida","monsterDead",500);
			
				if(data['drop']==1)
				{
					jAlert(data['dropMsg'], 'Drop Drop Drop!!!');	
				}					
				
				$('#monsterWeakness').text("");
				switch(data['animation'])
				{
				case 1:
					var atkanim=0;
					atkanim=truncate(randomBetween(1,3));
					$("#monsterWeakness").append("<img class='attackBoxAnim' src='images/attackAnimat/v"+atkanim+"/ata1.png' width='250' height='250'/>");
					setTimeout(function() {$('#monsterWeakness').text(""); 
					$("#monsterWeakness").append("<img class='attackBoxAnim' src='images/attackAnimat/v"+atkanim+"/ata2.png' width='250' height='250' />"); }, 100);	
					setTimeout(function() {$('#monsterWeakness').text(""); 
					$("#monsterWeakness").append("<img class='attackBoxAnim' src='images/attackAnimat/v"+atkanim+"/ata3.png' width='250' height='250'/>"); }, 200);	
					setTimeout(function() {$('#monsterWeakness').text(""); 
					$("#monsterWeakness").append("<img class='attackBoxAnim' src='images/attackAnimat/v"+atkanim+"/ata4.png' width='250' height='250'/>"); }, 300);	
					setTimeout(function() {$('#monsterWeakness').text(""); 
					$("#monsterWeakness").append("<img class='attackBoxAnim' src='images/attackAnimat/v"+atkanim+"/ata5.png' width='250' height='250'/>"); }, 400);	
					setTimeout(function() {$('#monsterWeakness').text(""); }, 500);	
				break;
				case 2:
						$('#monsterWeakness').hide("");
						$("#monsterWeakness").append("<img class='attackBoxAnim' src='images/attackAnimat/skill/magic.gif' width='250' height='250'/>");
						 $( "#monsterWeakness" ).fadeIn(2000, function() {
							 $( "#monsterWeakness" ).fadeOut(1000);
						 });
				break;
				case 3:
						$('#monsterWeakness').hide("");
						$("#monsterWeakness").append("<img class='attackBoxAnim' src='images/attackAnimat/skill/"+data['customAnimation']+".gif' width='"+data['custAW']+"' height='"+data['custAH']+"'/>");
						 $( "#monsterWeakness" ).fadeIn(2000, function() {
							 $( "#monsterWeakness" ).fadeOut(1000);
						 });
				break;
					}
					
					userVida=parseInt(data['userLife']);
					userVidaLimit=parseInt(data['userLifeLimit']);
					userDPScal=parseInt(data['realDPS']);
					dpsMeterShow(userDPScal);
					sendUpdatePartyBars(userVida,userVidaLimit,userDPScal);
					setTimeout ('userVidaUpdate()', 1000);
					userMana=data['userMana'];
					userManaLimit=data['userManaLimit'];
					setTimeout ('userManaUpdate()', 1000);

					//TEST
				//	LogroShowMundo(data['mundo']);
				if(data['revealMundo'])
				{
					//LogroShowMundo(data['revealMundo']);
				}
				if(data['papaisDead'])
				{
					//location.href='index.php?sec=recompensas';
				}


				if(data['muerto'])
				{
					$('#main').fadeOut(1000);
					setTimeout(function() {
						$('#main').css("background-color","");
						$('#main').css("border","");
						$('#main').text("");
						$("#main").append("<div id='msgMuerte'>ESTAS<br>MUERTO!</div>");
						$('#main').fadeIn(1000);
						$('#main').animate({fontSize: "200px" }, 1000 );
						
						}, 1000);					
				setTimeout(function() {
					window.location = "index.php";
				}, 3000);
				}
				if(data['gold'])
				{
					goldChange(data['gold']);
				}
				if(data['exp'])
				{
					userExp=data['exp'];
					setTimeout ('userExpUpdate()', 1000);
				}
				if(data.mob)
				{
					var p=0;
					$("#monsterBody").text("");
					while(data.mob[p])
					{
						$("#monsterBody").append("<div class='monster2' align='center'><img src='images/"+data.mob[p]['foto']+"' width='50' height='50' /><br>"+data.mob[p]['nombre']+"<br>"+data.mob[p]['vida']+"</div>");
						p++;
					}
				}
				else
				{
					if(data['enemySlaying'] && autoCloseDeath==0)
						closeattack();
					else
						monstersDeath=1;
				}
			});
	}
}
function selectTheBoludo(targ,id,time)
{
	$("#selectTarget").hide();
	boludo=targ;
	useskill(id,time,0);
}
function closeTargetSkill()
{
	$("#selectTarget").hide();
}
function partyStats(data,id,time)
{
	var i=0;
	if(data.targ)
		{
			$("#partyTargetShow").text("");
			while(data.targ[i])
			{
				$("#partyTargetShow").append("<div onclick='javascript:selectTheBoludo("+data.targ[i]['id']+","+id+","+time+");' class='PartyTPlayer' align='center'><div class='namePartyTarg'>"+data.targ[i]['name']+" has "+data.targ[i]['vida']+" life</div></div>");
				i++;
			}
	}
}
function useskill(id,time,targ)
	{
		if(skillActivation[id])
		{
			jAlert("la habilidad no esta lista", 'Error');	
		}
		else
		{
			switch(id)
			{
			default:
				if(targ==1)
				{
					$("#selectTarget").show();
					$.ajax({
						data: "",
						type: "GET",
						dataType: "json",
						url: "json/getPartyStats.php",
						success: function(data){
						partyStats(data,id,time);
					}
					});
				}
				else
				{
					$("#listo").hide();
					$('#loadSkill').fadeIn();
				//$('#footer').text("json/attack.php?id="+MONSTER+"&skill="+id+"&target="+boludo+"");

				//jAlert("json/attack_mob.php?"+monster_hash+"&skill="+id+"&target="+boludo+"");

				if(tipoTarget==1)
				{
						$.ajax({
							data: "id="+MONSTER+"&skill="+id+"&target="+boludo+"",
							type: "GET",
							dataType: "json",
							url: "json/attack.php",
							success: function(data){
							resultados(data,id,time);
						}
						});
				}
				else
				{
					
					$.ajax({
							data: monster_hash+"&skill="+id+"&target="+boludo+"",
							type: "GET",
							dataType: "json",
							url: "json/attack_mob.php",
							success: function(data){
							resultados(data,id,time);
						}
						});
					
				}
				}
			break;
			}
		}
	}
//// TODO POCIONES
var potionUsed=[false,false,false,false,false,false];
/////

potionGetDone =(data)=>
{
	if(data['error'])
		jAlert("Error",data['error']);
	if(data['vida'])
	{
		userVida+=parseInt(data['vida']);
		setTimeout ('userVidaUpdate()', 100);
	}
	if(data['mana'])
	{
		userMana+=parseInt(data['mana']);
		setTimeout ('userManaUpdate()', 100);
	}
	if(data['vidaLimit'])
	{
		userVidaLimit+=parseInt(data['vidaLimit']);
		setTimeout ('userVidaUpdate()', 100);
	}
	if(data['manaLimit'])
	{
		userManaLimit+=parseInt(data['manaLimit']);
		setTimeout ('userManaUpdate()', 100);
	}
	if(data['auraCheck'])
		addAura(data.aura['idSkill'],data.aura['lvl'],data.aura['auraTimeOut'],0);
}

usarPocion = (id)=>{
	if(!potionUsed[id])
	{
		$.ajax({
			data: "pot="+id,
			type: "GET",
			dataType: "json",
			url: "json/potions.php",
			success: function(data){
				potionGetDone(data);
			}
		});
		fkingCountDown("potion_"+id,60,"potion",id);	
		$('#potion_'+id).addClass("skill_cooldown");
		potionUsed[id]=true;
	}
	else
	{
		jAlert("La pocion todavia no esta lista!", 'Error');	

	}
}	
pocionesSetup = (slot,nombre,img,cd)=>{
	if(cd>0)
		{
			fkingCountDown("potion_"+slot,cd,"potion",slot);	
			$('#potion_'+slot).addClass("skill_cooldown");
			potionUsed[slot]=true;
		}
		$('#potion_'+slot).show();
		$('#potion_'+slot).attr("title",nombre);
		$('#potion_'+slot).css("background-image", "url('images/item/pot/"+img+"')");
		$('.slot_all').cluetip({splitTitle: '|',delayedClose: 0,cluetipClass:'auras',cursor:'pointer'});

}