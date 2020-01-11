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
		$idDungeon = $pj['inDungeon'];
                $inRunz = $pj['inRunz'];
		$pjLevel = $pj['nivel'];
		$PARTY = $pj['party'];
         $CLAN= $pj['clan'];
		$stats = checkStats($pj['STR'],$pj['CON'],$pj['DEX'],$pj['WIT'],$pj['INTEL'],$pj['MEN'],$pj['nivel'],$pj['idPersonaje']);

	$multyDifer=dificultyHP($stats['dificultyLvl']);
					
	if(isset($_GET['id']))
	{
		$data="";
		$id = intval($_GET['id']);

			$query = 'SELECT p.idPersonaje,p.nivel, p.sexo, p.nombre AS NAMER, p.Vida, c.*, rm.id AS RMID
				FROM ranked_match rm LEFT JOIN personaje p on (rm.idPlayer1 = p.idPersonaje OR rm.idPlayer2 = p.idPersonaje) AND winner=0 AND p.idPersonaje = '.$id.' JOIN clase c USING ( idClase )
				';
			
			$monster = $db->sql_query($query);
			$mob = $db->sql_fetchrow($monster);
			$badluck = checkStats($mob['STR'],$mob['CON'],$mob['DEX'],$mob['WIT'],$mob['INTEL'],$mob['MEN'],$mob['nivel'],$mob['idPersonaje']);
			$mob['VidaLimit'] = $badluck['VidaLimit'];
			
				$data['mob'] = array("nombre"=>$mob['NAMER'],"foto"=>'clases/'.$mob['imagen'].'_'.$mob['sexo'].'.jpg',"id"=>$mob['idPersonaje'],"vida"=>$mob['Vida']
				,"vidalimite"=>$mob['VidaLimit'],"deQuien"=>0,"tipo"=>1);
	}
	else
	{
		$data="";
		
		$query = 'SELECT p.clan, p.sexo, p.nombre, p.nivel, c.imagen, p.pvpTime, p.pkTime, p.idPersonaje
			FROM ranked_match rm LEFT JOIN personaje p on (rm.idPlayer1 = p.idPersonaje OR rm.idPlayer2 = p.idPersonaje) JOIN clase c USING ( idClase )
			WHERE (rm.idPlayer1 = '.$pj['idPersonaje'].' OR rm.idPlayer2 = '.$pj['idPersonaje'].') AND winner=0';
		$monster = $db->sql_query($query);
		$data['baina']=1;
		while($mob = $db->sql_fetchrow($monster))
		{
			$data['baina']=0;
			$data['mob'][] = array("enemy"=>$myEnemy,"nombre"=>$mob['nombre'],"foto"=>'clases/'.$mob['imagen'].'_'.$mob['sexo'].'.jpg',"id"=>$mob['idPersonaje'],"deQuien"=>$mob['deQuien'],"mob"=>1,"lvl"=>$mob['nivel'],"tipo"=>1,"colored"=>$color,"clan"=>$mob['clanName']);
		}
	}
		
	
	$data['dungeon']=0;
	 echo json_encode($data);

?>