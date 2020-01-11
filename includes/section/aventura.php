<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
$today = date("z");
if($pj['inDungeon']==0)
{
		 $template->assign_var('HONOR', $pj['honor']);
		switch($pj['aventura'])
		{
			case 0:
				if($pj['nivel']>=10)
					{
						$template->set_filenames(array(
								'content' => 'templates/sec/aventura/parte1.html' )
							);
					}
				else
					show_error("Necesitas ser nivel 10 para continuar la aventura.","index.php");
			break;
			case 1:
				if($pj['nivel']>=20)
					{
						$template->set_filenames(array(
								'content' => 'templates/sec/aventura/parte2.html' )
							);
					}
				else
					show_error("Necesitas ser nivel 20 para continuar la aventura.","index.php");
			break;
			case 2:
				if($pj['nivel']>=30)
					{
						$template->set_filenames(array(
								'content' => 'templates/sec/aventura/parte3.html' )
							);
					}
				else
					show_error("Necesitas ser nivel 30 para continuar la aventura.","index.php");
			break;
			case 3:
					show_error("Por el momento no hay mas aventuras.","index.php");
			break;
		}
}
else
	show_error("Estas en un dungeon","index.php");
?> 