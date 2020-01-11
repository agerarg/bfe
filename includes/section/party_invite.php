<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET['accept']))
	{
		
		$id = intval($_GET['accept']);	
		$query = 'SELECT subClassActive, nombre, idPersonaje, party, nivel
		FROM personaje
			WHERE idPersonaje = '.$id.'';
		$leader = $db->sql_fetchrow($db->sql_query($query));

		if($leader['subClassActive']>0)
						{
							$query_clases = 'SELECT subClassActive, nombre, idPersonaje, party, nivel
							  FROM personaje 
							  WHERE idCuenta = "'.$log->get("idCuenta").'" 
							  AND idPersonaje = '.$leader['subClassActive'].' AND desactivada =0';
							$srch_clases = $db->sql_query($query_clases);
							$leader = $db->sql_fetchrow($srch_clases);
						}

		if($leader)
		{
			$query = 'SELECT *
		FROM partyinvite
			WHERE idParty = '.$id.' AND idTarget = '.$log->get("pjSelected").'';
		$invite = $db->sql_fetchrow($db->sql_query($query));
			if($invite)
			{
					if($leader['nivel']<=($pj['nivel']+20) AND $leader['nivel']>=($pj['nivel']-20))
					{
						$query = 'SELECT count(*) as CONTA
						FROM personaje
						WHERE party = '.$id.' ';
						$ptrct = $db->sql_fetchrow($db->sql_query($query));
						$cantidad = $ptrct['CONTA'];
						if($cantidad<=5)
						{
							$db->sql_query("DELETE FROM partyinvite WHERE idParty = ".$id." AND idTarget = ".$log->get("pjSelected"));
							$msg = "Ahora estas en la party!";
							$db->sql_query("UPDATE personaje SET party = ".$id." WHERE idPersonaje = ".$log->get("pjSelected"));
							header("Location: index.php?sec=party&rewin");
							die();
						}
						else
						{
							$msg = "La party esta full!";
						}
				}
				else
				{
					$msg = "Esta party requiere ser nivel almenos ".($leader['nivel']-20)." y no mayor a ".($leader['nivel']+20)."!";
				}
			}
			else
			{
				$msg = "No fuiste invitado!";
			}
			
		}
		else
		{
			$msg = "La party no existe!";
		}
		show_error($msg,"index.php");
	}
else
if($pj['party']==$log->get("pjSelected"))
{
	$template->set_filenames(array(
		'content' => 'templates/sec/party_invite.html' )
	);
	$template->assign_var('INVITEPIBE',false);

	if(isset($_GET['force']))
	{
		$idForce = (int)$_GET['force'];
		$query = 'SELECT subClassActive, nombre, idPersonaje, party
						FROM personaje
						WHERE idPersonaje = "'.$idForce.'" AND desactivada=0 ';

		$target = $db->sql_fetchrow($db->sql_query($query));

		if($target['subClassActive']>0)
						{
							$query_clases = 'SELECT subClassActive,idPersonaje, nombre, idPersonaje, party
							  FROM personaje 
							  WHERE idPersonaje = '.$target['subClassActive'].' AND desactivada =0';
							$srch_clases = $db->sql_query($query_clases);
							$target = $db->sql_fetchrow($srch_clases);
						}
						
		if($target)
						{
							if($stats['dimension']==2)
							{
								$msg = "No se puede invitar en un evento!";
							}
							else
							{
								if($target['party']==0)
								{
									$Info = "<div class='ptChInv'>".$pj['nombre']." te invita a hacer un equipo</div><a href='index.php?sec=partyInvite&accept=".$log->get("pjSelected")."'>Aceptar Party de ".$pj['nombre']."</a>";									
									$db->sql_query("INSERT INTO partyinvite (idParty,idTarget) 
													VALUES('".$log->get("pjSelected")."','".$target['idPersonaje']."')");	
									
									$db->sql_query('INSERT INTO  chat(idPersonaje,mensaje) 
												VALUES("'.$target['idPersonaje'].'"," '.$Info.'")');
									$msg = $target['nombre']." fue invitado!";
									$template->assign_var('INVITEPIBE',$target['idPersonaje']);
								}   
								else
								{
									$msg = $target['nombre']." ya esta en una party!";
								}
							}
						}
						else
						{
							$msg = "El personaje ".$nombre." no existe!";
						}

		systemLog("self",$msg);	
		
		
	}


	if(isset($_POST['invite']))
	{
		$nombre = textIntoSql($_POST['nick']);
		$nombre = str_replace(" ","",$nombre);
		$query = 'SELECT subClassActive, nombre, idPersonaje, party
						FROM personaje
						WHERE nombre = "'.$nombre.'" AND desactivada=0 AND SubClassFrom=0';

						$target = $db->sql_fetchrow($db->sql_query($query));

						if($target['subClassActive']>0)
						{
							$query_clases = 'SELECT subClassActive,idPersonaje, nombre, idPersonaje, party
							  FROM personaje 
							  WHERE idPersonaje = '.$target['subClassActive'].' AND desactivada =0';
							$srch_clases = $db->sql_query($query_clases);
							$target = $db->sql_fetchrow($srch_clases);
						}

						if($target)
						{
							if($stats['dimension']==2)
							{
								$msg = "No se puede invitar en un evento!";
							}
							else
							{
								if($target['party']==0)
								{
									$Info = "<div class='ptChInv'>".$pj['nombre']." te invita a hacer un equipo</div><a href='index.php?sec=partyInvite&accept=".$log->get("pjSelected")."'>Aceptar Party de ".$pj['nombre']."</a>";									
									$db->sql_query("INSERT INTO partyinvite (idParty,idTarget) 
													VALUES('".$log->get("pjSelected")."','".$target['idPersonaje']."')");	
									
									$db->sql_query('INSERT INTO  chat(idPersonaje,mensaje) 
												VALUES("'.$target['idPersonaje'].'"," '.$Info.'")');
									$msg = $target['nombre']." fue invitado!";
									$template->assign_var('INVITEPIBE',$target['idPersonaje']);
								}   
								else
								{
									$msg = $target['nombre']." ya esta en una party!";
								}
							}
						}
						else
						{
							$msg = "El personaje ".$nombre." no existe!";
						}

		systemLog("self",$msg);				
		

	}
	$query = 'SELECT p.realDPS, p.nivel, p.nombre,c.STYLE, c.imagen, p.sexo, p.attackCooldown, p.idPersonaje
	FROM personaje p JOIN clase c USING ( idClase ) JOIN partyinvite pai ON pai.idParty = '.$pj['party'].'
	WHERE pai.idTarget = p.idPersonaje ORDER BY pai.idInvite DESC';
$partymemsq = $db->sql_query($query);
		while($partymem = $db->sql_fetchrow($partymemsq))
		{
			$template->assign_block_vars('INVITES', array(
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
else
{
	show_error("No sos lider de party","index.php?sec=party");

}

?> 