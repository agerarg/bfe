<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
		$top = intval($_GET['top']);
		$left = intval($_GET['left']);
		setcookie("PARTY_TOP", $top, time()+60*60*24*100, "/");
		 setcookie("PARTY_LEFT", $left, time()+60*60*24*100, "/");
?> 