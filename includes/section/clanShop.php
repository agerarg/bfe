<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
if($pj['clan']>0)
{
	$template->set_filenames(array(
		'content' => 'templates/sec/clanShop.html' )
	);
	$template->assign_var('HONOR', $pj['clanRep']);

	
}
else
{
	show_error("Solo miembros de clan pueden ver la tienda","index.php?sec=party");

}

?> 