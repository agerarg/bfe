	function callMakeWorld(data)
	{
		var i=0;
		var j=0;
		dynPosX=data['ourX'];
		dynPosY=data['ourY'];
		$("#world").text("");
		for (i = 0; i <= mapLimit; i++) { 
			for (j = 0; j <= mapLimit; j++) { 
				if(data.ground)
				{
					if(data.ground[i+"_"+j])
					{
						var arr = data['ground'][i+"_"+j];
						$("#world").append("<div class='slotG libreG "+arr['tipo']+"' id='"+i+"_"+j+"'></div>");	
					}
					else
					{
						$("#world").append("<div class='slotG libreG "+base+"' id='"+i+"_"+j+"'></div>");	
					}
					if(data.ground[i+"_"+j+"obj"])
					{
						var arr = data['ground'][i+"_"+j+"obj"];
						if(arr['funct']=="build")
							$("#"+i+"_"+j).append("<img class='"+arr['funct']+"' id='"+i+"p"+j+"' idTerra='"+arr['idTerra']+"' src='images/building/"+arr['tipo']+".png'>");	
						else
							$("#"+i+"_"+j).append("<img class='"+arr['funct']+"' id='"+i+"p"+j+"' idTerra='"+arr['idTerra']+"' src='images/objets/"+arr['tipo']+".png' width='40' height='40'>");	
						//$("#"+i+"_"+j).removeClass("libre");
					}
				//$("#world").append("<div class='slotG libreG "+base+"' id='"+i+"_"+j+"'>"+i+"_"+j+"</div>");	
					
				/*if(dynPosY-i>=worldDimencion-5 || dynPosX-j>=worldDimencion-5 || dynPosX-j<-6 || dynPosY-i<-6)
					$("#"+i+"_"+j).attr('class', 'endOfMap slotG');	*/
				}
			}
			$("#world").append("<div class='slotEnd'></div>");
		}
	}
    function makeWorld()
	{
		$.ajax({
					data: "",
					type: "GET",
					dataType: "json",
					url: "json/worldInfo.php",
					success: function(data){
					callMakeWorld(data);
				}
				});
	}
function move()
{
	if(movePj)
	{
		frames++;
		if(frames==7)
		{
			frames=0;
			movePx=0;
		}
		else
			movePx-=64;
		$('#pj').find('img').css('margin-left', movePx);
	}
	else
	{
		movePx=0;
		$('#pj').find('img').css('margin-left', 0);
	}
	setTimeout(function() {
			move();
			}, 150);
}
function moveGetDone(data)
{
	var i=0;
	var j=0;
	keyLock=true;
	dynPosX=data['ourX'];
	dynPosY=data['ourY'];
	freeMovement=true;
	
	for (i = 0; i <= mapLimit; i++) { 
		for (j = 0; j <= mapLimit; j++) { 
			if(data.ground)
			{
				if(data.ground[i+"_"+j])
				{
					var arr = data['ground'][i+"_"+j];
					$("#"+i+"_"+j).attr('class', 'slotG libreG '+arr['tipo']);
					$("#"+i+"_"+j).text("");
				}
				else
				{
					$("#"+i+"_"+j).attr('class', 'slotG libreG '+base);
					$("#"+i+"_"+j).text("");
				}
				if(data.ground[i+"_"+j+"obj"])
				{
					var arr = data['ground'][i+"_"+j+"obj"];
					$("#"+i+"_"+j).text("");
					if(arr['funct']=="monster")
							$("#"+i+"_"+j).append("<img class='"+arr['funct']+"' id='"+i+"p"+j+"' src='images/monster/"+monsterImg+".png'>");	
						else
							$("#"+i+"_"+j).append("<img class='"+arr['funct']+"' id='"+i+"p"+j+"' idTerra='"+arr['idTerra']+"' src='images/objets/"+arr['tipo']+".png' width='40' height='40'>");	
				}
				
			}
			else
			{
					$("#"+i+"_"+j).text("");
					$("#"+i+"_"+j).attr('class', 'slotG libreG '+base);
					
			}
			//$("#"+i+"_"+j).text((dynPosX+i));
			
			/*if(dynPosY-i>=worldDimencion-5 || dynPosX-j>=worldDimencion-5 || dynPosX-j<-6 || dynPosY-i<-6)
					$("#"+i+"_"+j).attr('class', 'endOfMap slotG');*/
		}
	}
}
function refreshWorld(data)
	{
		freeMovement=false;
		if(data['error']==0)
		{
			freeMovement=false;
			switch(data['move'])
			{
				case 'left':
					$('#entorno').animate( { scrollLeft: '-=40', }, 1000, function() {
						$('#entorno').animate( { scrollLeft: '+=40', }, 0);
						movePj=false;
						 moveGetDone(data);
					   });
				break;
				case 'right':
					$('#entorno').animate( { scrollLeft: '+=40', }, 1000, function() {
					$('#entorno').animate( { scrollLeft: '-=40', }, 0);
					 moveGetDone(data);
					movePj=false;
				   });
				break;
				case 'up':
					$('#entorno').animate( { scrollTop: '-=40', }, 1000, function() {
						$('#entorno').animate( { scrollTop: '+=40', }, 0);
					 moveGetDone(data);
					movePj=false;
				   });
				break;
				case 'down':
					$('#entorno').animate( { scrollTop: '+=40', }, 1000, function() {
						$('#entorno').animate( { scrollTop: '-=40', }, 0);
					 moveGetDone(data);
					movePj=false;
				   });
				break;
			}
		}
		else
		{
			if(data['fightMode']==1)
			{
				fightStart();
			}
			else
			{
				new Messi(data['eco'], {title: 'Error',titleClass: 'anim error',buttons: [{id: 0, label: 'Cerrar', val: 'X'}], callback: function() { 
					freeMovement=true;
					keyLock=true; 
				}});
			}
			movePj=false;
		}
	}	
function interact(X,Y,move)
{
		keyLock=false;
		if(freeMovement)
		{
			$.ajax({
						data: "",
						type: "GET",
						dataType: "json",
						url: "json/move.php?move="+move,
						success: function(data){
						refreshWorld(data);
					}
					});
		}
}
function startWorld()
{
		makeWorld();
}
var keypressCheck=0;
$(document).ready(function(){	
	$(document).keypress(function( event ) {
		if(keyLock)
		{
		  if ( event.which == 119 ) /// UP
		  { 
				movePj=true;
				keyLock=false;
				interact(ourPositionX,ourPositionY-1,"up");
		  
		  }
		  if ( event.which == 97 ) /// LEFT
		  { 
			movePj=true;
			keyLock=false;
			interact(ourPositionX-1,ourPositionY,"left");
		  }
		   if ( event.which == 100 ) /// RIGHT
		  { 
			movePj=true;
			keyLock=false;
			interact(ourPositionX+1,ourPositionY,"right");
		  }
		  if ( event.which == 115 ) /// DOWN
		  { 
			movePj=true;
			keyLock=false;
			interact(ourPositionX,ourPositionY+1,"down");
		  }
	}
	});
	
  });