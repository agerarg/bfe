<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////

$grado=1;
if(isset($_GET['grade']))
	$grado=$_GET['grade'];
	
$runz = intval($_GET['runz']);

if($runz>0)
  $template->assign_var('RUNZ', $runz);
else
  $template->assign_var('RUNZ', 2);



$template->assign_var('SELWORLD', 0);
$template->assign_var('GRADE', $grado);
$template->set_filenames(array(
			'content' => 'templates/sec/craftListClan.html' )
		);


?> 