<?php
$pj['NahShitOn'] = 1;
$pj['NahAcumulate'] = $aura['acumuleitor'];
$pj['NahAuraId'] = $aura['idAura'];

$pj['Defensa'] = potenciar($pj['Defensa'],($pj['NahAcumulate']/2));
$pj['DefensaMagica'] = potenciar($pj['DefensaMagica'],($pj['NahAcumulate']/2));
?>
