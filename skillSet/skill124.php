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
			insertBuff($targets['idPersonaje'],210,124,300,$log->get("pjSelected"));
		}	
				
	$msgs = "<spam class='ShamanSkill'>".$pj['nombre']." uso ".$skill['nombre']."!</spam>";
	$db->sql_query('INSERT INTO  chat(party,mensaje) 
					VALUES("'.$pj['party'].'","'.$msgs.'")');	
}
else
{
	insertBuff($pj['idPersonaje'],210,124,300,$log->get("pjSelected"));
}

$data['info'] .= textoAtaque(3,$skill['nombre']);
$data['aura'][] = array("idSkill"=>124,"lvl"=>1,"auraTimeOut"=>300,"pasive"=>0);
$data['auraRowCheck']=true;	
		
$MonsterAttackAproval=false;
?>