<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
if($pj["idCuenta"]==1)
{
	if(isset($_POST['cantidad']))
	{
		$cantidad = intval($_POST['cantidad']);
		$usuario = textIntoSql($_POST['nombre']);
		$query = 'SELECT nombre,pjSelected
				FROM cuenta
			WHERE nombre = "'.$usuario.'"';
		$cta = $db->sql_fetchrow($db->sql_query($query));
		if($cta)
		{
			if($cantidad>0)
			{
				systemLog("self","Se envio ".$cantidad." a ".$cta['nombre']);
				systemLog("other","<div class=recompensa>El admin te dio ".$cantidad." puntos de Rec.</div>",$cta['pjSelected']);
				show_message($cantidad." rec enviadas!","index.php?sec=admin");
			}
			else
				show_error("Pone la cantidad","index.php");
		}
		else
		show_error("No se encontro la cuenta (".$cta['nombre'].")","index.php?sec=admin");
	}
	else
	{
					$template->set_filenames(array(
									'content' => 'templates/sec/admin.html' )
								);	
	}
}
else
	show_error("No tienes permisos!","index.php");
?> 