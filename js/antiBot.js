var imgCapcha=0;
var dialogoDisponible=0;
function loadCamcha()
{
	if(imgCapcha=0)
	{
		imgCapcha=1;
		$("#campcha").show();
		$("#campcha").attr('src', 'captcha.php?'+Math.random());
	}
	else
	{
		 $( "#campcha" ).fadeOut(500, function() {
			$("#campcha").show();
			$("#campcha").attr('src', 'captcha.php?'+Math.random());
		  });
	}
}
function checkBoting(data)
{
	switch(data['ok'])
	{
		case 1:
                       allowHotKey=true;
			$('#checkPoint').fadeOut(1000, function () {
				$.modal.close(); // must call this!
				userExp=data['exp'];
				setTimeout ('userExpUpdate()', 1000);
			});
		break;
		case 0:
			loadCamcha();
			 jAlert("La palabra no coincide ingreso "+data['ingresada']+" y era "+data['registrada'], 'Error!');
			$('#captLoad').hide();
			$("#palabra").val("");
			$("#palabra").focus();
			$('#captContent').fadeIn(2000);	
		break;
		case 2:
			jAlert("Esta deslogeado!", 'Error!');	
			setTimeout(function() {
						window.location = "index.php";
					}, 2000);
		break;
	}
}
function sendBotMsg()
{
	if($('#palabra').val().length>2)
	{
		dialogoDisponible=0;
		$('#captContent').hide();
			$('#captLoad').show();
			$.ajax({
						data: "palabra="+$("#palabra").val(),
						type: "GET",
						dataType: "json",
						url: "json/antiBot.php",
						success: function(data){
						checkBoting(data);
					}
					});	
	}
}
function wildAntiBot()
{
        allowHotKey=false;
	$(document).keypress(function(e) {
		if(e.which == 13) {
			sendBotMsg();
			}
		});
	loadCamcha();	
	$('#checkPoint').modal();
	dialogoDisponible=1;
	$('#goCheck').click(function() {
		sendBotMsg();
	});
}