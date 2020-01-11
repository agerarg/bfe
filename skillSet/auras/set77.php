<?php
//
switch($aura['nivel'])
{
	case 1:
		$pj['Ataque']=potenciar($pj['Ataque'],15);	
		$pj['AtaqueMagico']=potenciar($pj['AtaqueMagico'],15);	
	break;
	case 2:
		$pj['Ataque']=potenciar($pj['Ataque'],20);	
		$pj['AtaqueMagico']=potenciar($pj['AtaqueMagico'],20);	
	break;
	case 3:
		$pj['Ataque']=potenciar($pj['Ataque'],25);	
		$pj['AtaqueMagico']=potenciar($pj['AtaqueMagico'],25);	
	break;
}


?>
