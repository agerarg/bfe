<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
include('../system/conexion.php');
	$db = new sql_db;
	$id = intval($_GET['id']);
		$data="";
		
		
		$query = 'SELECT  *
			FROM skillads
			WHERE idSkill = '.$id.'';
		$skillads = $db->sql_query($query);
		$n=0;
		while($skill = $db->sql_fetchrow($skillads))
		{
			$n++;
			$data["mob"][] = array("name"=>"fx".$n,"evento"=>$skill['evento'],"tipo"=>$skill['tipo'],"poder"=>$skill['poder']);
			
		}
		
			$query = 'SELECT  *
			FROM skill
			WHERE idSkill = '.$id.'';
		$skillinfo = $db->sql_query($query);
		$skillinfo = $db->sql_fetchrow($skillinfo);
		
		
		$data['nombre'] = $skillinfo['nombre'];
		$data['cooldown'] = $skillinfo['cooldown'];
		$data['costomp'] = $skillinfo['costomp'];
		for($i=0;$i<count($data["mob"]);$i++)
			{
				$skillinfo['desc'] = str_replace($data["mob"][$i]['name'],"(".$data["mob"][$i]['poder'].")",$skillinfo['desc']);
			}
		$data['desc'] = utf8_encode($skillinfo['desc']);
		$data['lvls'] = $skillinfo['lvls'];
		$data['id'] = $skillinfo['idSkill'];
		$data['active'] = $skillinfo['active'];
		$data['imagen'] = $skillinfo['imagen'];
		
		$lvling = explode(",",$skillinfo['lvling']);
		for($i=0;$i<count($lvling);$i++)
			{
				$data["lvling"][] = array("nivel"=>$i,"requiere"=>$lvling[$i]);
			}
	 echo json_encode($data);
?> 