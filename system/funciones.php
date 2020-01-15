<?PHP
/*
Copyright (C) 2007 BfE-Online.com.ar

 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation;
*/
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager_arg@hotmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
if(SWORDON != 1)
{
	header("Location: index.php");
	die();
}
function getRandomElem()
{
	$elem="none";
	$rnd=mt_rand(1,6);
	switch ($rnd) {
		case 1:
			$elem="fire";
		break;
		case 2:
			$elem="water";
		break;
		case 3:
			$elem="earth";
		break;
		case 4:
			$elem="wind";
		break;
		case 5:
			$elem="dark";
		break;
		case 6:
			$elem="holy";
		break;
	}
	return $elem;
}
function damageResist($dmg,$resist)
{
	$dmg = penetration($dmg,$resist);
	$dmg = penetration($dmg,$resist);
	return defensa($dmg,10);
}
function monsterGenMap()
{
	global $db,$log,$mundo,$pj;

	//Chekking Instance
	if($mundo['extraInfo']==1)
		$query = 'SELECT *
			FROM mapinstance
			WHERE idParty = '.$pj['party'].' AND idMundo = '.$mundo['id'].' LIMIT 0,1';
	else
		$query = 'SELECT *
			FROM mapinstance
			WHERE idPlayer = '.$log->get("pjSelected").' LIMIT 0,1';
	$mapInstancesq = $db->sql_query($query);
	$mapInstance = $db->sql_fetchrow($mapInstancesq);	

	$mapBossOn=0;
						$query = 'SELECT m.idMonster,m.VidaLimit
								FROM monster m JOIN monster_board mb USING ( idMonster )
								WHERE m.papa = 0 AND m.idMonster = mb.idMonster AND mb.idMundo = '.$mundo['id'].'
								ORDER BY RAND() LIMIT 0,1';
							
								$monsterCreatorsq = $db->sql_query($query);
								$monsterCreator = $db->sql_fetchrow($monsterCreatorsq);						
								if($monsterCreator)
								{
									//Goblin
									//Odin
									if($mundo['extraInfo']==1)
										{
											if(!$mapInstance)
												$db->sql_query('INSERT INTO  mapinstance(idParty,idMundo) 
														VALUES("'.$pj['party'].'","'.$mundo['id'].'")');
											else
											{
												if($mapInstance['monsterCount']>1)
												{
													$query = 'SELECT idInMundo
													FROM inmundo
													WHERE idMonster = '.$mundo['mapBoss'].' AND mundo = '.$mundo['id'].' AND openToClan = '.$pj['party'].'';
													$CheckBosssq = $db->sql_query($query);
													$CheckBoss = $db->sql_fetchrow($CheckBosssq);	

													if(!$CheckBoss)
													{

														$query = 'SELECT idMonster,VidaLimit
														FROM monster
														WHERE idMonster = '.$mundo['mapBoss'].'
														LIMIT 0,1';
													
														$bossMapsq = $db->sql_query($query);
														$bossMap = $db->sql_fetchrow($bossMapsq);		

														$db->sql_query('INSERT INTO  inmundo(idMonster,tipo,mundo,currentLife,openToClan,element) 
														VALUES("'.$bossMap['idMonster'].'","2",
														"'.$mundo['id'].'","'.($bossMap['VidaLimit']).'",'.$pj['party'].',"'.getRandomElem().'")');
														$db->sql_query("UPDATE mapinstance SET monsterCount =  0
															WHERE id = ".$mapInstance['id']);
														$mapBossOn=1;

													}
												}
												else
												{
													$db->sql_query("UPDATE mapinstance SET monsterCount =  (monsterCount+1) 
														WHERE id = ".$mapInstance['id']);
												}
											}
											$eliteAviable=true;
											if($mundo['id']==178)
											{
												$eliteAviable=false;
											}
											$cantidad = 8 + $mundo['nivel']/3;
											for($i=0;$i<$cantidad;$i++)
											{
												if(mt_rand(1,20)==15 && $eliteAviable)
													$db->sql_query('INSERT INTO  inmundo(idMonster,tipo,mundo,currentLife,openToClan,champion,element) 
												VALUES("'.$monsterCreator['idMonster'].'","2",
												"'.$mundo['id'].'","'.($monsterCreator['VidaLimit']*3).'",'.$pj['party'].',1,"'.getRandomElem().'")');
												else
													$db->sql_query('INSERT INTO  inmundo(idMonster,tipo,mundo,currentLife,openToClan,element) 
													VALUES("'.$monsterCreator['idMonster'].'","2",
													"'.$mundo['id'].'","'.$monsterCreator['VidaLimit'].'",'.$pj['party'].',"'.getRandomElem().'")');
											
											}
										}
										else
										{
											if(!$mapInstance)
												$db->sql_query('INSERT INTO  mapinstance(idPlayer,idMundo) 
														VALUES("'.$log->get("pjSelected").'","'.$mundo['id'].'")');
											else
											{
												if($mapInstance['monsterCount']>1)
												{

													$query = 'SELECT idInMundo
													FROM inmundo
													WHERE idMonster = '.$mundo['mapBoss'].' AND mundo = '.$mundo['id'].' AND deQuien = '.$log->get("pjSelected").'';
													$CheckBosssq = $db->sql_query($query);
													$CheckBoss = $db->sql_fetchrow($CheckBosssq);	

													if(!$CheckBoss)
													{
														$query = 'SELECT idMonster,VidaLimit
														FROM monster
														WHERE idMonster = '.$mundo['mapBoss'].'
														LIMIT 0,1';
													
														$bossMapsq = $db->sql_query($query);
														$bossMap = $db->sql_fetchrow($bossMapsq);		

														$db->sql_query('INSERT INTO  inmundo(idMonster,tipo,mundo,currentLife,deQuien,element) 
														VALUES("'.$bossMap['idMonster'].'","2",
														"'.$mundo['id'].'","'.$bossMap['VidaLimit'].'",'.$log->get("pjSelected").',"'.getRandomElem().'")');

														$db->sql_query("UPDATE mapinstance SET monsterCount =  0
															WHERE id = ".$mapInstance['id']);
														$mapBossOn=1;
													}
												}
												else
												{
													$db->sql_query("UPDATE mapinstance SET monsterCount =  (monsterCount+1) 
													WHERE id = ".$mapInstance['id']);
												}
												
											}
											
											$cantidad = 5 + $mundo['nivel']/5;

											for($i=0;$i<$cantidad;$i++)
											{
												if(mt_rand(1,20)==15)
													$db->sql_query('INSERT INTO  inmundo(idMonster,tipo,mundo,currentLife,champion,deQuien,element) 
												VALUES("'.$monsterCreator['idMonster'].'","2",
												"'.$mundo['id'].'","'.($monsterCreator['VidaLimit']*3).'",1,'.$log->get("pjSelected").',"'.getRandomElem().'")');
												else
													$db->sql_query('INSERT INTO  inmundo(idMonster,tipo,mundo,currentLife,deQuien,element) 
													VALUES("'.$monsterCreator['idMonster'].'","2",
													"'.$mundo['id'].'","'.$monsterCreator['VidaLimit'].'",'.$log->get("pjSelected").',"'.getRandomElem().'")');
											
											}
										}
								}
							return $mapBossOn;
}
function getCurrency($name,$from=false,$id=0)
{
	global $db,$log;
	$asd="";
	if($id===0)
		switch($name)
		{
			case "ReRoll":
				$id=613;
			break;
			case "Chaos":
				$id=614;
			break;
			case "Upulus":
				$id=615;
			break;
			case "Exodimo":
				$id=616;
			break;
			case "Alquimist":
				$id=617;
			break;
			case "Corruption":
				$id=618;
			break;
		}
	if($from)
		$idCuenta= $from;
	else	
		$idCuenta= $log->get("idCuenta");
	$query = 'SELECT idInventario, cantidad
	FROM inventario 
	WHERE idCuenta = '.$idCuenta.' 
	AND idItem = '.$id.'
	AND enVenta = 0';
	$itemsq = $db->sql_query($query);
	$moneda = $db->sql_fetchrow($itemsq);
	return $moneda;
}
function recreateItem($id)
{
	global $db;
	$leyendafin="";
	$query = 'SELECT RollId,idExodimo 
	FROM inventario 
	WHERE idInventario = '.$id;
	$inventsq = $db->sql_query($query);
	$invent = $db->sql_fetchrow($inventsq);

	$query = 'SELECT *
	FROM item_attr 
	WHERE idInventario = '.$id;
	$attrsq = $db->sql_query($query);
	$maxvalio="";
	$marquer = " &#10067;";
	$exodimo = " &#10024;";
	$update = "&#128310;";
	while($attr = $db->sql_fetchrow($attrsq))
	{
		$maxvalio="";
		$mark="";
		$up="";
		if($invent['RollId']===$attr['idAttrb'])
			$mark=$marquer;
		if($invent['idExodimo']===$attr['idAttrb'])
			$mark=$exodimo;	
		if($attr['blackmarket']==1)
			$up=$update;
		$leyendafin.=$up." ".$attr['attrb']." +".$attr['valor'].$maxvalio.$mark."<br>";
	}
	$db->sql_query('UPDATE inventario 
	SET atributos = "'.$leyendafin.'" 
	WHERE idInventario = '.$id);
	
	return $leyendafin;
}
function earnDropBox($nivel,$tier,$idPersonaje,$especial=0)
{
	global $db;
	$db->sql_query('INSERT INTO  boxes_player(nivel,tier,idPersonaje,especial) 
				VALUES("'.$nivel.'","'.$tier.'","'.$idPersonaje.'",'.$especial.')');
}
function mascotaAge($time)
{
	$now = time();
	$sec = $now-$time;
	$Horas= $sec / (60*60);
	$Dias = $Horas/24;
	return intval($Dias);
}
function mascotaState($ano)
{
	$state="Bebe";
	if($ano>3)
		$state="Joven";
	if($ano>6)
		$state="Viejo";
	return $state;
}
function bigintval($value) {
  $value = trim($value);
  if (ctype_digit($value)) {
    return $value;
  }
  $value = preg_replace("/[^0-9](.*)$/", '', $value);
  if (ctype_digit($value)) {
    return $value;
  }
  return 0;
}
/*function textLoad($idioma,$load)
{
	@include("idioma/".$load.".php");
	@include("../idioma/".$load.".php");
}
function salidaTexto($texto)
{
	
}*/
function textGrado($grade)
{
	switch($grade)
	{
	case 2:
		return "D (Lvl 20)";
	break;
	case 3:
		return "C (Lvl 40)";
	break;
	case 4:
		return "C (Lvl 40)";
	break;
	case 5:
		return "B (Lvl 51)";
	 break;
	 case 6:
		return "B (Lvl 51)";
	 break;
	 case 7:
		return "A (Lvl 61)";
	 break;
	 case 8:
		return "S (Lvl 76)";
	 break;
	 case 9:
		return "S80 (Lvl 80)";
	 break;
	  case 10:
		return "X (Lvl 86)";
	 break;
	  case 11:
		return "Y (Lvl 90)";
	 break;
	  case 12:
		return "Z (Lvl 100)";
	 break;
	}
}
function checkGear($grade)
{
	global $db,$pj;
	$query = 'SELECT count(*) as CONTA
				FROM inventario inv JOIN item i USING (idItem)
				WHERE i.grado >= '.$grade.' AND inv.usadoPor = '.$pj['idPersonaje'].'';
	$grade = $db->sql_fetchrow($db->sql_query($query));
	if($grade['CONTA']>4)
		return true;
	else	
		return false;
}
function checkPermutacionItem($item)
{
	if($item['tradeTo']>0)
	{
		$data["result"] = false;
		$data["error"] = "El item esta en trade";
	}
	else
	if($item['enVenta']==1)
	{
		$data["result"] = false;
		$data["error"] = "El item esta en venta";
	}
	else
	if($item['intradeable']==1)
	{
		$data["result"] = false;
		$data["error"] = "El item no puede ser movido.";
	}
	else
	if($item['usadoPor']!=0)
	{
		$data["result"] = false;
		$data["error"] = "El item esta en uso";
	}else
		$data["result"] = true;
	return $data;
}
function textoAtaque($tipo,$data1,$data2=false,$data3=false)
{
	switch($tipo)
	{
		case 1:
			return "uso ".$data1." golpeo por ".optimalDmg($data2);
		break;
		case 2:
			return "uso ".$data1." golpe critico por ".optimalDmg($data2);
		break;
		case 3:
			return "usaste ".$data1."";
		break;
		case 4://PVP
			return "uso ".$data1."";
		break;
		case 5:
			return "uso ".$data1." golpeo por ".optimalDmg($data2)." y se curo ".optimalDmg($data3)." de vida";
		break;
		case 6:
			return "uso ".$data1." golpe critico por ".optimalDmg($data2)." y se curo ".optimalDmg($data3)." de vida";
		break;
		case 7:
			return "uso ".$data1." y se curo ".$data2." de vida";
		break;
	}
}
function conversor_segundos($seg_ini) {

$horas = floor($seg_ini/3600);
$minutos = floor(($seg_ini-($horas*3600))/60);
$segundos = $seg_ini-($horas*3600)-($minutos*60);
return $horas.'h:'.$minutos.'m:'.$segundos.'s';

}
function textIntoSql($text)
{
	global $mysqli;
	$text = htmlspecialchars($text);
	$text = $mysqli->real_escape_string($text);
	if(strlen($text)>100)
		die("<div align='center'><img src='images/sql.jpg'/></div>!");
	return $text;
}
function tratadoDesc($cadena)
{
	$cadena = utf8_encode($cadena);
	$cadena = @eregi_replace("/\r\n+|\r+|\n+|\t+/i",  ' ', $cadena);
	return $cadena;
}
function escala($base,$escala)
{
	$per = $base / 100;
	$dmg = $per * $escala;
	return $dmg;
}
function reduccion($base,$reduc)
{
	$per = $base / 100;
	$dmg = (100 - $reduc)*$per;
	return $dmg;
}
function sacarPoner($attr,$operator,$power)
{
	global $db,$pj;
	if($attr=="VidaLimit")
	{
		if($operator=="-" AND $pj['Vida']>($pj['VidaLimit']-$power))
			$add=" Vida = (VidaLimit-".$power.'),';
	}
	if($attr=="ManaLimit")
	{
		if($operator=="-" AND $pj['Mana']>($pj['ManaLimit']-$power))
			$add.=" Mana = (ManaLimit-".$power.'),';
	}
	$db->sql_query("UPDATE personaje SET
		".$add."
		".$attr." = (".$attr.$operator.$power.") 
	WHERE idPersonaje = ".$pj["idPersonaje"]."");
}
function sacarPonerEnemy($attr,$operator,$power)
{
	global $db,$monster;
	if($attr=="VidaLimit")
	{
		if($operator=="-" AND $monster['Vida']>($monster['VidaLimit']-$power))
			$add=" Vida = (VidaLimit-".$power.'),';
	}
	if($attr=="ManaLimit")
	{
		if($operator=="-" AND $monster['Mana']>($monster['ManaLimit']-$power))
			$add.=" Mana = (ManaLimit-".$power.'),';
	}
	$db->sql_query("UPDATE personaje SET
		".$add."
		".$attr." = (".$attr.$operator.$power.") 
	WHERE idPersonaje = ".$monster["idPersonaje"]."");
}
function tiempoMuerto($lvl)
{
	return $lvl*6;
}
function autorizationMadness($seed)
{
	date_default_timezone_set("America/Argentina/Buenos_Aires");
	return md5(strtolower($seed).date('y:z:h:i', time())."K");
}
function NumerarPaginas($page, $CantiFilas, $NombrePag, &$limitbottom, $cantidad_por_pagina)
	{
	$limitbottom = ($page-1)* $cantidad_por_pagina;
	if($CantiFilas > $cantidad_por_pagina) 
	{
		$totalpages = $CantiFilas / $cantidad_por_pagina;
		if(!is_int($totalpages))  //hay un "." en $totalpaages, osea no es entero ---->original funtion if (ereg(".",$totalpages))
		{	
			$info2 = explode(".",$totalpages); // devuelve un array, cada sub(i) tiene una parte del string, se usa el separador "." 
			$info = str_replace(".","",$info2[0]); // (cadena_buscada,cadena_nueva,cadena)
			$newpage = $info + 1; //como no es entero, then necesito paginas enteras+1 
		}
		else
		{
			$newpage = $totalpages; 
		}
		for($eachpage=1; $eachpage <= $newpage; $eachpage++) 
		{ 	
			if($eachpage == $page) 
			{	
				$pagehtml .= "($eachpage) "; 
			} 
			else  
			{ 
				$pagehtml .= "[<A HREF=\"".$NombrePag."page=$eachpage\">$eachpage</A>] "; 
			}
		}// fin for
		$showpages = "<CENTER><B>Pagina:</B> $pagehtml</CENTER>";
	}	//end if
	return $showpages;	
	}///fin de fun
function optimalDmg($dmg)
{
	if($dmg>100000000)
	{
		//100kk
			$magnitud="num100kk";
			$dmg=bcdiv($dmg,1000000,0)."KK";
	}
	else if($dmg>10000000)
	{
		//10kk
		$magnitud="num10kk";
		$dmg=bcdiv($dmg,1000000,0)."KK";
	}else if($dmg>1000000)
	{
		//1kk
		$magnitud="num1kk";
		$dmg=bcdiv($dmg,1000000,1)."KK";
	}
	else if($dmg>100000)
	{
		//100k
		$magnitud="num100k";
		$dmg=bcdiv($dmg,1000,0)."K";
	}else if($dmg>10000)
	{
		//10k
		$magnitud="num10k";
		$dmg=bcdiv($dmg,1000,0)."K";
	}else if($dmg>1000)
	{
		//1k
		$magnitud="num1k";
		$dmg=bcdiv($dmg,1000,1)."K";
	}
	return "<span class=".$magnitud.">".$dmg."</span>";
}
function defensa($ataque,$defensa)
	{
	if($ataque <=0)
	{
		$ataque = 1;
	}
	if($defensa <=0)
	{
		$defensa = 1;
	}
	$numero1 = $ataque;
	$numero2 = $defensa;

	$percent = bcdiv($numero1,$numero2,0);

	$porcentaje = bigintval($percent*30);
	return $porcentaje+1;
	}
function normal($dano)
{
	//$dmg = mt_rand($dano,intval($dano + ($dano/10)));
	return $dano;
}
function critical($dano,$power)
{
	$per_dano = bcdiv($dano,100,0);
	$multiplier = $dano + bigintval($per_dano * $power);
	//$critical_chanse = mt_rand($multiplier,bigintval($multiplier + ($multiplier/10)));
	return $multiplier;
}


function get_power($power,$lvl)
	{
		$lvl=($lvl-1);
		$w = explode(',',$power);
		return $w[intval($lvl)];
	}

class skill_bonus
{
	var $datos;
	var $numbers;
	function get_improve($total,$que)
	{
		$resultado = $total;
		if($this->datos[$que."percent"]>0)
		{
		$percent = $total / 100;
		$resultado = $total + intval($percent * $this->datos[$que."percent"]);
		}
		if($this->datos[$que.'normal']>0)	
		{
		$resultado = $total + $this->datos[$que.'normal'];
		}

		/////////////////////////////////////////////////////////////////////////
		if($this->datos[$que."_cursepercent"]>0)
		{
		$percent = $total / 100;
		$resultado = $resultado - intval($percent * $this->datos[$que."_cursepercent"]);
		}
		if($this->datos[$que.'_cursenormal']>0)	
		{
		$resultado = $resultado - $this->datos[$que.'_cursenormal'];
		}
		if($resultado<0)
		$resultado = 1;
		return $resultado;
	}
	function acumulate($que,$magic_power,$per)
	{
			if($per==1)
			$this->datos[$que."percent"] = $this->datos[$que] + $magic_power;
			else
			$this->datos[$que.'normal'] = $this->datos[$que] + $magic_power;
	}
}
function show_message($texto,$link)
{
	global $template;
	$template->set_filenames(array(
								'content' => 'templates/sec/message.html' )
							);
	$template->assign_var('ERROR_MSG', $texto);		
	$template->assign_var('ERROR_LINK', $link);		
}
function show_error($texto,$link)
{
	global $template;
	$template->set_filenames(array(
								'content' => 'templates/sec/error.html' )
							);
	$template->assign_var('ERROR_MSG', $texto);		
	$template->assign_var('ERROR_LINK', $link);		

	$template->assign_var_from_handle("CONTENT_HTML", "content");	
	$template->pparse('body');
	die();
}
function add_QuestItem($id,$cantidad=1,$idCuenta,$intradeable=0)
{
	global $db,$log;
	if($cantidad<1)
	$cantidad=1;
	$query = 'SELECT inv.idInventario, i.contable, inv.cantidad
								FROM inventario inv JOIN item i USING ( idItem )
								WHERE inv.idCuenta = '.$idCuenta.' AND inv.idItem = '.$id.'';
	$itemsq = $db->sql_query($query);
	$item = $db->sql_fetchrow($itemsq);
	if($item AND $item['contable'])
	{
		if($item['cantidad']>0)
			$db->sql_query("UPDATE inventario SET
					cantidad = (cantidad+".$cantidad.")
					WHERE idInventario = ".$item['idInventario']);
		else
			$db->sql_query("UPDATE inventario SET
					cantidad = (".$cantidad.")
					WHERE idInventario = ".$item['idInventario']);
				
	}
	else
		$db->sql_query('INSERT INTO inventario(idItem,idCuenta,cantidad,intradeable) VALUES("'.$id.'","'.$idCuenta.'","'.$cantidad.'","'.$intradeable.'")');
}
function add_item($id,$cantidad=1,$idCuenta=false,$intradeable=0)
{
	global $db,$log;
	if($idCuenta==false)
		$idCuenta=$log->get("idCuenta");
	if($cantidad<1)
	$cantidad=1;
	$query = 'SELECT inv.idInventario, i.contable, inv.cantidad
								FROM inventario inv JOIN item i USING ( idItem )
								WHERE inv.idCuenta = '.$idCuenta.' AND inv.idItem = '.$id.'';
	$itemsq = $db->sql_query($query);
	$item = $db->sql_fetchrow($itemsq);
	if($item AND $item['contable'])
	{
		if($item['cantidad']>0)
			$db->sql_query("UPDATE inventario SET
					cantidad = (cantidad+".$cantidad.")
					WHERE idInventario = ".$item['idInventario']);
		else
			$db->sql_query("UPDATE inventario SET
					cantidad = (".$cantidad.")
					WHERE idInventario = ".$item['idInventario']);
				
	}
	else
		$db->sql_query('INSERT INTO inventario(idItem,idCuenta,cantidad,intradeable) VALUES("'.$id.'","'.$idCuenta.'","'.$cantidad.'","'.$intradeable.'")');
}
function delete_item($id)
{
	global $db;
	$query = 'SELECT cantidad
			FROM inventario
			WHERE idInventario = '.$id.'';
	$itemsq = $db->sql_query($query);
	$item = $db->sql_fetchrow($itemsq);
	if($item['cantidad']>1)
		$db->sql_query("UPDATE inventario SET cantidad = (cantidad-1) WHERE idInventario = ".$id);
	else
	{
		$db->sql_query("DELETE FROM item_attr WHERE idInventario = ".$id);
		$db->sql_query("DELETE FROM inventario WHERE idInventario = ".$id);
	}
}
function restar_oro($deuda)
{
	global $db, $log;
	$result = $realGold-$deuda;
	//$log->set("oro",$result);
	$db->sql_query("UPDATE cuenta SET oro = (oro-".$deuda.") WHERE idCuenta = ".$log->get("idCuenta"));
}
function lvlupskillcost($costo,$lvl)
{
	$costo = intval(($costo/3)*$lvl);
	return $costo;
}
function travel($x1,$y1,$x2,$y2,$lvl)
{
	//$result = pow(($x2 - $x1),2) + pow(($y2 - $y1),2);
	
	//$costos = intval(intval($result/(1550000/($lvl*$lvl)))/3) +1;
	
	return 0;
}
function potenciar($basic,$per)
{
	$thing = $basic + bigintval(($basic/100)*$per);
	return $thing;
}
function getPuntos($lvl)
{
	$pts = intval($lvl/5)+1;
	return $pts;
}
function getAventuraBuffs($PJID,$weapon,$shiedl)
{
	global $db;
	$pj['Wtipo']=$weapon;
	$pj['shieldDef']=$shiedl;
	$query = 'SELECT a.idPersonaje, s.idRealSkill, s.idSkill, a.idAura, a.timeOut, s.nombre,s.nivel , s.imagen, a.buff, a.statsChanger, a.static, a.acumuleitor
				FROM aura a JOIN skill s USING ( idSkill )
				WHERE a.idPersonaje = '.$PJID.' AND a.aventura = 1 ORDER BY s.idRealSkill';		
				$skillsq = $db->sql_query($query);
				while($aura = $db->sql_fetchrow($skillsq))
				{
						if($aura['timeOut']<$now AND $aura['static']==0)
						{
							$db->sql_query("DELETE FROM aura WHERE idAura = '".$aura['idAura']."'");
						}
						else
						{
							if(!$neveragain[$aura['idRealSkill']])
							{
								$neveragain[$aura['idRealSkill']]=true;
								if(file_exists("skillSet/auras/set".$aura['idRealSkill'].".php"))
							@include("skillSet/auras/set".$aura['idRealSkill'].".php");
						else
							@include("../skillSet/auras/set".$aura['idRealSkill'].".php");
							}
						}
				}
	return $pj;
}
function checkStats($STR,$CON,$DEX,$WIT,$INT,$MEN,$LVL,$PJID)
{
	global $db,$log,$pj;

		$PJID= intval($PJID);
		$CurrentVida=$pj['Vida'];
		$CurrentMana=$pj['Mana'];
		$PJNivel=$pj['nivel'];
		$PJclase=$pj['idClase'];
		//$PetId=$pj['idPet'];
		$IniEXPBONUS=$pj['EXPBONUS'];
		$IniGOLDBONUS=$pj['GOLDBONUS'];
		$iniGEARSHOW=$pj['GearPower'];

		$iniResFire = $pj['resist_fire'];
		$iniResWater = $pj['resist_water'];
		$iniResEarth = $pj['resist_earth'];
		$iniResWind = $pj['resist_wind'];
		$iniResDark = $pj['resist_dark'];
		$iniResHoly = $pj['resist_holy'];

		$godLevel['godlvlAttack']=$pj['godlvlAttack'];
		$godLevel['godlvlCritico']=$pj['godlvlCritico'];
		$godLevel['godlvlDefensa']=$pj['godlvlDefensa'];
		$godLevel['godlvlVida']=$pj['godlvlVida'];
		$godLevel['godlvlElem']=$pj['godlvlElem'];

		$iniInParty=$pj['party'];
		unset($pj);
		$pj['manoDerecha']=0;
		$pj['dimension']=1;
		$pj['dificultyLvl'] = 1;
		$pj['VidaLimit'] = 100;
		$pj['ManaLimit'] = 100;
		
		$pj['shieldDef']=0;
		//unset($_SESSION['PJITEM']);
		if($PJID==$log->get("pjSelected") AND isset($_SESSION['PJITEM']))
		{
			$pj=$_SESSION['PJITEM'];
			$idFoot = $_SESSION['PJITEM_idFoot'];
			$idGloves = $_SESSION['PJITEM_idGloves'];
			$idHead = $_SESSION['PJITEM_idHead'];
			$idShield = $_SESSION['PJITEM_idShield'];
			$idArmor = $_SESSION['PJITEM_idArmor'];
			$Wtipo = $_SESSION['PJITEM_Wtipo'];
			$armorSet=$_SESSION['PJITEM_armorset'];
			$itemLevel=$_SESSION['PJITEM_Nivel'];
			$criticalBonus=$_SESSION['PJITEM_criticalb'];
			$PCBonus=$_SESSION['PJITEM_PCBonus'];
			$gear=$_SESSION['PJITEM_gear'];
			if(isset($_SESSION["dimension"]))
				$pj['dimension']=$_SESSION["dimension"];
		}
		//CHEKEO ITEMS
		else
		{
		$query = 'SELECT i.*,inv.masterWork, inv.manoDerecha,inv.extraLevel,inv.value, inv.enchant, inv.SAchar, inv.SA, ia.attrb, ia.valor, inv.idInventario, inv.manoIzquierda, inv.conNombre, inv.nameCheck, inv.nameTimeTry, inv.trucho, inv.lvlAstral
				FROM item i JOIN inventario inv USING ( idItem ) LEFT JOIN item_attr ia on ia.idInventario = inv.idInventario 
				WHERE inv.usadoPor = '.$PJID.' ORDER BY inv.idInventario';
		$itemsq = $db->sql_query($query);

		$defensa = 50;
		$Mdefensa = 40;
		$ataque = 5;
		$mataque = 0;
		$itemLevel=0;
		$potenciarAtaque=0;
		$potenciarAtaqueM=0;
		$gear = 0;
		$tipoDer = "";
		$tipoIzq = "";
		while($item = $db->sql_fetchrow($itemsq))
		{
			
			if($item['attrb'])//AND $item['manoIzquierda']==0
			{
					$pj[$item['attrb']] += $item['valor'];
			}
			if($noRepeat!=$item['idInventario'])
			{
			    $gear += ($item['grado']*100)+($item['enchant']*$item['enchant']*$item['enchant']);
			    if($item['masterWork'])
			    	$gear += $item['grado']*10;
				$noRepeat=$item['idInventario'];
				//Special Ability	
				if($item['tipo']=="runa")
				{
					if(file_exists("runasSet/runa".$item['idItem'].".php"))
							@include("runasSet/runa".$item['idItem'].".php");
						else
							@include("../runasSet/runa".$item['idItem'].".php");
					
				}
				
				if($item['armorset']>0)
				{
					$armorSet[$item['armorset']]['nombre'] = $item['Nombre'];
					$armorSet[$item['armorset']]['setId'] = $item['armorset'];
					if($PJID==$log->get("pjSelected"))
					$_SESSION['PJITEM_armorset']=$armorSet;
				}
				//Special Ability	
				if($item['SA']==1  AND $item['manoIzquierda']==0)
				{
					if(file_exists("SpecialAbility/".$item['SAchar'].".php"))
							@include("SpecialAbility/".$item['SAchar'].".php");
						else
							@include("../SpecialAbility/".$item['SAchar'].".php");
				}
				//set info
				if($item['trucho']==0)
				{
					switch($item['tipo'])
					{
						case 'foots':
							$idFoot = $item['idItem'];
							if($PJID==$log->get("pjSelected"))
							$_SESSION['PJITEM_idFoot']=$idFoot;
						break;
						case 'gloves':
							$idGloves = $item['idItem'];
							if($PJID==$log->get("pjSelected"))
							$_SESSION['PJITEM_idGloves']=$idGloves;
						break;
						case 'head':
							$idHead = $item['idItem'];
							if($PJID==$log->get("pjSelected"))
							$_SESSION['PJITEM_idHead']=$idHead;
						break;
						case 'shield':
							$idShield = $item['idItem'];
							if($PJID==$log->get("pjSelected"))
							$_SESSION['PJITEM_idShield']=$idShield;
							$pj['shieldDef'] = potenciar($item['shieldDef'],10*$item['enchant']);
							
						break;
						case 'armor':
							$idArmor = $item['idItem'];
							if($PJID==$log->get("pjSelected"))
							$_SESSION['PJITEM_idArmor']=$idArmor;
						break;
					}
				}
				
				$itemLevel += $item['Nivel'];
				$criticalBonus	+= $item['Critico'];
				$PCBonus	+= $item['PC'];
				$pj['VidaLimit'] += $item['VidaLimit'];
				$pj['ManaLimit'] += $item['ManaLimit'];
				switch($item['value'])
				{
					case 1:
						$item['Ataque']+=intval($item['Ataque']/4);
						$item['AtaqueMagico']+=intval($item['AtaqueMagico']/4);
						$item['Defensa']+=intval($item['Defensa']/4);
						$item['DefensaMagica']+=intval($item['DefensaMagica']/4);
					break;
					case 2:
						$item['Ataque']+=intval($item['Ataque']/3);
						$item['AtaqueMagico']+=intval($item['AtaqueMagico']/3);
						$item['Defensa']+=intval($item['Defensa']/3);
						$item['DefensaMagica']+=intval($item['DefensaMagica']/3);
					break;
					case 3:
						$item['Ataque']+=intval($item['Ataque']/2);
						$item['AtaqueMagico']+=intval($item['AtaqueMagico']/2);
						$item['Defensa']+=intval($item['Defensa']/2);
						$item['DefensaMagica']+=intval($item['DefensaMagica']/2);
						
					break;
					case 4:
						$item['Ataque']+=intval($item['Ataque']);
						$item['AtaqueMagico']+=intval($item['AtaqueMagico']);
						$item['Defensa']+=intval($item['Defensa']);
						$item['DefensaMagica']+=intval($item['DefensaMagica']);
						
						$pj['BasicLegendarys']++;
					break;
				}
				if($item['tipo']=="W")
				{
					$pj['CantidadArmas']+=1;
					if($item['manoDerecha']==1)
					{
						$pj['manoDerecha'] = 1;
						$tipoDer = $item['subtipo'];
					}
					else
						$tipoIzq = $item['subtipo'];


					$pj['weaponTier']+=$item['value'];
					if($pj['CantidadArmas']>1 && $pj['weaponTier']>0)
						$pj['weaponTier']=intval($pj['weaponTier']/2);

					if($item['grado']>=3 AND $item['trucho']==0)
					{
						$pj['lvlAstral']=$item['lvlAstral'];
						if($item['conNombre']==1)
						{
							$pj['nameWeapon']=0;
							$item['Ataque']+=intval($item['Ataque']/3);
							$item['AtaqueMagico']+=intval($item['AtaqueMagico']/3);
						}
						else
						{
							$pj['nameWeapon']=1;
							$pj['idWeapon']=$item['idInventario'];
							$pj['nameCheckW']=$item['nameCheck'];
							$pj['TimeW']=$item['nameTimeTry'];
						}
					}
					else
						$pj['nameWeapon']=0;
					$Wtipo = $item['subtipo'];
					if($PJID==$log->get("pjSelected"))
					$_SESSION['PJITEM_Wtipo']=$Wtipo;

				}// FIN TIPO W
				$defensa+= potenciar($item['Defensa'],10*$item['enchant']);	
				$Mdefensa+= potenciar($item['DefensaMagica'],10*$item['enchant']);	
				$ataque+= potenciar($item['Ataque'],10*$item['enchant']);
				$mataque+= potenciar($item['AtaqueMagico'],10*$item['enchant']);
			}
			
		}	//fin item while

		if($pj['manoDerecha']==1)
		{
			if($tipoIzq != $tipoDer)
			{
					$Wtipo = "mixto";
					if($PJID==$log->get("pjSelected"))
						$_SESSION['PJITEM_Wtipo']=$Wtipo;
			}		
		}
					

		if($PJID==$log->get("pjSelected"))
			{
				$_SESSION['PJITEM_Nivel']=$itemLevel;
				$_SESSION['PJITEM_criticalb']=$criticalBonus;
				$_SESSION['PJITEM_PCBonus']=$PCBonus;
				$_SESSION['PJITEM_gear']=$gear;
				if(isset($_SESSION["dimension"]))
					$pj['dimension']=$_SESSION["dimension"];
			}
		$wpenalty = 0;
		switch($Wtipo)
		{
			case 'bow':
				$wpenalty = 10;
			break;
			case 'bigsword':
				$wpenalty = 10;
			break;
			case 'dagger':
				$wpenalty = 8;
			break;
			default:
				$wpenalty = 9;
			break;
		}
		if($idShield>0)
		{
			$pj['ShieldRate'] += 10;
			$pj['ShieldOn']=1;
		}
		else
			$pj['ShieldRate'] = 0;
		
		//DEFENSE DESBUFF
		/*
		$defensa=intval($defensa/2);
		$Mdefensa=intval($Mdefensa/2);
		*/
		$pj['ItemLevel'] = intval($itemLevel / 8);
		//
		//ARMA
		$pj['Wtipo'] = $Wtipo;
		
		$pj['PJID'] = $PJID;
		$pj['idPersonaje'] = $PJID;
		$pj['Ataque'] += $ataque;



		$pj['AtaqueMagico'] += $mataque;
		$pj['ShockResist'] = 0;
		$pj['Defensa'] += $defensa;
		$pj['DefensaMagica'] += $Mdefensa;
		$pj['Critico'] += 0;
		$pj['CriticoMagico'] += 0 + $bonusCriticoMagico;
		$pj['PC'] += 25;
		$pj['PCMagico'] += 10;
		$pj['PSpeed'] += 0;
		$pj['CSpeed'] += 15;
		
		
		
		$potenciarDefensa=0;
		$potenciarDefensaM=0;
		
		$pj['weapon'] = $Wtipo;
		
		$pj['VidaLimit'] = $pj['VidaLimit']+intval((($CON/3)*$LVL*$LVL)/4)+100+$LVL;
		$pj['ManaLimit'] = $pj['ManaLimit']+($MEN*($LVL+10))+$LVL;
		
		$pj['MagicPenetration']+=0;
		$pj['ArmorPenetration']+=0;
		$pj['HpRegen']+=intval($pj['VidaLimit']/200)+1;
		$pj['MpRegen']+=intval($pj['ManaLimit']/300)+1;
		
		$pj['Ataque'] = $pj['Ataque']+($LVL*5)+intval(($ataque/100)*($STR*4))+7;
				
		$pj['AtaqueMagico'] = $pj['AtaqueMagico']+($LVL*3)+intval(($mataque/100)*($INT*4))+11;
		
		$pj['ShockResist'] = $pj['ShockResist']+$CON+5;
		
		$pj['Defensa'] = $pj['Defensa']+($LVL*10);
		$pj['Defensa'] = potenciar($pj['Defensa'],$potenciarDefensa);
		
		$pj['DefensaMagica'] = $pj['DefensaMagica']+($LVL*10)+intval(($Mdefensa/100)*$MEN);
		$pj['DefensaMagica'] = potenciar($pj['DefensaMagica'],$potenciarDefensaM);
		
		$pj['Critico'] = $pj['Critico']+5 + $criticalBonus;
		
		$pj['CriticoMagico'] = $pj['CriticoMagico']+5;
		
		$pj['PC'] = $pj['PC']+$DEX + $PCBonus;
		$pj['PCMagico'] = intval($pj['PCMagico']+($WIT/2)+($INT/2));
		
		$pj['PSpeed'] = $pj['PSpeed']+$wpenalty-$PhisySpeedBonus;
		$pj['CSpeed'] = $pj['CSpeed']-$CastSpeedBonus;

		//DPS
		if($pj['Ataque']>$pj['AtaqueMagico'])
		{
			$pj['baseDPS'] = intval($pj['Ataque'] * (1 + ($pj['Critico']/100) * ($pj['PC']/100)));
			$pj['baseDPS'] = penetration($pj['baseDPS'],($pj['PSpeed']*5));
		}
		else
		{
			$pj['baseDPS'] = intval(($pj['AtaqueMagico']*2) * (1 + ($pj['CriticoMagico']/100) * ($pj['PCMagico']/100))) ;
			$pj['baseDPS'] = penetration($pj['baseDPS'],($pj['CSpeed']*3));
		}

		$pj['CON'] = $CON;
		$pj['STR'] = $STR;
		$pj['DEX'] = $DEX;
		$pj['INT'] = $INT;
		$pj['WIT'] = $WIT;
		$pj['MEN'] = $MEN;
		
		if(is_array($armorSet))
		{
			$setOrdId=0;
			foreach ($armorSet as $value) {
				$part=intval($partPluz);
				$setid=$value['setId'];
				if($NoReSet['SETG'][$setid]==false)
				{
						$pj['someSet']=true;
						$NoReSet['SETG'][$setid]=true;
						$setOrdId++;
					$pj['SET_UP'][$setOrdId]['id']=$setid;	
					if(file_exists("armorSets/set".$value['setId'].".php"))
							@include("armorSets/set".$value['setId'].".php");
						else
							@include("../armorSets/set".$value['setId'].".php");

					if(!$pj['SET_UP'][$setOrdId]['nombre'])
						$pj['SET_UP'][$setOrdId]['valid']=false;
					else	
						$pj['SET_UP'][$setOrdId]['valid']=true;	
				}
			}


			/// PET
			

		}

		//FIN BASIC
		//// SAVE SHET
		if($PJID==$log->get("pjSelected"))
			$_SESSION['PJITEM']=$pj;
		}
		$now = tiempoReal();
		$pj['corruptHand']=0;
		$pj['Allow2Hand']=0;
		// AURAS CHECK //
		$query = 'SELECT a.idPersonaje, s.idRealSkill, s.idSkill, a.idAura, a.timeOut, a.extraData, s.nombre,s.nivel , s.imagen, a.buff, a.statsChanger, a.static, a.acumuleitor
		FROM aura a JOIN skill s USING ( idSkill )
		WHERE a.idPersonaje = '.$PJID.' AND a.aventura = 0 ORDER BY s.active, s.idRealSkill';
		$skillsq = $db->sql_query($query);
		while($aura = $db->sql_fetchrow($skillsq))
		{
				if($aura['timeOut']<$now AND $aura['static']==0)
				{
					$db->sql_query("DELETE FROM aura WHERE idAura = '".$aura['idAura']."'");
				}
				else
				{
					if(!$neveragain[$aura['idRealSkill']])
					{
						$neveragain[$aura['idRealSkill']]=true;
						if(file_exists("skillSet/auras/set".$aura['idRealSkill'].".php"))
							@include("skillSet/auras/set".$aura['idRealSkill'].".php");
						else
							@include("../skillSet/auras/set".$aura['idRealSkill'].".php");
					}
				}
		}

		if(!$pj['Allow2Hand'] && $pj['manoDerecha']==1)
			$pj['corruptHand']=1;

		if($manaSeal)
			$pj['VidaLimit']+=$pj['ManaLimit'];
		
		if($pj['garca_trankadura'])
			$pj['Ataque']+=$pj['PC'];


		if($pj['ZT_FireSword'])
		{
			$pj['Ataque']+=$pj['VidaLimit'];
		}


		$pj['Ataque'] = potenciar($pj['Ataque'],$potenciarAtaque);
		$pj['AtaqueMagico'] = potenciar($pj['AtaqueMagico'],$potenciarAtaqueM);
		
		//
		//Mecanica Ataque
		$pj['elemAttack']="no";
		$pj['elemDmg']=0;
		if($pj['fire']>$pj['elemDmg'])
		{
			$pj['elemAttack']="fire";
			$pj['fire'] = potenciar($pj['fire'],$pj['RpFire']);
			$pj['elemDmg']=$pj['fire'];
		}
		if($pj['water']>$pj['elemDmg'])
		{
			$pj['elemAttack']="water";
			$pj['water'] = potenciar($pj['water'],$pj['RpWater']);
			$pj['elemDmg']=$pj['water'];
		}
		if($pj['earth']>$pj['elemDmg'])
		{
			$pj['elemAttack']="earth";
			$pj['earth'] = potenciar($pj['earth'],$pj['RpEarth']);
			$pj['elemDmg']=$pj['earth'];
		}
		if($pj['wind']>$pj['elemDmg'])
		{
			$pj['elemAttack']="wind";
			$pj['wind'] = potenciar($pj['wind'],$pj['RpWind']);	
			$pj['elemDmg']=$pj['wind'];
		}
		if($pj['dark']>$pj['elemDmg'])
		{
			$pj['elemAttack']="dark";
			$pj['dark'] = potenciar($pj['dark'],$pj['RpDark']);	
			$pj['elemDmg']=$pj['dark'];
		}
		if($pj['holy']>$pj['elemDmg'])
		{
			$pj['elemAttack']="holy";
			$pj['holy'] = potenciar($pj['holy'],$pj['RpHoly']);	
			$pj['elemDmg']=$pj['holy'];
		}	
		if($pj['elementalDmg'])
				$pj['elemDmg']+=$pj['elementalDmg'];

		if($pj['elementalMix'])
		{
			$pj['elemDmg']=($pj['holy']+$pj['fire']+$pj['water']+$pj['earth']+$pj['wind']+$pj['dark']);
			$pj['elemAttack']="fire";
		}
		//SETS
		if($pj['DominantElemt']>0)
		{
			$pj['elemDmg']+=$pj['DominantElemt'];
		}
		//DarkLord Fix
		if($pj['darkLord']==1)
		{
			$pj['Ataque']+=intval($pj['Defensa']+$pj['DefensaMagica']);
			if($pj['elemAttack']=="dark")
				$pj['Ataque']+=($pj['dark']*4);
		}
		if($pj['bloodLord'])
		   $pj['VampireStance']= $pj['VampireStance']*2;	
		   
		if($pj['BloodArmor'])
			$pj['VidaLimit'] = potenciar($pj['VidaLimit'],25);

		if($pj['ultimateWarrior'])
			$pj['Defensa']+=$pj['Defensa'];	
       if($pj['NightStalker'] && $PJclase==6)
       		$pj['Ataque'] = potenciar($pj['Ataque'],intval($pj['VampireStance']/2));	

		 
		 if($pj['GK_cirujeitor'])
		 {
			 switch($pj['weaponTier'])
			 {
				case 0:
					$pj['Ataque']+=(int)$pj['Ataque']*2.5;   
				break;
				case 1:
					$pj['Ataque']+=(int)$pj['Ataque']*2;   
				break;
				case 2:
					$pj['Ataque']+=(int)$pj['Ataque']*1.5;   
				break;
				case 3:
					$pj['Ataque']+=(int)$pj['Ataque']*1;   
				break;
				case 4:
					$pj['Ataque']+=(int)$pj['Ataque']*0.5;   
				break;
			 }
			  
		 }

		 //
		  if($pj['Bluntieitor'])
		 {
			 $pj['BluntieitorBonus'] = intval($pj['VidaLimit']/1000);
			 if($pj['BluntieitorBonus']>90)
			 	$pj['BluntieitorBonus']=90;
		 }
		// RUNA VEL DE ATAQUE
		if($pj['runa_velAttack'])
			$pj['PSpeed'] -= $pj['runa_velAttack'];

		 //PositionAbsolute
		if($pj['PositionAbsolute'] AND $Wtipo="bow"  && $PJclase==4)
		{
			$pj['Ataque']=potenciar($pj['Ataque'],300);
			 $pj['PSpeed']=6;
		}
		

		if($pj['rompeOrtos'])
			$pj['Ataque']+=(int)$pj['Ataque']*($pj['PSpeed']/4);

		if($pj['MM_Exquisite'])
			$pj['Ataque']+=(int)($pj['Ataque']/4)*$pj['BasicLegendarys'];

		if($pj['SubClass_Exquisite'])
			$pj['Ataque']+=(int)($pj['Ataque']*0.05)*$pj['BasicLegendarys'];
		if($pj['SubClass_HolyCast'])
			$pj['CSpeed'] = 3;

		if($pj['SubClass_BloodyKiller'])
		{
			$pj['PC'] = potenciar($pj['PC'],15);
			$pj['PCMagico'] = potenciar($pj['PCMagico'],15);
		}
		if($pj['SubClass_ElFocus'])
		{
			$pj['elemDmg'] = potenciar($pj['elemDmg'],25);
		}
		if($godLevel['godlvlElem']>0)
		{
			$pj['elemDmg']=potenciar($pj['elemDmg'],$godLevel['godlvlElem']);
		}
		

		$pj['Ataque'] = potenciar($pj['Ataque'],$pj['elemDmg']);		
		$pj['AtaqueMagico'] = potenciar($pj['AtaqueMagico'],$pj['elemDmg']);
		$pj['baseDPS'] = potenciar($gear,$pj['elemDmg']);



		//FIX DEF
		/*
		$pj['Defensa'] += $LVL*$LVL;	
		$pj['DefensaMagica'] += $LVL*$LVL;	
		*/

	
		/// RUNAS SET ///

		if($pj['runa_attack'])
			$pj['Ataque'] = potenciar($pj['Ataque'],$pj['runa_attack']);	
		if($pj['runa_magicAttack'])
			$pj['AtaqueMagico'] = potenciar($pj['AtaqueMagico'],$pj['runa_magicAttack']);		
		if($pj['runa_velCasteo'])
			$pj['CSpeed'] -= $pj['runa_velCasteo'];
		if($pj['runa_shieldDef'])
			$pj['shieldDef'] = potenciar($pj['shieldDef'],$pj['runa_shieldDef']);
		if($pj['runa_vida'])
			$pj['VidaLimit'] = potenciar($pj['VidaLimit'],$pj['runa_vida']);	


		if($pj['AuraFastCast'])
		{
			$pj['CSpeed']=intval($pj['CSpeed']/2);
			$pj['Defensa']= penetration($pj['Defensa'],20);
		}

		// LIMITES //
		if($pj['PSpeed']<3)
			 $pj['PSpeed'] = 3;
		
		if($pj['CSpeed']<3)
			 $pj['CSpeed'] = 3;

		//DESTRO
		if($pj['DestroActive'] && $Wtipo="bigsword" && $PJclase==7)
		{
			switch($pj['DestroLvl'])
			{
				case 1:
					$pj['Ataque']=potenciar($pj['Ataque'],450);
				break;
				case 2:
					$pj['Ataque']=potenciar($pj['Ataque'],850);
				break;
			}
		}
		if($pj['SwordTrans'])
			   $pj['AtaqueMagico']+=$pj['Ataque'];

		if($pj['SH_Magicus'])
			$pj['Ataque']+=(int)($pj['Ataque']/10)*$pj['SH_buffs'];

		
		if($pj['inmortalityLvl'])
		{
			$pj['Defensa']+=intval(($pj['Defensa']/100)*($pj['inmortalityAcumulate']*$pj['inmortalityLvl']));
		
		}	


		/// NO ESCALABLES
		if($pj['destro_power'])
		{
			$pj['Ataque'] += ($LVL*25);
		}

		if($pj['MM_SimpleLife'] && $Wtipo=="bow")
		{
			$query = 'SELECT skillPoints
				FROM personaje
				WHERE idPersonaje = '.$PJID;
				$usersq = $db->sql_query($query);
				$user = $db->sql_fetchrow($usersq);
			if($user['skillPoints']>=24)
				$user['skillPoints']=24;
			$pj['Ataque']+=intval(1000*$user['skillPoints']);
		}

		if($pj['V_LifeForce'])
		{
			$pj['Ataque'] += intval(($pj['VidaLimit']/500)*100);
		}

		if($pj['N_Sorieketon'])
		{
			$pj['Ataque']+= (int)$pj['evasion']*1000;
		}
		if($pj['ZT_DoomGuard'])
		{
			$pj['Defensa'] += potenciar($pj['Defensa'],25);
			$pj['DefensaMagica'] += potenciar($pj['DefensaMagica'],25);
		}

		//SAVING EXP & GOLD BONUS
		if($PJID==$log->get("pjSelected") && $iniInParty>0)
		{
			if($IniEXPBONUS!=$pj['EXPBONUS'])
			{
				$db->sql_query("UPDATE personaje SET
				EXPBONUS='".$pj['EXPBONUS']."'
				WHERE idPersonaje = ".$log->get("pjSelected")."");
			}
			if($IniGOLDBONUS!=$pj['GOLDBONUS'])
			{
				$db->sql_query("UPDATE personaje SET
				GOLDBONUS='".$pj['GOLDBONUS']."'
				WHERE idPersonaje = ".$log->get("pjSelected")."");
			}
		}


		if($pj['C_InnerFire'])
		{
			$pj['Defensa'] += $pj['Defensa'];
			$pj['DefensaMagica'] += $pj['DefensaMagica'];
		}

		if($pj['OdynBlessing'])
		{
			$pj['Defensa']+= 2000;
			$pj['DefensaMagica']+= 2000;
			$pj['Ataque']+= 10000;
			$pj['AtaqueMagico'] += 5000;
			if($pj['Critico']<100)
				$pj['Critico']=100;
			if($pj['CriticoMagico']<100)
				$pj['CriticoMagico']=100;
		}
		if($pj['ColossalSpeed'])
		{
			 $pj['PSpeed'] = 5;
			 if($pj['Critico']<100)
				$pj['Critico']=100;
		}

		//GOD LVL SHIT
		if($godLevel['godlvlAttack']>0)
		{
			$pj['Ataque'] = potenciar($pj['Ataque'],$godLevel['godlvlAttack']);
			$pj['AtaqueMagico'] = potenciar($pj['AtaqueMagico'],$godLevel['godlvlAttack']);
		}
		if($godLevel['godlvlCritico']>0)
		{
			$pj['PC'] = potenciar($pj['PC'],$godLevel['godlvlCritico']);
			$pj['PCMagico'] = potenciar($pj['PCMagico'],$godLevel['godlvlCritico']);
		}
		if($godLevel['godlvlDefensa']>0)
		{
			$pj['Defensa']= potenciar($pj['Defensa'],$godLevel['godlvlDefensa']);
			$pj['DefensaMagica']= potenciar($pj['DefensaMagica'],$godLevel['godlvlDefensa']);
		}
		if($godLevel['godlvlVida']>0)
		{
			$pj['VidaLimit'] = potenciar($pj['VidaLimit'],($godLevel['godlvlVida']*5));	
		}
		
		//Resistences
		$pj['ResFire'] += $pj['ResAll'];
		$pj['ResWater'] += $pj['ResAll'];
		$pj['ResEarth'] += $pj['ResAll'];
		$pj['ResWind'] += $pj['ResAll'];
		$pj['ResDark'] += $pj['ResAll'];
		$pj['ResHoly'] += $pj['ResAll'];

		$pj['ResFireFull'] = $pj['ResFire'];
		$pj['ResWaterFull'] = $pj['ResWater'];
		$pj['ResEarthFull'] = $pj['ResEarth'];
		$pj['ResWindFull']= $pj['ResWind'];
		$pj['ResDarkFull'] = $pj['ResDark'];
		$pj['ResHolyFull'] = $pj['ResHoly'];

		//Limit
		if($pj['ResFire']>75)
			$pj['ResFire']=75;
		if($pj['ResWater']>75)
			$pj['ResWater']=75;
		if($pj['ResEarth']>75)
			$pj['ResEarth']=75;
		if($pj['ResWind']>75)
			$pj['ResWind']=75;
		if($pj['ResDark']>75)
			$pj['ResDark']=75;
		if($pj['ResHoly']>75)
			$pj['ResHoly']=75;

		//SSVINGGEAR TO SERVER
		$pj['GearPower'] = $gear;
		if($PJID==$log->get("pjSelected"))
		{
			$pj['GearPower'] = $_SESSION['PJITEM_gear'];
			if($pj['GearPower']!=$iniGEARSHOW)
				{
					$db->sql_query("UPDATE personaje SET
					GearPower='".$pj['GearPower']."'
					WHERE idPersonaje = ".$log->get("pjSelected")."");
				}

			if($pj['ResFire']!=$iniResFire)
				{
					$db->sql_query("UPDATE personaje SET
					resist_fire='".$pj['ResFire']."'
					WHERE idPersonaje = ".$log->get("pjSelected")."");
				}	
			if($pj['ResWater']!=$iniResWater)
				{
					$db->sql_query("UPDATE personaje SET
					resist_water='".$pj['ResWater']."'
					WHERE idPersonaje = ".$log->get("pjSelected")."");
				}	
			if($pj['ResEarth']!=$iniResEarth)
				{
					$db->sql_query("UPDATE personaje SET
					resist_earth='".$pj['ResEarth']."'
					WHERE idPersonaje = ".$log->get("pjSelected")."");
				}	
			if($pj['ResWind']!=$iniResWind)
				{
					$db->sql_query("UPDATE personaje SET
					resist_wind='".$pj['ResWind']."'
					WHERE idPersonaje = ".$log->get("pjSelected")."");
				}	
			if($pj['ResDark']!=$iniResDark)
				{
					$db->sql_query("UPDATE personaje SET
					resist_dark='".$pj['ResDark']."'
					WHERE idPersonaje = ".$log->get("pjSelected")."");
				}	
			if($pj['ResHoly']!=$iniResHoly)
				{
					$db->sql_query("UPDATE personaje SET
					resist_holy='".$pj['ResHoly']."'
					WHERE idPersonaje = ".$log->get("pjSelected")."");
				}	
		}

		$pj['Ataque']=intval($pj['Ataque']);
		//TEST
		//$pj['Ataque']+= potenciar(potenciar(12077270,859),800)  ;
		//$pj['PSpeed']=10;
		//$pj['Defensa']+=99999;
		//$pj['Critico'] = 100;
		//$pj['ManaShield']+=30;
		return $pj;
}

function Monster_experience($L,$multy) {

 	return intval((($L*$L)/5 + 10 )*2)*$multy;
}
function Monster_gold($L,$multy) {
	return intval(($L*$L)/10 + 1 )*$multy;
}
function makeNotice($titulo,$texto)
{
	global $db;
	$fecha =date("Y-m-d");
	$db->sql_query('INSERT INTO notices (fecha,titulo,texto) 
		VALUES("'.$fecha.'","The '.$titulo.'","'.$texto.'")');	
}
function insertBuff($idPersonaje,$idSkill,$idSkillReal,$time,$extra=0)
{
	global $db;
	$now = tiempoReal();
	$db->sql_query("DELETE FROM aura WHERE idSkillReal = '".$idSkillReal."' AND idPersonaje = ".$idPersonaje."");
	
	$db->sql_query('INSERT INTO  aura(idPersonaje,idSkill,static,idSkillReal,timeOut,extraData) 
	VALUES("'.$idPersonaje.'","'.$idSkill.'","0","'.$idSkillReal.'",'.($now+$time).','.$extra.')');
}
function systemLog($tipo,$msg,$to=0)
{
	global $db,$pj,$log;
	$now = tiempoReal();
	switch($tipo)
	{
		case 'party':
			$db->sql_query('INSERT INTO  chat(party,mensaje,tempo) 
			VALUES("'.$pj['party'].'","'.$msg.'",'.$now.')');
		break;
		case 'self':
			$db->sql_query('INSERT INTO  chat(idPersonaje,mensaje,tempo) 
			VALUES("'.$log->get("pjSelected").'","'.$msg.'",'.$now.')');
		break;
		case 'other':
			$db->sql_query('INSERT INTO  chat(idPersonaje,mensaje,tempo) 
			VALUES("'.$to.'","'.$msg.'",'.$now.')');
		break;
		case 'clan':
			$db->sql_query('INSERT INTO  chat(clan,mensaje,tempo) 
			VALUES("'.$to.'","'.$msg.'",'.$now.')');
		break;
		case 'global':
			$db->sql_query('INSERT INTO  chat(global,mensaje,tempo) 
			VALUES(1,"'.$msg.'",'.$now.')');
		break;
	}
}
function penetration($base,$per)
{
	if($per>0)
		$newArmor = bigintval($base - ($base/100)*$per);
	else
		$newArmor = $base;
	if($newArmor<=0)
		$newArmor=1;
	return $newArmor;
}
function dificultyHP($dig)
{
	switch($dig)
					{
						case 1:
							$multyDifer=1;
						break;
						case 2:
							$multyDifer=3;
						break;
						case 3:
							$multyDifer=8;
						break;
						case 4:
							$multyDifer=45;
						break;
						case 5:
							$multyDifer=100;
						break;
						case 6:
							$multyDifer=250;
						break;
					}
	return $multyDifer;
}
function dificultyAttack($dig)
{
	switch($dig)
	{
		case 1:
			$multyDifer=1;
		break;
		case 2:
			$multyDifer=3;
		break;
		case 3:
			$multyDifer=5;
		break;
		case 4:
			$multyDifer=15;
		break;
		case 5:
			$multyDifer=25;
		break;
		case 6:
			$multyDifer=45;
		break;
	}
	return $multyDifer;
}
function dificultyExpMulty($dig)
{
	switch($dig)
	{
		case 1:
			$multyDifer=1;
		break;
		case 2:
			$multyDifer=2;
		break;
		case 3:
			$multyDifer=3;
		break;
		case 4:
			$multyDifer=8;
		break;
		case 5:
			$multyDifer=15;
		break;
		case 6:
			$multyDifer=25;
		break;
	}
	return $multyDifer;
}
function dificultyGoldMulty($dig)
{
	switch($dig)
	{
		case 1:
			$multyDifer=1;
		break;
		case 2:
			$multyDifer=2;
		break;
		case 3:
			$multyDifer=3;
		break;
		case 4:
			$multyDifer=4;
		break;
		case 5:
			$multyDifer=5;
		break;
		case 6:
			$multyDifer=6;
		break;
	}
	return $multyDifer;
}
function rand_float($st_num=0,$end_num=1,$mul=1000000)
{
if ($st_num>$end_num) return false;
return mt_rand($st_num*$mul,$end_num*$mul)/$mul;
}
?>