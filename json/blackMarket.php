<?php
define('SWORDON', 1);
include('../system/conexion.php');
include('../system/login.php');
include('../system/funciones.php');
session_start();
$db = new sql_db;
$log = new LOGuser;

function GetChaos()
{
	global $db,$log;
	$query = 'SELECT inv.idInventario, inv.cantidad
						FROM inventario inv
						WHERE inv.idCuenta = '.$log->get("idCuenta").' AND inv.usadoPor = 0 AND inv.enVenta = 0 AND inv.intradeable = 0
						AND  idItem = 614';
	$dropsq = $db->sql_query($query);
	$CraftFromPlayer = $db->sql_fetchrow($dropsq);
	return (int)$CraftFromPlayer['cantidad'];
}


$data['error']=1;
$data['error_msg']="";
switch ($_GET['t']) {
	case 'craftxchaos':
		$tier = (int)$_GET['tier'];
		$cant = (int)$_GET['cant'];

		$check = $cant%100;
		if($check==0 && $cant>0 && $cant<100000 && $tier>=3 && $tier<=9)
		{
			$matId = 0;
			$ratio = 0;
			switch ($tier) {
				case 3:
					$matId = 400;
					$ratio = 1;
				break;
				case 4:
					$matId = 401;
					$ratio = 2;
				break;
				case 5:
					$matId = 402;
					$ratio = 3;
				break;
				case 6:
					$matId = 403;
					$ratio = 4;
				break;
				case 7:
					$matId = 438;
					$ratio = 5;
				break;
				case 8:
					$matId = 449;
					$ratio = 7;
				break;
				case 9:
					$matId = 450;
					$ratio = 10;
				break;
			}

			if($matId>0)
			{
					$query = 'SELECT inv.idInventario, inv.cantidad
						FROM inventario inv
						WHERE inv.idCuenta = '.$log->get("idCuenta").' AND inv.usadoPor = 0 AND inv.enVenta = 0 AND inv.intradeable = 0
						AND  idItem = '.$matId;
					$dropsq = $db->sql_query($query);
					$CraftFromPlayer = $db->sql_fetchrow($dropsq);
					if($CraftFromPlayer['cantidad']>=$cant)
					{
						$chaos = $cant/100 * $ratio;

						$db->sql_query("UPDATE inventario SET
																		cantidad = (cantidad-".$cant.")
																		WHERE idItem = ".$matId." AND idCuenta = ".$log->get("idCuenta")."");
						add_item(614,$chaos);
						$data['error_msg']="Obtuviste ".$chaos." Chaos!";
						$data['error']=0;
					}
					else
					{
						$data['error']=1;
						$data['error_msg']="No tienes suficientes crafts";
					}
				
			}
		}
	break;
	case 'update':
		$tier = (int)$_GET['tier'];
		$piece = $_GET['piece'];
		$data['error']=0;
		$typee=textIntoSql($piece);
		$sqladd2="";
		if($typee == "W1")
		{
			$typee = "W";
			$sqladd2 = " AND (inv.manoIzquierda = 1 OR (inv.manoIzquierda = 0 AND inv.manoDerecha = 0)) ";
		}
		if($typee == "W2")
		{
			$typee = "W";
			$sqladd2 = " AND inv.manoDerecha = 1 ";
		}
		$query = 'SELECT inv.idExodimo, inv.idInventario, inv.value, i.Nombre, i.grado, inv.corrupted
		FROM inventario inv 
		JOIN item i 
		USING (idItem) 
		WHERE i.tipo = "'.$typee.'"
		AND inv.usadoPor = '.$log->get("pjSelected").'
		
		AND inv.enVenta = 0'.$sqladd2;
		$selectItemsq = $db->sql_query($query);
		$selectItem = $db->sql_fetchrow($selectItemsq);

		if((int)$selectItem['idInventario']==0)
		{
			$data['error']=1;
			$data['error_msg']="No se encontro el item";
		}
		
		if($selectItem['corrupted']==1 && $data['error']==0)
		{
			$data['error']=1;
			$data['error_msg']="No se puede updatear items corruptos";
		}

		$price = 0;
		$minCant=0;
		$maxCant=0;
		switch ($tier) {
			case 6:
				$price = 10;
				$realGrade = 8;
				$minCant=1;
				$maxCant=2;
			break;
			case 7:
				$price = 15;
				$realGrade = 9;
				$minCant=1;
				$maxCant=3;
			break;
			case 8:
				$price = 20;
				$realGrade = 10;
				$minCant=2;
				$maxCant=3;
			break;
			case 9:
				$price = 30;
				$realGrade = 11;
				$minCant=2;
				$maxCant=4;
			break;
		}

		if($selectItem['grado']!=$realGrade && $data['error']==0)
		{
			$data['error']=1;
			$data['error_msg']="El item no es el grado seleccionado";
		}

		if( GetChaos() <  $price)
		{
			$data['error']=1;
			$data['error_msg']="No tienes suficientes Chaos";
		}

		if($data['error']==0)
		{
			$itemId = $selectItem['idInventario'];
			$db->sql_query('DELETE FROM item_attr WHERE idInventario = '.$itemId.' AND blackmarket=1');


			$acumulate=mt_rand($minCant,$maxCant);
			$buffGiven=0;

			$resistFireFree = true;
			$resistWaterFree = true;
			$resistWindFree = true;
			$resistEarthFree = true;
			$resistDarkFree = true;
			$resistHolyFree = true;
			$resistAllFree = true;
			$VidaLimitFree=true;
			$CriticalPowerFree=true;
			$CriticalPowerMagicFree=true;
			$attaqueFree=true;
			$attaqueMagicFree=true;
			$leyenda="";
			$mainLuky =  mt_rand(5,10);
			
			while($buffGiven<$acumulate)
			{
				$chanc = mt_rand(1,20);
				if($chanc==$mainLuky AND $resistAllFree AND $buffGiven<$acumulate)
					{
						$resistAllFree=false;
						$buffGiven++;
						$attr="ResAll";
						$valor=(int)rand_float($realGrade*0.5,$realGrade*1.5);
						$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor,blackmarket) VALUES("'.$itemId.'","'.$attr.'","'.$valor.'",1)');
						$leyenda .= "&#128310; ".$attr." +".$valor." <br>";
					}
				$chanc = mt_rand(1,20);
				if($chanc==$mainLuky AND $resistHolyFree AND $buffGiven<$acumulate)
					{
						$resistHolyFree=false;
						$buffGiven++;
						$attr="ResHoly";
						$valor=mt_rand($realGrade*1,$realGrade*5);
						$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor,blackmarket) VALUES("'.$itemId.'","'.$attr.'","'.$valor.'",1)');
						$leyenda .= "&#128310; ".$attr." +".$valor." <br>";
					}
				$chanc = mt_rand(1,20);
				if($chanc==$mainLuky AND $resistDarkFree AND $buffGiven<$acumulate)
					{
						$resistDarkFree=false;
						$buffGiven++;
						$attr="ResDark";
						$valor=mt_rand($realGrade*1,$realGrade*5);
						$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor,blackmarket) VALUES("'.$itemId.'","'.$attr.'","'.$valor.'",1)');
						$leyenda .= "&#128310; ".$attr." +".$valor." <br>";
					}
				$chanc = mt_rand(1,20);
				if($chanc==$mainLuky AND $resistEarthFree AND $buffGiven<$acumulate)
					{
						$resistEarthFree=false;
						$buffGiven++;
						$attr="ResEarth";
						$valor=mt_rand($realGrade*1,$realGrade*5);
						$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor,blackmarket) VALUES("'.$itemId.'","'.$attr.'","'.$valor.'",1)');
						$leyenda .= "&#128310; ".$attr." +".$valor." <br>";
					}
				$chanc = mt_rand(1,20);
				if($chanc==$mainLuky AND $resistFireFree AND $buffGiven<$acumulate)
					{
						$resistFireFree=false;
						$buffGiven++;
						$attr="ResFire";
						$valor=mt_rand($realGrade*1,$realGrade*5);
						$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor,blackmarket) VALUES("'.$itemId.'","'.$attr.'","'.$valor.'",1)');
						$leyenda .= "&#128310; ".$attr." +".$valor." <br>";
					}
					$chanc = mt_rand(1,20);
				if($chanc==$mainLuky AND $resistWaterFree AND $buffGiven<$acumulate)
					{
						$resistWaterFree=false;
						$buffGiven++;
						$attr="ResWater";
						$valor=mt_rand($realGrade*1,$realGrade*5);
						$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor,blackmarket) VALUES("'.$itemId.'","'.$attr.'","'.$valor.'",1)');
						$leyenda .= "&#128310; ".$attr." +".$valor." <br>";
					}

					$chanc = mt_rand(1,20);
				if($chanc==$mainLuky AND $resistWindFree AND $buffGiven<$acumulate)
					{
						$resistWindFree=false;
						$buffGiven++;
						$attr="ResWind";
						$valor=mt_rand($realGrade*1,$realGrade*5);
						$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor,blackmarket) VALUES("'.$itemId.'","'.$attr.'","'.$valor.'",1)');
						$leyenda .= "&#128310; ".$attr." +".$valor." <br>";
					}


				$chanc = mt_rand(1,20);
				if($chanc==$mainLuky AND $attaqueFree AND $buffGiven<$acumulate)
					{
						$attaqueFree=false;
						$buffGiven++;
						$attr="Ataque";
						$valor=mt_rand($realGrade*15,$realGrade*30);
						$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor,blackmarket) VALUES("'.$itemId.'","'.$attr.'","'.$valor.'",1)');
						$leyenda .= "&#128310; ".$attr." +".$valor." <br>";
					}
				$chanc = mt_rand(1,20);
				if($chanc==$mainLuky AND $attaqueMagicFree AND $buffGiven<$acumulate)
					{
						$attaqueMagicFree=false;
						$buffGiven++;
						$attr="AtaqueMagico";
						$valor=mt_rand($realGrade*15,$realGrade*30);
						$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor,blackmarket) VALUES("'.$itemId.'","'.$attr.'","'.$valor.'",1)');
						$leyenda .= "&#128310; ".$attr." +".$valor." <br>";
					}
					$chanc = mt_rand(1,20);
				if($chanc==$mainLuky AND $CriticalPowerFree AND $buffGiven<$acumulate)
					{
						$CriticalPowerFree=false;
						$buffGiven++;
						$attr="PC";
						$valor=mt_rand($realGrade*10,$realGrade*15);
						$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor,blackmarket) VALUES("'.$itemId.'","'.$attr.'","'.$valor.'",1)');
						$leyenda .= "&#128310; ".$attr." +".$valor." <br>";
					}
					$chanc = mt_rand(1,20);
				if($chanc==$mainLuky AND $CriticalPowerMagicFree AND $buffGiven<$acumulate)
					{
						$CriticalPowerMagicFree=false;
						$buffGiven++;
						$attr="PCMagico";
						$valor=mt_rand($realGrade*10,$realGrade*15);
						$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor,blackmarket) VALUES("'.$itemId.'","'.$attr.'","'.$valor.'",1)');
						$leyenda .= "&#128310; ".$attr." +".$valor." <br>";
					}
					$chanc = mt_rand(1,20);
				if($chanc==$mainLuky AND $VidaLimitFree AND $buffGiven<$acumulate)
					{
						$VidaLimitFree=false;
						$buffGiven++;
						$attr="VidaLimit";
						$valor=mt_rand($realGrade*40,$realGrade*60);
						$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor,blackmarket) VALUES("'.$itemId.'","'.$attr.'","'.$valor.'",1)');
						$leyenda .= "&#128310; ".$attr." +".$valor." <br>";
					}
			}

			recreateItem($itemId);
			unset($_SESSION['PJITEM']);
			$db->sql_query("UPDATE inventario SET
				cantidad = (cantidad-".$price.")
				WHERE idItem = 614 AND idCuenta = ".$log->get("idCuenta")."");
			$data['error']=0;
			$data['error_msg']="Item Updated!";
		}

	break;
}



echo json_encode($data);
?>
