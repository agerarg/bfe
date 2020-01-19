<?php

			$template->set_filenames(array(
									'content' => 'templates/sec/cartas.html' )
								);

		$query = 'SELECT i.idItem, i.cantReq, inv.cantidad FROM item i LEFT JOIN inventario inv ON inv.idItem = i.idItem AND inv.idCuenta = '.$log->get("idCuenta").'
		WHERE i.subtipo = "card"';
		$cartsSq = $db->sql_query($query);
		while($card = $db->sql_fetchrow($cartsSq))
		{
			$template->assign_block_vars('CARD', array(
				'IMAGE' => $card['idItem'],
				'CANTIDAD' => (int)$card['cantidad'],
				'CANTIDADREQ' =>  $card['cantReq']
				));		
		}	
		


		/*$query = 'SELECT * FROM cartas';
		$cartsSq = $db->sql_query($query);
		while($card = $db->sql_fetchrow($cartsSq))
		{
			$template->assign_block_vars('CARD', array(
				'IMAGE' => $card['imagen'],
				'CANTIDAD' => 0,
				'CANTIDADREQ' =>  $card['cantidadReq']
				));		
		}		*/	


