var mensajes = new Array();
var internalId=0;
var mouseOnChat=false;
var lastGenealId=0;
var lastClanId=0;
var lastPrivadoId=0;
var lastPartyId=0;
function showMsg(data)
{	
	if(!mouseOnChat)
	{
	var i=0;
	$("#ch_mensajes_sistema").text("");
	if(data['newMsg']==1)
	{
		while(data['msg'][i])
		{
			if(data['msg'][i]['pvpTarget']>0)
				$("#ch_mensajes_sistema").append("<div class='unMensaje'><div class='msg_texto'><a href='index.php?sec=mundo&mundo="+data['msg'][i]['mundo']+"&target="+data['msg'][i]['pvpTarget']+"'>"+data['msg'][i]['nombre']+"</a>"+data['msg'][i]['text']+"</div></div>");
			else	
				$("#ch_mensajes_sistema").append("<div class='unMensaje'><div class='msg_texto'>"+data['msg'][i]['text']+"</div></div>");
			i++;
		}
	}
	
	$("#ch_mensajes_sistema").scrollTop($("#ch_mensajes_sistema")[0].scrollHeight);
	}
}

function refreshChat()
{
		
			$.ajax({
					data: "",
					type: "GET",
					dataType: "json",
					url: "json/chat_refresh.php",
					success: function(data){
					showMsg(data);
				}
				});
			
}
function activar()
{
	activationCount();
}	
function closeALl()
{
	$("#ch_mensajes_privado").hide();
	$("#chat_privado").css( "content", "url('images/chat_privado1.png')" );
	$("#ch_mensajes_general").hide();
	$("#chat_general").css( "content", "url('images/chat_general1.png')" );
	$("#ch_mensajes_clan").hide();
	$("#chat_clan").css( "content", "url('images/chat_clan1.png')" );
	$("#ch_mensajes_party").hide();
	$("#chat_party").css( "content", "url('images/chat_party1.png')" );
	$("#chatImputer").hide();
	 $("#chatImputerPriv").hide();
}

function activarPeste(elem)
{
	$("#"+elem).css( "content", "url('images/"+elem+"3.png')" );
}

function realChat(data)
{
	disparadorDeEventos();
	if(!mouseOnChat)
	{
		var i=0;
		$("#ch_mensajes_general").text("");
		$("#ch_mensajes_party").text("");
		$("#ch_mensajes_clan").text("");
		$("#ch_mensajes_privado").text("");
		var lastPriv="";
		while(data.msg[i])
		{
			switch(data.msg[i]['tipoMSG'])
			{ 
				case 'privado':
					$("#ch_mensajes_privado").append("<div class='chatou '>"+data.msg[i]['tiempo']+" <a class='chNombre' href='index.php?sec=ver&pj="+data.msg[i]['nombre']+"'>"+data.msg[i]['nombre']+"</a>:<spam class='privChat'> "+data.msg[i]['text']+"</spam></div>");
					$("#ch_mensajes_general").append("<div class='chatou '>"+data.msg[i]['tiempo']+" <a class='chNombre' href='index.php?sec=ver&pj="+data.msg[i]['nombre']+"'>"+data.msg[i]['nombre']+"</a>:<spam class='privChat'> "+data.msg[i]['text']+"</spam></div>");
					if(parseInt(data.msg[i]['idPj']) != idPersonaje)
						lastPriv=data.msg[i]['nombre'];
					
				break;
				case 'party':
					$("#ch_mensajes_party").append("<div class='chatou '>"+data.msg[i]['tiempo']+" <a class='chNombre' href='index.php?sec=ver&pj="+data.msg[i]['nombre']+"'>"+data.msg[i]['nombre']+"</a>:<spam class='partyChat'> "+data.msg[i]['text']+"</spam></div>");
					$("#ch_mensajes_general").append("<div class='chatou '>"+data.msg[i]['tiempo']+" <a class='chNombre' href='index.php?sec=ver&pj="+data.msg[i]['nombre']+"'>"+data.msg[i]['nombre']+"</a>:<spam class='partyChat'> "+data.msg[i]['text']+"</spam></div>");
				break;
				case 'clan':
					$("#ch_mensajes_clan").append("<div class='chatou '>"+data.msg[i]['tiempo']+" <a class='chNombre' href='index.php?sec=ver&pj="+data.msg[i]['nombre']+"'>"+data.msg[i]['nombre']+"</a>:<spam class='clanChat'> "+data.msg[i]['text']+"</spam></div>");
					$("#ch_mensajes_general").append("<div class='chatou '>"+data.msg[i]['tiempo']+" <a class='chNombre' href='index.php?sec=ver&pj="+data.msg[i]['nombre']+"'>"+data.msg[i]['nombre']+"</a>:<spam class='clanChat'> "+data.msg[i]['text']+"</spam></div>");
				break;
				default:		
					$("#ch_mensajes_general").append("<div class='chatou '>"+data.msg[i]['tiempo']+" <a class='chNombre' href='index.php?sec=ver&pj="+data.msg[i]['nombre']+"'>"+data.msg[i]['nombre']+"</a>:<spam> "+data.msg[i]['text']+"</spam></div>");
				break;
			}
			i++;
		}
		if($("#playerTo").val()=="")
			$("#playerTo").val(lastPriv);
		$("#ch_mensajes_privado").scrollTop($("#ch_mensajes_privado")[0].scrollHeight);
		$("#ch_mensajes_general").scrollTop($("#ch_mensajes_general")[0].scrollHeight);
		$("#ch_mensajes_clan").scrollTop($("#ch_mensajes_clan")[0].scrollHeight);
		$("#ch_mensajes_party").scrollTop($("#ch_mensajes_party")[0].scrollHeight);
	}
	setTimeout(function(){
      	updateRealChat(null);
	 	  }, 3000);
}
function updateRealChat(data)
{
	/*if(data != null)
	{
		if(data['error']==1)
			jAlert(data['msg'], 'Upppss!');	
	}
	$.ajax({
			data: "",
			type: "GET",
			dataType: "json",
			url: "json/chatReal.php",
			success: function(data){
			realChat(data);
		}
		});*/
}

function mandar()
{
	if(chatSelector=="chat_privado")
	{
		$.ajax({
					data: "msg="+$("#hablar2").val()+"&tipo="+chatSelector+"&to="+$("#playerTo").val(),
					type: "POST",
					url: "json/chatRSend.php",
					success: function(data){
				updateRealChat(data);
			}
				});
		$("#hablar2").val("");
	}
	else
	{
		$.ajax({
					data: "msg="+$("#hablar").val()+"&tipo="+chatSelector,
					type: "POST",
					url: "json/chatRSend.php",
					success: function(data){
				updateRealChat(data);
			}
				});
		$("#hablar").val("");
	}
	
}

$(document).ready(function(){	

$('#chat').mousedown(function() {
   mouseOnChat=true;
}).bind('mouseup mouseleave', function() {
    mouseOnChat=false;
});


$( "#chat_general" ).click(function() {
	closeALl();
	$( this ).css( "content", "url('images/chat_general2.png')" );
	chatSelector="chat_general";
  $( "#ch_mensajes_general" ).show(1000);
  $("#chatImputer").show(1000);
  $.ajax({
				data: "default="+chatSelector,
				type: "GET",
				url: "json/chatSetter.php",
			});
});
$( "#chat_privado" ).click(function() {
	closeALl();
	$( this ).css( "content", "url('images/chat_privado2.png')" );
	chatSelector="chat_privado";
	 $("#chatImputerPriv").show(1000);
  $( "#ch_mensajes_privado" ).show(1000);
   $.ajax({
				data: "default="+chatSelector,
				type: "GET",
				url: "json/chatSetter.php",
			});
});
$( "#chat_clan" ).click(function() {
	closeALl();
	$( this ).css( "content", "url('images/chat_clan2.png')" );
	chatSelector="chat_clan";
  $( "#ch_mensajes_clan" ).show(1000);
  $("#chatImputer").show(1000);
  $.ajax({
				data: "default="+chatSelector,
				type: "GET",
				url: "json/chatSetter.php",
			});
});
$( "#chat_party" ).click(function() {
	closeALl();
	$( this ).css( "content", "url('images/chat_party2.png')" );
	chatSelector="chat_party";
  $( "#ch_mensajes_party" ).show(1000);
  $("#chatImputer").show(1000);
   $.ajax({
				data: "default="+chatSelector,
				type: "GET",
				url: "json/chatSetter.php",
			});
});


$( ".hablar" ).keydown(function(e) {
   if(e.which==13)
   		mandar();
});		 // allowHotKey 
	 // allowHotKey 


$( ".hablar" ).click(function() {
   allowHotKey=false;
});
$( ".hablar" ).focusout(function() {
     allowHotKey=true;
  });

});

