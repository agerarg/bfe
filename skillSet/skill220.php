<?php
$data['animation']=0;
$fisicalCoolDown = 5;
$mixedid = intval($check['idInMundo']+$check['idPersonaje']);
if($cantidad==1 OR $pvp==1)
	{	
		$_SESSION['MarcaMuerte']=$mixedid;
		$data['info'] .= textoAtaque(3,$skill['nombre']);
		$pvpInfo .= textoAtaque(3,$skill['nombre']);
	}
	else
	{
		$data['info'] .= "Solo se puede marcar 1 objetivo.";
	}
$MonsterAttackAproval=false;
?>
