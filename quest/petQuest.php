<?php
if($mision['idMisionOn'])
{
	$msg = "<div class='questEnd'>".$mision['nombre']." completa!</div><div class='questDrop'>
	Gano un Huevo de Perro<br>
	</div>";
	add_item(414,1,$mision['idCuenta'],0);
		
}
else
	die("GTFO!");
?>
