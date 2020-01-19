var mouseOnChat=false;
var partyCurren=0;
var onParty=false;
var mostrarItemId=0;
var mostrarItemName="";
const charimage=userImagen;

var saveTimer = 0;
var spamCoutner=0;
var spamBlock=false;
var spamCounter=0;
var chatTypeShoer="";
function closeItemShow()
{
	$("#mostrarItemSh").hide("slow");
}
function showItemOnDone(data)
{
	let item =data['litem'];
	if(item)
	{
	let enchant="";
	let setInfo="";
	$("#mostrarItemSh").text("");
	if(item['enchant']>0)
		enchant=" +"+item['enchant'];
	else
		enchant="";	

	if(item['armorset']>0)
		{
			let idItemTrue = item['armorset'];
			  setInfo+= "<div class=ComunDescSet><div class=SetName>Set "+item['Nombre']+"</div><div class=raidDrop>Requiere:<br>"+descArmor[idItemTrue]['req']+"</div>";
			setInfo+= "<div>Bonus:<br>"+descArmor[idItemTrue]['desc']+"</div></div>";
		}
		if(item['subtipo']=="card")
		$("#mostrarItemSh").append("<div class='itemRulerSh'><div class='Sh_Attr' >"+makeDesc(item,"<br>")+'</div></div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><div class="itemRulerCloser"><button onclick="closeItemShow()" id="closeItemSh" class="boxInner" >Cerrar</button></div>');
		else
		$("#mostrarItemSh").append('<div class="itemRulerSh"><div class="itemRShTitl"><img src="images/item/'+item['subtipo']+'/'+item['imagen']+'"> '+item['Nombre']+enchant+"</div><div class='Sh_Attr' >"+makeDesc(item,"<br>")+'</div>'+setInfo+'</div><div class="itemRulerCloser"><button onclick="closeItemShow()" id="closeItemSh" class="boxInner" >Cerrar</button></div>');
	$("#mostrarItemSh").show("slow");
	}
	else
		$("#mostrarItemSh").hide("");

}
function showItemOn(id)
{
	$("#mostrarItemSh").text('');
	$("#mostrarItemSh").append('<div class="itemRulerSh"><div class="loadingSh">Cargando...<br><img src="images/477.gif"></div></div><div class="itemRulerCloser"><button onclick="closeItemShow()" id="closeItemSh" class="boxInner" >Cerrar</button></div>');
	$("#mostrarItemSh").show("slow");

	$.ajax({
				data: "id="+id,
				type: "GET",
				dataType: "json",
				url: "json/showItem.php",
				success: function(data){
				showItemOnDone(data);
			}
			});
}
function mostrarEnChat(id,name)
{
	mostrarItemId=id;
	mostrarItemName=name;
	let msg = $("#chatImputer").val();
	msg = msg.replace("{item}", '');
	msg+="{item}";
	$("#chatImputer").val(msg);

}
function scrollChat()
{
	$('#chatBoxer').animate({
	scrollTop: $('#chatBoxer').get(0).scrollHeight}, 0);
}
function enviarMsg() 
	{
		var d = new Date();
		var now = Math.round(d.getTime() / 1000);
		if(now<saveTimer)
			spamBlock=true;
		else
			spamBlock=false;
			saveTimer=now+1;
		if(!spamBlock)	
		{
			let msg = $("#chatImputer").val();
			if(msg.length>0)
			{
				let item = 0;
				let itemName="";
				let partyuly=0;

				if(mostrarItemId>0)
				{
					item=mostrarItemId;
					itemName=mostrarItemName;
				}

				switch(chatTypeShoer)
				{
					case 'party':
						socket.emit('partyMsg',{"id": idPersonajeBase,"party": partyCurren,"charimage": charimage, "usuario": userNombre, "msg": msg, "item": item,"itemName": itemName,"col": varCol});
					break;
					case 'clan':
						socket.emit('clanMsg',{"id": idPersonajeBase,"party": 0,"clan": clanId,"charimage": charimage, "usuario": userNombre, "msg": msg, "item": item,"itemName": itemName,"col": varCol});
					break;
					default:
						socket.emit('chatMsg', {"id": idPersonajeBase,"party": 0,"charimage": charimage, "usuario": userNombre, "msg": msg, "item": item,"itemName": itemName,"col": varCol});
					break;
				}

				$("#chatImputer").val("");

				msg = msg.replace(/<\/?[^>]+>/ig, " ");
				$.ajax({
									data: {tipoChat: chatTypeShoer,charimage:charimage, name: userNombre, msg: msg, item: item, itemName: itemName, col: varCol  },
									type: "POST",
									dataType: "json",
									url: "json/newChatSend.php"
								});
			}
		}
		else
		{
			$("#chatImputer").val("");
			setTimeout(() => {
				jAlert("No se pueden enviar tantos mensajes seguidos.", 'Spamero!');
			}, 500);
		}	
	}
var map = {
	"<3": "\u2764\uFE0F",
	"</3": "\uD83D\uDC94",
	":D": "\uD83D\uDE00",
	":)": "\uD83D\uDE03",
	";)": "\uD83D\uDE09",
	":(": "\uD83D\uDE12",
	":p": "\uD83D\uDE1B",
	";p": "\uD83D\uDE1C",
	":'(": "\uD83D\uDE22"
	};
	
function escapeSpecialChars(regex) {
	return regex.replace(/([()[{*+.$^\\|?])/g, '\\$1');
	}	
function replaceAll(str, find, replace) {
	return str.replace(new RegExp(find.toString(), 'g'), replace);
}
replacerin = (msg)=>{
	msg = msg.replace(/<\/?[^>]+>/ig, " ");
	msg = msg.replace(/&amp;/g, '&');
	return msg;
}	
function inserterinoChat(data)
{
	let msg = data['msg'];

	msg = replacerin(msg);
	data['charimage'] =  replacerin(data['charimage']);
	data['usuario'] =  replacerin(data['usuario']);
	let checkBlank = msg.split(' ').join('');
	msg = replaceAll(msg,escapeSpecialChars("/div"), ''); 
	if(checkBlank.length>1)
	{
	msg = replaceAll(msg,":p", '<img src="images/emoticons/3.png" width= "25px" height="25px" />');
	msg = replaceAll(msg,":y", '<img src="images/emoticons/1.png" width= "25px" height="25px" />');
	msg = replaceAll(msg,escapeSpecialChars(":)"), '<img src="images/emoticons/2.png" width= "25px" height="25px" />'); 
	msg = replaceAll(msg,escapeSpecialChars(":("), '<img src="images/emoticons/4.png" width= "25px" height="25px" />'); 
	msg = replaceAll(msg,escapeSpecialChars(":|"), '<img src="images/emoticons/5.png" width= "25px" height="25px" />');

	msg = replaceAll(msg,":d", '<img src="images/emoticons/6.png" width= "25px" height="25px" />');
	
	msg = replaceAll(msg,escapeSpecialChars(":'("), '<img src="images/emoticons/7.png" width= "25px" height="25px" />');
	msg = replaceAll(msg,":o", '<img src="images/emoticons/8.png" width= "25px" height="25px" />');
	msg = replaceAll(msg,":8", '<img src="images/emoticons/10.png" width= "25px" height="25px" />');
	if(data['item']>0)
	 	{
	 		if(data['odin']>0)
		 		msg = ' <div class="odynBless"> Creo una Obra Maestra: <a href="javascript:showItemOn('+data['item']+')">'+data['itemName']+'</a>!</div> ';
		 	else
	 			msg = msg.replace("{item}", ' <a href="javascript:showItemOn('+data['item']+')">'+data['itemName']+'</a> ');
	 	}
	 
	 	let msgtype = "msgType_global";
	 	if(data['party']>0)
			 	msgtype = "msgType_party";
		if(data['clan']>0)
				msgtype = "msgType_clan";
		 	
		let colaborator = '<div class="msg_image"><img src="images/colaboradorIcon.png" title="Colaborador" width= "25px" height="25px" /></div>';
		if(data['col']==0)
			colaborator="";
		let playerImg = '<img src="images/clases/'+data['charimage']+'" width= "25px" height="25px" />';
	 	$("#chatBoxer").append(' <div class="msg_body '+msgtype+'">'+
	 					'<div class="msg_image">'+playerImg+'</div>'+colaborator+
                        '<div class="msg_name"><a href="javascript:opcionesPlayer('+data['id']+','+"'"+data['usuario']+"'"+');">'+data['usuario']+'</a>:</div>'+
                       '<div class="msg_text">'+msg+'</div>'+
                      '</div>');
	 	scrollChat();
   }	 	
}
function updateChaterino(data)
{
		$("#chatBoxer").text("");
	let i=0;
	if(Array.isArray(data['msg']))
	{
		data=data['msg'];
		while(data[i])
		{
			inserterinoChat({"party": data[i]['party'],"clan": data[i]['clan'],"charimage": data[i]['charimage'],"usuario": data[i]['nombre'], "msg": data[i]['text'], "item": data[i]['item'], "itemName": data[i]['itemName'],"odin": data[i]['odin'],"id": data[i]['id'],"col": data[i]['col']});
			i++;
		}
	}
}
function loadChaterino()
{

		$("#chatBoxer").text("");
		$("#chatBoxer").append("<br><br><br><br><br><br> <div align=center><img src='images/477.gif'></div>");
	$.ajax({
				data: "tipoChat="+chatTypeShoer,
				type: "GET",
				dataType: "json",
				url: "json/chatReal.php",
				success: function(data){
				updateChaterino(data);
			}
			});
}

OpPlayerSilenceDone=(data)=>{
	ChatBans = data['bans'];
	PartyOptionClose();
	loadChaterino();

}
OpPlayerSilence=(id)=>{
	$.ajax({
				data: "id="+id,
				type: "GET",
				dataType: "json",
				url: "json/chatBan.php",
				success: function(data){
				OpPlayerSilenceDone(data);
			}
			});
}

opcionesPlayer=(id,name)=>{

	$("#partyOptionsTitle").text(name);

	$("#partyOptions").show();

	$("#partyOptionsOptions").text("");
	$("#partyOptionsOptions").append('<div class="partyOptionsEach"><a href="index.php?sec=ver&pj='+name+'">Ver Perfil</a></div>');
	if(partyOwener)
			$("#partyOptionsOptions").append('<div class="partyOptionsEach"><a href="index.php?sec=partyInvite&force='+id+'">Invitar a Party</a></div>');
	if(clanOwener)
		$("#partyOptionsOptions").append('<div class="partyOptionsEach"><a href="index.php?sec=clanmanage&ver=peticiones&force='+id+'">Invitar a Clan</a></div>');
	$("#partyOptionsOptions").append('<div class="partyOptionsEach"><a href="javascript:OpPlayerSilence('+id+');">Silenciar</a></div>');
}
PartyOptionClose=()=>{
	$("#partyOptions").hide();
}
$(document).ready(function(){	
	$("#partyOptions").hide();
	partyCurren=partyId;

	$('#chat').mousedown(function() {
	   	mouseOnChat=true;
	}).bind('mouseup mouseleave', function() {
	    mouseOnChat=false;
	});

	$(document).keydown(function(e) {
		   if(e.which==13)
		   		enviarMsg();
	});	

	$( "#chatEnviar" ).click(function() {
	  	enviarMsg();
	});

	 socket.on('partyMsg'+partyCurren, function(data){
	 	inserterinoChat(data);
	 });
	 socket.on('clanMsg'+clanId, function(data){
	 	inserterinoChat(data);
	 });

	 socket.on('chatMsg', function(data){
	 	var res = ChatBans.split(",");
	 	for (var i = 0; i < res.length; i++) {
	        if(res[i]==data['id'])
	        {
	        	return false;
	        }
	    }
	 	inserterinoChat(data);
	 });

	 $( "#chatChannel" ).change(function() {
	  		
	  		switch($("#chatChannel").val())
	  		{
	  			case "3":
	  				chatTypeShoer="clan";
	  				loadChaterino();
	  			break;
	  			case "2":
	  				chatTypeShoer="party";
	  				loadChaterino();
	  			break;
	  			default:
	  				chatTypeShoer="";
	  				loadChaterino();
	  			break;
	  		}
	  	
	});

	 loadChaterino();
});



