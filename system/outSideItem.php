<?php

function randomAttrb($itemId,$grade,$value)
{
	global $db,$tipoRoll;
	$mainLuky =  mt_rand(1,5);
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
		 	$skilltopPer=20;
			$elemtopPer=20;
			
			$maxSkill3 = 8;
			$maxSkill5 = 20;
		 	$maxSkill1 = 30;
			$maxSkill2 = 55;
			$maxSkill4 = 450;
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
	if($value==0)
	$value=1;
			$skilltopPer=$skilltopPer*$value;
			$elemtopPer=$elemtopPer*$value;
			$maxSkill3 = $maxSkill3*$value;
			$maxSkill5 = $maxSkill5*$value;
		 	$maxSkill1 = $maxSkill1*$value;
			$maxSkill2 = $maxSkill2*$value;
			$maxSkill4 = $maxSkill4*$value;
	
	// VALUE
	
	
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
						$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor)  VALUES("'.$itemId.'","'.$attr.'","'.$valor.'")');
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
						$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor)  VALUES("'.$itemId.'","'.$attr.'","'.$valor.'")');
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
						$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor)  VALUES("'.$itemId.'","'.$attr.'","'.$valor.'")');
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
						$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor)  VALUES("'.$itemId.'","'.$attr.'","'.$valor.'")');
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
						$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor)  VALUES("'.$itemId.'","'.$attr.'","'.$valor.'")');
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
						$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor)  VALUES("'.$itemId.'","'.$attr.'","'.$valor.'")');
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
					$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor)  VALUES("'.$itemId.'","'.$attr.'","'.$valor.'")');
					$leyenda .= $attr." +".$valor." <br>";
				}
				$chanc = mt_rand(1,20);
				if($chanc==$mainLuky AND $DefensaMagicaFree AND $buffGiven<$acumulate)
				{
					$DefensaMagicaFree=false;
					$buffGiven++;
					$attr="DefensaMagica";
					$valor=mt_rand(20,$maxSkill2);
					$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor)  VALUES("'.$itemId.'","'.$attr.'","'.$valor.'")');
					$leyenda .= $attr." +".$valor." <br>";
				}
				$chanc = mt_rand(1,20);
				if($chanc==$mainLuky AND $VidaLimitFree AND $buffGiven<$acumulate)
				{
					$VidaLimitFree=false;
					$buffGiven++;
					$attr="VidaLimit";
					$valor=mt_rand(100,$maxSkill4);
					$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor)  VALUES("'.$itemId.'","'.$attr.'","'.$valor.'")');
					$leyenda .= $attr." +".$valor." <br>";
				}
				$chanc = mt_rand(1,20);
				if($chanc==$mainLuky AND $ManaLimitFree AND $buffGiven<$acumulate)
				{
					$ManaLimitFree=false;
					$buffGiven++;
					$attr="ManaLimit";
					$valor=mt_rand(100,$maxSkill4);
					$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor)  VALUES("'.$itemId.'","'.$attr.'","'.$valor.'")');
					$leyenda .= $attr." +".$valor." <br>";
				}
				$chanc = mt_rand(1,20);
				if($chanc==$mainLuky AND $HpRegenFree AND $buffGiven<$acumulate)
				{
					$HpRegenFree=false;
					$buffGiven++;
					$attr="HpRegen";
					$valor=mt_rand(1,$maxSkill5);
					$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor)  VALUES("'.$itemId.'","'.$attr.'","'.$valor.'")');
					$leyenda .= $attr." +".$valor." <br>";
				}
				$chanc = mt_rand(1,20);
				if($chanc==$mainLuky AND $MpRegenFree AND $buffGiven<$acumulate)
				{
					$MpRegenFree=false;
					$buffGiven++;
					$attr="MpRegen";
					$valor=mt_rand(1,$maxSkill5);
					$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor)  VALUES("'.$itemId.'","'.$attr.'","'.$valor.'")');
					$leyenda .= $attr." +".$valor." <br>";
				}
		
	}	
}
/////////////////////////////////////////////////randomCorrupted
function randomCorrupted($itemId,$grade,$value)
{
	global $db,$tipoRoll;
	$mainLuky =  mt_rand(1,5);
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
		 	$skilltopPer=20;
			$elemtopPer=20;
			
			$maxSkill3 = 8;
			$maxSkill5 = 20;
		 	$maxSkill1 = 30;
			$maxSkill2 = 55;
			$maxSkill4 = 450;
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
	if($value==0)
	$value=1;
			$skilltopPer=$skilltopPer*$value;
			$elemtopPer=$elemtopPer*$value;
			$maxSkill3 = $maxSkill3*$value;
			$maxSkill5 = $maxSkill5*$value;
		 	$maxSkill1 = $maxSkill1*$value;
			$maxSkill2 = $maxSkill2*$value;
			$maxSkill4 = $maxSkill4*$value;
	
	// VALUE
	// CORRUPTED

			$maxSkill3 = $maxSkill3*2;
			$maxSkill5 = $maxSkill5*2;
		 	$maxSkill1 = $maxSkill1*2;
			$maxSkill2 = $maxSkill2*2;
			$maxSkill4 = $maxSkill4*2;
	
	$acumulate=$value+mt_rand(1,3);
	
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
						$valor=mt_rand(10,$maxSkill1);
						$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor)  VALUES("'.$itemId.'","'.$attr.'","'.$valor.'")');
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
						$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor)  VALUES("'.$itemId.'","'.$attr.'","'.$valor.'")');
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
						$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor)  VALUES("'.$itemId.'","'.$attr.'","'.$valor.'")');
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
						$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor)  VALUES("'.$itemId.'","'.$attr.'","'.$valor.'")');
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
						$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor)  VALUES("'.$itemId.'","'.$attr.'","'.$valor.'")');
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
						$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor)  VALUES("'.$itemId.'","'.$attr.'","'.$valor.'")');
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
					$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor)  VALUES("'.$itemId.'","'.$attr.'","'.$valor.'")');
					$leyenda .= $attr." +".$valor." <br>";
				}
				$chanc = mt_rand(1,20);
				if($chanc==$mainLuky AND $DefensaMagicaFree AND $buffGiven<$acumulate)
				{
					$DefensaMagicaFree=false;
					$buffGiven++;
					$attr="DefensaMagica";
					$valor=mt_rand(20,$maxSkill2);
					$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor)  VALUES("'.$itemId.'","'.$attr.'","'.$valor.'")');
					$leyenda .= $attr." +".$valor." <br>";
				}
				$chanc = mt_rand(1,20);
				if($chanc==$mainLuky AND $VidaLimitFree AND $buffGiven<$acumulate)
				{
					$VidaLimitFree=false;
					$buffGiven++;
					$attr="VidaLimit";
					$valor=mt_rand(100,$maxSkill4);
					$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor)  VALUES("'.$itemId.'","'.$attr.'","'.$valor.'")');
					$leyenda .= $attr." +".$valor." <br>";
				}
				$chanc = mt_rand(1,20);
				if($chanc==$mainLuky AND $ManaLimitFree AND $buffGiven<$acumulate)
				{
					$ManaLimitFree=false;
					$buffGiven++;
					$attr="ManaLimit";
					$valor=mt_rand(100,$maxSkill4);
					$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor)  VALUES("'.$itemId.'","'.$attr.'","'.$valor.'")');
					$leyenda .= $attr." +".$valor." <br>";
				}
				$chanc = mt_rand(1,20);
				if($chanc==$mainLuky AND $HpRegenFree AND $buffGiven<$acumulate)
				{
					$HpRegenFree=false;
					$buffGiven++;
					$attr="HpRegen";
					$valor=mt_rand(1,$maxSkill5);
					$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor)  VALUES("'.$itemId.'","'.$attr.'","'.$valor.'")');
					$leyenda .= $attr." +".$valor." <br>";
				}
				$chanc = mt_rand(1,20);
				if($chanc==$mainLuky AND $MpRegenFree AND $buffGiven<$acumulate)
				{
					$MpRegenFree=false;
					$buffGiven++;
					$attr="MpRegen";
					$valor=mt_rand(1,$maxSkill5);
					$db->sql_query('INSERT INTO item_attr(idInventario,attrb,valor)  VALUES("'.$itemId.'","'.$attr.'","'.$valor.'")');
					$leyenda .= $attr." +".$valor." <br>";
				}
		
	}	
}
?>