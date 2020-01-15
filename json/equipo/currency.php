<?php
if($item['enVenta']==1)
{
	$data["error"] = "El item esta en venta.";
}else
if($item['cantidad']<=0)
{
	$data["error"]="No tienes mas de esto!";
}else
if($item['idItem']==615)
{
	$data["error"] = "Upulus: Ganaste un punto de habilidad";
	$db->sql_query("UPDATE personaje SET
		newSkillPoints = (newSkillPoints+1),
		skillPoints = (skillPoints+1)
	WHERE idPersonaje = ".$log->get("pjSelected")."");
	$db->sql_query("UPDATE inventario SET 
					cantidad = (cantidad-1)
					WHERE idInventario = ".$item['idInventario']);
}
else
{

	$typee=textIntoSql($_GET['focus']);
	$sqladd2="";
	if($typee == "Wizq")
	{
		$typee = "W";
		$sqladd2 = " AND (inv.manoIzquierda = 1 OR (inv.manoIzquierda = 0 AND inv.manoDerecha = 0))  ";
	}
	if($typee == "Wder")
	{
		$typee = "W";
		$sqladd2 = " AND inv.manoDerecha = 1 ";
	}
	$query = 'SELECT inv.idExodimo, inv.idInventario, inv.value, i.Nombre, i.grado
	FROM inventario inv 
	JOIN item i 
	USING (idItem) 
	WHERE i.tipo = "'.$typee.'"
	AND inv.usadoPor = '.$log->get("pjSelected").'
	AND inv.corrupted = 0
	AND inv.masterWork = 0
	AND inv.enVenta = 0'.$sqladd2;
	$selectItemsq = $db->sql_query($query);
	$selectItem = $db->sql_fetchrow($selectItemsq);

	if($selectItem)
	{
		switch($item['idItem'])
		{
			case 614: // CHAOS  
				$query = 'SELECT count(*) as CONTA
				FROM item_attr 
				WHERE idInventario = '.$selectItem['idInventario'].'
				AND NOT attrb IN ("wind","water","fire","earth","dark","holy")';
				$attrsq = $db->sql_query($query);
				$cta = $db->sql_fetchrow($attrsq);
				if($cta['CONTA']>1)
				{
					$query = 'SELECT *
					FROM item_attr 
					WHERE idInventario = '.$selectItem['idInventario'].'
					ORDER BY RAND() LIMIT 0,2';
					$attrsq = $db->sql_query($query);
					$more=false;

					$grade=$selectItem['grado'];
					
					$value=$selectItem['value'];
					if($value==0)
						$value=1;
					include('../system/tablaAtributos.php');

					while($attr = $db->sql_fetchrow($attrsq))
					{
						
						if($more)
						{
							$valor=$attr['valor']*2;
							$valUp=$attr['attrb'];
							switch($attr['attrb'])
					{
					/////// ALLLLL
						case "Ataque": // ataque
							if($valor>$maxSkill1)
							{
								$valor=$maxSkill1;
							}
							$limit=$maxSkill1;
						break;
						case "AtaqueMagico": // ataque magico
							if($valor>$maxSkill1)
							{
								$valor=$maxSkill1;
							}
							$limit=$maxSkill1;
						break;
						case "Critico": // critico
							$limit=$maxSkill3;
							if($valor>$limit)
							{
								$valor=$limit;
							}
						break;
						case "CriticoMagico": //critico magico
							$limit=$maxSkill3;
							if($valor>$limit)
							{
								$valor=$limit;
							}
						break;
						case "PC": // PC
							$limit=$maxSkill1;
							if($valor>$limit)
							{
								$valor=$limit;
							}
							
						break;
						case "PCMagico": // PC MAGICO
							$limit=$maxSkill1;
							if($valor>$limit)
							{
								$valor=$limit;
							}
						break;
						case "Defensa": // defensa
							$limit=$maxSkill2;
							if($valor>$limit)
							{
								$valor=$limit;
							}
						break;
						case "DefensaMagica": // defensa magica
							$limit=$maxSkill2;
							if($valor>$limit)
							{
								$valor=$limit;
							}
						break;
						case "VidaLimit": // vida
							$limit=$maxSkill4;
							if($valor>$limit)
							{
								$valor=$limit;
							}
						break;
						case "ManaLimit": // mana
						$limit=$maxSkill4;
							if($valor>$limit)
							{
								$valor=$limit;
							}
						break;
						case "HpRegen": //hp reg
							$limit=$maxSkill5;
							if($valor>$limit)
							{
								$valor=$limit;
							}
						break; 
						case "MpRegen": //mp regen
							$limit=$maxSkill5;
							if($valor>$limit)
							{
								$valor=$limit;
							}
						break;
						default:
							die();
						break;
						}
						$uppr=$valor;
						}
						else
						{
							$valor = intval($attr['valor']/2);
							$atrrFuck=$attr['attrb'];
							$valueFk=$valor;
						}
						$more=true;
						$db->sql_query("UPDATE item_attr SET
							valor = ".$valor."
						WHERE idAttrb = ".$attr["idAttrb"]."");
					}
					recreateItem($selectItem['idInventario']);
					$data["error"]="Chaos: el item (".$selectItem['Nombre'].") ah sido chaoseado!\n cambios [+".$valUp.":(".$uppr."/".$limit.")][-".$atrrFuck.":(".$valueFk.")]";
					$db->sql_query("UPDATE inventario SET 
									cantidad = (cantidad-1)
									WHERE idInventario = ".$item['idInventario']);
				}
				else
				$data["error"]="Error: el item (".$selectItem['Nombre'].") tiene que tener almenos 2 atributos.";
			break;
			//////////////////////////////////////////////////////////////////////////////////
			case 616: // EXODIMO
				if($selectItem['idExodimo']==0)
				{
					$grade=$selectItem['grado'];
					
					$value=$selectItem['value'];
					if($value==0)
						$value=1;
					include('../system/tablaAtributos.php');
					$cantBeAtr=Array();
					$query = 'SELECT *
					FROM item_attr
					WHERE idInventario = '.$selectItem['idInventario'];
					$itematrsq = $db->sql_query($query);
					$atrbList="";
					$vueltas=0;
					$leyendafin="";
					$forceElement=0;
					while($atrr = $db->sql_fetchrow($itematrsq))
					{
						if($atrr['idAttrb']!=$AtribId)
						{
							$cantBeAtr[$atrr['attrb']]=1;
						}
					}
				$vueltas=0;
				while(0==$vueltas)
					{
						
						$atrChance = mt_rand(2,13);
						switch($atrChance)
						{
						/////// ALLLLL
							case 2: // ataque
									if(!$cantBeAtr['Ataque'])
									{
									$vueltas++;
										$attaqueFree=false;
										$buffGiven++;
										$attr="Ataque";
										$valor=mt_rand(10,$maxSkill1);
									}
							break;
							case 3: // ataque magico
									if(!$cantBeAtr['AtaqueMagico'])
									{
										$vueltas++;
										$attaqueMagicFree=false;
										$buffGiven++;
										$attr="AtaqueMagico";
										$valor=mt_rand(10,$maxSkill1);
									}
							break;
							case 4: // critico
									if(!$cantBeAtr['Critico'])
									{
										$vueltas++;
										$criticalFree=false;
										$buffGiven++;
										$attr="Critico";
										$valor=mt_rand(1,$maxSkill3);
									}
							break;
							case 5: //critico magico
									if(!$cantBeAtr['CriticoMagico'])
									{
										$vueltas++;
										$CriticoMagicoFree=false;
										$buffGiven++;
										$attr="CriticoMagico";
										$valor=mt_rand(1,$maxSkill3);
									}
							break;
							case 6: // PC
									if(!$cantBeAtr['PC'])
									{
										$vueltas++;
										$PCFree=false;
										$buffGiven++;
										$attr="PC";
										$valor=mt_rand(5,$maxSkill1);
									}
							break;
							case 7: // PC MAGICO
									if(!$cantBeAtr['PCMagico'])
									{
										$vueltas++;
										$PCMagicoFree=false;
										$buffGiven++;
										$attr="PCMagico";
										$valor=mt_rand(5,$maxSkill1);
									}
							break;
							case 8: // defensa
								if(!$cantBeAtr['Defensa'])
									{
										$vueltas++;
									$DefensaFree=false;
									$buffGiven++;
									$attr="Defensa";
									$valor=mt_rand(20,$maxSkill2);
								}
							break;
							case 9: // defensa magica
								if(!$cantBeAtr['DefensaMagica'])
									{
									$DefensaMagicaFree=false;
									$buffGiven++;
									$attr="DefensaMagica";
									$valor=mt_rand(20,$maxSkill2);
								}
							break;
							case 10: // vida
							if(!$cantBeAtr['VidaLimit'])
									{
										$vueltas++;
									$VidaLimitFree=false;
									$buffGiven++;
									$attr="VidaLimit";
									$valor=mt_rand(100,$maxSkill4);
								}
							break;
							case 11: // mana
							if(!$cantBeAtr['ManaLimit'])
									{
										$vueltas++;
									$ManaLimitFree=false;
									$buffGiven++;
									$attr="ManaLimit";
									$valor=mt_rand(100,$maxSkill4);
								}
							break;
							case 12: //hp reg
									if(!$cantBeAtr['HpRegen'])
									{
										$vueltas++;
									$HpRegenFree=false;
									$buffGiven++;
									$attr="HpRegen";
									$valor=mt_rand(1,$maxSkill5);
								}
							break; 
							case 13: //mp regen
								if(!$cantBeAtr['MpRegen'])
									{
										$vueltas++;
									$MpRegenFree=false;
									$buffGiven++;
									$attr="MpRegen";
									$valor=mt_rand(1,$maxSkill5);
								}
							break;
							}
					}
					$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor) 
						VALUES("'.$selectItem['idInventario'].'",
						"'.$attr.'",
						"'.$valor.'")');
					$query = "SELECT MAX(idAttrb) AS ID FROM  item_attr";
					$toAdd = $db->sql_fetchrow($db->sql_query($query));
						$db->sql_query("UPDATE inventario SET 
									idExodimo = ".$toAdd['ID']."
									WHERE idInventario = ".$selectItem['idInventario']);

					recreateItem($selectItem['idInventario']);
					$data["error"]="Exodimo: el item (".$selectItem['Nombre'].") ah sido Exodimozado!";
					$db->sql_query("UPDATE inventario SET 
									cantidad = (cantidad-1)
									WHERE idInventario = ".$item['idInventario']);
			}
			else
			$data["error"]="Error: el item (".$selectItem['Nombre'].") ya fue Exodimozado!";
			break;
			////////////////////////////////////////////////////////////////////////
			/////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////

			case 617: // Alquemist
				
					if($selectItem['value']==0)
					{
						$alchr = mt_rand(2,4);

						$db->sql_query("UPDATE inventario SET 
						idExodimo = 0,
						value = ".$alchr."
						WHERE idInventario = ".$selectItem['idInventario']);

						$db->sql_query("DELETE FROM item_attr WHERE idInventario = ".$selectItem['idInventario']);
						include('../system/outSideItem.php');

						randomAttrb($selectItem['idInventario'],$selectItem['grado'],$alchr);

						recreateItem($selectItem['idInventario']);
						$data["error"]="Alquimist: el item (".$selectItem['Nombre'].") ah sido alquimisteado!";
						$db->sql_query("UPDATE inventario SET 
										cantidad = (cantidad-1)
										WHERE idInventario = ".$item['idInventario']);
					}
					else
					$data["error"]="Error: el item (".$selectItem['Nombre'].") no es comun!";

				
			break;
			////////////////////////////////////////////////////////////////////////
			/////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////
			case 618: // corrupted
			
						$db->sql_query("UPDATE inventario SET 
						corrupted = 1
						WHERE idInventario = ".$selectItem['idInventario']);

						$db->sql_query("DELETE FROM item_attr WHERE idInventario = ".$selectItem['idInventario']);
						include('../system/outSideItem.php');

						randomCorrupted($selectItem['idInventario'],$selectItem['grado'],$selectItem['value']);

						recreateItem($selectItem['idInventario']);
						$data["error"]="Corruption: el item (".$selectItem['Nombre'].") ah ahora es corrupto!";
						$db->sql_query("UPDATE inventario SET 
										cantidad = (cantidad-1)
										WHERE idInventario = ".$item['idInventario']);

			break;

		}

	}
	else
		$data["error"] = "El item ".$typee." no puede ser modificado";
}
$error=1;