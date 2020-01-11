<?php

	switch($aura['nivel'])
	{
		case 1:
			$pj['Ataque']=potenciar($pj['Ataque'],60);	
			$pj['PSpeed']-=2;
			$pj['Critico']+=10;
			$pj['PC']+=250;
		break;
		case 2:
			$pj['Ataque']=potenciar($pj['Ataque'],120);	
			$pj['PSpeed']-=3;
			$pj['Critico']+=15;
			$pj['PC']+=300;
		break;
		case 3:
			$pj['Ataque']=potenciar($pj['Ataque'],240);	
			$pj['PSpeed']-=3;
			$pj['Critico']+=20;
			$pj['PC']+=350;
		break;
	}

?>
