<?php
//Special Ability
	switch($item['grado'])
	{
		case 3:
		case 4:
			$defensa+= 50;
		break;
		case 5:
		case 6:
			$defensa+= 100;
			$pj['ShieldRate']+=10;
		break;
		case 7:
			$defensa+= 100;
			$pj['ShieldRate']+=15;
		break;
		case 8:
			$defensa+= 150;
			$pj['ShieldRate']+=20;
		break;
			case 9:
			$defensa+= 200;
			$pj['ShieldRate']+=25;
		break;
			case 10:
			$defensa+= 250;
			$pj['ShieldRate']+=30;
		break;
		case 11:
			$defensa+= 300;
			$pj['ShieldRate']+=35;
		break;
		case 12:
			$defensa+= 350;
			$pj['ShieldRate']+=40;
		break;
	}
?>
