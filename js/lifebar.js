function lifebar(vida,vida_limit,imgvida,imgdead,velocidad) {
	var per=0;
	per = vida / vida_limit;
	per = per*100;
	per=per;
	vida=0;
	vida_limit=0;
	for(i=0;i<100;i++)
	{
		(per > i)?(vida++):(vida_limit++);
	}
	$("#"+imgvida).animate({
		width: vida,
	  }, velocidad );
		
	$("#"+imgdead).animate({
		width: vida_limit,
	  }, velocidad );
}
function lifebar2(vida,vida_limit,imgvida,imgdead,velocidad) {
	var per=0;
	per = vida / vida_limit;
	per = per*300;
	per=per;
	vida=0;
	vida_limit=0;
	for(i=0;i<300;i++)
	{
		(per > i)?(vida++):(vida_limit++);
	}
	$("#"+imgvida).animate({
		width: vida,
	  }, velocidad );
		
	$("#"+imgdead).animate({
		width: vida_limit,
	  }, velocidad );
}
function setVida()
{
	lifebar(userVida,userVidaLimit,"userVida","userDead",0);
	$("#userLifeBar").attr("title","Life: "+userVida+"/"+userVidaLimit);
	$("#LifeNumber").text(userVida+"/"+userVidaLimit);
}
function setMana()
{
	lifebar(userMana,userManaLimit,"userMana","userManaOff",0);
	$("#userManaBar").attr("title","Mana: "+userMana+"/"+userManaLimit);
	$("#ManaNumber").text(userMana+"/"+userManaLimit);
}
function setExp()
{
	lifebar(userExp,userExpLimit,"userExp","userExpOff",0);
	$("#userExpBar").attr("title","Exp: "+userExp+"/"+userExpLimit);
                var porcent=0;
                if(userExp>0)
                    var porcent = ((userExp/userExpLimit)*100);
                else
                   var porcent = 0;
		$("#ExpNumber").text(porcent.toFixed(2)+"%");
}

function userVidaUpdate()
{
	if(userVida>userVidaLimit)
	userVida=userVidaLimit;
	lifebar(userVida,userVidaLimit,"userVida","userDead",1500);
	$("#userLifeBar").attr("title","Life: "+userVida+"/"+userVidaLimit);
	$("#LifeNumber").text(userVida+"/"+userVidaLimit);
}
function userManaUpdate()
{
	if(userMana>userManaLimit)
	userMana=userManaLimit;
	lifebar(userMana,userManaLimit,"userMana","userManaOff",1500);
	$("#userManaBar").attr("title","Mana: "+userMana+"/"+userManaLimit);
	$("#ManaNumber").text(userMana+"/"+userManaLimit);
}
function userLvlUp(data)
{
	if(data['changes'])
	{
		if(partBoludo<=6 && partBoludo!=0)
			if(data['nivel']>=5)
			{
				disableBoludo=false;
				setTimeout(function(){showBoludo("parte11.jpg");}, 1000);
			}
		if(partBoludo==10)
			if(data['nivel']>=10)
			{
				disableBoludo=false;
				setTimeout(function(){showBoludo("parte13.jpg");}, 1000);
			}
		$('#pj_nivel').text('Lvl: '+data['nivel']);
		userExp =data['exp'];
		userExpLimit = data['expUp'];
		userVida = data['VidaLimit'];
		userVidaLimit = data['VidaLimit'];
		userMana= data['ManaLimit'];
		userManaLimit = data['ManaLimit'];
		userVidaUpdate();
		userManaUpdate();
		userExpUpdate();
	}
}
function userExpUpdate()
{
	if(userExp>=userExpLimit)
	{
		$.ajax({
				data: "",
				type: "GET",
				dataType: "json",
				url: "json/lvlup.php",
				success: function(data){
				userLvlUp(data);
			}
			});
	}
	else
	{
		lifebar(userExp,userExpLimit,"userExp","userExpOff",1500);
		$("#userExpBar").attr("title","Exp: "+userExp+"/"+userExpLimit);
                var porcent=0;
                if(userExp>0)
                    var porcent = ((userExp/userExpLimit)*100);
                else
                   var porcent = 0;
		$("#ExpNumber").text(porcent.toFixed(2)+"%");
	}
}