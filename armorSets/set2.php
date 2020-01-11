<?php
if($idHead==151)
{
	/// QUEST
		$query = 'SELECT idMisionOn
								FROM misiononplayer
								WHERE idPersonaje = "'.$PJID.'" AND idMision = 33 AND finalizado=0';
					$questsq = $db->sql_query($query);
					$quest = $db->sql_fetchrow($questsq);
					if($quest)
					{
							$questName = "Complete Set";
							$questExp = 800;
							$db->sql_query("UPDATE personaje SET
								exp = (exp+".$questExp.")
							  WHERE idPersonaje  = '".$PJID."'");
							
							$db->sql_query("UPDATE misiononplayer SET
								finalizado = 1
							  WHERE idMisionOn  = '".$quest['idMisionOn']."'");
							  
							$msg = "<div class='questEnd'>".$questName." done!</div>";
							$msg .= "<div class='questDrop'>
							+".$questExp." exp
							</div>";
							systemLog("self",$msg);
					}
		///////

		$pj['SET_UP'][$setOrdId]['nombre']="Devotion";
		$pj['SET_UP'][$setOrdId]['img']="robe/TunicOfDevotion.jpg";
	
	
	$pj['CSpeed']-=4;
}
?>
