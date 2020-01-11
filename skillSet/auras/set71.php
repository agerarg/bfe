<?php
//Revive
switch($aura['nivel'])
{
	case 1:
		$pj['Defensa'] = $pj['Defensa']-intval(($pj['Defensa']/100)*15);
		$pj['Ataque'] = $pj['Ataque']-intval(($pj['Ataque']/100)*15);
		$pj['AtaqueMagico'] = $pj['AtaqueMagico']-intval(($pj['AtaqueMagico']/100)*15);
	break;
}
?>
