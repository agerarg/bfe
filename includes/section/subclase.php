<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
$template->set_filenames(array(
							'content' => 'templates/sec/subclase.html' )
						);
$jscriptSub="";
die("subClase deshabilitado");
				
	$id = intval($_POST['clase']);
	if($id==0)
		$id = intval($_GET['clase']);
	if(isset($_POST['clase']) OR (isset($_GET['clase']) AND $_SESSION['subclaseQuest']==$id))
	{
		$query = 'SELECT nombre
								FROM clase
								WHERE idClase = '.$id.' AND active_class = 1';
		$subclase = $db->sql_fetchrow($db->sql_query($query));
		if($subclase)
		{
			if($pj['nivel']!=80)
				{
					show_error("Para hacer subclase requiere ser nivel 80","index.php?sec=subclase");
				}
				else
			if($id == $pj['idClase'])
				{
					show_error("No podes elegir tu misma clase","index.php?sec=subclase");
				}
				else
			if($pj['id_clase1']==0)
			{
				if(isset($_GET['si']))
				{
					$query = 'SELECT idInventario
								FROM inventario
								WHERE usadoPor = '.$log->get("pjSelected").' LIMIT 0,1';
					$item = $db->sql_fetchrow($db->sql_query($query));
					if($item)
					{
						show_error("Desequipa todos tus items para poder hacer subclase","index.php?sec=subclase");
					}
					else
					{
						$parPerLv = ($pj['paragonAcc']-8);
						$db->sql_query("DELETE FROM skilllearn WHERE idPersonaje = '".$pj['idPersonaje']."'");
						$db->sql_query("DELETE FROM aura WHERE idPersonaje = '".$pj['idPersonaje']."'");
						
						$db->sql_query("UPDATE personaje SET nivel=1, exp=0, expUp=5, id_clase1=".$id.", skillPoints=1, paragonAcc=".$parPerLv.", paragonNow=".$parPerLv." WHERE idPersonaje = ".$log->get("pjSelected"));
						show_message("Felicidades ahora tienes una nueva subclase","index.php?sec=subclase");
					}
				}
				else
				{
					$_SESSION['subclaseQuest']=$id;
					show_message("Estas seguro de elegir (".$subclase['nombre'].") como primera subclase?<br>
					<a href='index.php?sec=subclase&clase=".$id."&si=sabeee'>SI</a> - <a href='index.php?sec=subclase'>NO</a>","index.php?sec=subclase");
				}
			}else
			if($pj['id_clase2']==0)
			{
				if($pj['id_clase1']==$id)
				{
					show_error("Ya tienes subclase de esa clase","index.php?sec=subclase");
				}
				else
				if(isset($_GET['si']))
				{
					$query = 'SELECT idInventario
								FROM inventario
								WHERE usadoPor = '.$log->get("pjSelected").' LIMIT 0,1';
					$item = $db->sql_fetchrow($db->sql_query($query));
					if($item)
					{
						show_error("Desequipa todos tus items para poder hacer subclase","index.php?sec=subclase");
					}
					else
					{
						$parPerLv = ($pj['paragonAcc']-8);
						$db->sql_query("DELETE FROM skilllearn WHERE idPersonaje = '".$pj['idPersonaje']."'");
						$db->sql_query("DELETE FROM aura WHERE idPersonaje = '".$pj['idPersonaje']."'");
						
						$db->sql_query("UPDATE personaje SET nivel=1, exp=0, expUp=5, id_clase2=".$id.", skillPoints=1, paragonAcc=".$parPerLv.", paragonNow=".$parPerLv." WHERE idPersonaje = ".$log->get("pjSelected"));
						show_message("Felicidades ahora tienes una nueva subclase","index.php?sec=subclase");
					}
				}
				else
				{
					$_SESSION['subclaseQuest']=$id;
					show_message("Estas seguro de elegir (".$subclase['nombre'].") como segunda subclase?<br>
					<a href='index.php?sec=subclase&clase=".$id."&si=sabeee'>SI</a> - <a href='index.php?sec=subclase'>NO</a>","index.php?sec=subclase");
				}
			}
			else
			if($pj['id_clase2']>0 AND $pj['id_clase3']==0)
			{
				//////////
				if($pj['id_clase1']==$id OR $pj['id_clase2']==$id)
				{
					show_error("Ya tienes subclase de esa clase","index.php?sec=subclase");
				}
				else
				if(isset($_GET['si']))
				{
					$query = 'SELECT idInventario
								FROM inventario
								WHERE usadoPor = '.$log->get("pjSelected").' LIMIT 0,1';
					$item = $db->sql_fetchrow($db->sql_query($query));
					if($item)
					{
						show_error("Desequipa todos tus items para poder hacer subclase","index.php?sec=subclase");
					}
					else
					{
						$parPerLv = ($pj['paragonAcc']-8);
						$db->sql_query("DELETE FROM skilllearn WHERE idPersonaje = '".$pj['idPersonaje']."'");
						$db->sql_query("DELETE FROM aura WHERE idPersonaje = '".$pj['idPersonaje']."'");
						
						$db->sql_query("UPDATE personaje SET nivel=1, exp=0, expUp=5, id_clase3=".$id.", skillPoints=1, paragonAcc=".$parPerLv.", paragonNow=".$parPerLv." WHERE idPersonaje = ".$log->get("pjSelected"));
						show_message("Felicidades ahora tienes una nueva subclase","index.php?sec=subclase");
					}
				}
				else
				{
					$_SESSION['subclaseQuest']=$id;
					show_message("Estas seguro de elegir (".$subclase['nombre'].") como tercera subclase?<br>
					<a href='index.php?sec=subclase&clase=".$id."&si=sabeee'>SI</a> - <a href='index.php?sec=subclase'>NO</a>","index.php?sec=subclase");
				}
			}
			else
				show_error("Solo se puede tener 3 subclases","index.php?sec=subclase");
			
			
		}
		else
			show_error("La clase no existe","index.php?sec=subclase");
	}
	else
	{	
		$jscriptSub .= "$('#subclase1').fadeIn(1000); ";
		
		$query = 'SELECT nombre, idClase
							FROM clase
							WHERE active_class = 1';
		$query = $db->sql_query($query);
		while($clas = $db->sql_fetchrow($query))
			{	
				$template->assign_block_vars('CLASES', array(
							'NOMBRE' => $clas['nombre'],
							'ID' => $clas['idClase'],
							));
			}	
		
		
		if($pj['id_clase1']==0)
			$jscriptSub .= "$('#noSub1').fadeIn(1000); ";
		else
		{
			$jscriptSub .= "$('#alreadySub1').fadeIn(1000); ";
			$query = 'SELECT nombre, idClase
								FROM clase
								WHERE idClase = '.$pj['id_clase1'].'';
			$subclase1 = $db->sql_fetchrow($db->sql_query($query));
			 $template->assign_var('SUBCLASE1', $subclase1['nombre']);
			  $template->assign_var('SUBID1', $subclase1['idClase']);
			 $jscriptSub .= "$('#subclase2').fadeIn(1000); ";
		}
		
		if($pj['id_clase1']>0 AND $pj['id_clase2']==0)
		{
			$jscriptSub .= "$('#noSub2').fadeIn(1000); ";
		}
		else
		{
			$query = 'SELECT nombre, idClase
								FROM clase
								WHERE idClase = '.$pj['id_clase2'].'';
			$subclase1 = $db->sql_fetchrow($db->sql_query($query));
			 $template->assign_var('SUBCLASE2', $subclase1['nombre']);
			  $template->assign_var('SUBID2', $subclase1['idClase']);
			 $jscriptSub .= "$('#alreadySub2').fadeIn(1000); ";
			  $jscriptSub .= "$('#subclase3').fadeIn(1000); ";
		}
		
		if($pj['id_clase2']>0 AND $pj['id_clase3']==0)
		{
			$jscriptSub .= "$('#noSub3').fadeIn(1000); ";
		}
		else
		{
			$query = 'SELECT nombre, idClase
								FROM clase
								WHERE idClase = '.$pj['id_clase3'].'';
			$subclase1 = $db->sql_fetchrow($db->sql_query($query));
			 $template->assign_var('SUBCLASE3', $subclase1['nombre']);
			 $template->assign_var('SUBID3', $subclase1['idClase']);
			 $jscriptSub .= "$('#alreadySub3').fadeIn(1000); ";
		}
		
	}
	 $template->assign_var('SUBSCRIPT', $jscriptSub);

?> 