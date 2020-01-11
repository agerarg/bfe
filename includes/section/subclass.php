<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
function goToSelectHero()
{
	global $db,$log;
	$db->sql_query("UPDATE cuenta SET pjSelected = '0' 
										WHERE idCuenta  = '".$log->get("idCuenta")."'");
			$log->set("pjSelected",0);		
			unset($_SESSION['PJITEM']);
			unset($_SESSION['MADVSKILL']);	
			header("Location: index.php?sec=cambiarPj");
}
function getMySubClassSkills()
{
	global $db,$log,$pj;
	$query = 'SELECT idRealSkill
				FROM skilllearn
				WHERE '.$pj['SubClassFrom'].' = idPersonaje AND subclass = '.$log->get("pjSelected");
	$subsq = $db->sql_query($query);
	$result=Array();
	while($mysill = $db->sql_fetchrow($subsq))
	{
		$result[$mysill['idRealSkill']]=true;
	}
	return $result;
}
switch($_GET['op'])
{
	case 'skillLearn':
		$skillCheck = getMySubClassSkills();
		switch($_GET['id'])
		{
			case 1:
				$LevelRequired = 40;
				$SkillId = 580;
				$SkillIdReal = 430;
				$SkillName = "Boost HP";
			break;
			case 2:
				$LevelRequired = 60;
				$SkillId = 582;
				$SkillIdReal = 432;
				$SkillName = "Boost Def";
			break;
			case 3:
				$LevelRequired = 80;
				$SkillId = 581;
				$SkillIdReal = 431;
				$SkillName = "Boost Dmg";
			break;
			case 4:
				$query = 'SELECT idSkill, idRealSkill,nombre
					  FROM skill
					  WHERE SubClassId = '.$pj['idClase'];
				$skilsq4 = $db->sql_query($query);
				$skill4 = $db->sql_fetchrow($skilsq4);
				$LevelRequired = 100;
				$SkillId = $skill4['idSkill'];
				$SkillIdReal = $skill4['idRealSkill'];
				$SkillName = $skill4['nombre'];
			break;
		}

		if(!$skillCheck[$SkillIdReal] && $pj['nivel']>=$LevelRequired)
		{
			$query = 'SELECT idSkill,nivel,idRealSkill
				FROM skilllearn
				WHERE '.$pj['SubClassFrom'].' = idPersonaje AND idRealSkill = '.$SkillIdReal.'
				ORDER BY nivel DESC LIMIT 0,1';
				$updateSkillsq = $db->sql_query($query);
				$updatesk = $db->sql_fetchrow($updateSkillsq);
			if($updatesk)
			{
				$newLevel = ($updatesk['nivel']+1);
				$query = 'SELECT idSkill,nivel
				FROM skill
				WHERE idRealSkill = '.$updatesk['idRealSkill'].' AND nivel='.$newLevel.'';
				$newSkillsq = $db->sql_query($query);
				$newSkill = $db->sql_fetchrow($newSkillsq);


				$db->sql_query('INSERT INTO skilllearn (idSkill,idPersonaje,nivel,idRealSkill,subclass) 
												VALUES("'.$newSkill['idSkill'].'", "'.$pj['SubClassFrom'].'","'.$newLevel.'","'.$SkillIdReal.'",
												"'.$log->get("pjSelected").'")');

				$db->sql_query("DELETE FROM aura WHERE idSkillReal = ".$SkillIdReal." AND idPersonaje=".$pj['SubClassFrom']."");
				$db->sql_query('INSERT INTO  aura(idPersonaje,idSkill,static,idSkillReal,acumuleitor) 
									VALUES("'.$pj['SubClassFrom'].'","'.$newSkill['idSkill'].'","1",'.$SkillIdReal.',0)');

				show_message("Subiste de nivel ".$SkillName." en tu personaje principal!","index.php?sec=subclass&op=skills");
			}
			else
			{
				$db->sql_query('INSERT INTO skilllearn (idSkill,idPersonaje,nivel,idRealSkill,subclass) 
												VALUES("'.$SkillId.'", "'.$pj['SubClassFrom'].'","1","'.$SkillIdReal.'",
												"'.$log->get("pjSelected").'")');
				$db->sql_query('INSERT INTO  aura(idPersonaje,idSkill,static,idSkillReal,acumuleitor) 
									VALUES("'.$pj['SubClassFrom'].'","'.$SkillId.'","1",'.$SkillIdReal.',0)');

				show_message("Adquiriste ".$SkillName." en tu personaje principal!","index.php?sec=subclass&op=skills");
			}
		}
		else
		{
			show_error("No tienes suficiente nivel!","index.php?sec=subclass&op=skills");
		}

	break;
	///////////////////////////////////////////////////////////////////////////////////////////
	case 'skills':
	if($pj['SubClassFrom']>0)
	{
		
		$query = 'SELECT nombre, `desc`, imagen, idSkill, idRealSkill
					  FROM skill
					  WHERE SubClassId = '.$pj['idClase'];
		$skilsq = $db->sql_query($query);
		$skill = $db->sql_fetchrow($skilsq);

		$cadena = utf8_encode($skill['desc']);
		$cadena = @eregi_replace("/\r\n+|\r+|\n+|\t+/i",  ' ', $cadena);


		$template->assign_var('SPECIAL_DESC', $cadena);
		$template->assign_var('SPECIAL_SKILL', $skill['nombre']);
		$template->assign_var('SPECIAL_IMG', $skill['imagen']);

		//Check Showing
		$skillCheck = getMySubClassSkills();
		if($skillCheck[430])
			$template->assign_var('DISPLAYSKILL1', "GTFO");
		if($skillCheck[432])
			$template->assign_var('DISPLAYSKILL2', "GTFO");
		if($skillCheck[431])
			$template->assign_var('DISPLAYSKILL3', "GTFO");
		if($skillCheck[$skill['idRealSkill']])
			$template->assign_var('DISPLAYSKILL4', "GTFO");



		$template->set_filenames(array(
					'content' => 'templates/sec/subclass_learn.html' )
				);
	}
	else
	show_error("Solo puedes obtener habilidades de subclases!","index.php?sec=subclass");
	break;
	case 'switch':

		$id = (int)$_GET['id'];

		$query_clases = 'SELECT p.idPersonaje, p.SubClassFrom
					  FROM personaje p
					  WHERE p.idPersonaje = '.$id;
		$srch_clases = $db->sql_query($query_clases);
		$clase = $db->sql_fetchrow($srch_clases);

		if($clase['SubClassFrom']==$pj['idPersonaje'])
		{
			$db->sql_query("UPDATE personaje SET online=0, subClassActive=".$clase['idPersonaje']."
					WHERE idPersonaje = ".$pj['idPersonaje']);


			goToSelectHero();
				
		}
		else
			header("Location: index.php");
	break;

	case 'cancel':
		if(isset($_GET['go']) && $_SESSION['sub_cancel']=="go")
		{
			unset($_SESSION['sub_cancel']);
			$db->sql_query("UPDATE personaje SET desactivada=1, online=0
				WHERE idPersonaje = ".$pj['idPersonaje']);
			
			$query = 'SELECT idRealSkill,nivel
				FROM skilllearn
				WHERE '.$pj['SubClassFrom'].' = idPersonaje AND subclass > 0';
			$subsq = $db->sql_query($query);
			while($mysill = $db->sql_fetchrow($subsq))
			{
				$db->sql_query("DELETE FROM aura WHERE idSkillReal = ".$mysill['idRealSkill']." AND idPersonaje=".$pj['SubClassFrom']."");
			}
			$db->sql_query("DELETE FROM skilllearn WHERE ".$pj['SubClassFrom']." = idPersonaje AND subclass > 0");


			$db->sql_query("UPDATE personaje SET subClassActive=0
				WHERE idPersonaje = ".$pj['SubClassFrom']);

			goToSelectHero();

		}else
		{
			$_SESSION['sub_cancel']="go";
			show_message("Deseas destruir esta subclase? <br> vas a perder todo el progreso que hiciste!<br>
									<br>
									Todas las habilideades de subclase se van a remover, aprende de nuevo las habilidades.
									<br>
			<a href='index.php?sec=subclass&op=cancel&go'>SI DESTRUIR ESTA SUBCLASE</a>","index.php?sec=inicio");
		}
	break;

	case 'back':

		$db->sql_query("UPDATE personaje SET subClassActive=0
				WHERE idPersonaje = ".$pj['SubClassFrom']);

		$db->sql_query("UPDATE personaje SET online=0 
			WHERE idPersonaje = ".$pj['idPersonaje']);

		goToSelectHero();

	break;
	case 'add':
	if($pj['SubClassFrom']==0)
	{
	$getOut=false;
	$limitOut=false;
	$i=0;
		$query = 'SELECT c.nombre AS CLASE, p.nivel, idPersonaje
				FROM personaje p JOIN clase c USING ( idClase )
				WHERE '.$log->get("pjSelected").' = p.SubClassFrom AND p.desactivada = 0';
					$subsq = $db->sql_query($query);
					while($subs = $db->sql_fetchrow($subsq))
					{
						if($subs['nivel']<100)
							$getOut=true;
						$i++;
						if($i>=3)
							$limitOut=true;
					}
		if($limitOut)
		{	
			show_error("El limite de subclases es 3.","index.php?sec=subclass");
		}else
		if($getOut)
		{	
			show_error("Si tienes subclases primero tienes que hacerlas llegar a nivel 100 para poder agregar otra más.","index.php?sec=subclass");
		}else
	if($pj['nivel']>=100)
	{
		if(isset($_GET['yep']))
		{
			$classId = (int)$_GET['yep'];
			$getAlready=false;
			$query = 'SELECT p.idClase, c.nombre AS CLASE, p.nivel, idPersonaje
				FROM personaje p JOIN clase c USING ( idClase )
				WHERE '.$log->get("pjSelected").' = p.SubClassFrom AND p.desactivada = 0';
					$subsq = $db->sql_query($query);
					while($subs = $db->sql_fetchrow($subsq))
					{
						if($subs['idClase']==$classId)
							$getAlready=true;
					}
			if($getAlready)
			{
				show_error("Ya tienes una subclase de esta clase.","index.php?sec=subclass&op=add");
			}
			if($classId == $pj['idClase'])
			{
				show_error("No puedes hacer SubClase de tu misma Clase.","index.php?sec=subclass&op=add");
			}
			else
			{

			$VidaLimit = 100;
			$ManaLimit = 100;
			$query = "INSERT INTO personaje (nombre,idCuenta,idClase,
				Vida,Mana,location,sexo,antiBot,SubClassFrom,paragonAcc,paragonNow) 
				VALUES('".$pj['nombre']."',
				'".$log->get("idCuenta")."',
				'".$classId."',
				'".$VidaLimit."',
				'".$ManaLimit."',
				20,
				". $pj['sexo'].",
				".($now+1200).",".$pj['idPersonaje'].",".$pj['paragonAcc'].",".$pj['paragonNow'].")";					
			$db->sql_query($query);	

			$query = 'SELECT MAX(idPersonaje) AS ID FROM personaje ';
			$logrmaxsq = $db->sql_query($query);
			$logrmax = $db->sql_fetchrow($logrmaxsq);
			$newId = (int)$logrmax['ID'];

			switch($classId)
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

			$query = "INSERT INTO logros (idPersonaje) 
			VALUES (".$newId.")";					
			$db->sql_query($query);	

			$db->sql_query("UPDATE personaje SET online=0, subClassActive=".$newId." 
				WHERE idPersonaje = ".$log->get("pjSelected"));

			goToSelectHero();
			}
		}
		else
		$template->set_filenames(array(
					'content' => 'templates/sec/subclass_add.html' )
				);
	}
	else
		show_error("Tienes que tener nivel 100!","index.php?sec=subclass");

	}
	else
		show_error("Solo puedes agregar Subclases desde tu clase Base","index.php?sec=subclass");
	break;
	default:
	unset($_SESSION['sub_cancel']);
		if($pj['SubClassFrom']>0)
			$template->set_filenames(array(
					'content' => 'templates/sec/subclass_back.html' )
				);
			else
			{
				$getOut=false;
				$query = 'SELECT c.nombre AS CLASE, p.nivel, idPersonaje
					FROM personaje p JOIN clase c USING ( idClase )
					WHERE '.$log->get("pjSelected").' = p.SubClassFrom AND p.desactivada = 0';
						$subsq = $db->sql_query($query);
						while($subs = $db->sql_fetchrow($subsq))
						{
							if($subs['nivel']<100)
								$getOut=true;
							$template->assign_block_vars('SUB', array(
									'ID' => $subs['idPersonaje'],
									'NAME' => $subs['CLASE'],
									'LVL' =>  $subs['nivel']));	
						}
				if($getOut)
					$template->assign_var('ADD_SUBCLASS', "GTFO");

				$template->set_filenames(array(
					'content' => 'templates/sec/subclass.html' )
				);

			}
	break;
}

?> 