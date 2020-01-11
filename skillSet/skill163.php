<?php
$data['animation']=2;

if($pj['party']>0)
{
	$query = 'SELECT idPersonaje
			FROM personaje
			WHERE party = '.$pj['party'].'';
		$targetssq = $db->sql_query($query);
		while($targets = $db->sql_fetchrow($targetssq))
		{
			insertBuff($targets['idPersonaje'],$skill['idSkill'],163,600);
		}	
		
		$msgs = "<spam class='ShamanSkill'>".$pj['nombre']." uso ".$skill['nombre']."!</spam>";
		systemLog("party",$msgs);
					
}
else
{
	insertBuff($pj['idPersonaje'],$skill['idSkill'],163,600);
}

$data['aura'][] = array("idSkill"=>163,"lvl"=>$skill['nivel'],"auraTimeOut"=>600,"pasive"=>0);
	$data['auraRowCheck']=true;	
$data['info'] .= textoAtaque(3,$skill['nombre']);

$MonsterAttackAproval=false;

?>