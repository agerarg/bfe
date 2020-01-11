<?php
$data['animation']=0;
$fisicalCoolDown = 1;
if($pj['party']>0)
{
	$query = 'SELECT idPersonaje
			FROM personaje
			WHERE party = '.$pj['party'].' AND (idClase = 5 OR idClase = 7)';
		$targetssq = $db->sql_query($query);
		while($targets = $db->sql_fetchrow($targetssq))
		{
			insertBuff($targets['idPersonaje'],209,123,60);
		}	
				
	$msgs = "<spam class='ShamanSkill'>".$pj['nombre']." uso ".$skill['nombre']."!</spam>";
	$db->sql_query('INSERT INTO  chat(party,mensaje) 
					VALUES("'.$pj['party'].'","'.$msgs.'")');	
}
else
{
	if($pj['idClase']==5)
		insertBuff($pj['idPersonaje'],209,123,60);
}
$data['aura'][] = array("idSkill"=>123,"lvl"=>$skill['nivel'],"auraTimeOut"=>60,"pasive"=>0);
	$data['auraRowCheck']=true;	
$data['info'] .= textoAtaque(3,$skill['nombre']);


$MonsterAttackAproval=false;
	
?>
