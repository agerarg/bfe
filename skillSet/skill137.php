<?php
$data['animation']=0;
$fisicalCoolDown = 1;
if($pj['party']>0)
{
	$query = 'SELECT idPersonaje
			FROM personaje
			WHERE party = '.$pj['party'].'';
		$targetssq = $db->sql_query($query);
		while($targets = $db->sql_fetchrow($targetssq))
		{
			insertBuff($targets['idPersonaje'],229,137,60);
		}	
				
	$msgs = "<spam class='ShamanSkill'>".$pj['nombre']." uso ".$skill['nombre']."!</spam>";
	systemLog("party",$msgs);
}
else
{
	insertBuff($pj['idPersonaje'],229,137,60);
}
$data['aura'][] = array("idSkill"=>137,"lvl"=>1,"auraTimeOut"=>60,"pasive"=>0);
	$data['auraRowCheck']=true;	

$data['info'] .= textoAtaque(3,$skill['nombre']);


$MonsterAttackAproval=false;
?>
