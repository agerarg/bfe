<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////

$template->set_filenames(array(
							'content' => 'templates/sec/trade.html' )
						);
						
					$query = 'SELECT *
				FROM trade
				WHERE usr1 = '.$log->get("idCuenta").' OR usr2 = '.$log->get("idCuenta").' ';
				$tradesq = $db->sql_query($query);
					$trade = $db->sql_fetchrow($tradesq);
			if($trade)
			{		
				if($trade['usr1']==$log->get("idCuenta"))
				{
					$idDelOtro = $trade['usr2'];
					$my=1;
					$he=2;
				}
				else
				{
					$idDelOtro = $trade['usr1'];
					$my=2;
					$he=1;
				}
				$query = 'SELECT i.imagen, i.tipo,inv.idInventario,i.hand,i.imagen,inv.tradeTo
				FROM inventario inv, item i
				WHERE inv.idItem = i.idItem AND inv.trade=1 AND 
				inv.idCuenta = '.$log->get("idCuenta").' 	AND inv.tradeTo='.$idDelOtro.'';
					$itemsq = $db->sql_query($query);
					while($item = $db->sql_fetchrow($itemsq))
					{
							$template->assign_block_vars('OUR', array(
								'ID' => $item['idInventario']));	

					}
					if($trade['comfirmado1']==1 AND $trade['comfirmado2']==1)
						$template->assign_var('OFFER', 2);
					else if($trade['comfirmado'.$my]==1 AND $trade['comfirmado'.$he]==2)
						$template->assign_var('OFFER', 2);
					else if($trade['comfirmado'.$my]==2)
						$template->assign_var('OFFER', 3);	
					else
					 if($trade['comfirmado'.$my]==1)
						 $template->assign_var('OFFER', 1);	
					 else
						$template->assign_var('OFFER', 0);	
					
					
					
					$query = 'SELECT p.nombre
					FROM cuenta c, personaje p
					WHERE c.idCuenta = '.$idDelOtro.' AND c.pjSelected = p.idPersonaje';
				$ctasq = $db->sql_query($query);
				$cta = $db->sql_fetchrow($ctasq);	
					
				$query = 'SELECT p.nombre
					FROM cuenta c, personaje p
					WHERE c.idCuenta = '.$log->get("idCuenta").' AND c.pjSelected = p.idPersonaje';
				$pjsq = $db->sql_query($query);
				$pj = $db->sql_fetchrow($pjsq);		

				$template->assign_vars(array(
			 'MYNICK' => $pj["nombre"],
			 'OTHERNICK' => $cta["nombre"],
			 'MYGOLD'=>$trade['gold'.$my], 
			 'HISGOLD'=>$trade['gold'.$he]
			 ));	
					
				
			}
			else
			{
				$template->set_filenames(array(
							'content' => 'templates/sec/trade_src.html' )
						);

			}
?> 