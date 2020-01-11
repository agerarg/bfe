<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
$template->set_filenames(array(
											'content' => 'templates/sec/opciones.html' )
										);
if($pj['showBuffs'])
			{
				$template->assign_var('BUFFMODE', "SI");
			}
			else
			{
				$template->assign_var('BUFFMODE', "NO");
			}
switch($_GET['op'])
{
	case 'pasivos':
			
			if($pj['showBuffs'])
			{
				$template->assign_var('BUFFMODE', "SI");
				$db->sql_query("UPDATE personaje SET showBuffs=0 WHERE idPersonaje = ".$pj['idPersonaje']);
			}
			else
			{
				$db->sql_query("UPDATE personaje SET showBuffs=1 WHERE idPersonaje = ".$pj['idPersonaje']);
				$template->assign_var('BUFFMODE', "NO");
			}

	break;
	case 'pociones':
		$db->sql_query("UPDATE inventario 
						SET usadoPor=0
						WHERE idCuenta = ".$log->get("idCuenta")." AND (idItem IN (637,638,639,640,641,642,643,644,644,645,646,647))");
		show_message("Pociones reseteadas!","index.php?sec=inicio");
	break;
	case 'borrarPj':
		if(isset($_POST['sim']))
		{
			$db->sql_query("UPDATE personaje SET desactivada=1 WHERE idPersonaje = ".$pj['idPersonaje']);
			$db->sql_query("UPDATE inventario SET usadoPor=0 WHERE usadoPor = ".$pj['idPersonaje']);
			show_message("Personaje borrado.","index.php?sec=inicio");
			$db->sql_query("UPDATE cuenta SET pjSelected = '0' 
											WHERE idCuenta  = '".$log->get("idCuenta")."'");
			$log->set("pjSelected",0);		
			header("Location: index.php?sec=cambiarPj");
			die();		
		}
		else
			show_message("Esta seguro de borrar su personaje ".$pj['nombre']."?<br><br><br><form method=post><input name='sim' type='submit' value='BORRAR ".$pj['nombre']."' /></form>","index.php?sec=inicio");
	break;
	case 'resetAventura':
		if(isset($_POST['sis']))
		{
			$db->sql_query("DELETE FROM skilllearn WHERE idPersonaje = '".$pj['idPersonaje']."' AND aventura = 1");
			$db->sql_query("DELETE FROM aura WHERE idPersonaje = '".$pj['idPersonaje']."' AND aventura = 1");
			unset($_SESSION['PJITEM']);
			unset($_SESSION['MADVSKILL']);
			if($pj['nivel']>120)
				$pj['nivel']=120;
			$pasivos = intval($pj['nivel']/5);
			$db->sql_query("UPDATE personaje SET pasivosCurr=".$pasivos.", pasivosGain=0  WHERE idPersonaje = ".$pj['idPersonaje']);
			
			show_message("Aventuras reseteadas!","index.php?sec=inicio");
		}
		else
			show_message("Esta seguro de borrar todas sus habilidades de aventura y comenzar de nuevo desde 0?<br><br><br><form method=post><input name='sis' type='submit' value='RESETEAR AVENTURAS' /></form>","index.php?sec=inicio");
	break;
	default:									
		if(isset($_GET['redirecPap']))
		{
			if($pj['mundoForm']==0)
			{
				$db->sql_query("UPDATE personaje SET mundoForm=1 WHERE idCuenta = ".$log->get("idCuenta"));
				$pj['mundoForm']=1;
			}
			else
			{
				$db->sql_query("UPDATE personaje SET mundoForm=0 WHERE idCuenta = ".$log->get("idCuenta"));
				$pj['mundoForm']=0;
			}
		}
		
			if($pj['mundoForm']==0)
				$template->assign_var('MAPMODE', "SI");
			else
				$template->assign_var('MAPMODE', "NO");
	break;
}
?> 