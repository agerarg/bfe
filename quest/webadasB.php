<?php
if($mision['idMisionOn'])
{
	$Material = mt_rand(40,60);
	$Piece = mt_rand(10,15);
	$Blade = mt_rand(10,15);
	$msg = "<div class='questDrop'>
	".$Material." B materials<br>
	".$Piece." B piece<br>
	".$Blade." B blade<br>
	</div>";
	
			add_item(236,$Material,$mision['idCuenta']);
			add_item(238,$Piece,$mision['idCuenta']);
			add_item(237,$Blade,$mision['idCuenta']);
}
else
	die("GTFO!");
?>
