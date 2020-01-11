<?php
$pj['Ataque']+=25;
$pj['Ataque']+=$pj['AtaqueMagico'];
$pj['AtaqueMagico'] = penetration($pj['AtaqueMagico'],50);
?>
