<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
//ADMIN
if($pj['idPersonaje']==ADMIN)
{
	if(isset($_POST['crear']))
	{
		
		switch($_POST['cantidad'])
		{
			case 4:
				$brakets = 4;
			break;
			case 8:
				$brakets = 8;
			break;
			case 16:
				$brakets = 16;
			break;
			default:
				$error = "Cantidad de jugadores incorrecta";
			break; 
		}
		$nombre =textIntoSql($_POST['nombre']);
		$url =textIntoSql($_POST['url']);
		
		$oro1=intval($_POST['oro1']);
		$oro2=intval($_POST['oro2']);
		
		if(!$error )
		{
			show_message("Torneo creado con exito","index.php");
			$db->sql_query("INSERT INTO torneo (jugadores,nombre,direccion,premio1,premio2) 
			VALUES('".$brakets."','".$nombre."','".$url."','".$oro1."','".$oro2."')");	
		}
		else
		show_error("Error: ".$error."","index.php?sec=crearTorneo");

	}
	else
	{
	$template->set_filenames(array(
			'content' => 'templates/sec/crearTorneo.html' )
		);
	}
}
else
{
	show_error("No tienes permiso para entrar aquí","index.php?");
}
?> 