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
			insertBuff($targets['idPersonaje'],108,66,1200,$log->get("pjSelected"));
		}	
				
	$msgs = "<spam class='ShamanSkill'>".$pj['nombre']." uso ".$skill['nombre']."!</spam>";
	$db->sql_query('INSERT INTO  chat(party,mensaje) 
					VALUES("'.$pj['party'].'","'.$msgs.'")');	
}
else
{
	insertBuff($pj['idPersonaje'],108,66,1200,$log->get("pjSelected"));
}
$data['aura'][] = array("idSkill"=>66,"lvl"=>$skill['nivel'],"auraTimeOut"=>1200,"pasive"=>0);
	$data['auraRowCheck']=true;	
$data['info'] .= textoAtaque(3,$skill['nombre']);

$MonsterAttackAproval=false;

?>

