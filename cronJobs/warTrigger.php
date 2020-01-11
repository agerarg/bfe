<?php
  if(SWORDON != 1) die();
  include('system/conexion.php');
  $db = new sql_db;
  
  $query = 'SELECT * FROM gameactive';
  $gameCore = $db->sql_fetchrow($db->sql_query($query));
$now = time();
function addNexus($mund)
{
    global $db;
    $query = "INSERT INTO inmundo (idMonster,tipo,mundo,currentLife,globalmap) 
    VALUES(204,2,".$mund.",20,1)";		
    $db->sql_query($query);	
}

if(!$gameCore['war'])
{
    if($gameCore['warTime']<$now)
    {
        $db->sql_query("DELETE FROM inmundo 
        WHERE mundo IN(159,160,161,162,163,164,165)");

        addNexus(159);	
        addNexus(160);	
        addNexus(161);	
        addNexus(162);	
        addNexus(163);	
        addNexus(164);	
        addNexus(165);	

        $db->sql_query("UPDATE mundo SET clan=0 WHERE tipo='warzone'");
        $db->sql_query("UPDATE gameactive SET war = 1, warTime = ".($now+600));
        $msg="<div class=warzone_start> Inicio la guerra! </div>";
        $db->sql_query('INSERT INTO  chat(global,mensaje,tempo) 
            VALUES(1,"'.$msg.'",'.$now.')');
        
        die();
    }
}
else
{
    if($gameCore['warTime']<$now)
    {
        $query = 'SELECT *
        FROM mundo
         WHERE tipo="warzone"';
        $mundosq = $db->sql_query($query);
        while($mund = $db->sql_fetchrow($mundosq))
        {
            if($mund['clan']>0)
            {
                $db->sql_query("UPDATE clan 
                SET puntos_fijo= (puntos_fijo+1), 
                puntos=(puntos+1) 
                WHERE idClan=".$mund['clan']);
                $db->sql_query("UPDATE personaje 
                SET clanRep = (clanRep+5) 
                WHERE clan = ".$mund['clan']);
            }
        }

        $db->sql_query("UPDATE personaje 
        SET clanRep = (clanRep+5) , ParticipoEnWar=0
        WHERE ParticipoEnWar = 1");


        $newTimer = $now + mt_rand(3600,10800);
        $db->sql_query("UPDATE gameactive 
        SET war = 0, 
        warTime = ".$newTimer);
        $msg="<div class=warzone_start> Finalizo la guerra! </div>";
        $db->sql_query('INSERT INTO  chat(global,mensaje,tempo) 
            VALUES(1,"'.$msg.'",'.$now.')');
        $db->sql_query("DELETE FROM inmundo 
        WHERE mundo IN(159,160,161,162,163,164,165)");    

        die();
    }
}

?>