<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
if($logros['moosh']>=3)
{
if($stats['nameWeapon']==1)
{	
	$query = 'SELECT *
				FROM inventario
				WHERE idInventario = '.$stats['idWeapon'];
	$itemsq = $db->sql_query($query);
	$item = $db->sql_fetchrow($itemsq);
	if(isset($_POST['nombre']) AND $item['nameTimeTry']<time())
	{
		
		$nombre = textIntoSql($_POST['nombre']);
		
			$query = 'SELECT  nombre
			FROM jnombre
			WHERE idNombre = '.$item['idNombre'];
			$wnamesq = $db->sql_query($query);
			$wname = $db->sql_fetchrow($wnamesq);
			
			$query = 'SELECT  apellido
			FROM japellido
			WHERE idApellido = '.$item['idApellido'];
			$wlasNamesq = $db->sql_query($query);
			$wlasName = $db->sql_fetchrow($wlasNamesq);
			$fullName = $wname['nombre'].' '.$wlasName['apellido'];
		if($fullName == $nombre)
		{
			show_message("Feliidades! Haz encontrado el nombre de tu arma!","index.php");
			$db->sql_query("UPDATE inventario SET conNombre = 1, nameCheck='".$fullName."' WHERE idInventario = '".$item['idInventario']."'");	
			unset($_SESSION['PJITEM']);		
				
			
		}
		else
		{
			$db->sql_query("UPDATE inventario SET nameTimeTry = ".(time()+3600)." WHERE idInventario = '".$item['idInventario']."'");
			show_error("El nombre no es correcto!","index.php?sec=arma");
		}
	}
	else
	{	
	$template->set_filenames(array(
			'content' => 'templates/sec/arma.html' )
		);
		
	$template->assign_var('WNOMBRE', $item['nameCheck']);	
	
		if($item['nameTimeTry']>time())
		{
		 $template->assign_var('SHOWNIMPUT', "GTFO");
		 	$template->assign_var('NWTIME', conversor_segundos( $item['nameTimeTry']-time()));
		 
		}
		else
			$template->assign_var('SHOWNTIME', "GTFO");	
	}
}
else
{
	show_error("No tenes arma puesta, o es de nivel bajo!","index.php?");
}
}
else
{
	show_error("No tienes acceso a esta sección ","index.php");
}
?> 