<?php
		$per= intval(($CurrentVida * 100) / $pj['VidaLimit']);
		$reverse = 100-$per;
		$inmortality = $reverse;
	$bonus=0;
	
	$pj['AngerOn']=1;
	if($inmortality>1)
	{
switch($aura['nivel'])
{
	case 1:
		$bonus=$inmortality*5;
		$pj['Ataque']+=intval($bonus);
	break;
	case 2:
		$bonus=$inmortality*10;
		$pj['Ataque']+=intval($bonus);
	break;
	case 3:
		$bonus=$inmortality*20;
		$pj['Ataque']+=intval($bonus);
	break;
	case 4:
		$bonus=$inmortality*40;
		$pj['Ataque']+=intval($bonus);
	break;
}
	}
	$pj['AngerBonus']=intval($bonus);
	$pj['AngerLvl']=$aura['nivel'];
?>
