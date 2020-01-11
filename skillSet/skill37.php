<?php
//Agresion
$ataque_player=1;


if($stats['interruptCd'])
	$skill['cooldown']=intval($skill['cooldown']/2);

$chanceInterrupt = 50 - $monster['resistInterrupt'];

switch($skill['nivel'])
{
	case 1:
		switch($check['tipo'])
		{
			case 3:
				$asscnac = mt_rand(1,100);
				if($chanceInterrupt>$asscnac)
				{
					if($pj['party']>0)
						systemLog("party",'<spam class='."'itruptFailWin'".'>'.$pj['nombre'].' interrupt '.$monster['nombre'].'</spam>');
					else
						systemLog("self",'<spam class='."'itruptFailWin'".'>'.$pj['nombre'].' interrupt '.$monster['nombre'].'</spam>');
				$db->sql_query("UPDATE inmundo SET raidSkillready = 0 WHERE idInMundo = '".$check['idInMundo']."'");
				}
				else
				{
					if($pj['party']>0)
						systemLog("party",'<spam class='."'itruptFail'".'>'.$pj['nombre'].' fallo interrupt '.$monster['nombre'].'</spam>');
					else
						systemLog("self",'<spam class='."'itruptFail'".'>'.$pj['nombre'].' fallo interrupt '.$monster['nombre'].'</spam>');

				}
			break;
			case 2:
			if($pj['party']>0)
						systemLog("party",'<spam class='."'itruptFailWin'".'>'.$pj['nombre'].' interrupt '.$monster['nombre'].'</spam>');
					else
						systemLog("self",'<spam class='."'itruptFailWin'".'>interrupt '.$monster['nombre'].'!</spam>');
						
					if($multyTarget==0)
					{	
					$db->sql_query("UPDATE inmundo SET  raidSkillready = 0 WHERE idInMundo = '".$check['idInMundo']."'");
					}
					else
					{
						$db->sql_query('UPDATE inmundo im SET  raidSkillready = 0 WHERE 
												(im.idInMundo = "'.$id.'" OR im.idInMundo = "'.$id2.'" OR im.idInMundo = "'.$id3.'" OR im.idInMundo = "'.$id4.'" OR im.idInMundo = "'.$id5.'")');
					}
			break;
		}
	break;
}												

$data['info'] .= textoAtaque(3,$skill['nombre']);
?>
