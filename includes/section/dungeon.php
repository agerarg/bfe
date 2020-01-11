<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
$today = date("z");
function dungeonCost($lvl)
{
	$cost = ($lvl*5*$lvl);
	return $cost;
}
if($pj['inDungeon']==1)
{
	if(isset($_GET['salir']))
	{
		$db->sql_query("UPDATE personaje SET
					 inDungeon = 0, inRunz=0, location = 20  WHERE idPersonaje = '".$pj['idPersonaje']."'");
		$db->sql_query("DELETE FROM aura WHERE idSkillReal = 147 AND idPersonaje=".$pj['idPersonaje']."");
		show_message("Estas fuera del dungeon","index.php?sec=dungeon");			 
	}
	else
		show_message("Estas en un dungeon ahora mismo<br><a href='index.php?sec=dungeon&salir=1'>Salir de Dungeon</a>","index.php?sec=dungeon");
}
else
{
if($_GET['id'])
{	
			$idDungeon = intval($_GET['id']);
			$query = 'SELECT *
			FROM dungeon WHERE idDungeon = '.$idDungeon.' AND runz=0 AND oculto =0';
			$misionsq = $db->sql_query($query);

			$dungeon = $db->sql_fetchrow($misionsq);
		if($dungeon)
		{
			$realGold = $log->realGold();
			if($pj['nivel']>=$dungeon['nivel'])
			{
				if(dungeonCost($dungeon['nivel'])>$realGold)
					{
						show_error("No tienes suficiente oro","index.php?sec=dungeon&");	
					}else
				if(($pj['nivel']-20)>$dungeon['nivel'])
				{
					show_error("Tu nivel es demaciado alto para este dungeon","index.php?sec=dungeon&");
				}
				else
				if($pj['party']==0)
				{
				$db->sql_query("UPDATE cuenta SET oro = (oro-".dungeonCost($dungeon['nivel']).") WHERE idCuenta = ".$log->get("idCuenta"));
					$db->sql_query("DELETE FROM partyinvite WHERE idTarget = '".$pj['idPersonaje']."'");
					$db->sql_query("DELETE FROM dungeon_instance WHERE idPersonaje = '".$pj['idPersonaje']."'");
					
					insertBuff($pj['idPersonaje'],246,147,600);	
						
					$db->sql_query("UPDATE personaje SET
					 inDungeon = 1 WHERE idPersonaje = '".$pj['idPersonaje']."'");
					
					$db->sql_query('INSERT INTO  dungeon_instance(idDungeon,idParte,idPersonaje) 
										VALUES("'.$dungeon['idDungeon'].'","'.$dungeon['inicioPart'].'","'.$pj['idPersonaje'].'")');
					 
					 $query = 'SELECT max(idInstance) AS ID FROM dungeon_instance WHERE idPersonaje = '.$pj['idPersonaje'].'';	
					$itemsq = $db->sql_query($query);
					$maxId = $db->sql_fetchrow($itemsq);
	
					$query = 'SELECT idMonster,m.VidaLimit, db.cantidad
							FROM monster m JOIN dungeon_board db USING ( idMonster )
							WHERE db.idParte = '.$dungeon['inicioPart'].'';
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
					
					
					show_message("Dungeon ".$dungeon['nombre']." iniciado","index.php?sec=mundo");
					$msg = '<div class=questMeta>Dungeon '.$dungeon['nombre'].' iniciado.</div>';
					systemLog("self",$msg);
				}
				else
				{
					show_error("Estas en party, para hacer dungeons hay que estar solo","index.php?sec=dungeon&");
				}	
			}
			else
				show_error("Necesitas mas nivel para jugar este dungeon","index.php?sec=dungeon&");
		}
		else
			show_error("No existe el dungeon","index.php?sec=dungeon&");
}
else
{
								$template->set_filenames(array(
										'content' => 'templates/sec/dungeon.html' )
									);
								define('PATH_USERS', '?sec=dungeon&');
								 define('PAGINAS', 6);
								$page_number = intval($_GET['page']);
								if( $page_number == 0 ) 
								{ 
									$page_number = 1;
								}	
									
								$query = 'SELECT *
												FROM dungeon';
									$misionsq = $db->sql_query($query);
									
								$query = 'SELECT count(*) as CONTA 
										  FROM dungeon WHERE oculto =0';
								$count = $db->sql_fetchrow($db->sql_query($query));
								$filas = $count['CONTA'];
								$numeracion = NumerarPaginas($page_number, $filas, PATH_USERS, $limitbottom, PAGINAS);
							$query = 'SELECT * FROM dungeon WHERE runz=0 AND oculto =0  LIMIT '.$limitbottom.', '.PAGINAS;
									$misionsq = $db->sql_query($query);
									$template->assign_var('NUMERACION', $numeracion);
									$num = ( $page_number - 1 ) * PAGINAS;	
									while($mision = $db->sql_fetchrow($misionsq))
									{
										$reward = "Item ".textGrado($mision['grade']);
										switch($mision['grade'])
											{
												case 7:
													$reward = "Heads A";
												break;
												case 8:
													$reward = "Heads S";
												break;
												case 6:
													$reward = "Heads B";
												break;
											}
										$lvlLimit = $mision['nivel']+20;
										if($lvlLimit>86)
										$lvlLimit=86;
										$template->assign_block_vars('DUNG', array(
															'NOMBRE' => $mision['nombre'],
															'ID' =>  $mision['idDungeon'],
															'LVL' =>  $mision['nivel'],
															'LVLMX' =>  $lvlLimit,
															'DROP' => $mision['legLvl'],
															'COST' => dungeonCost($mision['nivel']),
															'GRAD' => $reward,
															'IMG' =>  $mision['img']
															));		
									}
}
}
?> 