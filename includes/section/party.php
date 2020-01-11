<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
$template->set_filenames(array(
	'content' => 'templates/sec/party.html' )
);
if(isset($_GET['rewin']))
	{
		$template->assign_var('GETOUTFROMMYPT',1);
	}
if($pj['party']==0)
{
	if(isset($_GET['crear']))
		{
			$db->sql_query("UPDATE personaje SET party = ".$log->get("pjSelected")." WHERE idPersonaje = ".$log->get("pjSelected"));
			$msg = " Creaste una party!";
			systemLog("self",$msg);	
			header("Location: index.php?sec=party");
			die();
		}
}
else
{
	if(isset($_GET['salir']))
		{
						if($pj['party']==$pj['idPersonaje'])
						{
							$db->sql_query("UPDATE personaje SET party = 0 WHERE party = ".$log->get("pjSelected"));
							$db->sql_query("DELETE FROM partyinvite WHERE idParty = ".$log->get("pjSelected"));
							$msg = " La party fue desmantelada!";
						}
						else
						{
						$db->sql_query("UPDATE personaje SET party = 0 WHERE idPersonaje = ".$log->get("pjSelected"));
							$msg = " Saliste de la party";
					}
					systemLog("self",$msg);	
					header("Location: index.php?sec=party&rewin");
			die();
		}
}
if($pj['party']==$log->get("pjSelected"))
{
	if(isset($_GET['kick']))
	{
			$id=intval($_GET['kick']);
				$query = 'SELECT nombre, idPersonaje, party
				FROM personaje
				WHERE party = '.$pj['party'].' AND idPersonaje = '.$id ;
				$target = $db->sql_fetchrow($db->sql_query($query));
				if($target)
				{
						/// CHECK RAIDS
						$query = 'SELECT id
				FROM mundo
				WHERE clan = '.$pj['party'].' AND warTime > '.time().'  AND tipo="raid"' ;
				$raid = $db->sql_fetchrow($db->sql_query($query));
				if($raid)
				{
					$msg = " No se puede echar de party cuando estas en un Raid Boss!";
					systemLog("self",$msg);
				}
				else
				{
						$Info = "<div class='ptChExp'>".$pj['nombre']." te expulso de la party.</div>";
						$db->sql_query("UPDATE personaje SET party = 0 WHERE idPersonaje = ".$target['idPersonaje']);
						$db->sql_query('INSERT INTO  chat(idPersonaje,mensaje) 
									VALUES("'.$target['idPersonaje'].'"," '.$Info.'")');
						$msg = $target['nombre']." ya fue removido de la party!";
						systemLog("self",$msg);
						$template->assign_var('GETOUTFROMMYPT',1);
				}
						
						
				}
				else
				{
					$msg = "Este personaje no esta en la party!";
						systemLog("self",$msg);
				}
				
	}

	$template->assign_var('INSIGNIA',"<img src='images/leader.png' />");
}
	if($pj['party']>0)
	{
		$template->assign_var('SHOWPARTY',"");
		$template->assign_var('SHOWPARTYBUTON',"GTFO");
		$query = 'SELECT p.realDPS, p.nivel, p.nombre,c.STYLE, c.imagen, p.sexo, p.attackCooldown, p.idPersonaje
					FROM personaje p JOIN clase c USING ( idClase )
					WHERE p.party = '.$pj['party'].'';
		$partymemsq = $db->sql_query($query);
						while($partymem = $db->sql_fetchrow($partymemsq))
						{
							$leaderKicl="";
							if($pj['party']==$log->get("pjSelected") && $partymem['idPersonaje']!=$pj['party'])
								$leaderKicl = '- <a href="index.php?sec=party&kick='.$partymem['idPersonaje'].'">Kick</a>';
							

							if($pj['party']==$partymem['idPersonaje'])
								$leaderDist = "<img src='images/leader.png' />";
							else
								$leaderDist = "";	
								
							$template->assign_block_vars('PARTY', array(
									'NOMBRE' => $partymem['nombre']." ".$leaderDist,
									'NOMBRELINK'=> $partymem['nombre'],
									'IMG' => $partymem['imagen'],
									'ID' => $partymem['idPersonaje'],
									'STAT' => $statu,
									'ROL' => $partymem['STYLE'],
									'DPS' => $partymem['realDPS'],
									'ACTIVO' => $active,
									'KICK' => $leaderKicl,
									'SEXO' => $partymem['sexo'],
									'LVL' =>  $partymem['nivel']));	
						}
					}
?> 