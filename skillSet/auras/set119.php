<?php
$pj['Allow2Hand']=1;
if($_SESSION['PJITEM_Wtipo']=="blunt")
{
	switch($aura['nivel'])
	{
		case 1:
			$pj['Ataque'] = potenciar($pj['Ataque'],30);		
		break;
		case 2:
			$pj['Ataque'] = potenciar($pj['Ataque'],60);		
		break;
		case 3:
			$pj['Ataque'] = potenciar($pj['Ataque'],120);		
		break;
	}
}
?>
