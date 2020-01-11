<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
if(!$legendaryAviable)
	include("../system/legendary.php");

function groupDrop($dropChar,$account,$name,$champ,$dropGrade,$dropChan,$special)
{
	global $db, $log;
		$info['exito'] = 0;	
			$info['dropMsg'] = "";
			
			$chance = mt_rand(1,100);
			$chanseGold=50;
			if($special==2)
			{
				if($champ)
				{
				$chance = mt_rand(1,5);
				$chanseGold=5;
				}
				else
				{
				$chance = mt_rand(1,10);
				$chanseGold=5;
				}
			}
			else
			if($special>0)
			{
				$chance = mt_rand(1,50);
				$chanseGold=25;
				if($champ)
					{
						$chance = mt_rand(1,10);
						$chanseGold=5;
					}
			}else
			{
				$chance = mt_rand(1,30);
				$chanseGold=15;
				if($champ)
				{
					$chance = mt_rand(1,2);
					$chanseGold=1;
				}
			}
			//
			if($chance == $chanseGold AND $dropGrade>0)
			{
				switch($special)
				{
					case 3:
						$query = 'SELECT i.Nombre, i.contable, i.leg, i.idItem
						FROM item i
						WHERE droppeable=1 AND tier=0 AND (epic=1 OR forceStats=1) ORDER BY RAND() LIMIT 0,1';
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
						$info['dropMsg'] .= "<div class=recompensaAstral>".$name." encontro un item Atral!<br>".$drop['Nombre']." ".$value."</div>";
					break;
					case 2:
						$query = 'SELECT i.Nombre, i.contable, i.leg, i.idItem
						FROM item i
						WHERE tier=0 AND specialMat=1 AND droppeable=1 ORDER BY RAND() LIMIT 0,1';
						$dropssq = $db->sql_query($query);
						$drop = $db->sql_fetchrow($dropssq);
						$cantidad=mt_rand(1,3);
						add_item($drop['idItem'],$cantidad,$account);						
						$info['dropMsg'] .= "<div class=recompensaAstral>".$name." encontro ".$cantidad." ".$drop['Nombre']."</div>";
					break;
					case 1:
						$query = 'SELECT i.Nombre, i.contable, i.leg, i.idItem, i.forceStats
						FROM item i
						WHERE grado = 7  AND droppeable=1 AND contable=0  AND specialMat=0   ORDER BY RAND() LIMIT 0,1';
						$dropssq = $db->sql_query($query);
						$drop = $db->sql_fetchrow($dropssq);
						$chance = mt_rand(1,100);
						///LEGENDARY
						$LegChance = 10;
						// EPIC
						$EpicChance = 30;
						// RARO
						$RareChance = 50;	
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
						$itemId = createLegendary($drop['idItem'],0,$account,0,$valueInt);
						$info['dropMsg'] .= "<div class=recompensa>".$name." encontro (".$drop['Nombre'].") ".$value."</div>";
					break;
				default:
					$query = 'SELECT i.Nombre, i.contable, i.leg, i.idItem
					FROM item i
					WHERE epic=0 AND grado='.$dropGrade.' AND contable=0 AND droppeable=1  AND specialMat=0  ORDER BY RAND() LIMIT 0,1';
					$dropssq = $db->sql_query($query);
					$drop = $db->sql_fetchrow($dropssq);
					

					$chance = mt_rand(1,100);
						///LEGENDARY
						$LegChance = 10;
						// EPIC
						$EpicChance = 30;
						// RARO
						$RareChance = 50;	
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
						$itemId = createLegendary($drop['idItem'],0,$account,0,$valueInt);
					
					$info['dropMsg'] .= "<div class=recompensa>".$name." encontro (".$drop['Nombre'].") ".$nameadds."</div>";
				break;	
				}	
					$info['exito'] = 1;	
					unset($nameadds);
			}
			
	return $info;
}
?> 