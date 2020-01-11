<?php 
$legendaryAviable=true;
$counterRare=0;
$counterEpic=0;
$counterLegendary=0;
$banTypes = null;


//error_reporting(E_ALL);
ini_set('display_errors', '0');

$query = 'SELECT *
		FROM personaje p
		WHERE p.idCuenta = '.$log->get("idCuenta").' AND p.idPersonaje = '.$log->get("pjSelected").' AND p.desactivada=0';
$pj = $db->sql_fetchrow($db->sql_query($query));

function generateBoxItem($boxTier,$idBox,$grado,$especial)
{
	global $log,$banTypes,$db,$counterRare,$counterEpic,$counterLegendary,$pj;

		$bansql = "";
		$bansep="";
		$i=0;
		if(is_array($banTypes))
		{
			$bansql.=" AND (";
			while($banTypes[$i])
			{
				$bansql.=$bansep." subtipo != '".$banTypes[$i]."' ";
				$bansep=" AND ";
				$i++;
			}
			$bansql.=")";
		}

	$getThis="";
	$runaSql = '0=1';
	if(mt_rand(1,7)==1)// ReRoll
		$getThis = 'i.idItem = 613';	
	
	if(mt_rand(1,500)==75)//Corruption
		$getThis = 'i.idItem = 618';
	
	if(mt_rand(1,555)==250)//Alquimist
		$getThis = 'i.idItem = 617';
		
	if(mt_rand(1,35)==10)//Exodimo
		$getThis = 'i.idItem = 616';
		
	if(mt_rand(1,25000)==500)//Upulus
		$getThis = 'i.idItem = 615';
	
	if(mt_rand(1,30)==7)//Chaos
		$getThis = 'i.idItem = 614';
		
	if($grado>=2 && $grado<=10 && mt_rand(1,100)==50)		
		$runaSql= 'i.tipo = "runa"';
	
	if($grado>=2 && $grado<=8 && mt_rand(1,50)==25)
		$runaSql = 'i.tipo = "stone"';


	//// DROP POCIONES
	if(mt_rand(1,5)==3)
	{
		$query = 'SELECT i.Nombre, inv.idInventario, i.idItem
			FROM item i 
			LEFT JOIN inventario inv 
			ON i.idItem = inv.idItem 
			AND inv.idCuenta = '.$log->get("idCuenta").'
			WHERE i.tipo = "pot" AND
			inv.idInventario is null
			ORDER BY RAND() LIMIT 0,1';
		$potionsq = $db->sql_query($query);
			$potion = $db->sql_fetchrow($potionsq);
			if($potion)
			{
				$getThis=" i.idItem = ".$potion['idItem']." ";
			}
	}
	///
	if(strlen($getThis)>3 && !$_SESSION['gotConsum'] && !$srcforNoMore)
	{
		$query = 'SELECT i.Nombre, i.contable, i.leg, i.idItem, i.subtipo
			FROM item i
			WHERE '.$getThis.' LIMIT 0,1';
		
		$_SESSION['gotConsum']=true;
	}
	else
		$query = 'SELECT i.Nombre, i.contable, i.leg, i.idItem, i.subtipo
			FROM item i
			WHERE (('.$runaSql.') OR (droppeable=1 AND grado='.$grado.' AND tier=0) '.$newbieSql.') '.$bansql.' ORDER BY RAND() LIMIT 0,1';
	
	switch($especial)
	{
		case 1: // Santa
			$rnd = mt_rand(1,5);
			$query = 'SELECT i.Nombre, i.contable, i.leg, i.idItem, i.subtipo
			FROM item i
			WHERE ( i.idItem = 615 OR i.idItem = 618 OR i.idItem = 617 OR i.idItem = 616 OR i.idItem = 614 OR (i.tipo = "runa" AND 2 > '.$rnd.') ) ORDER BY RAND() LIMIT 0,1';
		break;
	}

	$dropssq = $db->sql_query($query);
	$drop = $db->sql_fetchrow($dropssq);


			$banTypes[]=$drop['subtipo'];

			$valueInt=0;
			switch($boxTier)
			{
				case 1:
					if($counterRare==0 && $counterEpic==0 && $counterLegendary==0)
					{
						$chance = mt_rand(1,1000);
						$LegChance = 1;
						$EpicChance = 50;
						$RareChance = 100;	
						$MagicChance = 500;	
						if($chance<=$LegChance)
						{
							$valueInt=4;
							$counterLegendary++;
						}else if($chance<=$EpicChance)
						{
							$valueInt=3;
							$counterEpic++;
						}else if($chance<=$RareChance )
						{
							$valueInt=2;
							$counterRare++;
						}else if($chance<=$MagicChance )
						{
							$valueInt=1;
						}
					 }
				break;
				case 2:
					$chance = mt_rand(1,500);
					$LegChance = 1;
					$EpicChance = 50;
					$RareChance = 100;	
					$MagicChance = 200;	
					if($chance<=$LegChance && $counterLegendary==0)
					{
						$valueInt=4;
						$counterLegendary++;
					}else if($chance<=$EpicChance && $counterEpic==0)
					{
						$valueInt=3;
						$counterEpic++;
					}else if($chance<=$RareChance && $counterRare<3 )
					{
						$valueInt=2;
						$counterRare++;
					}else if($chance<=$MagicChance )
					{
						$valueInt=1;
					}
				break;
				case 3:
					$chance = mt_rand(1,250);
					$LegChance = 1;
					$EpicChance = 25;
					$RareChance = 100;	
					$valueInt=1;
					if($chance<=$LegChance && $counterLegendary==0)
					{
						$valueInt=4;
						$counterLegendary++;
					}else if($chance<=$EpicChance && $counterEpic<2)
					{
						$valueInt=3;
						$counterEpic++;
					}else if($chance<=$RareChance)
					{
						$valueInt=2;
						$counterRare++;
					}
				break;
				case 4:
					$chance = mt_rand(1,100);
					$LegChance = 1;
					$EpicChance = 20;
					$RareChance = 100;	
					$valueInt=1;
					if($chance<=$LegChance && $counterLegendary==0)
					{
						$valueInt=4;
						$counterLegendary++;
					}else if($chance<=$EpicChance && $counterEpic<3)
					{
						$valueInt=3;
						$counterEpic++;
					}else if($chance<=$RareChance)
					{
						$valueInt=2;
						$counterRare++;
					}
				break;
				case 5:
						$chance = mt_rand(1,10);
						$LegChance = 1;
						$EpicChance = 5;
						$RareChance = 100;	
						$valueInt=1;
						if($chance<=$LegChance && $counterLegendary==0)
						{
							$valueInt=4;
							$counterLegendary++;
						}else if($chance<=$EpicChance)
						{
							$valueInt=3;
							$counterEpic++;
						}else if($chance<=$RareChance)
						{
							$valueInt=2;
							$counterRare++;
						}
				break;
		}
	createDrop($drop['idItem'],$idBox,$valueInt,$grado,$especial);
}
function randomShit()
{
	switch(mt_rand(1,8))
	{
		case 1:
			$type ="head";
		break;
		case 2:
			$type ="gloves";
		break;
		case 3:
			$type ="foots";
		break;
		case 4:
			$type ="shield";
		break;
		case 5:
			$type ="armor";
		break;
		case 6:
			$type ="W";
		break;
		case 7:
			$type ="rings";
		break;
		case 8:
			$type ="necklace";
		break;
	}
	return $type ;
}
function randomAttrb($itemId,$grade,$type,$value,$idBox)
{
	global $db,$tipoRoll;
	$mainLuky =  mt_rand(1,5);
	
	include("tablaAtributos.php");
	
	// VALUE
	
	
	
	if($type=="W")
	{

			$elemtopPer=$elemtopPer*3;
			$skilltopPer=$skilltopPer*2;
	}
	$acumulate=$value;
	
	$attaqueFree=true;
	$attaqueMagicFree=true;
	$criticalFree=true;
	$CriticoMagicoFree=true;
	$PCFree=true;
	$DefensaFree=true;
	$PCMagicoFree=true;
	$DefensaMagicaFree=true;
	$VidaLimitFree=true;
	$ManaLimitFree=true;
	$HpRegenFree=true;
	$MpRegenFree=true;
	$buffGiven=0;
	while($buffGiven<$acumulate)
	{
		/////// ALLLLL
				if($tipoRoll!=2)
				{
					$chanc = mt_rand(1,20);
					if($chanc==$mainLuky AND $attaqueFree AND $buffGiven<$acumulate)
					{
						$attaqueFree=false;
						$buffGiven++;
						$attr="Ataque";
						$valor=mt_rand(10,$maxSkill1);
						$db->sql_query('INSERT INTO boxes_attr(idBoxDrop,attrb,valor,idBox,maxVal) VALUES("'.$itemId.'","'.$attr.'","'.$valor.'","'.$idBox.'","'.$maxSkill1.'")');
						$leyenda .= $attr." +".$valor." <br>";
					}
				}
				if($tipoRoll!=1)
				{
					$chanc = mt_rand(1,20);
					if($chanc==$mainLuky AND $attaqueMagicFree AND $buffGiven<$acumulate)
					{
						$attaqueMagicFree=false;
						$buffGiven++;
						$attr="AtaqueMagico";
						$valor=mt_rand(10,$maxSkill1);
						$db->sql_query('INSERT INTO boxes_attr(idBoxDrop,attrb,valor,idBox,maxVal) VALUES("'.$itemId.'","'.$attr.'","'.$valor.'","'.$idBox.'","'.$maxSkill1.'")');
						$leyenda .= $attr." +".$valor." <br>";
					}
				}
				if($tipoRoll!=2)
				{
					$chanc = mt_rand(1,20);
					if($chanc==$mainLuky AND $criticalFree AND $buffGiven<$acumulate)
					{
						$criticalFree=false;
						$buffGiven++;
						$attr="Critico";
						$valor=mt_rand(1,$maxSkill3);
						$db->sql_query('INSERT INTO boxes_attr(idBoxDrop,attrb,valor,idBox,maxVal) VALUES("'.$itemId.'","'.$attr.'","'.$valor.'","'.$idBox.'","'.$maxSkill3.'")');
						$leyenda .= $attr." +".$valor." <br>";
					}
				}
				if($tipoRoll!=1)
				{
					$chanc = mt_rand(1,20);
					if($chanc==$mainLuky AND $CriticoMagicoFree AND $buffGiven<$acumulate)
					{
						$CriticoMagicoFree=false;
						$buffGiven++;
						$attr="CriticoMagico";
						$valor=mt_rand(1,$maxSkill3);
						$db->sql_query('INSERT INTO boxes_attr(idBoxDrop,attrb,valor,idBox,maxVal) VALUES("'.$itemId.'","'.$attr.'","'.$valor.'","'.$idBox.'","'.$maxSkill3.'")');
						$leyenda .= $attr." +".$valor." <br>";
					}
				}
				if($tipoRoll!=2)
				{
					$chanc = mt_rand(1,20);
					if($chanc==$mainLuky AND $PCFree AND $buffGiven<$acumulate)
					{
						$PCFree=false;
						$buffGiven++;
						$attr="PC";
						$valor=mt_rand(5,$maxSkill1);
						$db->sql_query('INSERT INTO boxes_attr(idBoxDrop,attrb,valor,idBox,maxVal) VALUES("'.$itemId.'","'.$attr.'","'.$valor.'","'.$idBox.'","'.$maxSkill1.'")');
						$leyenda .= $attr." +".$valor." <br>";
					}
				}
				if($tipoRoll!=1)
				{
					$chanc = mt_rand(1,20);
					if($chanc==$mainLuky AND $PCMagicoFree AND $buffGiven<$acumulate)
					{
						$PCMagicoFree=false;
						$buffGiven++;
						$attr="PCMagico";
						$valor=mt_rand(5,$maxSkill1);
						$db->sql_query('INSERT INTO boxes_attr(idBoxDrop,attrb,valor,idBox,maxVal) VALUES("'.$itemId.'","'.$attr.'","'.$valor.'","'.$idBox.'","'.$maxSkill1.'")');
						$leyenda .= $attr." +".$valor." <br>";
					}
               	}
				$chanc = mt_rand(1,20);
				if($chanc==$mainLuky AND $DefensaFree AND $buffGiven<$acumulate)
				{
					$DefensaFree=false;
					$buffGiven++;
					$attr="Defensa";
					$valor=mt_rand(20,$maxSkill2);
					$db->sql_query('INSERT INTO boxes_attr(idBoxDrop,attrb,valor,idBox,maxVal) VALUES("'.$itemId.'","'.$attr.'","'.$valor.'","'.$idBox.'","'.$maxSkill2.'")');
					$leyenda .= $attr." +".$valor." <br>";
				}
				$chanc = mt_rand(1,20);
				if($chanc==$mainLuky AND $DefensaMagicaFree AND $buffGiven<$acumulate)
				{
					$DefensaMagicaFree=false;
					$buffGiven++;
					$attr="DefensaMagica";
					$valor=mt_rand(20,$maxSkill2);
					$db->sql_query('INSERT INTO boxes_attr(idBoxDrop,attrb,valor,idBox,maxVal) VALUES("'.$itemId.'","'.$attr.'","'.$valor.'","'.$idBox.'","'.$maxSkill2.'")');
					$leyenda .= $attr." +".$valor." <br>";
				}
				$chanc = mt_rand(1,20);
				if($chanc==$mainLuky AND $VidaLimitFree AND $buffGiven<$acumulate)
				{
					$VidaLimitFree=false;
					$buffGiven++;
					$attr="VidaLimit";
					$valor=mt_rand(100,$maxSkill4);
					$db->sql_query('INSERT INTO boxes_attr(idBoxDrop,attrb,valor,idBox,maxVal) VALUES("'.$itemId.'","'.$attr.'","'.$valor.'","'.$idBox.'","'.$maxSkill4.'")');
					$leyenda .= $attr." +".$valor." <br>";
				}
				$chanc = mt_rand(1,20);
				if($chanc==$mainLuky AND $ManaLimitFree AND $buffGiven<$acumulate)
				{
					$ManaLimitFree=false;
					$buffGiven++;
					$attr="ManaLimit";
					$valor=mt_rand(100,$maxSkill4);
					$db->sql_query('INSERT INTO boxes_attr(idBoxDrop,attrb,valor,idBox,maxVal) VALUES("'.$itemId.'","'.$attr.'","'.$valor.'","'.$idBox.'","'.$maxSkill4.'")');
					$leyenda .= $attr." +".$valor." <br>";
				}
				$chanc = mt_rand(1,20);
				if($chanc==$mainLuky AND $HpRegenFree AND $buffGiven<$acumulate)
				{
					$HpRegenFree=false;
					$buffGiven++;
					$attr="HpRegen";
					$valor=mt_rand(1,$maxSkill5);
					$db->sql_query('INSERT INTO boxes_attr(idBoxDrop,attrb,valor,idBox,maxVal) VALUES("'.$itemId.'","'.$attr.'","'.$valor.'","'.$idBox.'","'.$maxSkill5.'")');
					$leyenda .= $attr." +".$valor." <br>";
				}
				$chanc = mt_rand(1,20);
				if($chanc==$mainLuky AND $MpRegenFree AND $buffGiven<$acumulate)
				{
					$MpRegenFree=false;
					$buffGiven++;
					$attr="MpRegen";
					$valor=mt_rand(1,$maxSkill5);
					$db->sql_query('INSERT INTO boxes_attr(idBoxDrop,attrb,valor,idBox,maxVal) VALUES("'.$itemId.'","'.$attr.'","'.$valor.'","'.$idBox.'","'.$maxSkill5.'")');
					$leyenda .= $attr." +".$valor." <br>";
				}
		
	}	
		
	if($acumulate>0)
	{
		$db->sql_query("UPDATE boxes_drop SET text_legend = '".$leyenda."' 
		WHERE idBoxDrop	 = '".$itemId."'");
	}
	return $leyenda;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////
function createDrop($especif,$idBox,$tier,$dropGrado,$especial)
{
	global $db,$log;

	if($especif)
		{
			$query = 'SELECT * FROM item WHERE idItem='.$especif.'';
			$itemsq = $db->sql_query($query);
			$res = $db->sql_fetchrow($itemsq);
			$grade = $res['grado'];
			$type = $res['tipo'];
	
	if($res['contable']==1 || $res['tipo']=="runa" || $res['tipo']=="stone")
			$tier=0;
			
	switch ($especial) {
		case 1:
			$dropGrado=mt_rand(7,10);
		break;
	}

	$db->sql_query('INSERT INTO boxes_drop(idItem,idBox,nivel,extraLevel) 
		VALUES("'.$res['idItem'].'","'.$idBox.'",'.$tier.','.$dropGrado.')');

	$query = 'SELECT max(idBoxDrop) AS ID FROM boxes_drop';	
	$itemsq = $db->sql_query($query);
	$maxId = $db->sql_fetchrow($itemsq);
	

	//Random attributes
	//echo 'randomAttrb('.$maxId['ID'].','.$grade.','.$type.','.$clase.')';
	$temp = randomAttrb($maxId['ID'],$grade,$type,$tier,$idBox,$maxVal);
	
	return $maxId['ID']; 
	}
	else
	{
		die("ERROR creando legendaria");
	}
}
?>