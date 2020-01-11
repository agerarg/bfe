<?php
//Agresion
$ataque_player=1;
switch($skill['nivel'])
{
	case 1:
	if($pj['party']>0)
	{
		switch($check['tipo'])
		{
			case 3:
				$check['hateAuraTimer']=($now+60);
				$check['idTanker']=$pj['idPersonaje'];
				$db->sql_query('INSERT INTO  chat(party,mensaje) 
									VALUES("'.$pj['party'].'","<spam class='."'hate'".'>'.$pj['nombre'].' uso Hate en <a href='."'?sec=mundo&mundo=".$check['mundo']."&target=".$check['idInMundo']."&bicho'".'>'.$monster['nombre'].'</a></spam>")');
				$db->sql_query("UPDATE inmundo SET idTanker = '".$pj['idPersonaje']."', hateAuraTimer ='".($now+60)."' WHERE idInMundo = '".$check['idInMundo']."'");	
			break;
			case 2:
				$monsterrot="monstruo!";
				$check['hateAuraTimer']=($now+60);
				$check['idTanker']=$pj['idPersonaje'];
			
				if($multyTarget==0)
					{	
					$db->sql_query('INSERT INTO  chat(party,mensaje) 
									VALUES("'.$pj['party'].'","<spam class='."'hate'".'>'.$pj['nombre'].' uso Hate en <a href='."'?sec=mundo&mundo=".$check['mundo']."&target=".$check['idInMundo']."&bicho'".'>'.$monster['nombre'].'</a></spam>")');
					$db->sql_query("UPDATE inmundo SET idTanker = '".$pj['idPersonaje']."', hateAuraTimer ='".($now+60)."' WHERE idInMundo = '".$check['idInMundo']."'");
					}
					else
					{
						$db->sql_query('UPDATE inmundo im SET  idTanker = '.$pj['idPersonaje'].', hateAuraTimer ='.($now+60).' WHERE 
												(im.idInMundo = "'.$id.'" OR im.idInMundo = "'.$id2.'" OR im.idInMundo = "'.$id3.'" OR im.idInMundo = "'.$id4.'" OR im.idInMundo = "'.$id5.'")');
					}
				
			break;
			case 1:
				/*$db->sql_query('INSERT INTO  aura(idPersonaje,idSkill,static,idSkillReal,timeOut,acumuleitor) 
							VALUES("'.$monster['PJID'].'","25","0",13,'.($now+30).','.$pj['idPersonaje'].')');*/
				$db->sql_query('INSERT INTO  chat(party,mensaje) 
									VALUES("'.$pj['party'].'","<spam class='."'hate'".'>'.$pj['nombre'].' uso Hate en <a href='."'?sec=mundo&mundo=".$check['mundo']."&target=".$check['idInMundo']."&bicho'".'>'.$monster['nombre'].'</a></spam>")');
									
				$db->sql_query('INSERT INTO  aura(idPersonaje,idSkill,static,idSkillReal,timeOut,acumuleitor) 
							VALUES("'.$monster['PJID'].'","25","0",13,'.($now+30).','.$pj['idPersonaje'].')');			
				
				
				$pvpInfo .= textoAtaque(4,$skill['nombre']);
			break;
		}
	}
	break;
}												

$data['info'] .=  textoAtaque(3,$skill['nombre']);
?>
