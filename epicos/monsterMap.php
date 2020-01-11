<?php
    switch($dungeon['epico'])
    {
        case 166:
            switch($dungeon['waveCurr'])
            {
                case 1:
                    $idMOb= 176;
                    $cantidul=3;
                break;	
                case 2:
                     $idMOb= 177;
                     $cantidul=2;
                break;	
                case 3:
                    $idMOb= 205;
                    $cantidul=1;
                break;	
            }
        break;
       
    }    
    if($idMOb>0)
    {
        $query = 'SELECT *
                        FROM monster
                        WHERE idMonster = '.$idMOb;
        $monstersq = $db->sql_query($query);
            $mob = $db->sql_fetchrow($monstersq);		

            for($i=0;$i<$cantidul;$i++)
            {
                $db->sql_query('INSERT INTO  
                    inmundo(idMonster,tipo,mundo,
                    currentLife,dificulty,
                    idInstance,openToClan) 
                VALUES("'.$mob['idMonster'].'","2",
                    1,"'.$mob['VidaLimit'].'",1,'.$dungeon['idInstance'].',
                    '.$dungeon['idParty'].')');
            }	
    }
?>