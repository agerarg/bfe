var nombreDelSkill="";
function checkSkill(data,id)
{
	if(!data['error'])
	{
		var i=0;
		$("#lvlupers_list").text("");
		$("#hability_title_js").text("Leveling "+data['nombre']+":");
		$("#hability_title_js").append("<br>Lvl: "+data['level']+"/"+data['levelLimit']);
		nombreDelSkill = data['nombre'];
		while(data.skillads[i])
		{
				$("#lvlupers_list").append("<div  class='hability_aspect'>" +
                	"<div class='hability_ascpet_main'><div class='hability_ascpet_nombre'>"+data.skillads[i]['nombre']+"</div>"+
					"<div class='hability_ascpet_level'>Lvl: "+data.skillads[i]['lvl']+"</div></div>"+
                    "<div class='item_mains'><div class='hability_aspect_desc'>Changes from "+data.skillads[i]['power1']+" to "+data.skillads[i]['power2']+"</div></div></div>");
			i++;
		}
		$("#lvlupers_list").append("To level up this skill is required "+data['gold']+" Adena.<br><br><a href='javascript:mejorarSkillAspect("+id+");'>Leveling Up</a><br><br>");
	}
	else
	{
		jAlert(data['error'], 'Error');
		 $("#hability_show").hide();
	 	$("#item_list").show(500);
	}
}
function learnFirstSkill(data)
{
	if(data['error'])
		jAlert(data['error'], 'Error');
	else
	{
		jAlert(data['msg'], ' Congratulations! ',function(r) {
		   window.location = "index.php?sec=habilidades";
		});
		
	}
}
function learnFristsSkillStep(id)
{
	$.ajax({
						data: "id="+id,
						type: "GET",
						dataType: "json",
						url: "json/learnFirstSkill.php",
						success: function(data){
						learnFirstSkill(data);
					}
					});	
}
function checkSkillFirst(data,id)
{
	if(data['error'])
		jAlert(data['error'], 'Error');
	else
	{
		$("#lvlupers_list").text("");
		$("#hability_title_js").text("Learn "+data['nombre']+":");
		$("#hability_title_js").append("<br>Lvl: "+data['level']+"/"+data['levelLimit']);
		//nombreDelSkill = data['nombre'];
		$("#lvlupers_list").append("To learn this skill is necessary:"+data['mesage']+"<br><br><a href='javascript:learnFristsSkillStep("+id+",1);'>Learn</a><br><br>");
	}
}
function subirNivel(id,aprender)
{
	if(id>0)
	{	
		if(aprender==1)
		{
			
			$('#item_list').slideUp('slow', function() {
				 $("#hability_show").show(500);
			});
			$("#hability_title_js").text("Loading...");
			$.ajax({
				data: "id="+id,
				type: "GET",
				dataType: "json",
				url: "json/learnCheckShit.php",
				success: function(data){
				checkSkillFirst(data,id);
			}
			});
	
		}
		else
		{
			 $('#item_list').slideUp('slow', function() {
				 $("#hability_show").show(500);
			});
			$("#hability_title_js").text("Loading...");
			$.ajax({
				data: "id="+id,
				type: "GET",
				dataType: "json",
				url: "json/mySkillAds.php",
				success: function(data){
				checkSkill(data,id);
			}
			});
		}
	}
}
function volver()
{
	 $("#hability_show").hide('fast',function() {
   			 $("#item_list").slideDown('slow');
  		});
}
function learnSkillAds(data)
{
	if(data["error"])
		jAlert(data['error'], "Error");
	else
	{
		jAlert(data['msg'], 'The skill '+nombreDelSkill+' level went up!',function(r) {
		   window.location = "index.php?sec=habilidades";
		});
	}
}
function mejorarSkillAspect(skill)
{
			$.ajax({
					data: "skill="+skill,
					type: "GET",
					dataType: "json",
					url: "json/learnSkillAds.php",
					success: function(data){
					learnSkillAds(data);
				}
				});	
}

