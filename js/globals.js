var trueAurasTimer = new Array();
function fkingCountDown(ele,tiempo,funct,extra)
{
		trueAurasTimer[ele]=tiempo;
	GOfkingCountDown(ele,trueAurasTimer[ele],funct,extra);
}
function GOfkingCountDown(ele,tiempo,funct,extra)
{
		$('#'+ele).text(trueAurasTimer[ele]);
		if(tiempo<=0)
		{
			switch(funct)
			{
				case 'potion':
					$('#'+ele).removeClass("skill_cooldown");
					$('#'+ele).text("");
					potionUsed[extra]=false;
				break;
				case 'self':
					$('#'+ele).hide(300);
                                  //Avatar rest
                                    if(ele == "auraId146")
                                     {
                                      $("#pj_img").text("");
                                      $("#pj_img").append("<img src='images/clases/"+origAvatar+"' />");
                                     }
				//	CANTIDAD_AURAS--;
					/*if(CANTIDAD_AURAS==0)
						$("#auraShow").hide("slow");*/
				break;
				case 'mana':
						manaPotion=0;
					 $('#skill_'+extra).text('');
					 $('#skill_'+extra).removeClass("skill_cooldown");
					 $('#'+ele).removeClass("skillTimerRetro").addClass("skillTimer");
					$('#skill_-2').attr("title", cantManaPot+" Mana Potions|Heals you 500 de mana");
					$('#skill_-2').cluetip({splitTitle: '|',delayedClose: 0,cluetipClass:'auras',cursor:'pointer'});
				break;
				case 'vida':
					lifePotion=0;
					 $('#skill_'+extra).text('');
					 $('#skill_'+extra).removeClass("skill_cooldown");
					 $('#'+ele).removeClass("skillTimerRetro").addClass("skillTimer");
					 $('#skill_-1').attr("title", cantVidaPot+" Life Potions|Heals you 500 de vida");
					 $('#skill_-1').cluetip({splitTitle: '|',delayedClose: 0,cluetipClass:'auras',cursor:'pointer'});
				break;
				case 'skill':
					 $('#skill_'+extra).text('');
					 $('#skill_'+extra).removeClass("skill_cooldown");
					 $('#'+ele).removeClass("skillTimerRetro").addClass("skillTimer");
					 skillActivation[extra] = false;
				break;
				case 'attack':
					finalShowMoster();
					 //$("#esperaIn").hide();
					//$("#espera").css("display", "none");
					//$("#listo").css("display", "");
				break;
				case 'ranked':
					$('#RankedTimer').text("Luchar!!!");
				break;
				case 'muerto':
					$('#MuertoRevivir').show(500);
				break;
				case 'asedio':
					$("#"+ele).text("");
					$("#"+ele).append("<a href='index.php?sec=mundo&mundo="+extra+"'>Go to Fight</a>");
				break;
				case 'warTimer':
					jAlert("Raid time out!", 'FAIL',function(r) {
						if(r)
						{
							location.href='index.php?sec=mundo&mundo='+extra;
						}
					});
					$('#warTimelimit').hide(500);
				break;
				case 'warOver':
					jAlert("Battle over!", 'TERMINO',function(r) {
						if(r)
						{
							location.href='index.php?sec=mundo&mundo='+extra;
						}
					});
					$('#warTimelimit').hide(500);
				break;
			}
		}
		else
		{
			if(funct=='skill')
				$('#'+ele).removeClass("skillTimer").addClass("skillTimerRetro");
			trueAurasTimer[ele]=trueAurasTimer[ele]-1;
			setTimeout(function(){
				GOfkingCountDown(ele,trueAurasTimer[ele],funct,extra);
				}, 1000);
		}
}
function activationCount()
{
	clockInterno=300;
	$("#Activo").text("Active");
	$("#Activo").removeClass("inactiveUser");
	$("#Activo").addClass("activeUser");
	javaActivado=1;
}
function inactiveCount()
{
	if(clockInterno==0)
	{
		$("#Activo").text("Inactive");
		$("#Activo").removeClass("activeUser");
		$("#Activo").addClass("inactiveUser");
		javaActivado=0;
		clockInterno--;
	}
	else
		clockInterno--;

	setTimeout(function(){
			inactiveCount();
			}, 1000);
}

function dpsMeterShow(dps)
{
	if(dps>0)
	{
		var dps = parseInt(dps);
		var saved =0;
		var holdTxt= "";
		if(dps>999999)	
		{
			saved = dps;
			dps = (dps/1000000);
			holdTxt= dps.toFixed(1)+"kk";
		}
		else
		if(dps>9999)
		{
			dps = (dps/1000);
			holdTxt= dps.toFixed()+"k";
		}
		else
			holdTxt= dps;

		$('#DpsMeter').text("");
		$('#DpsMeter').append(holdTxt);
	}
}

function goldShowSet(gold)
{
	var gold = parseInt(gold);
	var saved =0;
	if(gold>999999)	
	{
		saved = gold;
		gold = (gold/1000000);
		
		/*saved = saved-(gold*100000);
		saved = (saved/1000);*/
		return gold.toFixed(1)+"kk";
	}
	else
	if(gold>9999)
	{
		gold = (gold/1000);
		return gold.toFixed()+"k";
	}
	else
		return gold;
}
function addGoldChange(current,gold)
{
	$("#Oro").text(goldShowSet(gold)).attr('title', 'Gold: '+gold);;
	if(current<gold)
	{
		if((gold-current)>5000)
			current+=1000;
		else
		if((gold-current)>500)
			current+=100;
		else
			current++;
		setTimeout("addGoldChange("+current+","+gold+");", 1);
	}
	else
		$("#Oro").text(goldShowSet(gold)).attr('title', 'Gold: '+gold);
}
function delGoldChange(current,gold)
{
	$("#Oro").text(goldShowSet(gold)).attr('title', 'Gold: '+gold);;
	if(current>gold)
	{
		if((current-gold)>5000)
			current-=1000;
		else
		if((current-gold)>500)
			current-=100;
		else
			current--;
		setTimeout("delGoldChange("+current+","+gold+");", 1);
	}
	else
		$("#Oro").text(goldShowSet(gold)).attr('title', 'Gold: '+gold);;
}
function goldChange(gold)
{
	if(userOro<=gold)
		addGoldChange(userOro,gold);
	else
		delGoldChange(userOro,gold);
	userOro=gold;
}
function eventHandle(data)
{
	if(data['error']==0)
	{
		if(data['atacado'])
		{
			if(MaloId!=data['idMalo'])
			{
				jConfirm(data['atacado']+' te esta atacando! lo queres atacar?', 'Cuidado!', function(r) {
						
						if( r)
						{
							 window.location = "index.php?sec=mundo&mundo="+mundo+"&target="+data['idMalo'];
						}
					});
			}
		}
		
	}
}
function eventCheck(data)
{
	switch(data['error'])
	{
		case 0:
			$.ajax({
			data: "",
			type: "GET",
			dataType: "json",
			url: "json/eventResolve.php",
			success: function(data2){
			eventHandle(data2);
			}
			});
		break;	
	}
}
function disparadorDeEventos()
{
	/*if(javaActivado==1)
	{
		$.ajax({
			data: "",
			type: "GET",
			dataType: "json",
			url: "json/event.php",
			success: function(data){
			eventCheck(data);
		}
		});
	}*/
}