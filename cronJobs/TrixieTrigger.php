<?php
  if(SWORDON != 1) die();
  
  $query = 'SELECT * FROM mundo WHERE id=182';
  $gameCore = $db->sql_fetchrow($db->sql_query($query));
$now = time();

if($gameCore['warTime']<$now)
{
    $query = 'SELECT idInMundo AS ID FROM inmundo WHERE
     idMonster = 248 AND mundo=183';  
    $bosssq = $db->sql_query($query);
    $trixie = $db->sql_fetchrow($bosssq);
    if(!$trixie)
    {
         $db->sql_query("DELETE FROM inmundo 
        WHERE mundo = 183"); 

         $query = 'SELECT *
                FROM monster
                WHERE idMonster = 248';
            $monstersq = $db->sql_query($query);
            $mob = $db->sql_fetchrow($monstersq);


         $db->sql_query('INSERT INTO  
                inmundo(idMonster,tipo,mundo,
                currentLife,dificulty,element,globalmap) 
            VALUES("'.$mob['idMonster'].'","2",
                183,"'.$mob['VidaLimit'].'",1,"dark",1)');

          $msg="<div class=trixie_start> Aparecio Trixie !!! </div>";
        $db->sql_query('INSERT INTO  chat(global,mensaje,tempo) 
            VALUES(1,"'.$msg.'",'.$now.')');
        echo "Spown Trixie";
    }

    $db->sql_query("UPDATE mundo 
        SET warTime = ".($now+86500)."
        WHERE id = 182");
     $db->sql_query("DELETE FROM aura 
        WHERE idSkillReal = 452"); 
}


?>