<?php
//Blade Master

	if($pj['Wtipo']=="sword" OR $pj['Wtipo']=="blunt")
	{		
		switch($aura['nivel'])
		{
			case 1:
				$pj['Critico']+=2;
				$pj['Ataque'] +=50;
				$pj['Ataque'] = potenciar($pj['Ataque'],50);
			break;
			case 2:
				$pj['Critico']+=4;
				$pj['Ataque'] +=100;
				$pj['Ataque'] = potenciar($pj['Ataque'],100);
			break;
			case 3:
				$pj['Critico']+=8;
				$pj['Ataque'] +=150;
				$pj['Ataque'] = potenciar($pj['Ataque'],200);
			break;
			case 4:
				$pj['Critico']+=16;
				$pj['Ataque'] +=200;
				$pj['Ataque'] = potenciar($pj['Ataque'],400);
			break;
		}
	}
?>
