<?php
                 		//ALONE
                 if(mt_rand(1,20)==15)
                 {
					add_item(651,1,$targets["idCuenta"],1);
					systemLog("self","<div class=drop2>Conseguiste un Garca Pass</div>") ;
					systemLog("party","<div class=recompensaAstral>".$targets['nombre']." gano Garca Pass</div>") ;      
				 }
				 if(mt_rand(1,20)==7)
                 {
					 $query = 'SELECT i.Nombre, i.contable, i.leg, i.idItem, i.subtipo
						 FROM item i
						 WHERE i.tipo = "stone" ORDER BY RAND() LIMIT 0,1';
						 $dropssq = $db->sql_query($query);
						 $drop = $db->sql_fetchrow($dropssq);

						$StoneTier = 10;

						if($StoneTier)
						{
						   add_item($drop['idItem'],1,$targets["idCuenta"]);
						     systemLog("party","<div class=recompensaAstral>".$targets['nombre']." gano ".$drop['Nombre']."</div>") ;        
						}
				 }

?>
