<?php
$data['animation']=2;
$fisicalCoolDown = $stats['CSpeed'];

if(isset($_GET['target']))
{
	$target = intval($_GET['target']);
	switch($skill['nivel'])
	{
		case 1:
			$heal= intval(($stats['AtaqueMagico']*0.8)+1000);
		break;
		case 2:
			$heal= intval(($stats['AtaqueMagico']*1.5)+2000);
		break;
	}
if($stats['TargetHealDmg']>0)
	$heal=potenciar($heal,$stats['TargetHealDmg']);	
	
if($stats['DDHeal'])
	$heal=$heal*2;
//////////// HEAL CRITICAL /////////
	$critical_chanse = mt_rand(1,100);
	if($stats['CriticoMagico'] > $critical_chanse)
	{
		$heal = critical($heal,$stats['PCMagico']);
		$criticolo="(Critical)";
	}
	else
	{
		$heal = normal($heal);
	}
//////////// END HEAL CRITICAL /////////

	if($pj['party']>0)
	{
		$query = 'SELECT nombre, idPersonaje, party
				FROM personaje
					WHERE party = '.$pj['party'].'  AND idPersonaje = '.$target.'';
		$tarrdgud = $db->sql_fetchrow($db->sql_query($query));
		if($tarrdgud)
		{
			$doHeal=true;
			if($stats['Agresion']==1)
			{
				$query = 'SELECT nombre, idPersonaje, party
				FROM personaje
					WHERE party = '.$pj['party'].' AND Vida>0 AND idPersonaje = '.$stats['AgresionId'].'';
				$tarrd = $db->sql_fetchrow($db->sql_query($query));
				if($tarrd)
				{
				$db->sql_query("UPDATE personaje SET Vida = (Vida+".$heal.")  WHERE  idPersonaje = '".$tarrd['idPersonaje']."'");
				$msgs = "<spam class='healSkill'>".$pj['nombre']." curo a ".$tarrd['nombre']."(Hate) por ".$heal.$criticolo." de vida!</spam>";
				systemLog("party",$msgs);
				$data['info'] .= "".$skill['nombre']." curo a ".$tarrd['nombre']." por ".$heal.$criticolo." de vida";
				$doHeal=false;
				}
				else
					$doHeal=true;
			}
			else if($stats['confusion']==1 AND mt_rand(1,100)<50)
			{
				$query = 'SELECT idPersonaje
									FROM personaje 
								WHERE idPersonaje != '.$pj['idPersonaje'].' AND location = '.$check['mundo'].' AND party = '.$pj['party'].' AND
								 Vida > 0 ORDER BY RAND() LIMIT 1';
				$tarrd = $db->sql_fetchrow($db->sql_query($query));
				if($tarrd)
				{
					$db->sql_query("UPDATE personaje SET Vida = (Vida+".$heal.")  WHERE  idPersonaje = '".$tarrd['idPersonaje']."'");
					$msgs = "<spam class='healSkill'>".$pj['nombre']." curo a ".$tarrd['nombre']."(Confusion) por ".$heal.$criticolo."de vida!</spam>";
					systemLog("party",$msgs);
					$data['info'] .= "".$skill['nombre']." curo a ".$tarrd['nombre']." por ".$heal.$criticolo." de vida";
					$doHeal=false;
				}
				else
					$doHeal=true;
			}
			
			
			if($doHeal)
			{
				if($tarrdgud['idPersonaje']==$pj['idPersonaje'])
					$vidaModifier += $heal;
				else
					$db->sql_query("UPDATE personaje SET Vida = (Vida+".$heal.")  WHERE  idPersonaje = ".$tarrdgud['idPersonaje']."");
				
				$msgs = "<spam class='healSkill'>".$pj['nombre']." curo a ".$tarrdgud['nombre']." por ".$heal.$criticolo." de vida!</spam>";
				systemLog("party",$msgs);
				$data['info'] .= "".$skill['nombre']." curo a ".$tarrd['nombre']." por ".$heal.$criticolo."";
			}
		}
		else
		{
			$data['info'] .= "".$skill['nombre']." no se encontro el objetivo!";	
		}
	}
	else
	{
		$vidaModifier += $heal;
		$data['info'] .= "".$skill['nombre']." te curo ".$heal."";
	}
}
else
{
	$data['info'] .= "".$skill['nombre']." no se encontro el objetivo!";	
}
$heal=0;
		
$MonsterAttackAproval=false;
?>