<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
//ADMIN

	$template->set_filenames(array(
			'content' => 'templates/sec/Wname.html' )
		);
		

	$query = 'SELECT nombre FROM jnombre';
	$namer = $db->sql_query($query);
	while($n = $db->sql_fetchrow($namer))
	{
		$template->assign_block_vars('N', array('NAME' => $n['nombre']));
	}
	$query = 'SELECT apellido FROM japellido';
	$namer = $db->sql_query($query);
	while($a = $db->sql_fetchrow($namer))
	{
		$template->assign_block_vars('A', array('NAME' => $a['apellido']));
	}

?> 