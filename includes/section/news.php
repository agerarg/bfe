<?php

			$template->set_filenames(array(
									'content' => 'templates/sec/facebookNews.html' )
								);



					$query = 'SELECT * FROM updates ORDER BY id DESC LIMIT 0,3';
					$updatesq = $db->sql_query($query);

					while($update = $db->sql_fetchrow($updatesq))
					{
						$date=date_create($update['fecha']);
						$fecha = date_format($date,"d-m-Y");
						$template->assign_block_vars('UPDATE', array(
											'TITULO' => $update['titulo'],
											'VIDEO' => $update['idvideo'],
											'FECHA' => $fecha
											));		
					}


?>

