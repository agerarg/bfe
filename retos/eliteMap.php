<?php
$champ=0;
 $exp=1;
     switch($dungeon['waveCurr'])
            {
                case 1:
                    $cantidul=5;
                break;  
                case 2:
                    $champ=1;
                     $exp=2;
                    $cantidul=1;
                break;  
            }
  $query = 'SELECT idMonster, VidaLimit
                            FROM monster  WHERE exp='. $exp.' AND papa=0 AND hardOne = 3 AND raid = 0 AND mapBoss = 0 ORDER BY RAND() DESC LIMIT 0,3';
    $monstersq = $db->sql_query($query);
    $monstersq = $db->sql_query($query);
        $mob = $db->sql_fetchrow($monstersq);		

        $db->sql_query("UPDATE dungeon_instance SET eliteLevel=(eliteLevel+1) WHERE idInstance = '".$dungeon['idInstance']."'");

        for($i=0;$i<$cantidul;$i++)
        {
            $vida=$mob['VidaLimit'];
            $vida+=intval(($vida*($dungeon['eliteLevel']+2))/4);
            if($champ==1)
                 $vida=$vida*3;

            $db->sql_query('INSERT INTO  
                inmundo(idMonster,tipo,mundo,
                currentLife,dificulty,
                idInstance,deQuien,champion) 
            VALUES("'.$mob['idMonster'].'","2",
                1,"'.$vida.'",1,'.$dungeon['idInstance'].',
                '.$log->get("pjSelected").','. $champ.')');
        }	
?>