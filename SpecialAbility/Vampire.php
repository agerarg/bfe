<?php
//Special Ability
	switch($item['grado'])
	{
		case 3:
		case 4:
			$pj['VampireStance']+= 50;
		break;
		case 5:
		case 6:
			$pj['VampireStance']+= 80;
		break;
		case 7:
			$pj['VampireStance']+= 120;
		break;
		case 8:
			$pj['VampireStance']+= 160;
		break;
		case 9:
			$pj['VampireStance']+= 180;
		break;
		case 10:
			$pj['VampireStance']+= 200;
		break;
		case 11:
			$pj['VampireStance']+= 250;
		break;
		case 12:
			$pj['VampireStance']+= 300;
		break;
	}
?>
