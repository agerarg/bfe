<?php

if($pj['Wtipo']=="bigsword")
{
	switch($aura['nivel'])
	{
		case 1:
			$pj['Ataque']=potenciar($pj['Ataque'],10);
		break;
		case 2:
			$pj['Ataque']=potenciar($pj['Ataque'],30);
		break;
		case 3:
			$pj['Ataque']=potenciar($pj['Ataque'],70);
		break;
		case 4:
			$pj['Ataque']=potenciar($pj['Ataque'],100);
		break;
	}
}
?>
