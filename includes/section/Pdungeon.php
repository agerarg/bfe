<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
if($pj['inDungeon']==1)
{
	if(isset($_GET['salir']))
	{
		///////////////////// INICIO BORRAR INSTANCIAS
			$query = 'SELECT idInstance FROM dungeon_instance WHERE idPersonaje='.$pj['idPersonaje'].'';
			$instancesq = $db->sql_query($query);
			while($instance = $db->sql_fetchrow($instancesq))
				$db->sql_query("DELETE FROM inmundo WHERE idInstance = '".$instance['idInstance']."'");
			$db->sql_query("DELETE FROM dungeon_instance WHERE idPersonaje = '".$pj['idPersonaje']."'");
		///////////////////// FIN BORRAR INSTANCIAS
					
		$db->sql_query("UPDATE personaje SET
					 inDungeon = 0, inRunz=0, location = 20, dungeonInstance = 0  WHERE idPersonaje = '".$pj['idPersonaje']."'");
					 
		$db->sql_query("DELETE FROM aura WHERE idSkillReal = 147 AND idPersonaje=".$pj['idPersonaje']."");
		
		show_message("Estas fuera del dungeon","index.php?sec=pdungeon");			 
	}
	else
		show_message("Estas en un dungeon ahora mismo<br><a href='index.php?sec=pdungeon&salir=1'>Salir de Dungeon</a>","index.php?sec=dungeon");
}
else
{
	
	if(isset($_POST['grado']))
	{
		if(($pj['party']>0 AND $pj['party']==$pj['idPersonaje']) OR $pj['party']==0)
	{
		$grado = intval($_POST['grado']);
		switch($grado)
		{
			case 3:
				$nivel=40;
				$minLevel=40;
				$maxLevel=60;
			break;
			case 4:
				$nivel=50;
				$minLevel=40;
				$maxLevel=60;
			break;
			case 5:
				$nivel=55;
				$minLevel=50;
				$maxLevel=70;
			break;
			case 6:
				$nivel=60;
				$minLevel=50;
				$maxLevel=70;
			break;
			case 7:
				$nivel=65;
				$minLevel=60;
				$maxLevel=80;
			break;
			case 7:
				$nivel=70;
				$minLevel=60;
				$maxLevel=80;
			break;
			case 8:
				$nivel=75;
				$minLevel=70;
				$maxLevel=86;
			break;
			case 9:
				$nivel=80;
				$minLevel=70;
				$maxLevel=120;
			break;
			case 10:
				$nivel=90;
				$minLevel=80;
				$maxLevel=120;
			break;
			default:
				$grado = 3;
				$nivel=40;
				$minLevel=40;
				$maxLevel=60;
			break;
		}
		$dificult = intval($_POST['dificultad']);
		switch($dificult)
		{
			case 1:
				$waves=3;
			break;
			case 2:
				$waves=4;
			break;
			case 3:
				$waves=5;
			break;
			case 4:
				$waves=6;
			break;
			case 5:
				$waves=7;
			break;
			case 6:
				$waves=8;
			break;
			default:
				$dificult=1;
				$waves=3;
			break;
		}
		if($dimencion!=1)
		{
			$errorMsg="Tienes que estar en la dimencion de Embolia";
			$error=1;
		}
		//LEVEL CHECK
		if($pj['party']>0)
		{
			$query = 'SELECT nombre, nivel FROM personaje WHERE party='.$pj['idPersonaje'].'';
					$partycharssq = $db->sql_query($query);
					while($partychar = $db->sql_fetchrow($partycharssq))
					{
						if($partychar['nivel'] < $minLevel)
						{
							$errorMsg=$partychar['nombre']." necesita ser nivel ".$minLevel." para este dungeon";
							$error=1;
						}
						if($partychar['nivel'] > $maxLevel)
						{
							$errorMsg=$partychar['nombre']." supera el nivel maximo (".$maxLevel.") para este dungeon";
							$error=1;
						}
					}
		}
		else
		{
			if($pj['nivel'] < $minLevel)
						{
							$errorMsg="necesitas ser nivel ".$minLevel." para este dungeon";
							$error=1;
						}
			if($pj['nivel'] > $maxLevel)
			{
				$errorMsg="superas el nivel maximo (".$maxLevel.") para este dungeon";
				$error=1;
			}
		}
		if($pj['nivel'] > $maxLevel)
			{
				$errorMsg="superas el nivel maximo (".$maxLevel.") para este dungeon";
				$error=1;
			}
		if($error==0)
		{
		/// BORRADO
		if($pj['party']>0)
		{
			$query = 'SELECT idPersonaje FROM personaje WHERE party='.$pj['idPersonaje'].'';
					$partycharssq = $db->sql_query($query);
					while($partychar = $db->sql_fetchrow($partycharssq))
					{
						insertBuff($partychar['idPersonaje'],246,147,600);	
						$query = 'SELECT idInstance FROM dungeon_instance WHERE idPersonaje='.$partychar['idPersonaje'].'';
						$instancesq = $db->sql_query($query);
						while($instance = $db->sql_fetchrow($instancesq))
						$db->sql_query("DELETE FROM inmundo WHERE idInstance = '".$instance['idInstance']."'");
						
						$db->sql_query("DELETE FROM dungeon_instance WHERE idPersonaje = '".$partychar['idPersonaje']."'");
					}
			$party=1;		
		}
		else
		{
			$party=0;
					insertBuff($pj['idPersonaje'],246,147,600);		
			///////////////////// INICIO BORRAR INSTANCIAS
					$query = 'SELECT idInstance FROM dungeon_instance WHERE idPersonaje='.$pj['idPersonaje'].'';
					$instancesq = $db->sql_query($query);
					while($instance = $db->sql_fetchrow($instancesq))
						$db->sql_query("DELETE FROM inmundo WHERE idInstance = '".$instance['idInstance']."'");
					$db->sql_query("DELETE FROM dungeon_instance WHERE idPersonaje = '".$pj['idPersonaje']."'");
					///////////////////// FIN BORRAR INSTANCIAS
		}
		
		 $db->sql_query('INSERT INTO  dungeon_instance(idPersonaje,nivel,waves,waveCurr,itemGrado,dificultad,idParty) 
		VALUES("'.$pj['idPersonaje'].'","'.$nivel.'",'.$waves.',1,'.$grado.','.$dificult.','.$party.')');
		
		$query = 'SELECT max(idInstance) AS ID FROM dungeon_instance WHERE idPersonaje = '.$pj['idPersonaje'].'';	
					$itemsq = $db->sql_query($query);
					$maxId = $db->sql_fetchrow($itemsq);
					
		if($pj['party']>0)
		{
			// Agregar Players
					$db->sql_query("UPDATE personaje SET
					 inDungeon = 1, dungeonInstance=".$maxId['ID']."
					 WHERE  party = '".$pj['idPersonaje']."'");
		}
		else
		{
			// Agregar Players
					$db->sql_query("UPDATE personaje SET
					 inDungeon = 1, dungeonInstance=".$maxId['ID']."
					 WHERE  idPersonaje = '".$pj['idPersonaje']."'");
		}
		



		$cantidad=mt_rand(2,4);
					$query = 'SELECT idMonster, VidaLimit
							FROM monster  WHERE exp=1 AND nivel < '.$nivel.' AND hardOne = 0 AND raid = 0 ORDER BY nivel DESC LIMIT 0,3';
							$monster = $db->sql_query($query);
							while($chor = $db->sql_fetchrow($monster))
							{	
								for($i=0;$i<$cantidad;$i++)
								{
									$vida=$chor['VidaLimit'];
									if($dungeon['dificultad']>0)
											$vida=$vida*$dungeon['dificultad'];
									$db->sql_query('INSERT INTO  inmundo(idMonster,tipo,mundo,currentLife,champion,dificulty,idInstance) 
											VALUES("'.$chor['idMonster'].'","2",
											1,"'.$vida.'",0,0,'.$maxId['ID'].')');
								}
										
							}
					$msg = '<div class=questMeta>Dungeon iniciado.</div>';
		if($pj['party']>0)
			systemLog("party",$msg);	
		else
			systemLog("self",$msg);	
		show_message("Dungeon iniciado!","index.php?sec=mundo");
		}
		else
		{
			show_error($errorMsg,"index.php?sec=pdungeon");
		}
	}
	else
	{
		show_error("Solo el lider de la party puede crear el dungeon!","index.php?sec=pdungeon");
	}
	}
	else
	{
			$template->set_filenames(array(
										'content' => 'templates/sec/dungeon.html' )
									);
	}
	
	
}
?> 