<?php
//Special Ability
	switch($item['grado'])
	{
		case 3:
		case 4:
			$pj['VidaLimit']+= 600;
		break;
		case 5:
		case 6:
			$pj['VidaLimit']+= 1200;
			$pj['Defensa']+=10;
			$pj['VampireStance']+=20;
		break;
		case 7:
			$pj['VidaLimit']+= 1800;
			$pj['Defensa']+=20;
			$pj['VampireStance']+=30;
		break;
		case 8:
			$pj['VidaLimit']+= 2500;
			$pj['Defensa']+=35;
			$pj['VampireStance']+=35;
		break;
		case 9:
			$pj['VidaLimit']+= 3000;
			$pj['Defensa']+=40;
			$pj['VampireStance']+=40;
		break;
		case 10:
			$pj['VidaLimit']+= 4000;
			$pj['Defensa']+=50;
			$pj['VampireStance']+=50;
		break;
		case 11:
			$pj['VidaLimit']+= 5000;
			$pj['Defensa']+=60;
			$pj['VampireStance']+=60;
		break;
		case 12:
			$pj['VidaLimit']+= 6000;
			$pj['Defensa']+=70;
			$pj['VampireStance']+=70;
		break;
	}
?>
