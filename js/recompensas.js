
function loadRecomensasDone(data)
{
	$("#Recompensas_list").text("");
	let i=0;
	let arr = data['b'];
	while(arr[i])
	{
		switch(arr[i]['especial'])
		{
			case "1":
				$("#Recompensas_list").append("<div id='Recompensas_id"+arr[i]['idBox']+"' class='Recompensas_box'><div>Cofre del Comandante</div>"+
			'<div><img class="Recompensas_icon" onclick="boxOpening('+arr[i]['idBox']+');" src="images/boxes/santa_close.png" width="101" height="87"></div>'+
			'<a href="javascript:boxDestroying('+arr[i]['idBox']+');">Eliminar</a></div>');
			break;
			default:
				$("#Recompensas_list").append("<div id='Recompensas_id"+arr[i]['idBox']+"' class='Recompensas_box'><div>Cofre Nivel "+arr[i]['nivel']+"</div>"+
			'<div><img class="Recompensas_icon" onclick="boxOpening('+arr[i]['idBox']+');" src="images/boxes/tier'+arr[i]['tier']+'_close.png" width="101" height="87"></div>'+
			'<a href="javascript:boxDestroying('+arr[i]['idBox']+');">Eliminar</a></div>');
			break;
			
		}

		i++;
	}
}
function loadRecomensas()
{
	 $.ajax({
        data: "",
        type: "GET",
        dataType: "json",
        url: "json/boxList.php",
        success: function(data){
        loadRecomensasDone(data);
      }
      });
}

$(document).ready(function(){ 

		loadRecomensas();

});