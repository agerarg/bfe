runaText = (idRuna,Level)=>{
	let desc="NO DESC! runa:"+idRuna+" lvl:"+Level;
	let value=0;
	idRuna=parseInt(idRuna);
	Level=parseInt(Level);
	switch(idRuna)
	{
		case 578:
			switch(Level)
			{
				case 2:
		            value=5;
		        break;
		        case 3:
		            value=7;
		        break;
		        case 4:
		            value=10;
		        break;
		        case 5:
		            value=12;
		        break;  	
				case 6:
					value=15;
				break;
				case 7:
					value=20;
				break;	
				case 8:
					value=25;
				break;
				case 9:
					value=30;
				break;
				case 10:
					value=35;
				break;			
			}
			desc="Incrementa "+value+"% de ataque total";
		break;
		case 579:
			switch(Level)
			{
				case 2:
		            value=1;
		        break;
		        case 3:
		            value=1;
		        break;
		        case 4:
		            value=2;
		        break;
		        case 5:
		            value=2;
		        break;			
				case 6:
					value=3;
				break;
				case 7:
					value=4;
				break;	
				case 8:
					value=5;
				break;
				case 9:
					value=6;
				break;
				case 10:
					value=7;
				break;			
			}
			desc="Incrementa +"+value+" la velocidad de ataque";
		break;
		case 580:
			switch(Level)
			{
				case 2:
		            value=1;
		        break;
		        case 3:
		            value=1;
		        break;
		        case 4:
		            value=2;
		        break;
		        case 5:
		            value=2;
		        break;		
				case 6:
					value=3;
				break;
				case 7:
					value=4;
				break;	
				case 8:
					value=5;
				break;
				case 9:
					value=6;
				break;
				case 10:
					value=7;
				break;			
			}
			desc="Incrementa +"+value+" la velocidad de casteo";
		break;
		case 581:
			switch(Level)
			{
				case 2:
		            value=2;
		        break;
		        case 3:
		            value=3;
		        break;
				case 4:
					value=4;
				break;
				case 5:
					value=6;
				break;		
				case 6:
					value=8;
				break;
				case 7:
					value=10;
				break;	
				case 8:
					value=12;
				break;
				case 9:
					value=25;
				break;
				case 10:
					value=30;
				break;			
			}
			desc="Reduce el cooldown de habilidades un "+value+"%";
		break;
		case 582:
			switch(Level)
			{
				case 2:
		            value=10;
		        break;
		        case 3:
		            value=12;
		        break;
				case 4:
					value=15;
				break;
				case 5:
					value=20;
				break;		
				case 6:
					value=25;
				break;
				case 7:
					value=30;
				break;	
				case 8:
					value=35;
				break;
				case 9:
					value=40;
				break;
				case 10:
					value=50;
				break;			
			}
			desc="Incrementa el daño en criticos +"+value+"%";
		break;
		case 583:
			switch(Level)
			{
				case 2:
		            value=20;
		        break;
		        case 3:
		            value=25;
		        break;  
				case 4:
					value=50;
				break;
				case 5:
					value=100;
				break;		
				case 6:
					value=150;
				break;
				case 7:
					value=200;
				break;	
				case 8:
					value=250;
				break;
				case 9:
					value=300;
				break;
				case 10:
					value=400;
				break;			
			}
			desc="Incrementa el daño de tu mascota un +"+value+"%";
		break;
		case 584:
			switch(Level)
			{
				case 2:
		            value=5;
		        break;
		         case 3:
		            value=7;
		        break;
		        case 4:
		            value=10;
		        break;
				case 5:
					value=12;
				break;		
				case 6:
					value=15;
				break;
				case 7:
					value=20;
				break;	
				case 8:
					value=25;
				break;
				case 9:
					value=30;
				break;
				case 10:
					value=40;
				break;			
			}
			desc="Incrementa el daño contra monstruos campeones en "+value+"%";
		break;
		case 585:
			switch(Level)
			{
				case 2:
		            value=5;
		        break;
		        case 3:
		            value=6;
		        break;
		        case 4:
		            value=8;
		        break;
		        case 5:
		            value=10;
		        break;		
				case 6:
					value=15;
				break;
				case 7:
					value=20;
				break;	
				case 8:
					value=25;
				break;
				case 9:
					value=30;
				break;
				case 10:
					value=40;
				break;			
			}
			desc="Incrementa el daño contra monstruos "+value+"%";
		break;
		case 586:
			switch(Level)
			{
				case 2:
		            value=2;
		        break;
		        case 3:
		            value=5;
		        break;
				case 4:
					value=10;
				break;
				case 5:
					value=15;
				break;		
				case 6:
					value=20;
				break;
				case 7:
					value=25;
				break;	
				case 8:
					value=30;
				break;
				case 9:
					value=40;
				break;
				case 10:
					value=50;
				break;			
			}
			desc=""+value+"% de golpear doble en un ataque basico";
		break;
		case 587:
			switch(Level)
			{
				case 2:
		            value=2;
		        break;
		        case 3:
		            value=5;
		        break;
				case 4:
					value=10;
				break;
				case 5:
					value=15;
				break;		
				case 6:
					value=20;
				break;
				case 7:
					value=25;
				break;	
				case 8:
					value=30;
				break;
				case 9:
					value=40;
				break;
				case 10:
					value=50;
				break;			
			}
			desc="Incrementa el elemento Dark en "+value+"%";
		break;
		case 588:
			switch(Level)
			{
				 case 2:
		            value=2;
		        break;
		        case 3:
		            value=5;
		        break;
				case 4:
					value=10;
				break;
				case 5:
					value=15;
				break;		
				case 6:
					value=20;
				break;
				case 7:
					value=25;
				break;	
				case 8:
					value=30;
				break;
				case 9:
					value=40;
				break;
				case 10:
					value=50;
				break;			
			}
			desc="Incrementa el elemento Earth en "+value+"%";
		break;
		case 589:
			switch(Level)
			{
				 case 2:
		            value=2;
		        break;
		        case 3:
		            value=5;
		        break;
				case 4:
					value=10;
				break;
				case 5:
					value=15;
				break;		
				case 6:
					value=20;
				break;
				case 7:
					value=25;
				break;	
				case 8:
					value=30;
				break;
				case 9:
					value=40;
				break;
				case 10:
					value=50;
				break;			
			}
			desc="Incrementa el elemento Fire en "+value+"%";
		break;
		case 590:
			switch(Level)
			{
				case 2:
		            value=2;
		        break;
		        case 3:
		            value=5;
		        break;
				case 4:
					value=10;
				break;
				case 5:
					value=15;
				break;		
				case 6:
					value=20;
				break;
				case 7:
					value=25;
				break;	
				case 8:
					value=30;
				break;
				case 9:
					value=40;
				break;
				case 10:
					value=50;
				break;			
			}
			desc="Incrementa el elemento Holy en "+value+"%";
		break;
		case 591:
			switch(Level)
			{
				case 2:
		            value=2;
		        break;
		        case 3:
		            value=5;
		        break;
				case 4:
					value=10;
				break;
				case 5:
					value=15;
				break;		
				case 6:
					value=20;
				break;
				case 7:
					value=25;
				break;	
				case 8:
					value=30;
				break;
				case 9:
					value=40;
				break;
				case 10:
					value=50;
				break;			
			}
			desc="Incrementa el elemento Water en "+value+"%";
		break;
		case 592:
			switch(Level)
			{
				case 2:
		            value=2;
		        break;
		        case 3:
		            value=5;
		        break;
				case 4:
					value=10;
				break;
				case 5:
					value=15;
				break;		
				case 6:
					value=20;
				break;
				case 7:
					value=25;
				break;	
				case 8:
					value=30;
				break;
				case 9:
					value=40;
				break;
				case 10:
					value=50;
				break;			
			}
			desc="Incrementa el elemento Wind en "+value+"%";
		break;
		case 593:
			switch(Level)
			{
				case 2:
		            value=40;
		        break;
		        case 3:
		            value=45;
		        break;
				case 4:
					value=50;
				break;
				case 5:
					value=60;
				break;		
				case 6:
					value=70;
				break;
				case 7:
					value=80;
				break;	
				case 8:
					value=90;
				break;
				case 9:
					value=100;
				break;
				case 10:
					value=110;
				break;			
			}
			desc="Incrementa la defensa de escudo en "+value+"%";
		break;
		case 594:
			switch(Level)
			{
				case 2:
		            value=2;
		        break;
		        case 3:
		            value=3;
		        break;
				case 4:
					value=4;
				break;
				case 5:
					value=6;
				break;		
				case 6:
					value=8;
				break;
				case 7:
					value=10;
				break;	
				case 8:
					value=12;
				break;
				case 9:
					value=15;
				break;
				case 10:
					value=20;
				break;			
			}
			desc="Incrementa evasion "+value+"%";
		break;
		case 595:
			switch(Level)
			{
				case 2:
		            value=10;
		        break;
		        case 3:
		            value=13;
		        break; 
				case 4:
					value=15;
				break;
				case 5:
					value=20;
				break;		
				case 6:
					value=25;
				break;
				case 7:
					value=30;
				break;	
				case 8:
					value=35;
				break;
				case 9:
					value=40;
				break;
				case 10:
					value=50;
				break;			
			}
			desc="Incrementa experiencia obtenida un "+value+"%";
		break;
		case 596:
			switch(Level)
			{
				case 2:
		            value=10;
		        break;
		        case 3:
		            value=12;
		        break;
				case 4:
					value=15;
				break;
				case 5:
					value=20;
				break;		
				case 6:
					value=25;
				break;
				case 7:
					value=30;
				break;	
				case 8:
					value=35;
				break;
				case 9:
					value=40;
				break;
				case 10:
					value=50;
				break;			
			}
			desc="Incrementa el oro obtenido un "+value+"%";
		break;
		case 597:
			switch(Level)
			{
				case 2:
		            value=5;
		        break;
		        case 3:
		            value=7;
		        break;
		        case 4:
		            value=10;
		        break;
		        case 5:
		            value=12;
		        break;		
				case 6:
					value=15;
				break;
				case 7:
					value=20;
				break;	
				case 8:
					value=25;
				break;
				case 9:
					value=30;
				break;
				case 10:
					value=35;
				break;			
			}
			desc="Incrementa "+value+"% el ataque magico total";
		break;
		case 598:
			switch(Level)
			{
				case 2:
		            value=2;
		        break;
		        case 3:
		            value=4;
		        break;
		        case 4:
		            value=6;
		        break;
		        case 5:
		            value=8;
		        break;		
		        case 6:
		            value=10;
		        break;
		        case 7:
		            value=12;
		        break;	
		        case 8:
		            value=15;
		        break;
		        case 9:
		            value=17;
		        break;
		        case 10:
		            value=20;
		        break;				
			}
			desc="Incrementa la chance de critico magico un +"+value+"%";
		break;
		case 599:
			switch(Level)
			{
				case 2:
		            value=8;
		        break;
		        case 3:
		            value=12;
		        break;
				case 4:
					value=15;
				break;
				case 5:
					value=20;
				break;		
				case 6:
					value=25;
				break;
				case 7:
					value=30;
				break;	
				case 8:
					value=35;
				break;
				case 9:
					value=40;
				break;
				case 10:
					value=50;
				break;			
			}
			desc="Incrementa el daño en critico magico un +"+value+"%";
		break;
		case 600:
			switch(Level)
			{
				case 2:
		            value=15;
		        break;
		        case 3:
		            value=20;
		        break;  
				case 4:
					value=25;
				break;
				case 5:
					value=50;
				break;		
				case 6:
					value=75;
				break;
				case 7:
					value=100;
				break;	
				case 8:
					value=125;
				break;
				case 9:
					value=150;
				break;
				case 10:
					value=200;
				break;			
			}
			desc="Incrementa la regeneración de mana +"+value+"";
		break;
		case 601:
			switch(Level)
			{
				case 2:
		            value=10;
		        break;
		        case 3:
		            value=12;
		        break;
		        case 4:
		            value=15;
		        break;
		        case 5:
		            value=17;
		        break;	
				case 6:
					value=20;
				break;
				case 7:
					value=25;
				break;	
				case 8:
					value=30;
				break;
				case 9:
					value=35;
				break;
				case 10:
					value=40;
				break;			
			}
			desc="Reduce el "+value+"% de daño en PvP";
		break;
		case 602:
			switch(Level)
			{
				case 2:
		            value=6;
		        break;
		        case 3:
		            value=8;
		        break;
				case 4:
					value=10;
				break;
				case 5:
					value=15;
				break;		
				case 6:
					value=20;
				break;
				case 7:
					value=25;
				break;	
				case 8:
					value=30;
				break;
				case 9:
					value=35;
				break;
				case 10:
					value=40;
				break;			
			}
			desc="Un "+value+"% del daño recibido de monstruos es consumido en mana.";
		break;
		case 603:
			switch(Level)
			{
				case 2:
		            value=50;
		        break;
		         case 3:
		            value=75;
		        break;
				case 4:
					value=100;
				break;
				case 5:
					value=150;
				break;		
				case 6:
					value=200;
				break;
				case 7:
					value=250;
				break;	
				case 8:
					value=300;
				break;
				case 9:
					value=350;
				break;
				case 10:
					value=400;
				break;			
			}
			desc="Te curas +"+value+" de vida cuando pegas golpes basicos.";
		break;
		case 604:
			switch(Level)
			{
				case 2:
		            value=10;
		        break;
		        case 3:
		            value=15;
		        break;
				case 4:
					value=20;
				break;
				case 5:
					value=25;
				break;		
				case 6:
					value=30;
				break;
				case 7:
					value=35;
				break;	
				case 8:
					value=40;
				break;
				case 9:
					value=45;
				break;
				case 10:
					value=50;
				break;			
			}
			desc="Aumenta "+value+"% de vida.";
		break;
		case 605:
			switch(Level)
			{
				case 2:
		            value=15;
		        break;
		        case 3:
		            value=20;
		        break;
				case 4:
					value=25;
				break;
				case 5:
					value=50;
				break;		
				case 6:
					value=75;
				break;
				case 7:
					value=100;
				break;	
				case 8:
					value=125;
				break;
				case 9:
					value=150;
				break;
				case 10:
					value=200;
				break;			
			}
			desc="Incrementa la regeneración de vida +"+value+"";
		break;
		case 612:
			switch(Level)
			{
				case 2:
		            value=3;
		        break;
		        case 3:
		            value=5;
		        break;
		        case 4:
		            value=7;
		        break;
		        case 5:
		            value=10;
		        break;		
		        case 6:
		            value=12;
		        break;
		        case 7:
		            value=15;
		        break;	
		        case 8:
		            value=17;
		        break;
		        case 9:
		            value=20;
		        break;
		        case 10:
		            value=25;
		        break;			
			}
			desc="Incrementa el critico +"+value+"";
		break;
	}
	return desc;
}