<?php
     $db->sql_query("UPDATE personaje SET
                paragonAcc = (paragonAcc+1),
                paragonNow = (paragonNow+1)
              WHERE idPersonaje  = '".$log->get("pjSelected")."' OR SubClassFrom  = '".$log->get("pjSelected")."'");

  
      $msg = "<div class='mapObjetive'>Paragon Rift Nivel ".($dungeon['eliteLevel']-1)." Completado!<br><a href='index.php?sec=paragon'>Ver paragon</a></div>";

            systemLog("self",  $msg) ;     

?>