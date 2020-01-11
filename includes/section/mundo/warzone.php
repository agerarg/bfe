<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
$goFight=0;
		$cleanbrlocation = explode("<br>",$mundo['nombre']);
		$template->assign_var('USR_LOCATION', $cleanbrlocation[0]);
						if($pj['nivel']<80)
						{
							show_message("Solo personajes de nivel 80+ pueden ingresar aqui!",
							"index.php?sec=mundo");	
						}									
						else if($pj['clan']==0)
						{
								show_message("Necesitas clan para ingresar aqui.",
						"index.php?sec=mundo");	
						}
						else
						{
							$db->sql_query("UPDATE inmundo 
							SET sesion_time = 0 
							WHERE idPlayer = '".$log->get("pjSelected")."'");
							$goFight=1;

							$db->sql_query("UPDATE personaje 
							SET ParticipoEnWar = 1 
							WHERE idPersonaje = '".$log->get("pjSelected")."'");

						}										
?> 