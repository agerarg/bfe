<?php
$data['animation']=0;
$fisicalCoolDown = 1;
$now = tiempoReal();
$idSkill=512;
$idSkillReal=365;
$time=30;
if($pj['party']>0)
{
	$query = 'SELECT idPersonaje
			FROM personaje
			WHERE party = '.$pj['party'].'';
		$targetssq = $db->sql_query($query);
		while($targets = $db->sql_fetchrow($targetssq))
		{			
			$db->sql_query("DELETE FROM aura WHERE idSkillReal = '".$idSkillReal."' AND idPersonaje = ".$targets['idPersonaje']."");
			
			$db->sql_query('INSERT INTO  aura(idPersonaje,idSkill,static,idSkillReal,timeOut,extraData) 
			VALUES("'.$targets['idPersonaje'].'","'.$idSkill.'","0","'.$idSkillReal.'",'.($now+$time).','.$mixedid.')');
			
		}	
				
	$msgs = "<spam class='ShamanSkill'>".$pj['nombre']." uso ".$skill['nombre']."!</spam>";
	systemLog("party",$msgs);				
}
else
{
	$db->sql_query('INSERT INTO  aura(idPersonaje,idSkill,static,idSkillReal,timeOut,extraData) 
			VALUES("'.$pj['idPersonaje'].'","'.$idSkill.'","0","'.$idSkillReal.'",'.($now+$time).','.$mixedid.')');
}
$data['aura'][] = array("idSkill"=>365,"lvl"=>$skill['nivel'],"auraTimeOut"=>30,"pasive"=>0);
	$data['auraRowCheck']=true;	
$data['info'] .= textoAtaque(3,$skill['nombre']);


$MonsterAttackAproval=false;
?>
