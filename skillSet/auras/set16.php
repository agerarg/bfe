<?php
//Soul Capsule
$pj['soulGain'] = $pj['soulGain']+1;
$pj['soulShitOn'] = 1;
$pj['soulAcumulate'] = $aura['acumuleitor'];
$pj['soulAuraId'] = $aura['idAura'];
$pj['soulLvl'] = $aura['nivel'];
switch($aura['nivel'])
{
	case 1:
		$pj['soulContainer'] = 50;
	break;
	case 2:
		$pj['soulContainer'] = 100;
	break;
	case 3:
		$pj['soulContainer'] = 150;
	break;
	case 4:
		$pj['soulContainer'] = 200;
	break;
}
?>
