var idAura=0;
var currentAuras = new Array();
var armorSetted = 0;
var armorCreated = new Array();
function aurasSetUp(data)
{
	if(data['error'])
		jAlert(data['error'], 'Error');
	else
	{
		//$("#auraShow").hide();
		var cantidad=0;
		var i=0;
		var idSkill;
		var lvl;
		if(data['something'])
		{
			while(data.aura[i])
			{
				addAura(data.aura[i]['idSkill'],data.aura[i]['lvl'],data.aura[i]['timeOut'],data.aura[i]['static']);
				i++;
			}
			idAura=i;
			$("#auraShow").show();
		}
	}
}
function aurasSearcherAndDestroy(id)
{
		$('#auraId'+id).hide(1000);

	/*if(CANTIDAD_AURAS==0)
		$("#auraShow").hide("slow");*/
}

function setArmor(id,nombre,imagen)
{
	$('.armorBaka').hide(500);
	if(!armorCreated[id])
	{
		$("#auraShow").append("<div class='auraSingle armorBaka' id='armorSetp"+id+"' title='Set "+nombre+"|<div>Bonus:<br>"+descArmor[id]['desc']+"</div>'></div>");
		
		armorCreated[id]=true;	
	}
	else
	{
		$("#armorSetp").attr('title', "Set "+nombre+"|<div>Bonus:<br>"+descArmor[id]['desc']+"</div></div>");	
	}
	$('#armorSetp'+id).show(1000);
	$('#armorSetp'+id).css('background-image', "url(images/item/"+imagen+")");
	$('.auraSingle').cluetip({splitTitle: '|',delayedClose: 0,cluetipClass:'auras'});
}
function destroyArmor()
{
		$('.armorBaka').hide(500);
}
function addAura(id,lvl,timeout,static)
{
		idAura = id;
		var mixid = id+"_"+lvl;
		if(currentAuras[id])
		{
			$('#auraId'+idAura).hide();
			$('#auraId'+idAura).css('background-image', "url(images/skill/"+descSkill[mixid]['img']+")");
			$('#auraId'+idAura).attr('title', descSkill[mixid]['nombre']+"|"+descSkill[mixid]['desc']);
			$('#auraId'+idAura).show(1000);
			if(static==0)
				if(trueAurasTimer['auraId'+idAura]>0)
					trueAurasTimer['auraId'+idAura]=timeout;
				else
					fkingCountDown('auraId'+idAura,timeout,"self",0);
			else
				if(timeout>0)
					$('#auraId'+idAura).text(timeout);
				else
					$('#auraId'+idAura).text("");
		}
		else
		{
			$("#auraShow").show("slow");
			$("#auraShow").append("<div class='auraSingle' id='auraId"+idAura+"' title='"+descSkill[mixid]['nombre']+"|"+descSkill[mixid]['desc']+"'></div>");
			$('#auraId'+idAura).hide();
			$('#auraId'+idAura).show(1000);
			$('#auraId'+idAura).css('background-image', "url(images/skill/"+descSkill[mixid]['img']+")");
			if(static==0)
				fkingCountDown('auraId'+idAura,timeout,"self",0);
			else
				if(timeout>0)
					$('#auraId'+idAura).text(timeout);
				else
					$('#auraId'+idAura).text("");	
			idAura++;
			currentAuras[id]=true;
		}
		$('.auraSingle').cluetip({splitTitle: '|',delayedClose: 0,cluetipClass:'auras'});
}
function checkAuras()
{
	$.ajax({
				data: "",
				type: "GET",
				dataType: "json",
				url: "json/auras.php",
				success: function(data){
				aurasSetUp(data);
			}
			});
}