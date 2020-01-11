<?php
	$pj['ChargeFocus']=1;
	$pj['ChargeFocusAcc']= intval($aura['acumuleitor']);	
	$pj['ChargeFocusId'] = $aura['idAura'];
	$pj['ChargeFocusLvl'] = $aura['nivel'];
	switch($aura['nivel'])
		{
			case 1:
				$pj['ChargeFocusLimit']= 2;	
			break;
			case 2:
				$pj['ChargeFocusLimit']= 3;	
			break;
			case 3:
				$pj['ChargeFocusLimit']= 4;	
			break;
			case 4:
				$pj['ChargeFocusLimit']= 5;	
			break;
		}
?>
