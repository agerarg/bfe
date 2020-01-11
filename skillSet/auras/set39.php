<?php
//critCity
$pj['critCityShitOn'] = 1;
$pj['critCityAcumulate'] = $aura['acumuleitor'];
$pj['critCityAuraId'] = $aura['idAura'];
$pj['critNivel'] = $aura['nivel'];
switch($aura['nivel'])
{
	case 1:
		$pj['critCityLimit'] = 10;
	break;
	case 2:
		$pj['critCityLimit'] = 8;
	break;
	case 3:
		$pj['critCityLimit'] = 6;
	break;
	case 4:
		$pj['critCityLimit'] = 4;
	break;
}
?>
