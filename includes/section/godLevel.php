<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
$template->set_filenames(array(
							'content' => 'templates/sec/godLevel.html' )
						);	
					
	

 $template->assign_vars(array(
				 'GODLVL_ATAQUES' => "Nivel: ".$pj['godlvlAttack']." <br>Aumenta ".$pj['godlvlAttack']."% los Ataques",
				 'GODLVL_CRITICO' => "Nivel: ".$pj['godlvlCritico']." <br>Aumenta ".$pj['godlvlCritico']."% los Daños Criticos",
				 'GODLVL_DEFENSAS' => "Nivel: ".$pj['godlvlDefensa']." <br>Aumenta ".$pj['godlvlDefensa']."% las Defensas",
				  'GODLVL_ELEM' => "Nivel: ".$pj['godlvlElem']." <br>Aumenta ".$pj['godlvlElem']."% Elemento",
				   'GODLVL_VIDA' => "Nivel: ".$pj['godlvlVida']." <br>Aumenta ".($pj['godlvlVida']*5)."% la Vida",


				));

	$template->assign_var('PUNTOS', $pj['godLevelSpend']);				
				
?> 