<?php
//
switch($aura['nivel'])
{
	case 1:
		$pj['Ataque']+=50;
		$pj['Ataque']=potenciar($pj['Ataque'],25);	
	break;
	case 2:
		$pj['Ataque']+=100;
		$pj['Ataque']=potenciar($pj['Ataque'],50);	
	break;
}
?>
