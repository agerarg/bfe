

const char_clases = [
	{
	  id:1,
	  nombre:"Zombie Tank",
	  imagen:"zombie_tank",
	},
	{
	  id:2,
	  nombre:"Dark Mage",
	  imagen:"skeleton_mage",
	},
	{
	  id:3,
	  nombre:"Ninja",
	  imagen:"ninja",
	},
	{
	  id:4,
	  nombre:"Marksman",
	  imagen:"marksman",
	},
	{
	  id:5,
	  nombre:"Shaman",
	  imagen:"shaman",
	},
	{
	  id:6,
	  nombre:"Vampire",
	  imagen:"vampire",
	},
	{
	  id:7,
	  nombre:"Destroyer",
	  imagen:"destroyer",
	},
	{
	  id:8,
	  nombre:"Cleric",
	  imagen:"cleric",
	}, 
	{
	  id:10,
	  nombre:"Garca",
	  imagen:"garca",
	}, 
	{
	  id:10,
	  nombre:"Garca",
	  imagen:"garca",
	}
	];
  
  const char_tops = [
	{
	  nombre:"El que hace más daño (DPS)",
	  key:"DPS",
	  show:" DPS:"
	},
	{
	  nombre:"Mejor Armados (Gear)",
	  key:"GEAR",
	  show:" Gear:"
	},
	{
	  nombre:"Rift Paragon más altos (Rift)",
	  key:"RIFT",
	  show:" Rift:"
	},
	{
	  nombre:"Los más ricos (Oro)",
	  key:"GOLD",
	  show:" Oro:"
	},
	{
	  nombre:"Los más viciosos (Nivel)",
	  key:"LVL",
	  show:" Lvl:"
	},
	{
	  nombre:"Los más Peleadores (PvP)",
	  key:"PVP",
	  show:" Pvp:"
	},
	{
	  nombre:"Los más Asesinos (PK)",
	  key:"PK",
	  show:" Pk:"
	}
	];  
  
  getEle=(id)=>{
	return document.getElementById(id);
  } 
  elegirTop=()=>{
  
	  var CC_showTops =  getEle('CC_showTops');
	  var to = getEle('TOPtops');
	  let i=0;
	  to.innerHTML = "";
		while(char_tops[i])
		{
		  to.insertAdjacentHTML('beforeend', '<div onClick="elegirClase('+i+')" class="CC_elegir">'+char_tops[i]['nombre']+'</div>');
		  i++;
		}
		CC_showTops.style.display="block";
  }
  volverATops=()=>{
	var showClasses = getEle('CC_showClases'); 
	showClasses.style.display="none";
	var el = getEle('CC_ShowPlayers');
		el.style.display = "none";
	elegirTop();
  
  }
  elegirClase=(id)=>{
	var CC_showTops = getEle('CC_showTops');
	CC_showTops.style.display="none";
	var to = getEle('TOPoptions');
	var showClasses = getEle('CC_showClases');  
	to.innerHTML = "";
	if(id===0)
	{
		let i=0;
		to.insertAdjacentHTML('beforeend', '<div onClick="volverATops()" class="CC_elegir">Volver a Tops</div>');
		while(char_clases[i])
		{
			if(i!=8)
		  to.insertAdjacentHTML('beforeend', '<div onClick="loadTop(0,'+char_clases[i]['id']+')" class="CC_elegir"><div><img width="25" src="images/clases/minii_'+char_clases[i]['imagen']+'_1.png" /><img width="25" src="images/clases/minii_'+char_clases[i]['imagen']+'_0.png" /></div><div>'+char_clases[i]['nombre']+'</div></div>');
		  i++;
		}
		showClasses.style.display = 'block';
	}
	else
	{
	  to.insertAdjacentHTML('beforeend', '<div onClick="volverATops()" class="CC_elegir">Volver a Tops</div>');
	  showClasses.style.display = 'block';
	  loadTop(id);
	}
  
  }
  document.addEventListener("DOMContentLoaded",function(){
	elegirTop();
  });


  doneTop=(data,id)=>{

	var top = getEle('TOPplayerList');
	top.innerHTML = "";
	let i=0;
	let saying=char_tops[id]['show'];
	let idClase =0 ;
	let imagen=0;
		if(data)
		while(data[i])
		{
			idClase = parseInt(data[i]['idClase'])-1;
			imagen = '<img width="25" src="images/clases/minii_'+char_clases[idClase]['imagen']+'_'+data[i]['sexo']+'.png" />';
			top.insertAdjacentHTML('beforeend', '<div class="TopPlayerBlock">N°'+data[i]['topn']+' '+saying+''+data[i]['valor']+' por '+imagen+' <a target="_blank" href="index.php?sec=ver&pj='+data[i]['nombre']+'">'+data[i]['nombre']+'</a></div>');
			i++;
		}
  }


 loadTop =(id,dps)=>
	{
		
		var el = getEle('CC_ShowPlayers');
		el.style.display = "block";

		var to = getEle('TOPoptions');
	  to.innerHTML = "";
		to.insertAdjacentHTML('beforeend', '<div onClick="volverATops()" class="CC_elegir">Volver a Tops</div>');
		let tipo="";
		if(dps>0)
			tipo= "DPS"+dps;
		else
		tipo= char_tops[id]['key'];

		$.ajax({
			data: "tipo="+tipo,
			type: "GET",
			dataType: "json",
			url: "json/topPlayer.php",
			success: function(data){
			doneTop(data,id);
		}
		});
	}