<?php
$pj['MohShitOn'] = 1;
$pj['MohAcumulate'] = $aura['acumuleitor'];
$pj['MohAuraId'] = $aura['idAura'];

//$pj['Ataque'] = potenciar($pj['Ataque'],$pj['MohAcumulate']);
$pj['AtaqueMagico'] = potenciar($pj['AtaqueMagico'],$pj['MohAcumulate']);
?>
