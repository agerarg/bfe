<?php
//heal mana
$pj['mStrikeShitOn'] = 1;
switch($aura['nivel'])
{
	case 1:
		$pj['manaHealStr'] = intval(($pj['ManaLimit']/100)*3);
	break;
	case 2:
		$pj['manaHealStr'] = intval(($pj['ManaLimit']/100)*5);
	break;
}
?>
