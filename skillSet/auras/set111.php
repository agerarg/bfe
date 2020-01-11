<?php

	switch($aura['nivel'])
	{
		case 1:
			$pj['Ataque']=potenciar($pj['Ataque'],60);	
			$pj['Critico']+=10;
			$pj['PC']+=20;
		break;
		case 2:
			$pj['Ataque']=potenciar($pj['Ataque'],120);	
			$pj['Critico']+=15;
			$pj['PC']+=50;
		break;
		case 3:
			$pj['Ataque']=potenciar($pj['Ataque'],240);	
			$pj['Critico']+=20;
			$pj['PC']+=100;
		break;
	}

?>
