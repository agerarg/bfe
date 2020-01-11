
<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
if($pj["SubClassFrom"]==0)
{
	$query = 'SELECT *
					FROM clan WHERE idClan = '.$pj["clan"].'';
	$lidersq = $db->sql_query($query);
	$lidercheck = $db->sql_fetchrow($lidersq);
if($lidercheck)
{
	$template->assign_var('CLAN_ADMIN', '<a href="index.php?sec=clanmanage">Clan</a>- 
   		 <a href="index.php?sec=clanmanage&ver=peticiones">Invitar</a> - 
         <a href="index.php?sec=clanmanage&ver=miembros">Miembros</a> - 
         <a href="index.php?sec=clanShop">Tienda</a>');
	
	$id = $lidercheck['idClan'];
	$template->assign_var('NOMBRECLAN', $lidercheck['nombre']);
	$template->assign_var('PUNTOS', $lidercheck['puntos_fijo']);
$template->assign_var('RUNZ', $lidercheck['nivel']);
      $template->assign_var('POSO', $lidercheck['posoOro']);


$medallas="";
					if($clan['Cseal'])
						$medallas.='<img title="Grado C" src="images/clan/mdC.png" />';
					if($clan['Bseal'])
						$medallas.='<img title="Grado B" src="images/clan/mdB.png" />';
					if($clan['Aseal'])
						$medallas.='<img title="Grado A" src="images/clan/mdA.png" />';
					if($clan['Sseal'])
						$medallas.='<img title="Grado S" src="images/clan/mdS.png" />';
					if($clan['Xseal'])
						$medallas.='<img title="Grado X" src="images/clan/mdX.png" />';
					if(strlen ($medallas)<5)
						$medallas="Ninguna.";
					$template->assign_var('MEDALLAS', $medallas);	

		switch($_GET['ver'])
		{
                       case 'runz': 
					   /*
                        if(isset($_GET['go']))
                       {
                         if($lidercheck['idLeader']==$pj["idPersonaje"])
			 {
                          if($pj['inRunz']==0)
{
                 if($lidercheck['posoOro']>=100)
            {               
                   $db->sql_query("UPDATE clan SET posoOro= (posoOro-100) WHERE idClan= '".$lidercheck['idClan']."'");
                           $db->sql_query("DELETE FROM dungeon_instance WHERE clan= '".$lidercheck['idClan']."'");
                             $query = 'SELECT idPersonaje FROM personaje 
					WHERE clan = '.$lidercheck['idClan'].' AND nivel>=40 ';
		             $membersq = $db->sql_query($query);
                              while($member = $db->sql_fetchrow($membersq))
				{
                                     insertBuff($member['idPersonaje'],246,147,600);
                                }
                            $db->sql_query("UPDATE personaje SET inDungeon = 1, inRunz = 1 WHERE clan= '".$lidercheck['idClan']."' AND nivel>=40");
                            $db->sql_query('INSERT INTO  dungeon_instance(idDungeon,idParte,clan) 
										VALUES(9,29,"'.$lidercheck['idClan'].'")'); 
                               
                          $query = 'SELECT max(idInstance) AS ID FROM dungeon_instance WHERE clan= '.$lidercheck['idClan'].'';	
					$itemsq = $db->sql_query($query);
					$maxId = $db->sql_fetchrow($itemsq);
	
					$query = 'SELECT idMonster,m.VidaLimit, db.cantidad
							FROM monster m JOIN dungeon_board db USING ( idMonster )
							WHERE db.idParte = 29';
							$monster = $db->sql_query($query);
							while($chor = $db->sql_fetchrow($monster))
							{	
								for($i=0;$i<$chor['cantidad'];$i++)
								{
									$vida=$chor['VidaLimit'];
									$db->sql_query('INSERT INTO  inmundo(idMonster,tipo,mundo,currentLife,champion,dificulty,idInstance) 
											VALUES("'.$chor['idMonster'].'","2",
											1,"'.$vida.'",0,'.$stats['dificultyLvl'].','.$maxId['ID'].')');
								}
										
							} 
                systemLog("clan","<div class=runzAnun>El clan inicio Runz Infernal</div>",$lidercheck['idClan']);		
                   show_message("Runz Infernales han comenzado!","index.php?sec=mundo");	
}
else
     show_error("El clan no tiene suficiente oro","index.php?sec=clanmanage");
}
else
 show_error("Ya estas en el Runz","index.php?sec=mundo");
                             
                         }
                          else
                            show_error("Solo el l��der de clan puede iniciar los Runz","index.php?sec=clanmanage");
                       }
                       else
                       show_message("Para ingresar a Runz Infernales se requiere 100k de oro del tesoro de clan.<br>Todos los miembros del clan lvl 40 o mayor participan en el evento.<br><a href='index.php?sec=clanmanage&ver=runz&go=1'>Hacer Runz</a>","index.php?sec=clanmanage");	
						*/
                      break;
			default:
			$query = 'SELECT idMisionOn
						FROM misiononplayer
						WHERE idPersonaje = "'.$pj['idPersonaje'].'" AND idMision = 28 AND finalizado=0';
			$questsq = $db->sql_query($query);
			$quest = $db->sql_fetchrow($questsq);
				if($quest)
				{
					$db->sql_query("UPDATE personaje SET
						exp = (exp+2000)
					  WHERE idPersonaje  = '".$pj['idPersonaje']."'");
					
					$db->sql_query("UPDATE misiononplayer SET
						finalizado = 1
					  WHERE idMisionOn  = '".$quest['idMisionOn']."'");
					  
					$msg = "<div class='questEnd'>Clan Experience finalizado!</div>";
					$msg .= "<div class='questDrop'>
					+2000 exp
					</div>";
					systemLog("self",$msg);
					show_message("Clan Quest Completed! <br>Ganaste 2000 exp ",
					"index.php?sec=clanmanage");	
				}
			$template->assign_var('NIVEL',$lidercheck['nivel']);
			
			$query = 'SELECT count(*) as CONTA 
									  FROM personaje WHERE clan = '.$id.' AND SubClassFrom=0 ';
							$count = $db->sql_fetchrow($db->sql_query($query));
							$filas = $count['CONTA'];
				$template->assign_var('CANTIDAD',$filas);

				$MAXCantidad = 6;

				$template->assign_var('LIMITE',$MAXCantidad);
				
				
				if($quest)
					$template->assign_var('CLANQUEST0',"<div><a href='index.php?sec=clanmanage&quest'>Completar la mision: Clan Experience</a> </div>");
			

				$query = 'SELECT p.*,c.nombre AS CLASE ,c.imagen FROM personaje p JOIN clase c USING ( idClase ) 
				WHERE p.clan = '.$id.' AND SubClassFrom=0 ORDER BY nivel ';
					$membersq = $db->sql_query($query);
						while($member = $db->sql_fetchrow($membersq))
						{	
							$template->assign_block_vars('M', array(
													'NOMBRE' => $member['nombre'],
													'IMG' =>  $member['imagen'].'_'.$member['sexo'].'.jpg',
													'LVL' =>  $member['nivel'],	
													'CLASE' => $member['CLASE'],	
													'CLANPGAIN' => $member['clanpvp']
													));
						}	

				$template->set_filenames(array(
										'content' => 'templates/sec/clanMg.html' )
									);
			break;
                        
			case 'salir':
			if($lidercheck['idLeader']==$pj["idPersonaje"])
			{
					if(isset($_GET['acept']))
					{
						$db->sql_query("UPDATE clan SET members=1, activo=0 WHERE idClan = '".$lidercheck['idClan']."'");
						
						$db->sql_query("DELETE FROM misiononplayer WHERE idPersonaje = '".$pj['idPersonaje']."' AND idMision=5");
						
						$db->sql_query("UPDATE personaje SET clan=0, contribucionClan=0, inviteRight=0 WHERE clan = '".$lidercheck['idClan']."'");					
						show_message("Ya no sos del clan  '".$lidercheck['nombre']."'!",
					"index.php?sec=clan");				
					}
				else
					show_message("Estas seguro de destruir el clan '".$lidercheck['nombre']."'?<br>
					<a href='index.php?sec=clanmanage&ver=salir&acept'>Salir</a>",
					"index.php?sec=clanmanage");		
			}
			else
			{
				if(isset($_GET['acept']))
					{
						$db->sql_query("UPDATE clan SET members=(members-1) WHERE idClan = '".$lidercheck['idClan']."'");
						$db->sql_query("UPDATE personaje SET contribucionClan=0, clan=0, inviteRight=0 WHERE 
							idPersonaje = '".$pj["idPersonaje"]."' OR SubClassFrom = '".$pj["idPersonaje"]."'");

						show_message("Ya no sos del clan '".$lidercheck['nombre']."'!",
					"index.php?sec=clan");				
					}
				else
					show_message("Estas seguro de salir del clan '".$lidercheck['nombre']."'?<br>
					<a href='index.php?sec=clanmanage&ver=salir&acept'>Salir</a>",
					"index.php?sec=clanmanage");		
			}		
			break;		
			case 'peticiones':
			if($pj["inviteRight"]==1)		
			{	


				if(isset($_GET['force']))
				{
					$idForce = (int)$_GET['force'];
					$nombre = textIntoSql($_POST['invite']);
					$query = 'SELECT idPersonaje, clan, nombre
						  FROM personaje
						  WHERE idPersonaje = "'.$idForce.'" AND desactivada=0';
					$srMember = $db->sql_query($query);
					$player = $db->sql_fetchrow($srMember);
					
					if($player)
					{ 
						if($player['clan']==0)
						{
							$msg = "<div class=clanInvite>El clan (".$lidercheck['nombre'].") te invito a unirte.</div><div class=clanInvite><a href='index.php?sec=clanmanage&join=".$lidercheck['idClan']."'>Clic aqui para unirse al clan ".$lidercheck['nombre'].".</a></div>";
							systemLog("other",$msg,$player['idPersonaje']);
							show_message("La invitación fue enviada a ".$player['nombre']."","index.php?sec=clanmanage&ver=peticiones");
							$db->sql_query('INSERT INTO clan_request (idClan,idPersonaje) 
												VALUES("'.$id.'","'.$player['idPersonaje'].'")');	
							
							
						}
						else
							show_error($nombre." ya tiene un clan!","index.php?sec=clanmanage&ver=peticiones");	
					}
					else
						show_error("Personaje no encontrado!","index.php?sec=clanmanage&ver=peticiones");
				}
				else
				{


				if($_POST['invite'])
				{
					$nombre = textIntoSql($_POST['invite']);
					$query = 'SELECT idPersonaje, clan, nombre
						  FROM personaje
						  WHERE nombre = "'.$nombre.'" AND desactivada=0 AND SubClassFrom=0';
					$srMember = $db->sql_query($query);
					$player = $db->sql_fetchrow($srMember);
					
					if($player)
					{ 
						if($player['clan']==0)
						{
							$msg = "<div class=clanInvite>El clan (".$lidercheck['nombre'].") te invito a unirte.</div><div class=clanInvite><a href='index.php?sec=clanmanage&join=".$lidercheck['idClan']."'>Clic aqui para unirse al clan ".$lidercheck['nombre'].".</a></div>";
							systemLog("other",$msg,$player['idPersonaje']);
							show_message("La invitación fue enviada a ".$player['nombre']."","index.php?sec=clanmanage&ver=peticiones");
							$db->sql_query('INSERT INTO clan_request (idClan,idPersonaje) 
												VALUES("'.$id.'","'.$player['idPersonaje'].'")');	
							
							
						}
						else
							show_error($nombre." ya tiene un clan!","index.php?sec=clanmanage&ver=peticiones");	
					}
					else
						show_error("Personaje no encontrado!","index.php?sec=clanmanage&ver=peticiones");	
				}
				else
				{
				 	$template->set_filenames(array(
										'content' => 'templates/sec/clanMgPetitions.html' )
									);
				}
			}
			}
			else
				show_error("Hay que tener permisos para ver aca.","index.php?sec=clanmanage");
			break;
			case 'kick':
				$id = intval($_GET['id']);
				if($lidercheck['idLeader']==$pj["idPersonaje"])
				{
					$query = 'SELECT *
					FROM personaje WHERE idPersonaje = '.$id.' AND clan = '.$lidercheck['idClan'].'';
					$memberrq = $db->sql_query($query);
					$member = $db->sql_fetchrow($memberrq);
					if($member)
						if($lidercheck['idLeader']!=$id)
						{
							show_message("Member '".$member['nombre']."' kicked from the clan!","index.php?sec=clanmanage&ver=miembros");
							$db->sql_query("UPDATE clan SET members=(members-1) WHERE idClan = '".$lidercheck['idClan']."'");
							$db->sql_query("UPDATE personaje SET contribucionClan=0, clan=0, inviteRight=0 WHERE 
							idPersonaje = '".$member["idPersonaje"]."' OR SubClassFrom = '".$member["idPersonaje"]."'");
						}
						else
							show_error("No podes remover tus propios permisos -.-.","index.php?sec=clanmanage");
					else
						show_error("Este jugador no esta en el clan.","index.php?sec=clanmanage");
				}
				else
					show_error("No tenes permisos para ver aca.","index.php?sec=clanmanage");
			break;
			case 'right':
				$id = intval($_GET['id']);
				if($lidercheck['idLeader']==$pj["idPersonaje"])
				{
					$query = 'SELECT *
					FROM personaje WHERE idPersonaje = '.$id.' AND clan = '.$lidercheck['idClan'].' AND SubClassFrom = 0';
					$memberrq = $db->sql_query($query);
					$member = $db->sql_fetchrow($memberrq);
					if($member)
						if($lidercheck['idLeader']!=$id)
						{
							if($member["inviteRight"]==0)
							{
								show_message("El miembro '".$member['nombre']."' ahora puede invitar!","index.php?sec=clanmanage&ver=miembros");
								$db->sql_query("UPDATE personaje SET inviteRight=1 WHERE idPersonaje = '".$member['idPersonaje']."'");
							}
							else
							{
								show_message("El miembro '".$member['nombre']."' ahora no puede invitar!","index.php?sec=clanmanage&ver=miembros");
								$db->sql_query("UPDATE personaje SET inviteRight=1 WHERE idPersonaje = '".$member['idPersonaje']."'");
							}
						}
						else
							show_error("No te podes echar vos mismo o-O!","index.php?sec=clanmanage");
					else
						show_error("Este jugador no esta en el clan.","index.php?sec=clanmanage");
				}
				else
					show_error("No tenes permisos para ver aca.","index.php?sec=clanmanage");
			break;
			case 'miembros':
			$template->set_filenames(array(
									'content' => 'templates/sec/clanMgMiembros.html' )
								);
			define('PATH_USERS', '?sec=clanmanage&ver=miembros&');
						 define('PAGINAS', 10);
						$page_number = intval($_GET['page']);
						if( $page_number == 0 ) 
						{ 
							$page_number = 1;
						}
						$query = 'SELECT count(*) as CONTA 
								  FROM personaje WHERE clan = '.$id.' AND SubClassFrom=0 ';
						$count = $db->sql_fetchrow($db->sql_query($query));
						$filas = $count['CONTA'];
						$numeracion = NumerarPaginas($page_number, $filas, PATH_USERS, $limitbottom, PAGINAS);
						$template->assign_var('CANTIDAD', $filas);
					$query = 'SELECT p.*,c.nombre AS CLASE ,c.imagen FROM personaje p JOIN clase c USING ( idClase )
					WHERE p.clan = '.$id.' AND SubClassFrom=0 LIMIT '.$limitbottom.', '.PAGINAS;
							$membersq = $db->sql_query($query);
							$template->assign_var('NUMERACION', $numeracion);
							$num = ( $page_number - 1 ) * PAGINAS;
							while($member = $db->sql_fetchrow($membersq))
							{	
								if($lidercheck['idLeader']==$pj["idPersonaje"])		
								{
								$op="- <a href='index.php?sec=clanmanage&ver=kick&id=".$member["idPersonaje"]."'>Echar</a>";
									if($member["inviteRight"]==0)
									$op.=" - <a href='index.php?sec=clanmanage&ver=right&id=".$member["idPersonaje"]."'>(Dar Invite)</a> ";
									else
									$op.=" - <a href='index.php?sec=clanmanage&ver=right&id=".$member["idPersonaje"]."'>(Quitar Invite)</a> ";
								}
								$template->assign_block_vars('M', array(
														'NOMBRE' => $member['nombre'],
														'IMG' => $member['imagen'],
														'CLASE' => $member['CLASE'],
														'LVL' =>  $member['nivel'],
														'OP' => $op,
														'CLANPGAIN' => $member['clanpvp']
														));
							}	
			break;
		}
}
else
{
	if(isset($_GET['join']))
	{
		$idClan = intval($_GET['join']);
					$query = 'SELECT idRequest
						FROM clan_request
						WHERE idPersonaje = "'.$pj['idPersonaje'].'" AND idClan = '.$idClan.'';
					$membersq = $db->sql_query($query);
					$member = $db->sql_fetchrow($membersq);
					if($member)
					{
							$query = 'SELECT count(*) as CONTA 
									  FROM personaje WHERE clan = '.$idClan.' AND SubClassFrom = 0';
							$count = $db->sql_fetchrow($db->sql_query($query));
							$filas = $count['CONTA'];
							
							$query = 'SELECT *
											FROM clan WHERE idClan = '.$idClan.'';
							$lidersq = $db->sql_query($query);
							$lidercheck = $db->sql_fetchrow($lidersq);
							
							$MAXCantidad = 6;
							if($filas>=$MAXCantidad)
							{
								show_error("Llegaste al limite de miembros que es ".$MAXCantidad."!","index.php?sec=clanmanage&ver=peticiones");
							}
							else
							{
								$db->sql_query("UPDATE personaje SET clan=".$idClan." WHERE idPersonaje = '".$pj['idPersonaje']."'");

								$db->sql_query("UPDATE personaje SET clan=".$idClan." WHERE 
									idPersonaje = '".$pj['idPersonaje']."' OR 
									SubClassFrom = '".$pj["idPersonaje"]."'");


								$db->sql_query("DELETE FROM clan_request WHERE idPersonaje = '".$pj['idPersonaje']."'");
								$db->sql_query("UPDATE clan SET members=(members+1) WHERE idClan = '".$idClan."'");
								
								$msg = $pj['nombre']." es un nuevo miembro del clan!";
								systemLog("clan",$msg,$idClan);
								show_message("Bienvenido al clan!","index.php?sec=clanmanage");
								$CLAN=$idClan;
								
							}
						
					}
					else
						show_error("No se encontro la invitacion!","index.php");
	}
	else
	show_error("El clan no existe","index.php?sec=clan");
}
}
else
	show_error("No puedes entrar a cuestiones de clanes con la subclase","index.php");
?> 