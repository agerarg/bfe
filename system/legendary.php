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

	switch($grade)
	 {
		 case 12:
		 	$skilltopPer=40;
			$elemtopPer=40;
			
			$maxSkill3 = 8;
			$maxSkill5 = 50;
		 	$maxSkill1 = 60;
			$maxSkill2 = 85;
			$maxSkill4 = 750;
		 break;
		 case 11:
		 	$skilltopPer=30;
			$elemtopPer=30;
			
			$maxSkill3 = 16;
			$maxSkill5 = 40;
		 	$maxSkill1 = 50;
			$maxSkill2 = 75;
			$maxSkill4 = 650;
		 break;
		 case 10:
		 	$skilltopPer=25;
			$elemtopPer=25;
			
			$maxSkill3 = 12;
			$maxSkill5 = 30;
		 	$maxSkill1 = 40;
			$maxSkill2 = 65;
			$maxSkill4 = 550;
		 break;
		  case 9:
		 	$skilltopPer=23;
			$elemtopPer=23;
			
			$maxSkill3 = 10;
			$maxSkill5 = 25;
		 	$maxSkill1 = 35;
			$maxSkill2 = 60;
			$maxSkill4 = 500;
		 break;
		  case 8:
		 	$skilltopPer=20;
			$elemtopPer=20;
			
			$maxSkill3 = 8;
			$maxSkill5 = 20;
		 	$maxSkill1 = 30;
			$maxSkill2 = 55;
			$maxSkill4 = 450;
		 break;
		 case 7:
		 	$skilltopPer=15;
			$elemtopPer=15;
			
			$maxSkill3 = 5;
			$maxSkill5 = 15;
		 	$maxSkill1 = 25;
			$maxSkill2 = 50;
			$maxSkill4 = 350;
		 break;
		 case 1:
		 	$skilltopPer=5;
			$elemtopPer=5;
			
			$maxSkill3 = 2;
			$maxSkill5 = 5;
		 	$maxSkill1 = 10;
			$maxSkill2 = 25;
			$maxSkill4 = 150;
		 break;
		 case 2:
		 	$skilltopPer=5;
			$elemtopPer=5;
			
			$maxSkill3 = 2;
			$maxSkill5 = 5;
		 	$maxSkill1 = 10;
			$maxSkill2 = 25;
			$maxSkill4 = 150;
		 break;
		 case 3:
		 	$skilltopPer=6;
			$elemtopPer=6;
			
			$maxSkill3 = 3;
			$maxSkill5 = 6;
		 	$maxSkill1 = 12;
			$maxSkill2 = 30;
			$maxSkill4 = 175;
		 break;
		 case 4:
		 	$skilltopPer=7;
			$elemtopPer=7;
			
			$maxSkill3 = 3;
			$maxSkill5 = 7;
		 	$maxSkill1 = 11;
			$maxSkill2 = 30;
			$maxSkill4 = 200;
		 break;
		 case 5:
		 	$skilltopPer=8;
			$elemtopPer=8;
			
			$maxSkill3 = 4;
			$maxSkill5 = 8;
		 	$maxSkill1 = 12;
			$maxSkill2 = 35;
			$maxSkill4 = 250;
		 break;
		 case 6:
		 	$skilltopPer=10;
			$elemtopPer=10;
			
			$maxSkill3 = 4;
			$maxSkill5 = 13;
		 	$maxSkill1 = 20;
			$maxSkill2 = 40;
			$maxSkill4 = 300;
		 break;
	 }
	$acumulate=0;
	$leyenda="";
	
			$skilltopPer=$skilltopPer*$value;
			$elemtopPer=$elemtopPer*$value;
			$maxSkill3 = $maxSkill3*$value;
			$maxSkill5 = $maxSkill5*$value;
		 	$maxSkill1 = $maxSkill1*$value;
			$maxSkill2 = $maxSkill2*$value;
			$maxSkill4 = $maxSkill4*$value;
	
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
							$valor=mt_rand(10,$maxSkill1);
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
							$valor=mt_rand(10,$maxSkill1);
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
							$valor=mt_rand(1,$maxSkill3);
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
						$valor=mt_rand(1,$maxSkill3);
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
							$valor=mt_rand(5,$maxSkill1);
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
						$valor=mt_rand(5,$maxSkill1);
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
					$valor=mt_rand(20,$maxSkill2);
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
					$valor=mt_rand(20,$maxSkill2);
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
					$valor=mt_rand(100,$maxSkill4);
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
					$valor=mt_rand(100,$maxSkill4);
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
					$valor=mt_rand(1,$maxSkill5);
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
					$valor=mt_rand(1,$maxSkill5);
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

	$db->sql_query('INSERT INTO inventario(idItem,idCuenta,cantidad,intradeable,legendary,value,lvlAstral,masterWork) VALUES("'.$res['idItem'].'","'.$idCuenta.'",1,'.$intradeable.',1,'.$value.','.$astralLvl.','.$masterwork.')');

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