<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
function petCost($lvl,$cost)
{
   switch($lvl)
   {
     case 1:
       $plixer = $cost*3;
       $resp['txt']=$plixer." Crafts C";
       $resp['cant']=$plixer;
       $resp['id']=400;
     break; 
      case 2:
        $plixer = $cost*6;
       $resp['txt']=$plixer." Crafts C";
       $resp['cant']=$plixer;
       $resp['id']=400;
     break; 
     case 3:
        $plixer = $cost*10;
       $resp['txt']= $plixer." Crafts C";
       $resp['cant']=$plixer;
       $resp['id']=400;
     break; 
    case 4:
         $plixer = $cost*7;
       $resp['txt']=$plixer." Crafts B";
       $resp['cant']=$plixer;
       $resp['id']=401;
     break; 
    case 5:
       $plixer = $cost*16;
       $resp['txt']=$plixer." Crafts B";
       $resp['cant']=$plixer;
       $resp['id']=401;
     break; 
     case 6:
       $plixer = $cost*33;
       $resp['txt']=$plixer." Crafts B";
       $resp['cant']=$plixer;
       $resp['id']=401;
     break; 
case 7:
       $plixer = $cost*16;
       $resp['txt']=$plixer." Crafts A";
       $resp['cant']=$plixer;
       $resp['id']=402;
     break; 
case 8:
       $plixer = $cost*33;
       $resp['txt']=$plixer." Crafts A";
       $resp['cant']=$plixer;
       $resp['id']=402;
     break; 
case 9:
       $plixer = $cost*60;
       $resp['txt']=$plixer." Crafts A";
       $resp['cant']=$plixer;
       $resp['id']=402;
     break; 
case 10:
      $plixer = $cost*100;
       $resp['txt']=$plixer." Crafts A";
       $resp['cant']=$plixer;
       $resp['id']=402;
     break; 
   }
return $resp;
}
if(isset($_GET['lvlup']))
{
      $id = intval($_GET['lvlup']);
       $query = 'SELECT mp.*, m.ataque, m.imagen, m.costo
					FROM mascota_personaje mp JOIN mascotas m USING(idMascota)
					WHERE mp.idCuenta = '.$log->get("idCuenta").' AND mp.idMascPer = "'.$id.'"';
    $clansq = $db->sql_query($query);
    $clan = $db->sql_fetchrow($clansq);
 if($clan)
 {
        if($clan['nivel']<10)
        {
            $costos = petCost(($clan['nivel']+1),$clan['costo']);
            $query = 'SELECT idInventario
		  FROM inventario WHERE idItem = '.$costos['id'].'
			AND cantidad >= '.$costos['cant'].' AND idCuenta = '.$log->get("idCuenta").'';
	    $finale = $db->sql_fetchrow($db->sql_query($query));
	   if($finale)	
           { 
                $db->sql_query("update inventario set cantidad = (cantidad-".$costos['cant'].") where idInventario= ".$finale['idInventario']."");
               $db->sql_query("update mascota_personaje set nivel= (nivel+1) where idMascPer = ".$id."");
              show_message($clan['nombre']." subió a nivel ".($clan['nivel']+1)."!","index.php?sec=mascotas");
           }
           else
              show_error("No tienes los items requeridos!","index.php?sec=mascotas");
        }
        else
        show_error("La mascota ya esta al máximo nivel!","index.php?sec=mascotas");
 }
 else
 {
  			show_error("La mascota no existe!","index.php?sec=mascotas");
 }

}else	
if(isset($_GET['llamar']))
{
    $id = intval($_GET['llamar']);
       $query = 'SELECT mp.*, m.ataque, m.imagen
					FROM mascota_personaje mp JOIN mascotas m USING(idMascota)
					WHERE mp.idCuenta = '.$log->get("idCuenta").' AND mp.idMascPer = "'.$id.'"';
   $clansq = $db->sql_query($query);
   $clan = $db->sql_fetchrow($clansq);
  if($clan)
{
  if($clan['idPersonaje']==$log->get("pjSelected"))
{
     $db->sql_query("update mascota_personaje set idPersonaje = 0 where idPersonaje = ".$log->get("pjSelected")."");
  show_message($clan['nombre']." guardada!","index.php?sec=mascotas");
}
else
{
         $db->sql_query("update mascota_personaje set idPersonaje = 0 where idPersonaje = ".$log->get("pjSelected")."");
         $db->sql_query("update mascota_personaje set idPersonaje = ".$log->get("pjSelected")." where idMascPer = ".$id."");
        show_message($clan['nombre']." ahora te sigue!","index.php?sec=mascotas");
}

}
else
{
 			show_error("La mascota no existe!","index.php?sec=mascotas");
}
}
else
{
					$template->set_filenames(array(
							'content' => 'templates/sec/mascotas.html' )
						);	
					define('PATH_USERS', '?sec=mascotas&');
					 define('PAGINAS', 6);
					 
					
					 
					$page_number = intval($_GET['page']);
					if( $page_number == 0 ) 
					{ 
						$page_number = 1;
					}
					$query = 'SELECT count(*) as CONTA 
							  FROM mascota_personaje WHERE idCuenta = '.$log->get("idCuenta").'';
					$count = $db->sql_fetchrow($db->sql_query($query));
					$filas = $count['CONTA'];
					$numeracion = NumerarPaginas($page_number, $filas, PATH_USERS, $limitbottom, PAGINAS);
					$query = 'SELECT mp.*, m.ataque, m.imagen, m.costo
					FROM mascota_personaje mp JOIN mascotas m USING(idMascota)
					WHERE mp.idCuenta = '.$log->get("idCuenta").'
					ORDER BY nivel DESC LIMIT '.$limitbottom.', '.PAGINAS;
					$clansq = $db->sql_query($query);
					$template->assign_var('NUMERACION', $numeracion);
					$num = ( $page_number - 1 ) * PAGINAS;
					$numero = $page_number * PAGINAS - PAGINAS;
					while($clan = $db->sql_fetchrow($clansq))
					{	
                                                  $call="Llamar";
                                                if($clan['idPersonaje']==$log->get("pjSelected"))
                                                {
                                                   $used="(Esta a tu lado)";
                                                   $call="Guardar";
                                                }
                                                else
						if($clan['idPersonaje']>0)
                                                   $used="(Esta con otro personaje)";
                                                else
                                                   $used="(Libre)";
                                                $costos = petCost(($clan['nivel']+1),$clan['costo']);
                                                if($clan['nivel']<10)
                                                   $lvlup = "<a href='index.php?sec=mascotas&lvlup=".$clan['idMascPer']."'>Subir de Nivel (".$costos['txt'].")</a>";
                                                 else
                $lvlup="";
						$template->assign_block_vars('MASC', array(
												'ID' => $clan['idMascPer'],
												'NOMBRE' => $clan['nombre']." Lvl:".$clan['nivel']." ".$used,
                                                                                                 'CALL' => $call,
												'IMG' => $clan['imagen'],
												'LVL' =>  $clan['nivel'],
                                                                                                 LVLUP=>$lvlup,	
												'ATAQUE' => ($clan['ataque']*$clan['nivel']),
												));
					}
}

?> 