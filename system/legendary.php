<?php 
$legendaryAviable=true;
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
function randomAttrb($itemId,$grade,$type,$clase,$value,$astralLvl,$forceStats=0,$masterwork=0)
{
	global $db,$tipoRoll;
	$mainLuky =  mt_rand(1,5);
	if($astralLvl>0 OR $forceStats>0)
	{
		$value+=3;
	}

	include("tablaAtributos.php");
	// VALUE
	
	
	
	if($type=="W")
	{

			$elemtopPer=$elemtopPer*3;
			$skilltopPer=$skilltopPer*2;

			if($masterwork)
				$elemtopPer=$elemtopPer*2;

	}
	$acumulate=$value;
	if($masterwork)
		$acumulate+=3;

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
						if($masterwork)
							$valor=$maxSkill1*3;
						else	
							$valor=mt_rand(balanceStatMin($maxSkill1),$maxSkill1);
						$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor) VALUES("'.$itemId.'","'.$attr.'","'.$valor.'")');
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
						if($masterwork)
							$valor=$maxSkill1*3;
						else
							$valor=mt_rand(balanceStatMin($maxSkill1),$maxSkill1);
						$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor) VALUES("'.$itemId.'","'.$attr.'","'.$valor.'")');
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
						if($masterwork)
							$valor=$maxSkill3*3;
						else
							$valor=mt_rand(balanceStatMin($maxSkill3),$maxSkill3);
						$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor) VALUES("'.$itemId.'","'.$attr.'","'.$valor.'")');
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
						if($masterwork)
							$valor=$maxSkill3*3;
						else
						$valor=mt_rand(balanceStatMin($maxSkill3),$maxSkill3);
						$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor) VALUES("'.$itemId.'","'.$attr.'","'.$valor.'")');
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
						if($masterwork)
							$valor=$maxSkill1*3;
						else
							$valor=mt_rand(balanceStatMin($maxSkill1),$maxSkill1);
						$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor) VALUES("'.$itemId.'","'.$attr.'","'.$valor.'")');
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
						if($masterwork)
							$valor=$maxSkill1*3;
						else
						$valor=mt_rand(balanceStatMin($maxSkill1),$maxSkill1);
						$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor) VALUES("'.$itemId.'","'.$attr.'","'.$valor.'")');
						$leyenda .= $attr." +".$valor." <br>";
					}
               	}
				$chanc = mt_rand(1,20);
				if($chanc==$mainLuky AND $DefensaFree AND $buffGiven<$acumulate)
				{
					$DefensaFree=false;
					$buffGiven++;
					$attr="Defensa";
					if($masterwork)
							$valor=$maxSkill2*3;
						else
					$valor=mt_rand(balanceStatMin($maxSkill2),$maxSkill2);
					$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor) VALUES("'.$itemId.'","'.$attr.'","'.$valor.'")');
					$leyenda .= $attr." +".$valor." <br>";
				}
				$chanc = mt_rand(1,20);
				if($chanc==$mainLuky AND $DefensaMagicaFree AND $buffGiven<$acumulate)
				{
					$DefensaMagicaFree=false;
					$buffGiven++;
					$attr="DefensaMagica";
					if($masterwork)
							$valor=$maxSkill2*3;
						else
					$valor=mt_rand(balanceStatMin($maxSkill2),$maxSkill2);
					$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor) VALUES("'.$itemId.'","'.$attr.'","'.$valor.'")');
					$leyenda .= $attr." +".$valor." <br>";
				}
				$chanc = mt_rand(1,20);
				if($chanc==$mainLuky AND $VidaLimitFree AND $buffGiven<$acumulate)
				{
					$VidaLimitFree=false;
					$buffGiven++;
					$attr="VidaLimit";
					if($masterwork)
							$valor=$maxSkill4*3;
						else
					$valor=mt_rand(balanceStatMin($maxSkill4),$maxSkill4);
					$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor) VALUES("'.$itemId.'","'.$attr.'","'.$valor.'")');
					$leyenda .= $attr." +".$valor." <br>";
				}
				$chanc = mt_rand(1,20);
				if($chanc==$mainLuky AND $ManaLimitFree AND $buffGiven<$acumulate)
				{
					$ManaLimitFree=false;
					$buffGiven++;
					$attr="ManaLimit";
					if($masterwork)
							$valor=$maxSkill4*3;
						else
					$valor=mt_rand(balanceStatMin($maxSkill4),$maxSkill4);
					$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor) VALUES("'.$itemId.'","'.$attr.'","'.$valor.'")');
					$leyenda .= $attr." +".$valor." <br>";
				}
				$chanc = mt_rand(1,20);
				if($chanc==$mainLuky AND $HpRegenFree AND $buffGiven<$acumulate)
				{
					$HpRegenFree=false;
					$buffGiven++;
					$attr="HpRegen";
					if($masterwork)
							$valor=$maxSkill5*3;
						else
					$valor=mt_rand(balanceStatMin($maxSkill5),$maxSkill5);
					$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor) VALUES("'.$itemId.'","'.$attr.'","'.$valor.'")');
					$leyenda .= $attr." +".$valor." <br>";
				}
				$chanc = mt_rand(1,20);
				if($chanc==$mainLuky AND $MpRegenFree AND $buffGiven<$acumulate)
				{
					$MpRegenFree=false;
					$buffGiven++;
					$attr="MpRegen";
					if($masterwork)
							$valor=$maxSkill5*3;
						else
					$valor=mt_rand(balanceStatMin($maxSkill5),$maxSkill5);
					$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor) VALUES("'.$itemId.'","'.$attr.'","'.$valor.'")');
					$leyenda .= $attr." +".$valor." <br>";
				}
		
	}	
		
	if($acumulate>0)
		$db->sql_query('UPDATE inventario SET atributos = "'.$leyenda.'" WHERE idInventario = "'.$itemId.'"');
	
	return $leyenda;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////
function createLegendary($especif,$intradeable=0,$idCuenta=0,$clase=0,$value=1,$epic=0,$astralLvl=0,$forceStats=0,$masterwork=0)
{
	global $db,$log;
	if($especif)
		{
			if(!$idCuenta)
				$idCuenta = $log->get("idCuenta");
			$query = 'SELECT * FROM item WHERE idItem='.$especif.'';
			$itemsq = $db->sql_query($query);
			$res = $db->sql_fetchrow($itemsq);
			$grade = $res['grado'];
			$type = $res['tipo'];
				if(!$clase)
			{
				$query = 'SELECT p.idClase
									FROM personaje p RIGHT JOIN cuenta cu ON p.idPersonaje = cu.pjSelected
									WHERE p.idCuenta = '.$idCuenta.'';
				$pjsq = $db->sql_query($query);
				$pj = $db->sql_fetchrow($pjsq);
				$clase = $pj['idClase'];
			}
	$runaSkill1=0;
	$runaSkill2=0;
	$runaSkill3=0;
	if($res['grado']==12 && $res['armorset']>0)
	{
		$query = 'SELECT idItem FROM item WHERE i.tipo = "runa"  ORDER BY RAND() LIMIT 0,1';
		$runarndsq = $db->sql_query($query);
		$runa = $db->sql_fetchrow($runarndsq);
		$runaSkill1=$runa['idItem'];
		$query = 'SELECT idItem FROM item WHERE tipo = "runa" AND idItem!='.$runaSkill1.'  ORDER BY RAND() LIMIT 0,1';
		$runarndsq = $db->sql_query($query);
		$runa = $db->sql_fetchrow($runarndsq);
		$runaSkill2=$runa['idItem'];
	}

	$db->sql_query('INSERT INTO inventario(idItem,idCuenta,cantidad,intradeable,legendary,value,lvlAstral,masterWork,bonusRuna1,bonusRuna2,bonusRuna3) 
		VALUES("'.$res['idItem'].'","'.$idCuenta.'",1,'.$intradeable.',1,'.$value.','.$astralLvl.','.$masterwork.','.$runaSkill1.','.$runaSkill2.','.$runaSkill3.')');

	$query = 'SELECT max(idInventario) AS ID FROM inventario WHERE idCuenta = '.$idCuenta.'';	
	$itemsq = $db->sql_query($query);
	$maxId = $db->sql_fetchrow($itemsq);
	
	//Random attributes
	//echo 'randomAttrb('.$maxId['ID'].','.$grade.','.$type.','.$clase.')';
	$temp = randomAttrb($maxId['ID'],$grade,$type,$clase,$value,$astralLvl,$forceStats,$masterwork);
	return $maxId['ID']; 
	}
	else
	{
		die("ERROR creando legendaria");
	}
}
?>