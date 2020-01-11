<?php
	$pj['AuraSwordPike']=1;
	$pj['AuraSwordPikeId']=$aura['idAura'];
	$pj['AuraSwordPikeAcc']=$aura['acumuleitor'];
	if($aura['acumuleitor']>0)
	{
		//$pj['Ataque'] = potenciar($pj['Ataque'],$aura['acumuleitor']*25);
		//$pj['Critico'] += $pj['Critico']*$aura['acumuleitor'];
		$pj['PC'] += 50*$aura['acumuleitor'];
	}




?>
