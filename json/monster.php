<?php 
define('SWORDON', 1);
include('../system/conexion.php');
include('../system/login.php');
include('../system/funciones.php');
session_start();
$db = new sql_db;
$log = new LOGuser;
$now = time();
$today = date("z");
$query = 'SELECT p.*, c.STR,c.CON,c.DEX,c.WIT,c.INTEL,c.MEN 
			FROM personaje p JOIN clase c USING ( idClase ) 
			WHERE  p.idCuenta = '.$log->get("idCuenta").' AND p.idPersonaje = '.$log->get("pjSelected").'';
		$pj = $db->sql_fetchrow($db->sql_query($query));
		$idPersonaje = $pj['idPersonaje'];
		$DungeonInstance  = $pj['dungeonInstance'];
		$idDungeon = $pj['inDungeon'];
		$dungeonElite = $pj['dungeonElite'];
                $inRunz = $pj['inRunz'];
		$pjLevel = $pj['nivel'];
		$PARTY = $pj['party'];
               $CLAN= $pj['clan'];
		if($pj['inTorneo'])
			$torneo = $pj['idTorneo'];
		$stats = checkStats($pj['STR'],$pj['CON'],$pj['DEX'],$pj['WIT'],$pj['INTEL'],$pj['MEN'],$pj['nivel'],$pj['idPersonaje']);

	$multyDifer=dificultyHP($stats['dificultyLvl']);
	if(isset($_GET['id']))
	{
		$data="";
		$id = intval($_GET['id']);
		$id2 = intval($_GET['id2']);
		if($_GET['que']==2 OR $_GET['que']==3)
		{
			if($id2>0)
			{
				$id3 = intval($_GET['id3']);
				$id4 = intval($_GET['id4']);
				$id5 = intval($_GET['id5']);
				$data['multy']=1;
				$query = 'SELECT m.nombre,m.imagen,im.idInMundo,im.currentLife,m.VidaLimit,im.deQuien,m.idMonster,im.tipo,im.openToClan, im.dificulty
					FROM monster m JOIN inmundo im USING ( idMonster )
					WHERE (im.idInMundo = "'.$id.'" OR im.idInMundo = "'.$id2.'" OR im.idInMundo = "'.$id3.'" OR im.idInMundo = "'.$id4.'" OR im.idInMundo = "'.$id5.'")
					AND (im.tipo=2 OR im.tipo=3) ';
				$monster = $db->sql_query($query);
				while($mob = $db->sql_fetchrow($monster))
				{
					$data['hash'] .= "id".$hashNUm."=".$mob['idInMundo']."&";
					if(!$hashNUm)
						$hashNUm=2;
					else
						$hashNUm++;
					if($mob['champion']==1)
					$mob['VidaLimit']=$mob['VidaLimit']*3;
					
					if($mob['dificulty'])
					{
						$mob['VidaLimit']=$mob['VidaLimit']*$mob['dificulty'];
					}

					$data['mob'][] = array("nombre"=>$mob['nombre'],"foto"=>'mobs/'.$mob['imagen'],"id"=>$mob['idInMundo'],"vida"=>$mob['currentLife']
					,"vidalimite"=>$mob['VidaLimit'],"deQuien"=>$mob['deQuien'],"idMonster"=>$mob['idMonster'],"tipo"=>$mob['tipo'],"openToParty"=>$mob['openToClan']);
				}
			}
			else
			{
				$query = 'SELECT *
					FROM monster m JOIN inmundo im USING ( idMonster )
					WHERE im.idMonster = m.idMonster AND im.idInMundo = "'.$id.'" AND (im.tipo=2 OR im.tipo=3)';
				$monster = $db->sql_query($query);
				$mob = $db->sql_fetchrow($monster);
				
				if($mob['dificulty']>0)
				$mob['VidaLimit']=$mob['VidaLimit']*$mob['dificulty'];
				
				$data['hash'] = "id=".$id."&";
				if($mob['champion']==1)
					$mob['VidaLimit']=$mob['VidaLimit']*3;
					if($mob['champion']==1)
					{
						$mob['Ataque']+=$mob['Ataque'];
					}
			
				$extra = " - [Tipo: ".$mob['monsterType']." Ataque:".$mob['Ataque']." PDef:".$mob['Defensa']." MDef:".$mob['DefensaMagica']." Elemento:".$mob['element']."]";
				
				if($idDungeon)
					{
					$query = 'SELECT *
						FROM dungeon_instance
						WHERE idPersonaje='.$idPersonaje.' OR (idParty = 1 AND idPersonaje = '.$PARTY.' AND '.$PARTY.'>0) ORDER BY skillWIn DESC LIMIT 1';
						$dungeonsq = $db->sql_query($query);
						$dungeon = $db->sql_fetchrow($dungeonsq);

						if($dungeon['elite'])
						{
							$mob['VidaLimit']+=intval(($mob['VidaLimit']*($dungeon['eliteLevel']+1))/4);
						}

					}

				$data['mob'] = array("toPartu" =>$mob['toPartu'],"nombre"=>$mob['nombre'].$extra,"foto"=>'mobs/'.$mob['imagen'],"id"=>$mob['idInMundo'],"vida"=>$mob['currentLife']
					,"vidalimite"=>$mob['VidaLimit'],"deQuien"=>$mob['deQuien'],"idMonster"=>$mob['idMonster'],"tipo"=>$mob['tipo'],"openToParty"=>$mob['openToClan']);
			}
		}
		else
		{
			if($idDungeon==1)
			{
				$sqladd=" AND p.idPersonaje = ".$log->get("pjSelected");
			}
			if($torneo)
		$sqladd=" AND (p.idPersonaje = ".$log->get("pjSelected")." OR p.idPersonaje = ".$_SESSION['idContrincante'].") ";

			$query = 'SELECT p.idPersonaje,p.nivel, p.sexo, p.nombre AS NAMER, p.Vida, im.idInMundo, c.*
				FROM personaje p  JOIN clase c USING ( idClase ) LEFT JOIN inmundo im ON im.idPlayer = p.idPersonaje
				WHERE sesion_time > '.$now.' AND im.idInMundo = "'.$id.'" AND tipo=1 '.$sqladd.' LIMIT 1';

			$monster = $db->sql_query($query);
			$mob = $db->sql_fetchrow($monster);
			$badluck = checkStats($mob['STR'],$mob['CON'],$mob['DEX'],$mob['WIT'],$mob['INTEL'],$mob['MEN'],$mob['nivel'],$mob['idPersonaje']);
			$mob['VidaLimit'] = $badluck['VidaLimit'];
			
				$data['mob'] = array("nombre"=>$mob['NAMER'],"foto"=>'clases/'.$mob['imagen'].'_'.$mob['sexo'].'.png',"id"=>$mob['idInMundo'],"vida"=>$mob['Vida']
				,"vidalimite"=>$mob['VidaLimit'],"deQuien"=>0,"tipo"=>$mob['tipo']);
		}
	}
	else
	{
		$data="";
		$mundoid = intval($_GET['mundo']);
		$query = 'SELECT *
				  FROM mundo
				  WHERE id='.$mundoid.'';
		$mundosq = $db->sql_query($query);
		$mundo = $db->sql_fetchrow($mundosq);
		$query = 'SELECT clan
			FROM personaje
			WHERE idCuenta = '.$log->get("idCuenta").' AND idPersonaje = '.$log->get("pjSelected").'';
		$pj = $db->sql_fetchrow($db->sql_query($query));
		if($mundo)
		{
                      if($idDungeon==1)
						{
						 $sqladd=" AND p.dungeonInstance= ".$DungeonInstance;
						}
		// PLAYERS IN THE SAME WORLD SHOW 				
		$query = 'SELECT p.clan, p.sexo, p.nombre, p.nivel, im.idInMundo, c.imagen, p.pvpTime, p.pkTime, cl.nombre AS clanName
			FROM inmundo im 
			LEFT JOIN personaje p 
			on im.idPlayer = p.idPersonaje 
			JOIN clase c 
			USING ( idClase ) 
			LEFT JOIN clan cl 
			on p.clan = cl.idClan
			WHERE im.tipo=1 
			AND sesion_time > '.$now.' AND im.mundo = "'.$mundoid.'" AND  p.Vida > 0 '.$sqladd;
	
		$monster = $db->sql_query($query);
		
		$baina = 1;
		$saveclan = $mundo['clan'];
		while($mob = $db->sql_fetchrow($monster))
		{

			if($mob['clan']==$saveclan)
				$baina=0;
			$color = ($mob['pvpTime']>$now)?(1):(0);
			$color = ($mob['pkTime']>$now)?(2):($color);
		
			$myEnemy=0;
			
			if($mundo['tipo']=="free")
			{
				if($mob['clan']!=$pj['clan'])
                                 { 
                                       $baina=0;
					$myEnemy=1;
			        }
				$clanstuff[$mob['clan']]++;		
			}

			if($mundo['tipo']=="warzone" && $mob['clan']!=$pj['clan'])
				$color=2;
			$data['mob'][] = array("enemy"=>$myEnemy,"nombre"=>$mob['nombre'],"foto"=>'clases/'.$mob['imagen'].'_'.$mob['sexo'].'.png',"id"=>$mob['idInMundo'],"deQuien"=>$mob['deQuien'],"mob"=>1,"lvl"=>$mob['nivel'],"tipo"=>1,"colored"=>$color,"clan"=>$mob['clanName']);
		}
		
		$data['dungWave']=0;
		
		if($idDungeon==1)
		{

			$query = 'SELECT *
			FROM dungeon_instance
			WHERE idPersonaje='.$idPersonaje.' OR (idParty > 1 AND idParty = '.$PARTY.' AND '.$PARTY.'>0) ORDER BY skillWIn DESC LIMIT 1';
			
			$dungeonsq = $db->sql_query($query);
			$dungeon = $db->sql_fetchrow($dungeonsq);
			$sqladd="AND idInstance='".$DungeonInstance."'";

			$data['dungWave']=$dungeon['waveCurr'];
			$data['dungWaveLimit']=$dungeon['waves'];

		}
		else
			$sqladd="AND idInstance=0";
		// MONSTER SHOW IN THE WORLD OR INSTANCE
		$query = 'SELECT m.papa, m.raid, m.nivel, m.nombre, 
		m.imagen, im.currentLife, im.champion, 
		im.idInMundo, im.deQuien, im.ownerTime, 
		im.openToClan
		FROM monster m 
			JOIN inmundo im USING ( idMonster )
		WHERE (deQuien = '.$log->get("pjSelected").' 
			OR (openToClan>0 AND openToClan='.$PARTY.')
			OR globalmap=1) 
			AND (im.tipo=2 OR im.tipo=3) 
			AND im.mundo = "'.$mundoid.'" 
			AND im.currentLife > 0 '.$sqladd.' 
				ORDER BY im.idInMundo DESC';
	
			$monster = $db->sql_query($query);
			
		while($mob = $db->sql_fetchrow($monster))
		{
						$mobcity++;
	$data['mob'][] = array("nombre"=>$mob['nombre'],"foto"=>'mobs/'.$mob['imagen'],"id"=>$mob['idInMundo'],"deQuien"=>$mob['deQuien'],"mob"=>2,"lvl"=>$mob['nivel'],"champ"=>$mob['champion'],"ownerTime"=>$owned,"tipo"=>2,"colored"=>1,"clan"=>"","openToParty"=>$mob['openToClan'],"atacado"=> 0,"papa"=> $mob['papa']);
				
				$baina=0;
		}
		
			switch($mundo['tipo'])
			{
				case "train":
					if($mobcity<2)
					{
						$pj['party']=$PARTY;
						$data['mapBoss']=monsterGenMap();
						$baina=1;
					}
				break;
			case "free":
					$dayBlock = $now + 600;
					if($mundo['warTime']>$now)
					{
						$data['battle']=1;
						if($baina==1)
						{
							$topppl=0;
							$saveclan=0;
							
							while(list($key, $value) = each($clanstuff))
							{
								if($topppl<$value)
								{
									$topppl=$value;
									$saveclan=$key;
								}
							}
							$query = 'SELECT c.*, p.nombre AS KING
											FROM clan c, personaje p WHERE c.idClan = "'.$saveclan.'" AND p.idPersonaje  = c.idLeader ';
							$lidersq = $db->sql_query($query);
							$lidercheck = $db->sql_fetchrow($lidersq);
							if(!$lidercheck)
							{
								die("ERROR NO CLAN WTF");
							}
                                                           $cleanbrlocation = explode("<br>",$mundo['nombre']);
                                                      $msg = "<div class='asedioNew'>Clan ".$lidercheck['nombre']." gano ".$cleanbrlocation[0]."!</div>";
	
							systemLog("global",$msg);
							$db->sql_query("UPDATE mundo SET dayBlock = ".$dayBlock .", clan = ".$lidercheck['idClan'].", warTime = 0 WHERE id = ".$mundo['id']);
						
						}
					}
					else
					{
						$baina=2;
							$db->sql_query("UPDATE mundo SET dayBlock = ".$dayBlock.",
							warTime = 0 
							WHERE id = ".$mundo['id']);
						
					}
			break;
			default:
				$pj['party']=$PARTY;
				if($idDungeon==1)
				{
					if($mobcity==0)
					{
						if($dungeon['waves']<=$dungeon['waveCurr'])
						{
							// borrado de aura en reward
							if($dungeon['elite']>0)
								include('../retos/EliteReward.php');
							if($dungeon['reto']>0)
								include('../retos/rewards.php');
							if($dungeon['cata']>0)
								include('../catacumbas/rewards.php');

							$msg = '<div class=questMeta>Dungeon finalizado!</div>';
							if($pj['party']>0)
								systemLog("party",$msg);
							else
								systemLog("self",$msg);
							$baina=1;
							$db->sql_query("UPDATE personaje SET
										 inDungeon = 0, inRunz = 0, location = 20, dungeonInstance=0 
										 WHERE idPersonaje = '".$log->get("pjSelected")."'");
						}
						else
						{
							$baina=2;
							
								$db->sql_query("UPDATE dungeon_instance SET waveCurr = (waveCurr+1) WHERE idInstance = '".$dungeon['idInstance']."'");
								
								if($dungeon['reto']>0)
									include('../retos/monsterMap.php');

								if($dungeon['epico']>0)
									include('../epicos/monsterMap.php');

								if($dungeon['elite']==1)
									include('../retos/eliteMap.php');
							
						}
					}
					
				}
				
			break;
			}
	
		}
	}
	$data['baina']=$baina;
	$data['dungeon']=intval($dungeon['idInstance']);
	 echo json_encode($data);

?>