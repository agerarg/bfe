<?php
$pj['KonShitOn'] = 1;
$pj['KonAcumulate'] = $aura['acumuleitor'];
$pj['KonAuraId'] = $aura['idAura'];

$pj['VidaLimit'] = potenciar($pj['VidaLimit'],$pj['KonAcumulate']);
$pj['ManaLimit'] = potenciar($pj['ManaLimit'],$pj['KonAcumulate']);
?>
