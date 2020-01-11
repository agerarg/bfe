<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
define('SWORDON', 1);
include('../system/conexion.php');
include('../system/login.php');
include('../system/funciones.php');
session_start();
$db = new sql_db;
$log = new LOGuser;

function experience($L) {
 $a=2;
  for($x=1; $x<$L; $x++) {
	 $a += floor($x+300*pow(2, ($x/6)));
  }
 return floor($a/20);
}


if($log->check())
{
		$query = 'SELECT p.boludo, p.paragonAcc, p.skillPoints, p.idPersonaje, p.nivel, p.exp, p.expUp, c.* 
			FROM personaje p JOIN clase c USING ( idClase )
			WHERE p.idCuenta = '.$log->get("idCuenta").' AND p.idPersonaje = '.$log->get("pjSelected").'';
		$pj = $db->sql_fetchrow($db->sql_query($query));
		$niveles = 0;
		$data['changes']=0;
		$skillpointNOW = $pj['skillPointsOL'];
		$fkingSkillPoints=0;
		$paragon=0;
		$aventure=0;
		$godLevel=0;
		if($pj['exp']>=$pj['expUp'] AND $accumulate<=1 AND $pj['nivel']<200)
		{		
			$accumulate++;
			if($pj['nivel']>=120)
			{
				$pj['exp']=$pj['exp']-$pj['expUp'];
				$pj['expUp'] = intval(experience(120));
				$godLevel++;
				$msg = "<div class='recompensaGodLevel'>Conseguiste un God Level!<br><a href='index.php?sec=godlevel'>Mejorar tus habilidades</a></div>";
						systemLog("self",$msg);	
			}	
			else
			{
				$pj['exp']=$pj['exp']-$pj['expUp'];
				$pj['expUp'] = intval(experience($pj['nivel']+1));
				$niveles++;
				$pj['nivel']++;
				if($pj['nivel']<120)
				{
					if(fmod($pj['nivel'], 5) == 0)
					{
						$newPuntos=1;
						$msg = "<div class='questNew'>Conseguiste ".$newPuntos." de habilidad!<br><a href='index.php?sec=habilidades'>Ver tus habilidades</a></div>";
						systemLog("self",$msg);					
						$fkingSkillPoints=$fkingSkillPoints+$newPuntos;
					}
				}	
			}
		}
		
		if($niveles>0 OR $paragon>0 OR $godLevel>0)
		{			
			unset($_SESSION['PJITEM']);
			if($niveles>0)
			{
				systemLog("self","<div class='raidDrop'>Llegaste a nivel ".$pj['nivel']."!</div>");
			}
			$pointssql="";
			$stats = checkStats($pj['STR'],$pj['CON'],$pj['DEX'],$pj['WIT'],$pj['INTEL'],$pj['MEN'],$pj['nivel'],$pj['idPersonaje']);
			if($fkingSkillPoints>0)
				$pointssql = " skillPoints = (skillPoints+".$fkingSkillPoints."), ";
			
		         $db->sql_query("UPDATE personaje SET
				nivel = ".$pj['nivel'].",
				exp = ".$pj['exp'].",
				godLevel = (godLevel+".$godLevel."),
				godLevelSpend = (godLevelSpend+".$godLevel."),
				Vida = ".$stats['VidaLimit'].",
				Mana = ".$stats['ManaLimit'].",
				".$pointssql."
				expUp = ".$pj['expUp']."
			  WHERE idPersonaje  = '".$log->get("pjSelected")."'");
			$data['nivel']=$pj['nivel'];
			$data['exp']=$pj['exp'];
			$data['expUp']=$pj['expUp'];
			
			$data['VidaLimit']=$stats['VidaLimit'];
			$data['ManaLimit']=$stats['ManaLimit'];
			
			$data['changes']=1;
		
		}		
}
echo json_encode($data);
?> 