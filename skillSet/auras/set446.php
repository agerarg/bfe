<?php
	$pj['AuraComboMastery']=1;
	$pj['AuraComboMasteryId']=$aura['idAura'];
	$pj['AuraComboMasteryAcc']=$aura['acumuleitor'];
	if($aura['acumuleitor']>0)
	{
		$pj['Ataque'] = potenciar($pj['Ataque'],$aura['acumuleitor']*25);
		$pj['Critico'] += 5*$aura['acumuleitor'];
		$pj['PC'] += 25*$aura['acumuleitor'];
	}




?>
