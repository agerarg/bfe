<?php
if($mision['idMisionOn'])
{
		$ew = mt_rand(1,3);
		$ea = mt_rand(2,5);
		add_item(299,$ew,$mision['idCuenta'],1);
		add_item(298,$ea,$mision['idCuenta'],1);
				
		$msg = "<div class='questEnd'>
	Upgrade your items quest completed!<br>
	All gain ".$ew." EWA y ".$ea." EAA
	</div>";
}
else
	die("GTFO!");
?>
