<?php
//Agresion
$data['animation']=0;
$fisicalCoolDown = 1;
switch($skill['nivel'])
{
	case 1:
		switch($monster['tipo'])
		{
			case 2:
				if($monster['raidSkillready']==1)
				{
					$vidaModifier += intval(($stats['VidaLimit']/100)*30);
					$manaModifier  += intval(($stats['ManaLimit']/100)*30);
					$stunGoingOn=1;					
					if($pj['party']>0)
						systemLog("party",'<spam class='."'itruptFailWin'".'>'.$pj['nombre'].' disperso '.$monster['nombre'].'</spam>');
					else
						systemLog("self",'<spam class='."'itruptFailWin'".'>dispersaste '.$monster['nombre'].'!</spam>');
						
					if($multyTarget==0)
					{	
					$db->sql_query("UPDATE inmundo SET  attackCooldown=".($now+30).", raidSkillready = 0 WHERE idInMundo = '".$check['idInMundo']."'");
					}
					else
					{
						$db->sql_query('UPDATE inmundo im SET  attackCooldown='.($now+30).', raidSkillready = 0 WHERE 
												(im.idInMundo = "'.$id.'" OR im.idInMundo = "'.$id2.'" OR im.idInMundo = "'.$id3.'" OR im.idInMundo = "'.$id4.'" OR im.idInMundo = "'.$id5.'")');
					}
					
				}
				else
				{
					systemLog("self",'<spam class='."'itruptFail'".'>disperso fallo el mousntro no estaba casteando nada</spam>');
				}
			break;
		}
	break;
}												

$data['info'] .= textoAtaque(3,$skill['nombre']);
?>
