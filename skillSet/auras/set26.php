<?php
//
switch($aura['nivel'])
{
	case 1:
		$pj['Critico']+=2;
		$pj['PC']+=10;
		$pj['Ataque']=potenciar($pj['Ataque'],20);
	break;
	case 2:
		$pj['Critico']+=4;
		$pj['PC']+=15;
		$pj['Ataque']=potenciar($pj['Ataque'],40);
	break;
	case 3:
		$pj['Critico']+=6;
		$pj['PC']+=20;
		$pj['Ataque']=potenciar($pj['Ataque'],80);
	break;
	case 4:
		$pj['Critico']+=8;
		$pj['PC']+=25;
		$pj['Ataque']=potenciar($pj['Ataque'],160);
	break;
}

?>
