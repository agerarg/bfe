//// mostrar party
var partyOpStat=0;
var maxDps=0;
var partyMembersArr={};
function showParty()
{
	if(!partyOpStat)
	{
		$("#partyFlotante").show(1000);
		partyOpStat=1;
		$("#partyButton").hide(1000);

		$("#botonSrcParty").hide(1000);
	}
	else
	{ 
		$("#partyFlotante").hide(1000);
		partyOpStat=0;
		$("#partyButton").show(1000);
		$("#botonSrcParty").show(1000);
	}
}
////////////// INVITAR
function loadParty(data)
{
	$('#partyInviteIndex').show(400);
	$('#partyInviteLoad').hide();
	jAlert(data['mensaje'], 'message');	
}
function invitarPibe(id)
{
	socket.emit('heyWakeUp',{"to": id});
}
function insertInToPartyChanger(pMember)
{
	$("#partyChanger").append('<div class="partyChar">'+
				'<div class="partyImgPj"><img src="images/clases/'+pMember['imagen']+'_'+pMember['sexo']+'.jpg" alt="" width="50" height="50" /></div>'+
				'<div class="partyBlock">'+
					 '<div class="partyNamePj">&nbsp;&nbsp;<a href="index.php?sec=ver&pj='+pMember['nombre']+'">'+pMember['nombre']+'</a></div>'+
					 '<div class="partyLifeBar"> '+
							 '<div  align="left">'+
								 '<img src="images/iz_fin.gif" height="22" width="2" /><img id="partyVida_'+pMember['idPersonaje']+'" src="images/life.gif" height="22" width="100"/><img id="partyDead_'+pMember['idPersonaje']+'" src="images/dead.gif"   height="22" width="0"/><img src="images/dr_fin.gif" height="22" width="2"/>'+
							 '</div>'+
							 '<div id="partyVidaNum_'+pMember['idPersonaje']+'"  title="VIDA" class="partyLifeNumber" align="center">'+pMember['Vida']+'/'+pMember['VidaLimit']+'</div>'+
						'</div>'+
						  '<div class="partyDpsBar"> '+
							 '<div  align="left">'+
								 '<img src="images/iz_fin.gif" height="22" width="2" /><img id="partyVidaDPS_'+pMember['idPersonaje']+'" src="images/life_dmg.gif?1" height="22" width="100"/><img id="partyDeadDPS_'+pMember['idPersonaje']+'" src="images/dead.gif"   height="22" width="0"/><img src="images/dr_fin.gif" height="22" width="2"/>'+
							 '</div>'+
							 '<div id="partyDPS_'+pMember['idPersonaje']+'" class="partyLifeNumber" title="DPS" align="center">'+pMember['realDPS']+'</div>'+
							 '</div>'+
					'</div>'+
					'<div class="partyAssistSw"><a href="javascript:asistir('+pMember['idPersonaje']+')"><img src="images/Espada3.gif" alt="" width="25" height="25" /></a></div>'+
					'<div class="partyLvlSw">Lvl: '+pMember['nivel']+'</div>'+
				'</div>');
}
function partyUpdateShow()
{
	let i=0;
	if(partyMembersArr)
		while(partyMembersArr[i])
			{
				if(maxDps<=parseInt(partyMembersArr[i]['realDPS']))
					maxDps=parseInt(partyMembersArr[i]['realDPS']);
				lifebar(partyMembersArr[i]['Vida'],partyMembersArr[i]['VidaLimit'],"partyVida_"+partyMembersArr[i]['idPersonaje'],"partyDead_"+partyMembersArr[i]['idPersonaje'],1000);
				$("#partyVidaNum_"+partyMembersArr[i]['idPersonaje']).text(partyMembersArr[i]['Vida']+"/"+partyMembersArr[i]['VidaLimit']);
				
				lifebar(partyMembersArr[i]['realDPS'],maxDps,"partyVidaDPS_"+partyMembersArr[i]['idPersonaje'],"partyDeadDPS_"+partyMembersArr[i]['idPersonaje'],1000);
				let dpsPer=0;
				if(partyMembersArr[i]['realDPS']>0)
					dpsPer=((partyMembersArr[i]['realDPS']/maxDps)*100);
				$("#partyDPS_"+partyMembersArr[i]['idPersonaje']).text(dpsPer.toFixed(2)+"%");
				$("#partyDPS_"+partyMembersArr[i]['idPersonaje']).attr( "title", "DPS:"+partyMembersArr[i]['realDPS'] );
				i++;
			}
}
//////////// CHECK PARTY //////////////////
function loadPartyCheck(data)
{
	var i=0;
	var leaderOp="";
	var liderins="";
	$("#partyChanger").text("");
	partyMembersArr=data.party;
	if(data['party'])
	{
		while(data.party[i])
			{
				if(maxDps<=parseInt(data.party[i]['realDPS']))
					maxDps=parseInt(data.party[i]['realDPS']);
				insertInToPartyChanger(data.party[i]);
				i++;
			}	
		partyUpdateShow();	
	}
	if(i==0)
	{
		$("#partyFlotante").hide();
	}
	
}
function partyCheck()
{
	$.ajax({
				data: "",
				type: "GET",
				dataType: "json",
				url: "json/partyCheck.php",
				success: function(data){
				loadPartyCheck(data);
			}
			}); 
}
////////////
/////// PARTY ASIST //////////
function loadPartyAsistir(data)
{
	if(data['goForIt'])
	{
		if (typeof attack !== "undefined") { 

				if(data['nature']==4)
					{
			objetive[0]=data["targ1"];
			objetive[1]=data["targ2"];
			objetive[2]=data["targ3"];
			objetive[3]=data["targ4"];
			objetive[4]=data["targ5"];
			attack2(); MaloId=0;
				}
				else
			attack(data['target'],false,data['nature']);

		}
		else
		{
			jAlert("No se puede asistir si no estas en el mundo.", 'Error');	
		}
	}

		else
			jAlert(data['mensaje'], 'Mensaje');	
}
function asistir(id)
{
	$.ajax({
				data: "id="+id,
				type: "GET",
				dataType: "json",
				url: "json/partyAssist.php",
				success: function(data){
				loadPartyAsistir(data);
			}
			}); 
}
$( document ).ready(function() {
	if(partyCurren>0)
		partyCheck();
	
});

//SOKET IO SHIT
//Using partyCurren from newChat.js //
function srcPartyById(id)
{
	let i=0;
	while(partyMembersArr[i])
	{
		if(id==partyMembersArr[i]['idPersonaje'])
			return i;
		i++;
	}
}
function updatePartyBars(playerId,life,lifeLimit,dps)
{
	let id= srcPartyById(playerId);
	if(partyMembersArr[id])
	{
		partyMembersArr[id]['Vida']=life;
		partyMembersArr[id]['VidaLimit']=lifeLimit;
		partyMembersArr[id]['realDPS']=dps;
		partyUpdateShow();	
	}
}
function sendUpdatePartyBars(life,lifeLimit,dps)
{
	if(partyCurren>0)
	{
		let id= srcPartyById(idPersonaje);
		if(partyMembersArr[id])
		{
		if(life!=partyMembersArr[id]['Vida'] || lifeLimit!=partyMembersArr[id]['VidaLimit'] || dps!=partyMembersArr[id]['realDPS'])		
		{
			if(life<0)
				life=0;
			socket.emit('partyLifeUpdate', {"party": partyCurren,"playerId": idPersonaje, "life": life, "lifeLimit": lifeLimit,"dps": dps});
		}
	}
	}
}

$( document ).ready(function() {
	socket.on('partyLifeUpdate'+partyCurren, function(data){
		updatePartyBars(data['playerId'],data['life'],data['lifeLimit'],data['dps']);
	});
	socket.on('partyCheck'+partyCurren, function(data){
		partyCheck();
	});
	if(getOutFMP==1)
	{
		socket.emit('partyCheck', {"party": partyCurren});
	}
});