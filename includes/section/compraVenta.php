<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
if($logros['shika']>=3)
	{
		$template->set_filenames(array(
											'content' => 'templates/sec/compra_venta.html' )
										);

		$query = 'SELECT idInventario, cantidad
							FROM inventario 
							WHERE  idCuenta = '.$log->get("idCuenta").' AND idItem = 547';
							$dropsq = $db->sql_query($query);
							$drop = $db->sql_fetchrow($dropsq);
							$realGold = $drop['cantidad'];

				$template->assign_var('POLVOS', intval($realGold) );
	}	
	else
	{
		show_error("No tienes acceso a esta sección ","index.php");
	}		
?> 