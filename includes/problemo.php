<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
$template->set_filenames(array(
						'body' => 'templates/mainSimple.html' )
					);
					
					
					
					$template->set_filenames(array(
					'content' => 'templates/problema.html' )
					);
			unset($_SESSION['problemNext']);
			$_SESSION['problemSteps']=1;		
					

?> 