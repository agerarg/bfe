<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
$template->set_filenames(array(
						'body' => 'templates/mainSimple.html' )
					);
$now = time();
			switch($_GET['sec'])
			{
			case 'verclase':
				$template->set_filenames(array(
							'content' => 'templates/sec/habilidadesVer.html' )
						);
			$id = intval($_GET['id']);
				$template->assign_var('CLASE',$id);	
			switch($id)
					{	
						case 1:
						$template->assign_var('FONDIMAG',"zombie_warrior.jpg");	
						break;
						case 2:
						$template->assign_var('FONDIMAG',"skeleton_mage.jpg");	
						break;
						case 3:
						$template->assign_var('FONDIMAG',"ninja.jpg");	
						break;
						case 4:
						$template->assign_var('FONDIMAG',"marksman.jpg");	
						break;
						case 5:
						$template->assign_var('FONDIMAG',"shaman.jpg");	
						break;
						case 6:
						$template->assign_var('FONDIMAG',"vampire.jpg");	
						break;
						case 7:
						$template->assign_var('FONDIMAG',"destroyer.jpg");	
						break;
						case 8:
						$template->assign_var('FONDIMAG',"cleric.jpg");	
						break;
						case 10:
						$template->assign_var('FONDIMAG',"garca.jpg?1");	
						break;
						case 9:
							header("Location: index.php?sec=crearPj");
							die();
						break;
						default:
							header("Location: index.php?sec=crearPj");
							die();
						break;
						
					}
				$query = 'SELECT s.*
					FROM clase_skill cs JOIN skill s USING ( idSkill )
					WHERE cs.idClase='.$id;
					$skillsq = $db->sql_query($query);
					while($skill = $db->sql_fetchrow($skillsq))
					{	
						$i = $skill['idSkill'];
						$habilita = explode(',',$skill['skill_habilita']);
						if(is_array($habilita))
								foreach ($habilita as $id) {
									$habilitadopor[$id][] =  $i;
									$habilitadoa[$i][] =  $id;
							}
						$arrayskill[$i] = $skill;
						if($skill['idskilllearn']>0)
							$arrayskill[$i]['aprender']=1;
						else
							$arrayskill[$i]['aprender']=0;
					}
					if(is_array($arrayskill))
					foreach ($arrayskill as $skill) {
						$able=1;
						$upscripting="";
						$downscripting="";
						$id = $skill['idSkill'];
						//alble
						
						//requiere
						$template->assign_block_vars('SDOWNSLOT', array(
												'ID' => $skill['idSkill'],
												'DO' => $downscripting
												));
						//
						
						$template->assign_block_vars('SUPSLOT', array(
												'ID' => $skill['idSkill'],
												'DO' => $upscripting
												));
						//
						if($skill['lvl_requiere']<=$pj['nivel'])
							$cango=1;
						else
							$cango=0;
						$cadena = utf8_encode($skill['desc']);
						$cadena = @eregi_replace("/\r\n+|\r+|\n+|\t+/i",  ' ', $cadena);

	
						$template->assign_block_vars('S', array(
												'ID' => $skill['idSkill'],
												'SPOT' => $skill['slotPlacet'],
												'NAME' => $skill['nombre'],
												'IMG' => $skill['imagen'],
												'NEW' => $skill['aprender'],
												'CANDO' => $cango,
												'DESC' => $cadena,
												'ABLE' => $able
												));
					}
			break;
			case 'namer':
				$id = intval($_GET['id']);
				$query_clases = 'SELECT *
						  FROM clase WHERE idClase = '.$id.' AND active_class = 1';
				$srch_clases = $db->sql_query($query_clases);
				$clase = $db->sql_fetchrow($srch_clases);
				$template->assign_var('IMGCLASE', $clase['imagen'].'_0.png');
				$template->assign_var('IMGCLASE2', $clase['imagen'].'_1.png');
				if(isset($_POST['enviar']))
				{
					$user = textIntoSql($_POST['nombre']);
					if(@!eregi("^[-_A-Z0-9]{0,20}$",$user,$trashed))
					{
						$data['eco'] = "El nombre tiene caracteres invalidos!";
						$data['check']=0;
					}
					else if(!$clase['idClase'])
					{
						$data['eco'] = "La clase no existe!";
						$data['check']=0;
					}
					else if(strlen($user) <= 2 OR strlen($user) >= 11)
					{
						$data['eco'] = "El nombre tiene que tener entre 2 y 10 caracteres!";
						$data['check']=0;
					}
					else
					{
						$query = "SELECT count(*) as CONTA 
							  FROM  personaje
							  WHERE nombre = '".$user."'  AND desactivada=0";
						$count = $db->sql_fetchrow($db->sql_query($query));
						
						$query = "SELECT count(*) as CONTA 
							  FROM  personaje
							  WHERE idCuenta = '".$log->get("idCuenta")."'  AND desactivada=0 AND SubClassFrom=0";
						$cantidadpj = $db->sql_fetchrow($db->sql_query($query));
						
						if($count['CONTA'])
						{
							$data['eco'] = "El nombre ya esta en uso!";
							$data['check']=0;
						}
						else if($cantidadpj['CONTA']>4)
						{
							$data['eco'] = "La cantidad maxima de personajes es 5!";
							$data['check']=0;
						}
						else
						{
							$VidaLimit = 101+($clase['CON']*(21));
							$ManaLimit = 101+($clase['MEN']*(11));
							$sexo = intval($_POST['sexo']);
							if($sexo==1)
								$sexo=1;
							else
								$sexo=0;
								
							$query = 'SELECT MAX(idPersonaje) AS ID FROM personaje ';
							$logrmaxsq = $db->sql_query($query);
							$logrmax = $db->sql_fetchrow($logrmaxsq);
							$newId = ($logrmax['ID']+1);
							switch($clase['idClase'])
							{
								case 1:
									//ZOMBIE WARRIOR
									$db->sql_query("INSERT INTO inventario (idItem,idCuenta,intradeable,usadoPor) 
									VALUES('26','".$log->get("idCuenta")."',1,'".$newId."')");	
									$db->sql_query( "INSERT INTO inventario (idItem,idCuenta,intradeable,usadoPor) 
									VALUES('479','".$log->get("idCuenta")."',1,'".$newId."')");
								break;
								case 2:
									//Squeletal Mage
									$db->sql_query("INSERT INTO inventario (idItem,idCuenta,intradeable,usadoPor) 
									VALUES('41','".$log->get("idCuenta")."',1,'".$newId."')");	
									$db->sql_query("INSERT INTO inventario (idItem,idCuenta,intradeable,usadoPor) 
									VALUES('135','".$log->get("idCuenta")."',1,'".$newId."')");
								break;
								case 3:
									//Ninja
									$db->sql_query("INSERT INTO inventario (idItem,idCuenta,intradeable,usadoPor) 
									VALUES('1','".$log->get("idCuenta")."',1,'".$newId."')");
									$db->sql_query( "INSERT INTO inventario (idItem,idCuenta,intradeable,usadoPor) 
									VALUES('106','".$log->get("idCuenta")."',1,'".$newId."')");
								break;
								case 4: 
									// Marksman
									$db->sql_query("INSERT INTO inventario (idItem,idCuenta,intradeable,usadoPor) 
									VALUES('51','".$log->get("idCuenta")."',1,'".$newId."')");
									$db->sql_query("INSERT INTO inventario (idItem,idCuenta,intradeable,usadoPor) 
									VALUES('106','".$log->get("idCuenta")."',1,'".$newId."')");
								break;
								case 5:
									//Shaman
									$db->sql_query("INSERT INTO inventario (idItem,idCuenta,intradeable,usadoPor) 
									VALUES('11','".$log->get("idCuenta")."',1,'".$newId."')");
									$db->sql_query("INSERT INTO inventario (idItem,idCuenta,intradeable,usadoPor) 
									VALUES('135','".$log->get("idCuenta")."',1,'".$newId."')");
								break;
								case 6:
									//Vampire
									$db->sql_query("INSERT INTO inventario (idItem,idCuenta,intradeable,usadoPor) 
									VALUES('75','".$log->get("idCuenta")."',1,'".$newId."')");
									$db->sql_query("INSERT INTO inventario (idItem,idCuenta,intradeable,usadoPor) 
									VALUES('106','".$log->get("idCuenta")."',1,'".$newId."')");
								break;
								case 7:
									//Destroyer
									$db->sql_query("INSERT INTO inventario (idItem,idCuenta,intradeable,usadoPor) 
									VALUES('329','".$log->get("idCuenta")."',1,'".$newId."')");
									$db->sql_query("INSERT INTO inventario (idItem,idCuenta,intradeable,usadoPor) 
									VALUES('479','".$log->get("idCuenta")."',1,'".$newId."')");
								break;
								case 8:
									//Cleric
									$db->sql_query("INSERT INTO inventario (idItem,idCuenta,intradeable,usadoPor) 
									VALUES('41','".$log->get("idCuenta")."',1,'".$newId."')");	
									$db->sql_query("INSERT INTO inventario (idItem,idCuenta,intradeable,usadoPor) 
									VALUES('135','".$log->get("idCuenta")."',1,'".$newId."')");
								break;
								case 10:
									//Garca
									$db->sql_query("INSERT INTO inventario (idItem,idCuenta,intradeable,usadoPor) 
									VALUES('26','".$log->get("idCuenta")."',1,'".$newId."')");	
									$db->sql_query("INSERT INTO inventario (idItem,idCuenta,intradeable,usadoPor) 
									VALUES('106','".$log->get("idCuenta")."',1,'".$newId."')");
								break;
								
							}
							
							$query = "INSERT INTO personaje (nombre,idCuenta,idClase,
							Vida,Mana,location,sexo,antiBot) 
							VALUES('".$user."','".$log->get("idCuenta")."','".$clase['idClase']."',
							'".$VidaLimit."','".$ManaLimit."',".$clase['start_location'].",".$sexo.",".($now+1200).")";					
							$db->sql_query($query);	

							$query = "INSERT INTO logros (idPersonaje) 
							VALUES (".$newId.")";					
							$db->sql_query($query);	
							$data['check']=1;
						}
					}
					$template->set_filenames(array(
						'content' => 'templates/error.html' )
						);
					if($data['check']==0)
					{
						$_SESSION['champName'] = $user;
						$_SESSION['champSexo'] = $sexo;
						$template->assign_var('INFO', "Error: ".$data['eco']." <br><br />
<a href='index.php?sec=namer&id=".$clase['idClase']."'>Clic Aquí </a> para continuar");
					}
					else
					{
						$template->assign_var('INFO', "Se ha creado un nuevo personaje<br><br />
<a href='index.php?sec=personajes'>Clic Aquí </a> para continuar");
					}					
			}
			else
			{
				$template->set_filenames(array(
						'content' => 'templates/namer.html' )
						);
				$template->assign_var('NOMBRE', $_SESSION['champName']);	
				if($_SESSION['champName']==1)
					$template->assign_var('SEXO1', 'selected="selected"');	
				else
					$template->assign_var('SEXO2', 'selected="selected"');	
			}
			break;
			case 'crearPj':
						$template->set_filenames(array(
						'content' => 'templates/elegir_personaje.html' )
						);
					$query_clases = 'SELECT *
					  FROM clase WHERE active_class = 1';
					$srch_clases = $db->sql_query($query_clases);
					$n=0;
					while($clase = $db->sql_fetchrow($srch_clases))
						{	
							$n++;
							$template->assign_block_vars('C', array(
							'N' => $n,
							'ID' => $clase['idClase'],
							'NOMBRE' =>  $clase['nombre'],
							'IMG' =>  $clase['imagenBig'].'_0.jpg'
						  ));	
						
						}
			break;
			case 'deslog':
				$log->salir();
			break;
			default:
				$template->set_filenames(array(
						'content' => 'templates/mis_personajes.html' )
						);
				$query_clases = 'SELECT c.imagenBig, p.nombre, p.nivel, p.idPersonaje, p.sexo
					  FROM personaje p JOIN clase c USING ( idClase )
					  WHERE  p.idCuenta = "'.$log->get("idCuenta").'" AND p.SubClassFrom = 0 AND p.desactivada=0 ORDER BY idPersonaje';
					$srch_clases = $db->sql_query($query_clases);
					$n=0;
					while($clase = $db->sql_fetchrow($srch_clases))
						{
							$n++;
										$template->assign_block_vars('P', array(
										'IMG' => $clase['imagenBig'].'_'. $clase['sexo'].'.png',
										'NOMBRE' => $clase['nombre'],
										'LVL' => $clase['nivel'],
										'ID' => $clase['idPersonaje']));
						}
					$n = $n-5;
					while($n<0)
					{
						$template->assign_block_vars('F', array());
						$n++;
					}
			break;
			case 'jugar':
				$id = intval($_GET['id']);
				$query_clases = 'SELECT p.idPersonaje, p.subClassActive
					  FROM personaje p
					  WHERE p.idCuenta = "'.$log->get("idCuenta").'" AND p.idPersonaje = '.$id.'';
					$srch_clases = $db->sql_query($query_clases);
					$clase = $db->sql_fetchrow($srch_clases);
					if($clase['idPersonaje'])
					{
						if($clase['subClassActive']>0)
						{
							
							$query_clases = 'SELECT p.idPersonaje, p.subClassActive
							  FROM personaje p
							  WHERE p.idCuenta = "'.$log->get("idCuenta").'" 
							  AND p.idPersonaje = '.$clase['subClassActive'].' AND p.desactivada =0';
							$srch_clases = $db->sql_query($query_clases);
							$clase = $db->sql_fetchrow($srch_clases);
						}
						$log->set("pjSelected",$clase['idPersonaje']);
						$db->sql_query("UPDATE cuenta SET pjSelected = '".$clase['idPersonaje']."' 
						WHERE idCuenta  = '".$log->get("idCuenta")."'");
						header("Location: index.php");
						die();
					}
			break;
			
						}
?> 