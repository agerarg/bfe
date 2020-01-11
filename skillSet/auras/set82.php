<?php
//
$pj['SedSangre']=1;
switch($aura['nivel'])
{
	case 1:
		$pj['VampireStance']+=50;
		$pj['Ataque']=potenciar($pj['Ataque'],20);
	break;
	case 2:
		$pj['VampireStance']+=100;
		$pj['Ataque']=potenciar($pj['Ataque'],40);
	break;
	case 3:
		$pj['VampireStance']+=200;
		$pj['Ataque']=potenciar($pj['Ataque'],80);
	break;
	case 4:
		$pj['VampireStance']+=300;
		$pj['Ataque']=potenciar($pj['Ataque'],150);
	break;
	case 5:
		$pj['VampireStance']+=500;
		$pj['Ataque']=potenciar($pj['Ataque'],250);
	break;
}
?>
