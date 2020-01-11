<?php
		/// QUEST
			$query = 'SELECT idMisionOn
									FROM misiononplayer
									WHERE idPersonaje = "'.$pj['idPersonaje'].'" AND idMision = 32 AND finalizado=0';
						$questsq = $db->sql_query($query);
						$quest = $db->sql_fetchrow($questsq);
						if($quest)
						{
								$questName = "Code training";
								$questExp = 1000;
								$questGold = 100;
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
								show_message("Code activated! you have learned to get codes!","index.php?sec=CODES");
						}
						else
						{
							$derog=false;
									show_error("Quest no fond!","index.php?sec=CODES");

						}
			///////
		
?>
