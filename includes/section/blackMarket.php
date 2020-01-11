<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
$template->set_filenames(array(
											'content' => 'templates/sec/blackMarket.html' )
										);

if(isset($_GET['cagame']))
{
	switch ($_GET['cagame']) {
			case 'Anillo':
				$tipo="rings";
				$cost=3;
			break;
			case 'Casco':
				$tipo="head";
				$cost=3;
			break;
			case 'Collar':
				$tipo="necklace";
				$cost=3;
			break;
			case 'Arma':
				$tipo="W";
				$cost=5;
			break;
			case 'Armadura':
				$tipo="armor";
				$cost=5;
			break;
			case 'Escudo':
				$tipo="shield";
				$cost=3;
			break;
			case 'Guantes':
				$tipo="gloves";
				$cost=3;
			break;
			case 'Botas':
				$tipo="foots";
				$cost=3;
			break;
			default:
				show_error("Tipo de item no especificado","index.php?sec=blackMarket");
			break;
	}

	$query = 'SELECT idInventario, cantidad
					FROM inventario 
					WHERE  idCuenta = '.$log->get("idCuenta").' AND idItem = 547';
		$dropsq = $db->sql_query($query);
		$drop = $db->sql_fetchrow($dropsq);
		if($drop['cantidad']<$cost)
		{
			$errorMsg="No tienes suficiente Polvo Astral";
			show_error($errorMsg,"index.php?sec=blackMarket");
			$error=1;
		}
		if($error==0)
		{
			$db->sql_query("UPDATE inventario SET
					cantidad = (cantidad-".$cost.")
					WHERE idInventario = ".$drop['idInventario']);
		if(!$legendaryAviable)
			include("system/legendary.php");

		$query = 'SELECT i.Nombre, i.contable, i.leg, i.idItem
		FROM item i
		WHERE tier=0 AND (epic=1 OR forceStats=1) AND tipo="'.$tipo.'" ORDER BY RAND() LIMIT 0,1';
		$dropssq = $db->sql_query($query);
		$drop = $db->sql_fetchrow($dropssq);
		$value="";
		$chance = mt_rand(1,100);	
		///LEGENDARY
		$LegChance = 1;
		// EPIC
		$EpicChance = 5;
		// RARO
		$RareChance = 30;	
		if($chance<=$LegChance)
		{
			$valueInt=4;
			$value="Legendario";
			$varDropOn=1;
		}else if($chance<=$EpicChance)
		{
			$valueInt=3;
			$value="Epico";
			$varDropOn=1;
		}else if($chance<=$RareChance)
		{
			$valueInt=2;
			$value="Raro";
			$varDropOn=1;
		}else
		{
			$value="";
			$valueInt=1;
			$varDropOn=1;
		}
		createLegendary($drop['idItem'],0,$account,0,$valueInt,1,10,$drop['forceStats']);						
		$msg = "<div class=recompensaAstral>Mercado Negro:<br>".$drop['Nombre']." ".$value."</div>";	
		systemLog("self",$msg);
		show_message("Item Comprado!<br>".$msg,"index.php?sec=blackMarket");
		}

}
?> 