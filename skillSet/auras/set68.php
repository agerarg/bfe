<?php
if($pj['shieldDef']>0)
{
	$pj['inmortalityShitOn'] = 1;
	$pj['inmortalityAcumulate'] = $aura['acumuleitor'];
	$pj['inmortalityAuraId'] = $aura['idAura'];
	switch($aura['nivel'])
	{
		case 1:
			$pj['inmortalityLvl'] = 1;
		break;
		case 2:
			$pj['inmortalityLvl'] = 2;
		break;
	}
}
?>
