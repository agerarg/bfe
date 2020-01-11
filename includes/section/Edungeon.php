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
		
		show_message("Estas fuera del dungeon","index.php?sec=edungeon");			 
	}
	else
		show_message("Estas en un dungeon ahora mismo<br><a href='index.php?sec=pdungeon&salir=1'>Salir de Dungeon</a>","index.php?sec=edungeon");
}
else
{
	$minLevel=80;
	$nivel=90;
	$waves=3;
	$grado=1;
	if(isset($_POST['grado']))
	{
		if($dimencion!=1)
		{
			$errorMsg="Tienes que estar en la dimencion de Embolia";
			$error=1;
		}

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
					}
		}

		$grado = $pj["dungeonElite"]+1;
		$dungeonLevel = intval($_POST['nivel']);
		//LEVEL CHECK
		if($pj['nivel'] < $minLevel)
						{
							$errorMsg="necesitas ser nivel ".$minLevel." para este dungeon";
							$error=1;
						}
		if($dungeonLevel>($pj["dungeonElite"]+1) OR $dungeonLevel<=0)
		{
			$errorMsg="Error en nivel de dungeon";
			$error=1;
		}				

		if($pj['party']>0 AND $pj['party']!=$pj['idPersonaje']) 
		{
			$errorMsg="Tenes que ser el lider de la party";
			$error=1;
		}
		
		$query = 'SELECT idInventario, cantidad
					FROM inventario 
					WHERE  idCuenta = '.$log->get("idCuenta").' AND idItem = 570';
		$dropsq = $db->sql_query($query);
		$drop = $db->sql_fetchrow($dropsq);
		if($drop['cantidad']<=0)
		{
			$errorMsg="Necesitas tener un Elite Ticket";
			$error=1;
		}
		if($error==0)
		{
			$db->sql_query("UPDATE inventario SET
					cantidad = (cantidad-1)
					WHERE idInventario = ".$drop['idInventario']);

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
		
		 $db->sql_query('INSERT INTO  dungeon_instance(idPersonaje,nivel,waves,waveCurr,itemGrado,dificultad,elite,eliteLevel,idParty) 
		VALUES("'.$pj['idPersonaje'].'","'.$nivel.'",'.$waves.',1,'.$grado.',1,1,'.$dungeonLevel.','.$party.')');
		
		$query = 'SELECT max(idInstance) AS ID FROM dungeon_instance WHERE idPersonaje = '.$pj['idPersonaje'].'';	
					$itemsq = $db->sql_query($query);
					$maxId = $db->sql_fetchrow($itemsq);
					
		// Agregar Players
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
							FROM monster  WHERE exp=1 AND hardOne = 3 AND raid = 0 ORDER BY RAND() DESC LIMIT 0,3';
							$monster = $db->sql_query($query);
							$bichobis=0;
							while($chor = $db->sql_fetchrow($monster))
							{	
									for($i=0;$i<$cantidad;$i++)
									{
										if($bichobis<5)
										{
										$vida=$chor['VidaLimit'];
										$vida+=intval(($vida*($dungeonLevel+1))/4);
										$db->sql_query('INSERT INTO  inmundo(idMonster,tipo,mundo,currentLife,champion,dificulty,idInstance) 
												VALUES("'.$chor['idMonster'].'","2",
												1,"'.$vida.'",0,0,'.$maxId['ID'].')');
										}
										$bichobis++;
									}
							}
		$msg = '<div class=questMeta>Elite Dungeon Nivel '.$dungeonLevel.' iniciado.</div>';
		if($pj['party']>0)
			systemLog("party",$msg);	
		else
			systemLog("self",$msg);	
		show_message("Dungeon Elite iniciado!","index.php?sec=mundo");
		}
		else
		{
			show_error($errorMsg,"index.php?sec=edungeon");
		}
	}
	else
	{
			$template->assign_var('DUNGEONLVL', $pj["dungeonElite"]);
			$template->assign_var('DUNGEONREC', $pj["dungeonElite"]+1);
			if($pj["dungeonElite"]>0)
			$template->assign_var('DUNGEONCOST', 1);
				else
			$template->assign_var('DUNGEONCOST', 0);
			for($i=($pj["dungeonElite"]+1);$i>0;$i--)
					{	
						if($i>0)
						{
							$astrales=intval(($i*$i)/2)+1;
						
						$template->assign_block_vars('D', array(
												'LVL' =>$i,
												'REC' =>$astrales
												));
						}
					}	

			$template->set_filenames(array(
										'content' => 'templates/sec/Edungeon.html' )
									);
	}
}
?> 