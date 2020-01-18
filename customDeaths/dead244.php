<?php
                 		//ALONE
			$cant = mt_rand(1,3);
			add_item(673,$cant,$targets["idCuenta"]);
			systemLog("party","<div class=recompensaAstral>".$targets['nombre']." gano ".$cant." Astral Key</div>") ;         
					
?>
