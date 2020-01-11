<?php
if($item['enVenta']==0)
$data["error"] = "Este item no esta en venta.";
else
if($item['usadoPor']==0)
{
$query = 'SELECT *
                FROM compra_venta
                WHERE idInventario = '.$item['idInventario'].'';
$itemVentasq = $db->sql_query($query);
$itemVenta = $db->sql_fetchrow($itemVentasq);
if($itemVenta['wachTime']<$now)
{
    $db->sql_query("UPDATE inventario SET enVenta = 0 WHERE idInventario = ".$item['idInventario']);
    $db->sql_query("DELETE FROM compra_venta WHERE idInventario = ".$item['idInventario']);		
    $data["error"] = 0;
}
else
{
    $timeleft = ($itemVenta['wachTime']-$now);
    $min = round($timeleft/60,2);
    $data["error"] = "hay que esperar ".$min." minutos para poder cancelar la venta";
}
}
else
$data["error"] = "Si te sale esto, esta todo para la mierda.";
?>