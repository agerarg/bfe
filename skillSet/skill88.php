<?php
$data['animation']=0;
$fisicalCoolDown = 1;
$ataque_player=1;
$data['info'] .= textoAtaque(3,$skill['nombre']);

if($pj['party']>0)
{
	$query = 'SELECT idPersonaje
			FROM personaje
			WHERE party = '.$pj['party'].'';
		$targetssq = $db->sql_query($query);
		while($targets = $db->sql_fetchrow($targetssq))
		{
			insertBuff($targets['idPersonaje'],$skill['idSkill'],88,1200);
		}	
				
	$msgs = "<spam class='ShamanSkill'>".$pj['nombre']." use ".$skill['nombre']."!</spam>";
	$db->sql_query('INSERT INTO  chat(party,mensaje) 
					VALUES("'.$pj['party'].'","'.$msgs.'")');	
}
else
{
	insertBuff($pj['idPersonaje'],$skill['idSkill'],88,1200);
}
														
$data['aura'][] = array("idSkill"=>88,"lvl"=>$skill['nivel'],"auraTimeOut"=>1200,"pasive"=>0);
$data['auraRowCheck']=true;	
$MonsterAttackAproval=false;
?>
