<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
function mascotaStatsLvl($lvl)
{
	$stat['ataque']=intval(2.1*$lvl);
	$stat['defensa']=intval(1.3*$lvl);
	$stat['vida']=intval(13.75*$lvl);
	$stat['critico']=1+intval(0.1*$lvl);
	$stat['podercritico']=10+intval(0.4*$lvl);
	return $stat;
}
	if(isset($_GET['op']))
		{

			$id = intval($_GET['id']);
			$query = 'SELECT *
			FROM mascotas 
			WHERE idCuenta = '.$log->get("idCuenta").' AND idMascota = '.$id.' ';
			$monstersq = $db->sql_query($query);
			$monster = $db->sql_fetchrow($monstersq);
			if($monster)
			{
					switch($_GET['op'])
					{
						case "item":
							if(isset($_GET['idItem']))
							{
								$idItem = intval($_GET['idItem']);
								$query = 'SELECT inv.idInventario
								FROM item i JOIN inventario inv USING ( idItem )
								WHERE inv.usadoPor = 0 AND i.tipo = "W" AND inv.idCuenta = '.$log->get("idCuenta").' AND idInventario = '.$idItem;
								$itemsq = $db->sql_query($query);
								$item = $db->sql_fetchrow($itemsq);

								if($item)
								{
									$query = 'SELECT *
										FROM item_attr 
										WHERE idInventario = '.$item['idInventario'];
									$attrsq = $db->sql_query($query);
									while($attr = $db->sql_fetchrow($attrsq))
									{
										$stater[$attr['attrb']] += $attr['valor'];
									}

									$stat=mascotaStatsLvl($monster['nivel']);
									$statStr="";
									if($stater["Ataque"]>0)
										$statStr.=" Ataque + ".$stater["Ataque"];
									if($stater["Defensa"]>0)
										$statStr.=" Defensa + ".$stater["Defensa"];
									if($stater["Critico"]>0)
										$statStr.=" Critico + ".$stater["Critico"];
									if($stater["PC"]>0)
										$statStr.=" Poder Critico + ".$stater["PC"];
									if($stater["VidaLimit"]>0)
										$statStr.=" Vida + ".$stater["VidaLimit"];

									$stat['ataque']+=$stater["Ataque"];
									$stat['defensa']+=$stater["Defensa"];
									$stat['critico']+=$stater["Critico"];
									$stat['podercritico']+=$stater["PC"];
									$stat['vida']+=$stater["VidaLimit"];

									$db->sql_query("UPDATE mascotas SET 
										ataque = ".$stat['ataque'].",
										defensa = ".$stat['defensa'].",
										vida = ".$stat['vida'].",
										critico = ".$stat['critico'].",
										podercritico = ".$stat['podercritico']."
										WHERE idMascota = '".$id."'");
									
								 delete_item($item['idInventario']);	
								 unset($_SESSION['PJITEM']);
								show_message("Tu mascota obtuvo ".$statStr,"index.php?sec=mascotas");	
									

								}
								else
								{
									$error = "Error en encontrar el item!";
									show_error($error,"index.php?sec=mascotas");
								}
							}
							else
							{
									$template->assign_var('IDPET', $id);
									$template->set_filenames(array(
									'content' => 'templates/sec/mascota_item.html' )
								);
							}
						break;
						case "usar":
							unset($_SESSION['PJITEM']);
							$db->sql_query("UPDATE personaje SET 
								idPet = ".$id."
							 WHERE idPersonaje = '".$log->get("pjSelected")."'");
								show_message("Ahora estas usando a ".$monster['nombre']." en tus aventuras!","index.php?sec=mascotas");	
									$msg = '<div class=questMeta>Usando a '.$monster['nombre'].'.</div>';
									systemLog("self",$msg);
						break;
						case "check":
								$template->set_filenames(array(
							'content' => 'templates/sec/mascota.html' )
						);

						$template->assign_var('MONSTNAME', $monster['nombre']);
						$template->assign_var('MONSIMG', $monster['imagen']);
						$template->assign_var('ID', $id);

						break;
						case "aceptar":
							if(isset($_POST['pet']))
							{
								$user = textIntoSql($_POST['pet']);
								$cantpet=1;
								if(@!eregi("^[-_A-Z0-9]{0,20}$",$user,$trashed))
								{
									$error = "El nombre tiene caracteres invalidos!";
									show_error($error,"index.php?sec=mascotas");
								}
								else if(strlen($user) <= 2 OR strlen($user) >= 11)
								{
									$error = "El nombre tiene que tener entre 2 y 10 caracteres!";
									show_error($error,"index.php?sec=mascotas");
								}
								else
								{
									$stat=mascotaStatsLvl($monster['nivel']);
									$db->sql_query("UPDATE mascotas SET 
										nombre = '".$user."',
										ataque = ".$stat['ataque'].",
										defensa = ".$stat['defensa'].",
										vida = ".$stat['vida'].",
										critico = ".$stat['critico'].",
										podercritico = ".$stat['podercritico'].",
										nacimiento = ".$now.",
										noname = 0
										WHERE idMascota = '".$id."'");
									show_message("Tu mascota esta lista!","index.php?sec=mascotas");	
									$msg = '<div class=questMeta>Mascota Acpetada.</div>';
									systemLog("self",$msg);
								}
							}
							else
							{
							show_message(' <form action="" method="post">
								<div>Ponga un nombre para la mascota</div>
								<div align="center">Nombre:<br /> <input class="boxInner" size="15" name="pet" type="text" /></div>
								 <div align="center"><input value="Aceptar Mascota" type="submit" /></div>
								 </form>  
								',"index.php?sec=mascotas");	
							}
						break;
						case "tirar":
							if($_GET['really'])
							{
								$db->sql_query("UPDATE personaje SET 
								idPet = 0
							 WHERE idPersonaje = '".$log->get("pjSelected")."'");
								$db->sql_query("DELETE FROM mascotas WHERE idMascota =".$id."");
								show_message("Se ah removido la mascota seleccinada","index.php?sec=mascotas");	
								$msg = '<div class=questMeta>Mascota Borrada.</div>';
								systemLog("self",$msg);
							}
							else
							{
								show_message("Desea realmente elminar la mascota seleccionada?<br>
									<a href='index.php?sec=mascotas&op=tirar&id=".$id."&really=1'>REMOVER MASCOTA</a>","index.php?sec=mascotas");	
							}
						break;
					}
		
			}
			else
				show_error("No existe la mascota","index.php?sec=mascotas");
					
		}
		else
		{
			$template->set_filenames(array(
					'content' => 'templates/sec/misMascotas.html' )
				);
			define('PATH_USERS', '?sec=mascotas&');
			 define('PAGINAS', 9);
			$page_number = intval($_GET['page']);
			if( $page_number == 0 ) 
			{ 
				$page_number = 1;
			}			
			$query = 'SELECT count(*) as CONTA 
					  FROM mascotas WHERE idCuenta = '.$log->get("idCuenta").' ';
			$count = $db->sql_fetchrow($db->sql_query($query));
			$filas = $count['CONTA'];
			$numeracion = NumerarPaginas($page_number, $filas, PATH_USERS, $limitbottom, PAGINAS);
		$query = 'SELECT *
		FROM mascotas 
		WHERE idCuenta = '.$log->get("idCuenta").' ORDER BY idMascota DESC limit '.$limitbottom.','.PAGINAS;
				$monstersq = $db->sql_query($query);
				$template->assign_var('NUMERACION', $numeracion);
				$num = ( $page_number - 1 ) * PAGINAS;
				$algunaMasc=0;
				while($monster = $db->sql_fetchrow($monstersq))
				{	
					$algunaMasc=1;
					$age = mascotaAge($monster['nacimiento']);
					if($monster['noname']==1)
					{
						$op='<a href="index.php?sec=mascotas&op=aceptar&id='.$monster['idMascota'].'">Aceptar</a> - <a href="index.php?sec=mascotas&op=tirar&id='.$monster['idMascota'].'">Rechazar</a>';
						$sCosa="gtfo";
						$age=0;
					}
					else
					{
						$op='<a href="index.php?sec=mascotas&op=check&id='.$monster['idMascota'].'">Opciones</a>';
						$sCosa="";
					}	
					if($monster['idMascota']==$pj['idPet'])
					{
						$monster['nombre'].=" [EN USO]";
					}
						
						$template->assign_block_vars('M', array(
												'NOMBRE' => $monster['nombre'],
												'V' => $monster['vida'],
												'A' => $monster['ataque'],
												'D' => $monster['defensa'],
												'C' => $monster['critico'],
												'P' => $monster['podercritico'],
												'COSAS' => $sCosa,
												'OP' =>	$op,												
												'ID' => $monster['idMascota'],
												'LVL' => $monster['nivel'],
												'EDAD' => $age,
												'MUERTO' => mascotaState($age),
												'IMG' =>  $monster['imagen']
												));	
				}			
			
			if(!$algunaMasc)
			$template->assign_var('NUMERACION', "No tienes ninguna mascota");
		}
?> 