<?php
define('SWORDON', 1);
include('../system/conexion.php');
include('../system/funciones.php');
include('../system/login.php');
session_start();
$db = new sql_db;
$log = new LOGuser;
if($log->check())
{
    if($_SESSION['secure_section']=="bank")
    {

        $query = 'SELECT * FROM monedas';
		$monedasq = $db->sql_query($query);
		$moneda = $db->sql_fetchrow($monedasq);

        switch($_GET['dame'])
        {
            case "ReRoll":
                $precio = $moneda['reroll'];
                $id=613;
            break;
            case "Chaos":
                $precio = $moneda['chaos'];
                $id=614;
            break;
            case "Upulus":
                 $precio = $moneda['upulus'];
                 $id=615;
            break;
            case "Exodimo":
                 $precio = $moneda['exodimo'];
                 $id=616;
            break;
            case "Alquimist":
                 $precio = $moneda['alchemist'];
                 $id=617;
            break;
            case "Corruption":
                 $precio = $moneda['corruption'];
                 $id=618;
            break;
        }

        $cant = (int)$_GET['cant'];
        if($cant>0 && $cant<9999)
        {

            $realGold=$log->realGold();

            $precio=$precio*$cant;

            if($realGold>=$precio)
            {
                add_item($id,$cant);
                $db->sql_query("UPDATE cuenta SET oro = (oro-".$precio.") WHERE idCuenta = ".$log->get("idCuenta"));
                $data["gold"] = $realGold-$precio;
            }
            else
            $data['error']="No tenes suficiente oro";
        }
        else
             $data['error']="la cantidad tiene que ser mayor a 0";


    }
    else
    $data['error']="falsa session";

}
else
    $data['error']="no logeado";

echo json_encode($data);
?>