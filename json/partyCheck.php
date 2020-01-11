<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
include('../system/conexion.php');
include('../system/login.php');
session_start();
$db = new sql_db;
$log = new LOGuser;
if($log->check())
{

		$now = time();
		$query = 'SELECT idPersonaje, nombre, idPersonaje, party
		FROM personaje
			WHERE idCuenta = '.$log->get("idCuenta").' AND idPersonaje = '.$log->get("pjSelected").'';
		$pj = $db->sql_fetchrow($db->sql_query($query));
		if($pj['party']>0)
		{
			$query = 'SELECT p. Vida, p.realDPS, p.nivel, p.nombre, c.imagen, c.STYLE, p.sexo, p.attackCooldown, p.idPersonaje
						FROM personaje p JOIN clase c USING ( idClase )
						WHERE p.party = '.$pj['party'].' ';
			$partymemsq = $db->sql_query($query);
			while($partymem = $db->sql_fetchrow($partymemsq))
			{
				if($partymem['attackCooldown']>($now-300))
				{
					$partymem['style'] = "On";
					$partymem['activo'] = "YES";
				}
				else
				{
					$partymem['style'] = "Off";
					$partymem['activo'] = "NO";
				}
				if($pj['party']==$partymem['idPersonaje'])
					$partymem['lider'] = 1;
				$partymem['VidaLimit'] = $partymem['Vida'];	
				$data["party"][] = $partymem;
				
			}
		}
}
else
{
	$data['error'] = "Error: usuario no logeado";
}
 echo json_encode($data);
?> 