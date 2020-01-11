<?php
    $expup=0;
    switch($dungeon['cata'])
    {
        case 1:
            $lvli=6;
            $expup=100000;
            earnDropBox($lvli,4,$log->get("pjSelected"));
            earnDropBox($lvli,4,$log->get("pjSelected"));
            earnDropBox($lvli,4,$log->get("pjSelected"));
            systemLog("self","<div class=recompensaAstral>Felicidades completaste la primera Catacumba!<br>
            Ganaste ".$expup." de experiencia.</div>") ;     
            systemLog("self","<div class=recompensaAstral>Conseguiste 3 cofre nivel ".$lvli."!<br><a href='index.php?sec=recompensas'>Ir a abrirlo</a></div>") ;
          
        break;
        case 2:
            $lvli=8;
            $expup=2500000;
            earnDropBox($lvli,4,$log->get("pjSelected"));
            earnDropBox($lvli,4,$log->get("pjSelected"));
            earnDropBox($lvli,4,$log->get("pjSelected"));
            systemLog("self","<div class=recompensaAstral>Felicidades completaste la segunda Catacumba!<br>
            Ganaste ".$expup." de experiencia.</div>") ;    
            systemLog("self","<div class=recompensaAstral>Conseguiste 3 cofre nivel ".$lvli."!<br><a href='index.php?sec=recompensas'>Ir a abrirlo</a></div>") ;
             
        break;
        case 3:
            $lvli=9;
            $expup=1000000;
            earnDropBox($lvli,1,$log->get("pjSelected"));
            earnDropBox($lvli,1,$log->get("pjSelected"));
            earnDropBox($lvli,1,$log->get("pjSelected"));
            systemLog("self","<div class=recompensaAstral>Felicidades completaste la tercera Catacumba!<br>
            Ganaste ".$expup." de experiencia.</div>") ;  
            systemLog("self","<div class=recompensaAstral>Conseguiste 3 cofre nivel ".$lvli."!<br><a href='index.php?sec=recompensas'>Ir a abrirlo</a></div>") ;
        break;
    }
  
    if($expup>0 && $pj["nivel"]<LVLLIMIT)
    {
        $db->sql_query("UPDATE personaje SET 
                    exp = (exp+".$expup.") 
                    WHERE idPersonaje = '".$log->get("pjSelected")."'");
    }
?>