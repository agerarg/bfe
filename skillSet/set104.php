<?php

if($pj['Wtipo']=="bigsword")
{
	switch($aura['nivel'])
	{
		case 1:
			$pj['Ataque']=potenciar($pj['Ataque'],30);
		break;
		case 2:
			$pj['Ataque']=potenciar($pj['Ataque'],60);
		break;
		case 3:
			$pj['Ataque']=potenciar($pj['Ataque'],120);
		break;
		case 4:
			$pj['Ataque']=potenciar($pj['Ataque'],240);
		break;
	}
}
?>
