<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
		$cg = $_GET['default'];
		setcookie("CHAT_DEFAULT", $cg, time()+60*60*24*100, "/");
?> 