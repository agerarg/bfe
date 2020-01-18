<?php
                 		//ALONE
	$rd = mt_rand(1,5);
	//add_item(673,1,$targets["idCuenta"]);
	if($rd==3)
	{
		$customDrolv=12;
		earnDropBox($customDrolv,1,$targets["idPersonaje"]);
		systemLog("party","<div class=recompensaAstral>".$targets["nombre"]." saco un cofre nivel ".$customDrolv." Astral!</div>") ;	      
	}	
?>
