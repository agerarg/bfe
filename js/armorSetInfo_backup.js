var descArmor = new Array();
function armorSetInfo(id,requiere,desc)
{	
	var armIntro=new Array();
	armIntro['req'] = requiere;
	armIntro['desc'] = desc;
	descArmor[id]=armIntro;
}
//////// NOMBRE DE COSAS //////////////
commonSay = new Array();
commonSay['atkSpeed'] = " sec Vel Ataque";
commonSay['castSpeed'] = " sec Vel Casteo";
commonSay['hp'] = " Vida";
commonSay['mp'] = " Mana";
commonSay['magicAttack'] = " Ataque Magico";
commonSay['magicPen'] = " Penetracion Magica";
commonSay['attack'] = " Ataque";
commonSay['def'] = " Defensa";
commonSay['mDef'] = " Defensa Magica";
commonSay['allDef'] = " Defensas";
commonSay['crit'] = " Critico";
commonSay['critMagico'] = " Critico Magico";
commonSay['critMagicoPow'] = " Poder Critico Magico";
commonSay['critoPow'] = " Poder Critico";
commonSay['shieldRate'] = " Chanse de Bloqueo";
commonSay['shieldDef'] = " Defensa de Bloqueo";
commonSay['VampireStance'] = " Aura Vampirica";
commonSay['manaHealStr'] = " Aura de recuperar Mana";

commonSay['baseDmg'] = " Ataque Base";
commonSay['defBase'] = " Defensa Base";
commonSay['defMBase'] = " Defensa Magica Base";
commonSay['baseDmgMagic'] = " Ataque Magico Base";

commonSay['blunt'] = " (usando arma blunt)";
commonSay['bluntorsword'] = " (usando arma blunt o sword)";
commonSay['dual'] = " (usando arma dual)";
commonSay['dagger'] = " (usando arma dagger)";
commonSay['sword'] = " (usando arma sword)";
commonSay['bow'] = " (usando arma bow)";
commonSay['bigsword'] = " (usando arma bigsword)";
commonSay['resistShock'] = " Resistencia a Stun";
commonSay['wtf1'] = " de tu Ataque Magico como Ataque";
commonSay['wtf2'] = " de tu Ataque como Ataque Magico";
commonSay['wtf3'] = " de vida";
commonSay['wtf4'] = " de tu Defensa como Ataque";
////////// SETS ///////////////
armorSetInfo(0,"ERROR!","-Error-");

armorSetInfo(1,"Wooden Helmet","+4%"+commonSay['attack']+"<br>+1"+commonSay['atkSpeed']+"<br>+50"+commonSay['hp']);
armorSetInfo(2,"Devotion Circlet","+4"+commonSay['castSpeed']);
armorSetInfo(3,
"Mithril Helmet<br>Elven Mithril Gloves<br>Elven Mithril Boots",
"+2"+commonSay['castSpeed']+"<br>+2"+commonSay['critMagico']+"");

armorSetInfo(4,
"Helmet Of Knowledge<br>Gloves Of Knowledge<br>Boots Of Knowledge","+12%"+commonSay['magicAttack']+"<br>+1"+commonSay['castSpeed']);

armorSetInfo(5,
"Manticore Helmet<br>Manticore Gloves<br>Manticore Boots","+3%"+commonSay['attack']+"<br>+100"+commonSay['mp']+"");

armorSetInfo(6,
"Reinforced Helmet<br>Reinforced Gloves<br>Reinforced Boots","+2"+commonSay['atkSpeed']+"");

armorSetInfo(7,
"Brigandine Helmet<br>Brigandine Gloves<br>Brigandine Boots",
"+5%"+commonSay['def']+"<br>+100"+commonSay['hp']+" (Brigandine Shield)");

armorSetInfo(8,
"Mithril Helmet<br>Mithril Heavy Gloves<br>Mithril Heavy Boots",
"+4%"+commonSay['def']+"<br>+125"+commonSay['hp']+" (Hoplon)");

armorSetInfo(9,
"Karmian Helmet<br>Karmian Gloves<br>Karmian Shoes",
"+4"+commonSay['castSpeed']);

armorSetInfo(10,
"Demon Helmet<br>Demon Gloves<br>Demon Shoes",
"+5"+commonSay['baseDmgMagic']+"<br>+10%"+commonSay['critMagico']);

armorSetInfo(11,
"Drake Helmet<br>Drake Gloves<br>Drake Boots",
"+5%"+commonSay['attack']+"<br>+2"+commonSay['atkSpeed']+"<br>+12%"+commonSay['mDef']+"");

armorSetInfo(12,
"Plated Leather Gloves<br>Plated Leather Boots",
"+15 "+commonSay['baseDmg']+"");

armorSetInfo(13,
"Mithril Light Helmet<br>Mithril Light Gloves<br>Mithril Light Boots",
"+1"+commonSay['atkSpeed']+"<br>+2"+commonSay['crit']+"<br>+15%"+commonSay['critoPow']+"");

armorSetInfo(14,
"Composite Helmet<br>Composite Gloves<br>Composite Boots",
"+5%"+commonSay['def']+"<br>+50 "+commonSay['hp']+"<br>+8%"+commonSay['attack']+" "+commonSay['blunt']+"<br>+10%"+commonSay['mDef']+" (Composite Shield)");

armorSetInfo(15,
"Chain Mail Helmet<br>Chain Mail Gloves<br>Chain Mail Boots",
"+10%"+commonSay['def']+"<br>+200"+commonSay['hp']+" (Chain Shield)");

armorSetInfo(16,
"Full Plate Helmet<br>Full Plate Gloves<br>Full Plate Boots",
"+1"+commonSay['atkSpeed']+"<br>+250"+commonSay['hp']+"<br>+12%"+commonSay['def']+" (Full Plate Shield)<br>+8%"+commonSay['mDef']+" (Full Plate Shield)");
armorSetInfo(17,
"Divine Helmet<br>Divine Gloves<br>Divine Shoes",
"+5%"+commonSay['def']+"<br>+250"+commonSay['mp']+"<br>+3"+commonSay['castSpeed']+"");
armorSetInfo(18,
"Theca Helmet<br>Theca Gloves<br>Theca Boots",
"+1"+commonSay['atkSpeed']+"<br>+5%"+commonSay['attack']+"");

armorSetInfo(19,
"Avadon Helmet<br>Avadon Gloves<br>Avadon Boots",
"+4"+commonSay['castSpeed']+"<br>+4%"+commonSay['magicAttack']+" (Avadon Shield)");

armorSetInfo(20,
"Zubei Helmet<br>Zubei Gloves<br>Zubei Boots",
"+2"+commonSay['castSpeed']+"<br>+12%"+commonSay['magicAttack']+"");

armorSetInfo(21,
"Zubei Helmet<br>Zubei Gloves<br>Zubei Boots",
"+1"+commonSay['atkSpeed']+"<br>+10%"+commonSay['critoPow']+"<br>+5% Evasion"+commonSay['dagger']+"<br>+5%"+commonSay['crit']+commonSay['dagger']);

armorSetInfo(22,
"Avadon Helmet<br>Avadon Gloves<br>Avadon Boots",
"+1"+commonSay['atkSpeed']+"<br>+5%"+commonSay['def']+"<br>+15%"+commonSay['mDef']+"<br>+175"+commonSay['mp']+"<br>+10"+commonSay['bow']);

armorSetInfo(23,
"Avadon Helmet<br>Avadon Gloves<br>Avadon Boots",
"+8%"+commonSay['def']+"<br>+200"+commonSay['hp']+"<br>+5%"+commonSay['def']+commonSay['blunt']+"<br>+5%"+commonSay['def']+" (Avadon Shield)");

armorSetInfo(24,
"Zubei Helmet<br>Zubei Gloves<br>Zubei Boots",
"+1"+commonSay['atkSpeed']+"<br>+8%"+commonSay['attack']+"<br>+5%"+commonSay['attack']+commonSay['sword']);

armorSetInfo(25,
"Doom Helmet<br>Doom Gloves<br>Doom Boots",
"+5%"+commonSay['attack']+"<br>+40"+commonSay['baseDmg']+"");

armorSetInfo(26,
"Doom Helmet<br>Doom Gloves<br>Doom Boots",
"+15%"+commonSay['magicAttack']+"<br>+2"+commonSay['castSpeed']+"<br>+25%"+commonSay['critMagicoPow']+"");

armorSetInfo(27,
"Doom Helmet<br>Doom Gloves<br>Doom Boots",
"+500"+commonSay['hp']+"<br>+12%"+commonSay['defBase']+""+commonSay['blunt']+"<br>+15"+commonSay['defBase']+"<br>+25%"+commonSay['shieldRate']+" (Doom Shield)");

armorSetInfo(28,
"Blue Wolf Helmet<br>Blue Wolf Gloves<br>Blue Wolf Boots",
"+800"+commonSay['mp']+"<br>+3"+commonSay['castSpeed']+"<br>+8%"+commonSay['critMagico']+commonSay['bluntorsword']+"<br>+1"+commonSay['castSpeed']+commonSay['bluntorsword']);
armorSetInfo(29,
"Blue Wolf Helmet<br>Blue Wolf Gloves<br>Blue Wolf Boots",
"+2"+commonSay['atkSpeed']+"<br>+150"+commonSay['hp']+"<br>+500"+commonSay['mp']+"<br>+40"+commonSay['baseDmg']);
armorSetInfo(30,
"Blue Wolf Helmet<br>Blue Wolf Gloves<br>Blue Wolf Boots",
"+1"+commonSay['atkSpeed']+"<br>+8%"+commonSay['crit']+"<br>+30"+commonSay['baseDmg']+"<br>+8%"+commonSay['attack']+commonSay['bigsword']);

armorSetInfo(31,
"Dark Crystal Helmet<br>Dark Crystal Gloves<br>Dark Crystal Boots",
"+75"+commonSay['baseDmg']+"<br>+2"+commonSay['atkSpeed']+"<br>+25%"+commonSay['critoPow']+commonSay['dagger']);
armorSetInfo(32,
"Dark Crystal Helmet<br>Dark Crystal Gloves<br>Dark Crystal Boots",
"+2"+commonSay['castSpeed']+"<br>+50"+commonSay['baseDmgMagic']+"<br>+1"+commonSay['castSpeed']+"(Dark Crystal Shield)<br>+15"+commonSay['baseDmgMagic']+commonSay['bluntorsword']);
armorSetInfo(33,
"Dark Crystal Helmet<br>Dark Crystal Gloves<br>Dark Crystal Boots",
"+125"+commonSay['defBase']+"<br>+800"+commonSay['hp']+"<br>+18%"+commonSay['shieldRate']+" (Dark Crystal Shield)");

armorSetInfo(34,
"Tallum Helmet<br>Tallum Gloves<br>Tallum Boots",
"+75"+commonSay['baseDmg']+"<br>+500"+commonSay['mp']+"<br>+15"+commonSay['defBase']+commonSay['bow']);
armorSetInfo(35,
"Tallum Helmet<br>Tallum Gloves<br>Tallum Boots",
"+2"+commonSay['atkSpeed']+"<br>+50"+commonSay['baseDmg']+"<br>+50"+commonSay['defBase']+"<br>+500"+commonSay['hp']);
armorSetInfo(36,
"Tallum Helmet<br>Tallum Gloves<br>Tallum Boots",
"+2"+commonSay['castSpeed']+"<br>+65"+commonSay['baseDmgMagic']+"<br>+8%"+commonSay['mDef']+"<br>+1500"+commonSay['mp']+"");

armorSetInfo(37,
"Nightmare Helmet<br>Nightmare Gloves<br>Nightmare Boots",
"+200"+commonSay['defBase']+"<br>+1000"+commonSay['hp']+"<br>+50"+commonSay['defBase']+"(Shield Of Nightmare)");
armorSetInfo(38,
"Nightmare Helmet<br>Nightmare Gloves<br>Nightmare Boots",
"+3"+commonSay['atkSpeed']+"<br>+35%"+commonSay['critoPow']+"<br>+125"+commonSay['baseDmg']+"");
armorSetInfo(39,
"Nightmare Helmet<br>Nightmare Gloves<br>Nightmare Boots",
"+125"+commonSay['baseDmgMagic']+"<br>+3"+commonSay['castSpeed']+"");

armorSetInfo(40,
"Majestic Helmet<br>Majestic Gloves<br>Majestic Boots",
"+2"+commonSay['atkSpeed']+"<br>+80"+commonSay['defBase']+"<br>+80"+commonSay['baseDmg']+"<br>+250"+commonSay['hp']+"<br>+1000"+commonSay['mp']+"");
armorSetInfo(41,
"Majestic Helmet<br>Majestic Gloves<br>Majestic Boots",
"+2500"+commonSay['mp']+"<br>+100"+commonSay['baseDmg']+"<br>+15%"+commonSay['attack']+commonSay['bow']);
armorSetInfo(42,
"Majestic Helmet<br>Majestic Gloves<br>Majestic Boots",
"+2"+commonSay['castSpeed']+"<br>+2500"+commonSay['mp']+"<br>+500"+commonSay['hp']+"<br>+80"+commonSay['baseDmgMagic']+"<br>+5"+commonSay['critMagico']+"");

armorSetInfo(43,
"Imperial Helmet<br>Imperial Gloves<br>Imperial Boots",
"+1000"+commonSay['hp']+"<br>+1"+commonSay['atkSpeed']+"<br>+250"+commonSay['defBase']+"<br>+100"+commonSay['defBase']+" (Imperial Shield)<br>+100"+commonSay['defMBase']+" (Imperial Shield)<br>+500"+commonSay['hp']+" (Imperial Crusader Shield)<br>+100"+commonSay['baseDmg']+" (NO Imperial Shield)<br>+1"+commonSay['atkSpeed']+" (NO Imperial Shield)<br>+50"+commonSay['bigsword']+"");

armorSetInfo(44,
"Arcana Helmet<br>Arcana Gloves<br>Arcana Boots",
"+3000"+commonSay['mp']+"<br>+800"+commonSay['hp']+"<br>+4"+commonSay['castSpeed']+"<br>+150"+commonSay['baseDmgMagic']+"<br>+5"+commonSay['critMagico']+"<br>");

armorSetInfo(45,
"Draconic Helmet<br>Draconic Gloves<br>Draconic Boots",
"+3000"+commonSay['mp']+"<br>+250"+commonSay['baseDmg']+"<br>+10"+commonSay['crit']+"<br>+3"+commonSay['atkSpeed']+"<br>+50"+commonSay['baseDmg']+commonSay['bow']+"<br>+35%"+commonSay['critoPow']+commonSay['dagger']);

armorSetInfo(46,
"Infernal Helmet<br>Infernal Boots<br>Infernal Boots",
"+1000"+commonSay['hp']+"<br>+500"+commonSay['mp']+"<br>+4"+commonSay['castSpeed']+"<br>+125"+commonSay['baseDmgMagic']+"");

armorSetInfo(47,
"Infernal Helmet<br>Infernal Boots<br>Infernal Boots",
"+2500"+commonSay['hp']+"<br>+2"+commonSay['atkSpeed']+"<br>+125"+commonSay['baseDmg']+"<br>+200"+commonSay['defBase']+"<br>+200"+commonSay['VampireStance']+"");

armorSetInfo(48,
"Infernal Helmet<br>Infernal Boots<br>Infernal Boots",
"+1000"+commonSay['hp']+"<br>+200"+commonSay['baseDmg']+"<br>+35%"+commonSay['critoPow']+"<br>+100"+commonSay['VampireStance']+"<br>+100"+commonSay['manaHealStr']+"");

armorSetInfo(50,
"Almenos 2 items"," 2 partes:<br>+1000"+commonSay['hp']+" +100"+commonSay['allDef']+" +50"+commonSay['baseDmgMagic']+" +1"+commonSay['castSpeed']+" +1"+commonSay['critMagico']+" <br>3 partes:<br>Habilidades no consumen Faith +2000"+commonSay['hp']+" +200"+commonSay['allDef']+" +100"+commonSay['baseDmgMagic']+" +3"+commonSay['castSpeed']+" +3"+commonSay['critMagico']+"<br>4 partes:<br>Smite hace doble daño +3000"+commonSay['hp']+" +300"+commonSay['allDef']+" +150"+commonSay['baseDmgMagic']+" +5"+commonSay['castSpeed']+" +5"+commonSay['critMagico']+"");

armorSetInfo(51,
"Almenos 2 items"," 2 partes:<br>Group Heal y Desperate Heal 50% menos cooldown +1000"+commonSay['hp']+" +100"+commonSay['allDef']+" +50"+commonSay['baseDmgMagic']+" +1"+commonSay['castSpeed']+" +1"+commonSay['critMagico']+"<br>3 partes:<br>Miracle 50% menos cooldwon +2000"+commonSay['hp']+" +200"+commonSay['allDef']+" +100"+commonSay['baseDmgMagic']+" +3"+commonSay['castSpeed']+" +3"+commonSay['critMagico']+"<br>4 partes:<br>Todos los heals curan el doble +3000"+commonSay['hp']+" +300"+commonSay['allDef']+" +150"+commonSay['baseDmgMagic']+" +5"+commonSay['castSpeed']+" +5"+commonSay['critMagico']+"");

armorSetInfo(52,
"Almenos 2 items"," 2 partes:<br>+25 elemento dark +1000"+commonSay['hp']+" +100"+commonSay['allDef']+" +50"+commonSay['baseDmgMagic']+" +1"+commonSay['castSpeed']+" +1"+commonSay['critMagico']+"<br>3 partes:<br> Dark Explode dura el doble +2000"+commonSay['hp']+" +200"+commonSay['allDef']+" +100"+commonSay['baseDmgMagic']+" +3"+commonSay['castSpeed']+" +3"+commonSay['critMagico']+"<br>4 partes:<br>Soul Impact y Soul Vortex requieren 2 cargas para usarlos +3000"+commonSay['hp']+" +300"+commonSay['allDef']+" +150"+commonSay['baseDmgMagic']+" +5"+commonSay['castSpeed']+" +5"+commonSay['critMagico']+"");

armorSetInfo(53,
"Almenos 2 items"," 2 partes:<br>Soul Cannon +15% daño +1000"+commonSay['hp']+" +100"+commonSay['allDef']+" +50"+commonSay['baseDmgMagic']+" +1"+commonSay['castSpeed']+" +1"+commonSay['critMagico']+"<br>3 partes:<br> Bonus SoulCannonDmg se aplica a Soul Impact +2000"+commonSay['hp']+" +200"+commonSay['allDef']+" +100"+commonSay['baseDmgMagic']+" +3"+commonSay['castSpeed']+" +3"+commonSay['critMagico']+"<br>4 partes:<br>Soul Vortex siempre es critico +3000"+commonSay['hp']+" +300"+commonSay['allDef']+" +150"+commonSay['baseDmgMagic']+" +5"+commonSay['castSpeed']+" +5"+commonSay['critMagico']+"");

armorSetInfo(54,
"Almenos 2 items"," 2 partes:<br>Mortal Strike 50% menos cooldown +2000"+commonSay['hp']+" +200"+commonSay['allDef']+" 1"+commonSay['atkSpeed']+"<br>3 partes:<br> El % de retorno de daño se convierte en % de daño +4000"+commonSay['hp']+" +300"+commonSay['allDef']+" 2"+commonSay['atkSpeed']+"<br>4 partes:<br>Mortal Strike +125% daño +6000"+commonSay['hp']+" +400"+commonSay['allDef']+" 3"+commonSay['atkSpeed']+"");

armorSetInfo(55,
"Almenos 2 items"," 2 partes:<br>10% mas duro, Return 50% menos cooldown +2000"+commonSay['hp']+" +200"+commonSay['allDef']+"<br>3 partes:<br> 15% mas duro, Ultimate Defense 50% menos cooldown +4000"+commonSay['hp']+" +400"+commonSay['allDef']+"<br>4 partes:<br>25% mas duro, T-Virus Rage 50% menos cooldown +6000"+commonSay['hp']+" +600"+commonSay['allDef']+"");

armorSetInfo(56,
"Almenos 2 items"," 2 partes:<br>Sword Blast, Death Blast y DooM Blast 50% menos cooldown +1000"+commonSay['hp']+" +100"+commonSay['allDef']+"<br>3 partes:<br> 100% chance de Skill Edge +2000"+commonSay['hp']+" +200"+commonSay['allDef']+"<br>4 partes:<br>Activation y Rampage 50% menos cooldown +3000"+commonSay['hp']+" +300"+commonSay['allDef']+"");

armorSetInfo(57,
"Almenos 2 items"," 2 partes:<br>Destruction 50% menos cooldown +1000"+commonSay['hp']+" +100"+commonSay['allDef']+"<br>3 partes:<br> Destruction dura el doble +2000"+commonSay['hp']+" +200"+commonSay['allDef']+"<br>4 partes:<br>Destruction ya no saca velocidad de ataque +3000"+commonSay['hp']+" +300"+commonSay['allDef']+"");

armorSetInfo(58,
"Almenos 2 items"," 2 partes:<br>+15 elemento dark, Totem 50% menos cooldown +1000"+commonSay['hp']+" +100"+commonSay['allDef']+" +50"+commonSay['baseDmgMagic']+" +1"+commonSay['castSpeed']+" +1"+commonSay['critMagico']+"<br>3 partes:<br> Life Drain y Dark Spike tienen 50% cooldown no menos de eso. +2000"+commonSay['hp']+" +200"+commonSay['allDef']+" +100"+commonSay['baseDmgMagic']+" +3"+commonSay['castSpeed']+" +3"+commonSay['critMagico']+"<br>4 partes:<br>Dark Spike doble daño +3000"+commonSay['hp']+" +300"+commonSay['allDef']+" +150"+commonSay['baseDmgMagic']+" +5"+commonSay['castSpeed']+" +5"+commonSay['critMagico']+"");

armorSetInfo(59,
"Almenos 2 items"," 2 partes:<br>Puma Totem y Ritual duran 3 veces mas +1000"+commonSay['hp']+" +100"+commonSay['allDef']+" +50"+commonSay['baseDmg']+"<br>3 partes:<br> Dark Spike hace daño fisico. +2000"+commonSay['hp']+" +200"+commonSay['allDef']+" 1"+commonSay['atkSpeed']+" +100"+commonSay['baseDmg']+"<br>4 partes:<br>Stun Strike y Dark Spike menos 50% cooldown +3000"+commonSay['hp']+" +300"+commonSay['allDef']+" 2"+commonSay['atkSpeed']+" +150"+commonSay['baseDmg']+"");

armorSetInfo(60,
"Almenos 2 items"," 2 partes:<br>Interrupt 50% menos cooldown +1000"+commonSay['hp']+" +100"+commonSay['allDef']+" 1"+commonSay['atkSpeed']+" +100"+commonSay['baseDmg']+" +5"+commonSay['crit']+"<br>3 partes:<br> Ninjutsu y Destructor Blow menos 50% cooldown +2000"+commonSay['hp']+" +200"+commonSay['allDef']+" 2"+commonSay['atkSpeed']+" +300"+commonSay['baseDmg']+" +10"+commonSay['crit']+"<br>4 partes:<br>remueve el (BREAK) en combos +3000"+commonSay['hp']+" +300"+commonSay['allDef']+" 3"+commonSay['atkSpeed']+" +500"+commonSay['baseDmg']+" +15"+commonSay['crit']+"");

armorSetInfo(61,
"Almenos 2 items"," 2 partes:<br>+25% daño con daggers +1000"+commonSay['hp']+" +100"+commonSay['allDef']+" 1"+commonSay['atkSpeed']+" +100"+commonSay['baseDmg']+" +5"+commonSay['crit']+"<br>3 partes:<br> +10% chanse de Assassination +2000"+commonSay['hp']+" +200"+commonSay['allDef']+" 2"+commonSay['atkSpeed']+" +300"+commonSay['baseDmg']+" +10"+commonSay['crit']+"<br>4 partes:<br>+20% Penetración de Armadura +3000"+commonSay['hp']+" +300"+commonSay['allDef']+" 3"+commonSay['atkSpeed']+" +500"+commonSay['baseDmg']+" +15"+commonSay['crit']+"");

armorSetInfo(62,
"Almenos 2 items"," 2 partes:<br>Arrow Charge da el doble de flechas. +1000"+commonSay['hp']+" +100"+commonSay['allDef']+" +100"+commonSay['baseDmg']+"<br>3 partes:<br> Hit & Run menos 50% cooldown +2000"+commonSay['hp']+" +200"+commonSay['allDef']+" +200"+commonSay['baseDmg']+"<br>4 partes:<br>+15% "+commonSay['attack']+", +3000"+commonSay['hp']+" +300"+commonSay['allDef']+" +300"+commonSay['baseDmg']+"");

armorSetInfo(63,
"Almenos 2 items"," 2 partes:<br>No costo de mana en ataques basicos +1000"+commonSay['hp']+" +100"+commonSay['allDef']+" +200"+commonSay['baseDmg']+"<br>3 partes:<br> Doble Shot +15% daño +2000"+commonSay['hp']+" +200"+commonSay['allDef']+" +400"+commonSay['baseDmg']+"<br>4 partes:<br>Doble Shot menos 50% cooldown +3000"+commonSay['hp']+" +300"+commonSay['allDef']+" +600"+commonSay['baseDmg']+"");

armorSetInfo(64,
"Almenos 2 items"," 2 partes:<br>2+ Vel Ataque. +1000"+commonSay['hp']+" +100"+commonSay['allDef']+"<br>3 partes:<br> +250 Ataque, +250 Ataque Magico +2000"+commonSay['hp']+" +200"+commonSay['allDef']+"<br>4 partes:<br>Blood Blast +50% daño +3000"+commonSay['hp']+" +300"+commonSay['allDef']+"");

armorSetInfo(65,
"Almenos 2 items"," 2 partes:<br>+1000"+commonSay['hp']+" +100"+commonSay['allDef']+"<br>3 partes:<br> Bloody Combo menos 50% cooldown +2000"+commonSay['hp']+" +200"+commonSay['allDef']+"<br>4 partes:<br>Blood Lord dura 10min +3000"+commonSay['hp']+" +300"+commonSay['allDef']+"");


armorSetInfo(68,
"Casco Radamante<br>Guantes Radamante<br>Botas Radamante",
"+10000"+commonSay['hp']+"<br>+800"+commonSay['defBase']+"<br>+800"+commonSay['defMBase']+"<br>+3"+commonSay['atkSpeed']+"<br>+25%"+commonSay['attack']+"<br>+10"+commonSay['crit']+"<br>+25"+commonSay['critoPow']+"");

armorSetInfo(67,
"Casco Radamante<br>Guantes Radamante<br>Botas Radamante",
"+10000"+commonSay['hp']+"<br>+400"+commonSay['defBase']+"<br>+400"+commonSay['defMBase']+"<br>+5"+commonSay['castSpeed']+"<br>+25% "+commonSay['magicAttack']+"<br>+10"+commonSay['critMagico']+"<br>");

armorSetInfo(69,
"Casco Radamante<br>Guantes Radamante<br>Botas Radamante",
"+10000"+commonSay['hp']+"<br>+400"+commonSay['defBase']+"<br>+400"+commonSay['defMBase']+"<br>+12"+commonSay['crit']+"<br>+30%"+commonSay['attack']+"<br>+3"+commonSay['atkSpeed']+"<br>+50"+commonSay['critoPow']);



function enchantion(base,enchants)
{
	var baseN = parseInt(base);
	if(enchants>0)
	{
		var n= baseN + ((baseN/100)*(10*enchants));
		base = n.toFixed();
	}
	return base;//n.toFixed();
	
}
function itemGrade(lvl)
{
	var grade="NG";
	if(lvl>=20)
		grade="D";
	if(lvl>=40)
		grade="C";
	if(lvl>=52)
		grade="B";
	if(lvl>=61)
		grade="A";
	if(lvl>=74)
		grade="S";
	if(lvl>=80)
		grade="S80";
	if(lvl>=86)
		grade="X";
	if(lvl>=90)
		grade="Y";
	if(lvl>=110)
		grade="Z";			
	
	return grade;
}
///////////////
saThings = new Array();
saThings["AttackDmg_C"]="+100"+commonSay['attack'];
saThings["AttackDmg_B"]="+150"+commonSay['attack']+"<br>+1%"+commonSay['crit'];
saThings["AttackDmg_A"]="+220"+commonSay['attack']+"<br>+2%"+commonSay['crit'];
saThings["AttackDmg_S"]="+300"+commonSay['attack']+"<br>+3%"+commonSay['crit'];
saThings["AttackDmg_S80"]="+300"+commonSay['attack']+"<br>+3%"+commonSay['crit'];
saThings["AttackDmg_X"]="+350"+commonSay['attack']+"<br>+5%"+commonSay['crit'];
saThings["AttackDmg_Y"]="+400"+commonSay['attack']+"<br>+5%"+commonSay['crit'];
saThings["AttackDmg_Z"]="+450"+commonSay['attack']+"<br>+5%"+commonSay['crit'];

saThings["Heal_C"]="+600"+commonSay['hp'];
saThings["Heal_B"]="+1200"+commonSay['hp']+"<br>+10"+commonSay['def']+"<br>+20"+commonSay['VampireStance'];
saThings["Heal_A"]="+1800"+commonSay['hp']+"<br>+20"+commonSay['def']+"<br>+30"+commonSay['VampireStance'];
saThings["Heal_S"]="+2500"+commonSay['hp']+"<br>+35"+commonSay['def']+"<br>+35"+commonSay['VampireStance'];
saThings["Heal_S80"]="+3000"+commonSay['hp']+"<br>+40"+commonSay['def']+"<br>+40"+commonSay['VampireStance'];
saThings["Heal_X"]="+4000"+commonSay['hp']+"<br>+50"+commonSay['def']+"<br>+50"+commonSay['VampireStance'];
saThings["Heal_Y"]="+5000"+commonSay['hp']+"<br>+60"+commonSay['def']+"<br>+60"+commonSay['VampireStance'];
saThings["Heal_Z"]="+6000"+commonSay['hp']+"<br>+70"+commonSay['def']+"<br>+70"+commonSay['VampireStance'];


saThings["Defense_C"]="+50"+commonSay['def'];
saThings["Defense_B"]="+100"+commonSay['def']+"<br>+10%"+commonSay['shieldRate']+"";
saThings["Defense_A"]="+100"+commonSay['def']+"<br>+15%"+commonSay['shieldRate']+"";
saThings["Defense_S"]="+150"+commonSay['def']+"<br>+20%"+commonSay['shieldRate']+"";
saThings["Defense_S80"]="+200"+commonSay['def']+"<br>+25%"+commonSay['shieldRate']+"";
saThings["Defense_X"]="+250"+commonSay['def']+"<br>+30%"+commonSay['shieldRate']+"";
saThings["Defense_Y"]="+300"+commonSay['def']+"<br>+35%"+commonSay['shieldRate']+"";
saThings["Defense_Z"]="+350"+commonSay['def']+"<br>+40%"+commonSay['shieldRate']+"";


saThings["Acumen_C"]="+1"+commonSay['castSpeed'];
saThings["Acumen_B"]="+2"+commonSay['castSpeed'];
saThings["Acumen_A"]="+3"+commonSay['castSpeed']+"<br>+20"+commonSay['magicAttack'];
saThings["Acumen_S"]="+4"+commonSay['castSpeed']+"<br>+50"+commonSay['magicAttack'];
saThings["Acumen_S80"]="+4"+commonSay['castSpeed']+"<br>+75"+commonSay['magicAttack'];
saThings["Acumen_X"]="+5"+commonSay['castSpeed']+"<br>+150"+commonSay['magicAttack'];
saThings["Acumen_Y"]="+5"+commonSay['castSpeed']+"<br>+200"+commonSay['magicAttack'];
saThings["Acumen_Z"]="+5"+commonSay['castSpeed']+"<br>+250"+commonSay['magicAttack'];

saThings["Empower_C"]="+70"+commonSay['magicAttack'];
saThings["Empower_B"]="+100"+commonSay['magicAttack']+"<br>+1%"+commonSay['critMagico'];
saThings["Empower_A"]="+150"+commonSay['magicAttack']+"<br>+2%"+commonSay['critMagico'];
saThings["Empower_S"]="+200"+commonSay['magicAttack']+"<br>+3%"+commonSay['critMagico'];
saThings["Empower_S80"]="+250"+commonSay['magicAttack']+"<br>+4%"+commonSay['critMagico'];
saThings["Empower_X"]="+300"+commonSay['magicAttack']+"<br>+5%"+commonSay['critMagico'];
saThings["Empower_Y"]="+400"+commonSay['magicAttack']+"<br>+5%"+commonSay['critMagico'];
saThings["Empower_Z"]="+500"+commonSay['magicAttack']+"<br>+5%"+commonSay['critMagico'];

saThings["WildMagic_C"]="+5%"+commonSay['critMagico'];
saThings["WildMagic_B"]="+8%"+commonSay['critMagico'];
saThings["WildMagic_A"]="+10%"+commonSay['critMagico'];
saThings["WildMagic_S"]="+13%"+commonSay['critMagico'];
saThings["WildMagic_S80"]="+15%"+commonSay['critMagico'];
saThings["WildMagic_X"]="+16%"+commonSay['critMagico'];
saThings["WildMagic_Y"]="+17%"+commonSay['critMagico'];
saThings["WildMagic_Z"]="+18%"+commonSay['critMagico'];

saThings["Haste_C"]="+2"+commonSay['atkSpeed'];
saThings["Haste_B"]="+3"+commonSay['atkSpeed'];
saThings["Haste_A"]="+4"+commonSay['atkSpeed'];
saThings["Haste_S"]="+5"+commonSay['atkSpeed'];
saThings["Haste_S80"]="+5"+commonSay['atkSpeed'];
saThings["Haste_X"]="+5"+commonSay['atkSpeed'];
saThings["Haste_Y"]="+5"+commonSay['atkSpeed'];
saThings["Haste_Z"]="+5"+commonSay['atkSpeed'];

saThings["Focus_C"]="+5%"+commonSay['crit'];
saThings["Focus_B"]="+8%"+commonSay['crit'];
saThings["Focus_A"]="+10%"+commonSay['crit'];
saThings["Focus_S"]="+13%"+commonSay['crit']+"<br>+70"+commonSay['attack'];
saThings["Focus_S80"]="+15%"+commonSay['crit']+"<br>+80"+commonSay['attack'];
saThings["Focus_X"]="+15%"+commonSay['crit']+"<br>+100"+commonSay['attack'];
saThings["Focus_Y"]="+15%"+commonSay['crit']+"<br>+200"+commonSay['attack'];
saThings["Focus_Z"]="+15%"+commonSay['crit']+"<br>+300"+commonSay['attack'];

saThings["Vampire_C"]="+50"+commonSay['VampireStance'];
saThings["Vampire_B"]="+80"+commonSay['VampireStance'];
saThings["Vampire_A"]="+120"+commonSay['VampireStance'];
saThings["Vampire_S"]="+160"+commonSay['VampireStance'];
saThings["Vampire_S80"]="+180"+commonSay['VampireStance'];
saThings["Vampire_X"]="+200"+commonSay['VampireStance'];
saThings["Vampire_Y"]="+250"+commonSay['VampireStance'];
saThings["Vampire_Z"]="+300"+commonSay['VampireStance'];


saThings["Cost_C"]="-30% mp cost on skills";
saThings["Cost_B"]="-40% mp cost on skills";
saThings["Cost_A"]="-50% mp cost on skills<br>+1"+commonSay['castSpeed'];
saThings["Cost_S"]="-60% mp cost on skills<br>+1"+commonSay['castSpeed'];
saThings["Cost_S80"]="-60% mp cost on skills<br>+1"+commonSay['castSpeed'];
saThings["Cost_X"]="-60% mp cost on skills<br>+1"+commonSay['castSpeed'];
saThings["Cost_Y"]="-60% mp cost on skills<br>+1"+commonSay['castSpeed'];
saThings["Cost_X"]="-60% mp cost on skills<br>+1"+commonSay['castSpeed'];

saThings["Destruction_C"]="+25%"+commonSay['critoPow'];
saThings["Destruction_B"]="+30%"+commonSay['critoPow'];
saThings["Destruction_A"]="+35%"+commonSay['critoPow'];
saThings["Destruction_S"]="+40%"+commonSay['critoPow'];
saThings["Destruction_S80"]="+50%"+commonSay['critoPow'];
saThings["Destruction_X"]="+60%"+commonSay['critoPow'];
saThings["Destruction_Y"]="+70%"+commonSay['critoPow'];
saThings["Destruction_Z"]="+80%"+commonSay['critoPow'];

saThings["CheapShot_C"]="Basic attack has no mp cost on bows";
saThings["CheapShot_B"]="Basic attack has no mp cost on bows<br>+20% Doble Shot Damage";
saThings["CheapShot_A"]="Basic attack has no mp cost on bows<br>+30% Doble Shot Damage";
saThings["CheapShot_S"]="Basic attack has no mp cost on bows<br>+40% Doble Shot Damage";
saThings["CheapShot_S80"]="Basic attack has no mp cost on bows<br>+40% Doble Shot Damage";
saThings["CheapShot_X"]="Basic attack has no mp cost on bows<br>+40% Doble Shot Damage";
saThings["CheapShot_Y"]="Basic attack has no mp cost on bows<br>+40% Doble Shot Damage";
saThings["CheapShot_Z"]="Basic attack has no mp cost on bows<br>+40% Doble Shot Damage";

function saText(sa,grade)
{
	var texto="";
	texto=saThings[sa+"_"+grade];
	if(!texto)
		texto="Sa info: no found";
	return texto;
}
function makeDesc(cosasLocas,extra)
{
	var desc="";
	if(cosasLocas['SA']==1 && extra == "<br>")
		 desc+= "<div class=SA>Habilidad: "+cosasLocas['SAchar']+"<br>"+saText(cosasLocas['SAchar'],itemGrade(cosasLocas['Nivel']))+"</div>";
	if(cosasLocas['shieldDef']>0)
		 desc+= "+"+cosasLocas['shieldDef']+commonSay['shieldDef']+extra;
	if(cosasLocas['VidaLimit']>0)
		 desc+= "+"+cosasLocas['VidaLimit']+commonSay['hp']+extra;
	if(cosasLocas['ManaLimit']>0)
		 desc+= "+"+cosasLocas['ManaLimit']+commonSay['mp']+extra;
		 
	if(cosasLocas['Ataque']>0)
		 desc+= "+"+enchantion(cosasLocas['Ataque'],cosasLocas['enchant'])+commonSay['attack']+extra;
	if(cosasLocas['AtaqueMagico']>0)
		 desc+= "+"+enchantion(cosasLocas['AtaqueMagico'],cosasLocas['enchant'])+commonSay['magicAttack']+extra;
		 
	if(cosasLocas['Defensa']>0)
		 desc+= "+"+enchantion(cosasLocas['Defensa'],cosasLocas['enchant'])+commonSay['def']+extra;	
		 
	if(cosasLocas['DefensaMagica']>0)
		 desc+= "+"+enchantion(cosasLocas['DefensaMagica'],cosasLocas['enchant'])+commonSay['mDef']+extra; 
		 
	if(cosasLocas['Critico']>0)
		 desc+= "+"+cosasLocas['Critico']+commonSay['crit']+extra;	
	if(cosasLocas['PC']>0)
		 desc+= "+"+cosasLocas['PC']+commonSay['critoPow']+extra;	
	if(cosasLocas['CriticoMagico']>0)
		 desc+= "+"+cosasLocas['CriticoMagico']+commonSay['critMagico'];	
	if(cosasLocas['PCMagico']>0)
		 desc+= "+"+cosasLocas['PCMagico']+commonSay['critMagicoPow']+extra;	
	if(cosasLocas['epic']==1)
		desc+="<div class=epicItm>Epic: "+cosasLocas['textoLoco']+"</div>";
	
	if(cosasLocas['legendary']==1 && extra == "<br>")
		desc+="Attr Legendarios:<div class=legdesc>"+cosasLocas['atributos']+"";

	
		 
	desc+= "<div class=requiere>";
				desc+= "Tipo: "+cosasLocas['tipo']+"";
				if(cosasLocas['subtipo'])
					desc+= "("+cosasLocas['subtipo']+")"+extra;
				if(cosasLocas['tipo']=="W")
					desc+= " Manos: "+cosasLocas['hand']+" "+extra;
				desc+= " Grado: "+itemGrade(cosasLocas['Nivel'])+" Nivel: "+cosasLocas['Nivel']+" "+extra;
				
				if(cosasLocas['ClaseReq']>0)
					 desc+= "Clase: "+cosasLocas['txtClaseReq']+" "+extra;	 
		return desc;			 
}
