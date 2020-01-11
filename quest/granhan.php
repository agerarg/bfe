<?php
if($mision['idMisionOn'])
{
	$heart = mt_rand(5,10);
	
	switch(mt_rand(1,8))
	{
		case 1:
			$hsName="Bow Heart";
			$hsId=560;
		break;
		case 2:
			$hsName="Fist Heart";
			$hsId=561;
		break;
		case 3:
			$hsName="Dual Heart";
			$hsId=562;
		break;
		case 4:
			$hsName="Sword Heart";
			$hsId=563;
		break;
		case 5:
			$hsName="Big Sword Heart";
			$hsId=564;
		break;
		case 6:
			$hsName="Blunt Heart";
			$hsId=565;
		break;
		case 7:
			$hsName="Dagger Heart";
			$hsId=566;
		break;
		case 8:
			$hsName="Staff Heart";
			$hsId=568;
		break;
	}

	$gpart = mt_rand(40,50);
	$gcore = mt_rand(3,8);
	$msg = "<div class='questDrop'>
	".$heart." ".$hsName."<br>
	".$gpart." Gran Part<br>
	".$gcore." Gran Core<br>
	</div>";

	add_item($hsId,$heart,$mision['idCuenta'],0);
	add_item(558,$gpart,$mision['idCuenta'],0);
	add_item(559,$gcore,$mision['idCuenta'],0);
}
else
	die("GTFO!");
?>
