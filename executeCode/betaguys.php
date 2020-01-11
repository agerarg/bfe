<?php
		$db->sql_query("UPDATE cuenta SET rupias = (rupias+50) WHERE idCuenta = ".$log->get("idCuenta"));	
		
		show_message("Code activated! You gain 50 recommendation points!","index.php?sec=CODES");
?>
