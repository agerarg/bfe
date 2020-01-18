<?php
                 		//ALONE
			$cant = mt_rand(1,20);
			if($cant==6)
			{
				add_item(673,1,$targets["idCuenta"]);
				systemLog("party","<div class=recompensaAstral>".$targets['nombre']." gano un Astral Key</div>") ;         
			}
?>
