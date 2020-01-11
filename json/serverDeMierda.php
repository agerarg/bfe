<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
include('../system/conexion.php');
session_start();
$db = new sql_db;
$query = 'SELECT * FROM gameactive';
	$gameCore = $db->sql_fetchrow($db->sql_query($query));
	$data['back']=0;
	if($gameCore['activo']==0)
	{
		$paso = intval($_GET['paso']);
		$t = time();
		switch($paso)
		{
			case 1:
					for ($i = 1; $i <= 10; $i++) {
						$hola = mt_rand(1111,9999);
					}
					$_SESSION['problemSteps']=2;
					$_SESSION['problemNext']=$t;
					$data['back']=$t;
			break;
			case 2:
				if($_SESSION['problemNext']==$_GET['tempo'])
				{
					for ($i = 1; $i <= 100; $i++) {
							$hola = mt_rand(1111,9999);
						}
					$_SESSION['problemSteps']=3;
					$_SESSION['problemNext']=$t;
					$data['back']=$t;
				}
			break;
			case 3:
				$t = time();
				if($_SESSION['problemNext']==$_GET['tempo'])
				{
					for ($i = 1; $i <= 1000; $i++) {
							$hola = mt_rand(1111,9999);
						}
					$_SESSION['problemSteps']=4;
					$data['back']=$t;
					$_SESSION['problemNext']=$t;
				}
			break;
			case 4:
			$t = time();
				if($_SESSION['problemNext']==$_GET['tempo'])
				{
					for ($i = 1; $i <= 3000; $i++) {
							$hola = mt_rand(1111,9999);
						}
					$_SESSION['problemSteps']=5;
					$data['back']=$t;
					$_SESSION['problemNext']=$t;
				}
			break;
			case 5:
			$t = time();
				if($_SESSION['problemNext']==$_GET['tempo'])
				{
					$db->sql_query("UPDATE personaje set attackCooldown = 0, deathTime=0, lifePotTimer=0, manaPotTimer=0");
					$db->sql_query("UPDATE skilllearn set cooldownCurrent = 0");
					$db->sql_query("UPDATE inmundo set sesion_time = 0, ownerTime=0");
					$db->sql_query("UPDATE gameactive SET activo=1");
					$db->sql_query('DELETE FROM chat');
					$data['back']=$t;
					$_SESSION['problemNext']=$t;
				}
			break;
		}
	}
	else
	{
		$data['back']=8974;
	}
	
echo json_encode($data);
?> 