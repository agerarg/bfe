<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
$habilityOn=1;
$rand = mt_rand(1,9);
switch($rand)
{
	case 1:
		$SpecialAbility="Acumen";
	break;
	case 2:
		$SpecialAbility="WildMagic";
	break;
	case 3:
		$SpecialAbility="Empower";
	break;
	case 4:
		$SpecialAbility="Heal";
	break;
	case 5:
		$SpecialAbility="Defense";
	break;
	case 6:
		$SpecialAbility="Haste";
	break;
	case 7:
		$SpecialAbility="Focus";
	break;
	case 8:
		$SpecialAbility="Vampire";
	break;
	case 9:
		$SpecialAbility="Destruction";
	break;
}
 	$msg = "<div class=SA>Tu arma ahora tiene ".$SpecialAbility." SA!</div>";
	systemLog("self",$msg);	
	$data['GTFO']=$item['idInventario'];
	$data["error"]=1;
	 delete_item($item['idInventario']);
	
	$db->sql_query("UPDATE inventario SET
											SA = 1, SAchar='".$SpecialAbility."'
			WHERE idInventario = ".$W['idInventario']);
	///VISUAL THING
         $data["itemIdRe"] = $W['idInventario'];
         $data['newstats'] = checkStats($pj['STR'],$pj['CON'],$pj['DEX'],$pj['WIT'],$pj['INTEL'],$pj['MEN'],$pj['nivel'],$pj['idPersonaje']);
	 $db->sql_query("UPDATE personaje SET baseDPS = '".$data['newstats']['baseDPS']."' WHERE idPersonaje = ".$log->get("pjSelected"));
         $data['newSA']=1;
          $data['newSAchar']=$SpecialAbility;
	
	/// QUEST
		$query = 'SELECT idMisionOn
								FROM misiononplayer
								WHERE idPersonaje = "'.$pj['idPersonaje'].'" AND idMision = 39 AND finalizado=0';
					$questsq = $db->sql_query($query);
					$quest = $db->sql_fetchrow($questsq);
					if($quest)
					{
							$questName = "Use Special Hability";
							$questExp = 5000;
							$questGold = 10000;
							$db->sql_query("UPDATE personaje SET
								exp = (exp+".$questExp.")
							  WHERE idPersonaje  = '".$pj['idPersonaje']."'");
							
							$db->sql_query("UPDATE cuenta SET oro = (oro+".$questGold.") WHERE idCuenta = ".$log->get("idCuenta"));
							
							$db->sql_query("UPDATE misiononplayer SET
								finalizado = 1
							  WHERE idMisionOn  = '".$quest['idMisionOn']."'");
							  
							$msg = "<div class='questEnd'>".$questName." done!</div>";
							$msg .= "<div class='questDrop'>
							+".$questExp." exp<br>+".$questGold." gold
							</div>";
							systemLog("self",$msg);
					}
		///////
?> 