<?php
if($mision['idMisionOn'])
{
	$moar = "<div class='questEnd'>Paseo Infernal terminado!</div>";
	if($stats['dimension']==2)
	{
		switch($stats['dificultyLvl'])
		{	
			case 1:
				$legendaryMin = 1;
				$legendaryMax = 1;
			break;	
			case 2:
				$legendaryMin = 1;
				$legendaryMax = 2;
			break;	
			case 3:
				$legendaryMin = 2;
				$legendaryMax = 3;
				
				$epicMin = 0;
				$epicMax = 1;
			break;	
			case 4:
				$legendaryMin = 3;
				$legendaryMax = 4;
				
				$epicMin = 0;
				$epicMax = 1;
			break;	
			case 5:
				$legendaryMin = 5;
				$legendaryMax = 6;
				
				$epicMin = 1;
				$epicMax = 2;
			break;	
			case 6:
				$legendaryMin = 8;
				$legendaryMax = 10;
				
				$epicMin = 2;
				$epicMax = 5;
			break;	
				
		}	
		
		// RANKED
		if($pj['party']==0)
		{
			$legendaryMax = $legendaryMax*2;
			$query = 'SELECT a.timeOut, s.nivel
			FROM aura a, skill s
				WHERE a.idPersonaje = '.$mision['idPersonaje'].' AND a.idSkillReal = 100 AND a.idSkill = s.idSkill';
			$ranked = $db->sql_fetchrow($db->sql_query($query));
			$timelaps = ($ranked['timeOut']-$now);
			$tardo = 1800-$timelaps;
			
			
			$query = 'SELECT *
			FROM rankedinferno
				WHERE idPersonaje = '.$mision['idPersonaje'].' AND dificultad = '.$ranked['nivel'].'';
			$previus = $db->sql_fetchrow($db->sql_query($query));
			
			if(!$previus)
			{
			$db->sql_query('INSERT INTO rankedinferno (idPersonaje,tiempo,dificultad) 
				VALUES("'.$mision['idPersonaje'].'","'.$tardo.'","'.$ranked['nivel'].'")');
			}
			else
			{
				if($previus['tiempo']>$tardo)
				{
					$db->sql_query("UPDATE rankedinferno SET
										 tiempo = '".$tardo."' WHERE idPersonaje = '".$mision['idPersonaje']."'");
				}
			}
		
		}
		
		
		$chanc = mt_rand($legendaryMin,$legendaryMax);
		add_item(333,$chanc,$mision['idCuenta'],1);
		$moar = $chanc." Legendary Cupon<br>";
		
		if($epicMin>0)
		{
			$chanc2 = mt_rand($epicMin,$epicMax);
			add_item(334,$chanc2,$mision['idCuenta'],1);
			
			$moar = "".$chanc2." Epic Cupon<br>";
		}
		
		
		$db->sql_query("DELETE FROM aura WHERE idSkillReal = 100 AND idPersonaje=".$mision['idPersonaje']."");
		
	}
	else
	{
			$moar = "<div class='questEnd'>Tardo demaciado tiempo...</div>";
	}
	$msg = "<div class='questDrop'>
	".$moar."
	</div>";
			
}
else
	die("GTFO!");
?>
