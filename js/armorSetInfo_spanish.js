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
commonSay['atkSpeed'] = " seg Velocidad de Ataque";
commonSay['castSpeed'] = " seg Velocidad de Casteo";
commonSay['hp'] = " Vida";
commonSay['mp'] = " Mana";
commonSay['magicAttack'] = " Ataque Magico";
commonSay['attack'] = " Ataque";
commonSay['def'] = " Defensa";
commonSay['mDef'] = " Defensa Magica";
commonSay['crit'] = " Critico";
commonSay['critMagico'] = " Critico Magico";
commonSay['critMagicoPow'] = " Daño en Critico Magico";
commonSay['critoPow'] = " Daño en Critico";
commonSay['shieldRate'] = " Chance de Bloquear Golpe";
commonSay['shieldDef'] = " Defensa de escudo";

commonSay['baseDmg'] = " Daño base";
commonSay['defBase'] = " Defensa base";
commonSay['defMBase'] = " Defensa Magica base";
commonSay['baseDmgMagic'] = " Daño magico base";

commonSay['blunt'] = " (usando arma tipo blunt)";
commonSay['dual'] = " (usando arma tipo dual)";
commonSay['dagger'] = " (usando arma tipo dagger)";
commonSay['sword'] = " (usando arma tipo dagger)";
commonSay['bow'] = " (usando arma tipo bow)";
commonSay['resistShock'] = " Resistencia a Stun";

commonSay['wtf1'] = " de tu Ataque Magico como Ataque";
commonSay['wtf2'] = " de tu Ataque como Ataque Magico";
commonSay['wtf3'] = " de vida";
commonSay['wtf4'] = " de tu Defensa como Ataque";
////////// SETS ///////////////
armorSetInfo(0,"ERROR!","Desc Vacia");

armorSetInfo(1,"Wooden Helmet","+4%"+commonSay['attack']+"<br>+1"+commonSay['atkSpeed']+"<br>+50"+commonSay['hp']);
armorSetInfo(2,"Devotion Circlet","+4"+commonSay['castSpeed']);
armorSetInfo(3,
"Mithril Helmet<br>Elven Mithril Gloves<br>Elven Mithril Boots",
"+2"+commonSay['castSpeed']+"<br>-1 INT<br>+2 WIT");

armorSetInfo(4,
"Helmet Of Knowledge<br>Gloves Of Knowledge<br>Boots Of Knowledge","+12%"+commonSay['magicAttack']+"<br>+2 WIT");

armorSetInfo(5,
"Manticore Helmet<br>Manticore Gloves<br>Manticore Boots","+3%"+commonSay['attack']+"<br>+100"+commonSay['mp']+"<br>+1 DEX");

armorSetInfo(6,
"Reinforced Helmet<br>Reinforced Gloves<br>Reinforced Boots","+2"+commonSay['atkSpeed']+"<br>+1 STR");

armorSetInfo(7,
"Brigandine Helmet<br>Brigandine Gloves<br>Brigandine Boots",
"+5%"+commonSay['def']+"<br>+1 CON<br>+100"+commonSay['hp']+" (Brigandine Shield)");

armorSetInfo(8,
"Mithril Helmet<br>Mithril Heavy Gloves<br>Mithril Heavy Boots",
"+4%"+commonSay['def']+"<br>+1 STR<br>+125"+commonSay['hp']+" (Hoplon)");

armorSetInfo(9,
"Karmian Helmet<br>Karmian Gloves<br>Karmian Shoes",
"+4"+commonSay['castSpeed']);

armorSetInfo(10,
"Demon Helmet<br>Demon Gloves<br>Demon Shoes",
"+5 INT<br>-2 WIT<br>+10%"+commonSay['critMagico']);

armorSetInfo(11,
"Drake Helmet<br>Drake Gloves<br>Drake Boots",
"+5%"+commonSay['attack']+"<br>+1"+commonSay['atkSpeed']+"<br>+12%"+commonSay['mDef']+"<br>+2 WIT");

armorSetInfo(12,
"Plated Leather Gloves<br>Plated Leather Boots",
"+5 STR<br>-1 CON");

armorSetInfo(13,
"Mithril Light Helmet<br>Mithril Light Gloves<br>Mithril Light Boots",
"+1"+commonSay['atkSpeed']+"<br>+15%"+commonSay['critoPow']+"<br>+4 DEX<br>-3 CON<br>-2 MEN");

armorSetInfo(14,
"Composite Helmet<br>Composite Gloves<br>Composite Boots",
"+5%"+commonSay['def']+"<br>+2 CON<br>+8%"+commonSay['attack']+" "+commonSay['blunt']+"<br>+10%"+commonSay['mDef']+" (Composite Shield)");

armorSetInfo(15,
"Chain Mail Helmet<br>Chain Mail Gloves<br>Chain Mail Boots",
"+10%"+commonSay['def']+"<br>+200"+commonSay['hp']+" (Chain Shield)");

armorSetInfo(16,
"Full Plate Helmet<br>Full Plate Gloves<br>Full Plate Boots",
"+1"+commonSay['atkSpeed']+"<br>+250"+commonSay['hp']+"<br>+1 CON<br>+1 STR<br>+12%"+commonSay['def']+" (Full Plate Shield)<br>+8%"+commonSay['mDef']+" (Full Plate Shield)");
armorSetInfo(17,
"Divine Helmet<br>Divine Gloves<br>Divine Shoes",
"+5%"+commonSay['def']+"<br>+250"+commonSay['mp']+"<br>+3"+commonSay['castSpeed']+"<br>+2 WIT<br>+1 INT");
armorSetInfo(18,
"Theca Helmet<br>Theca Gloves<br>Theca Boots",
"+5%"+commonSay['def']+"<br>+1"+commonSay['atkSpeed']+"<br>+2 STR<br>+1 DEX<br>-2 CON<br>+4%"+commonSay['attack']+commonSay['dual']+"<br>+1"+commonSay['atkSpeed']+commonSay['dual']+"");

armorSetInfo(19,
"Avadon Helmet<br>Avadon Gloves<br>Avadon Boots",
"+4"+commonSay['castSpeed']+"<br>+4%"+commonSay['magicAttack']+" (Avadon Shield)");

armorSetInfo(20,
"Zubei Helmet<br>Zubei Gloves<br>Zubei Boots",
"+2"+commonSay['castSpeed']+"<br>+12%"+commonSay['magicAttack']+"");

armorSetInfo(21,
"Zubei Helmet<br>Zubei Gloves<br>Zubei Boots",
"+3"+commonSay['atkSpeed']+"<br>+1 STR<br>+2 DEX<br>-2 CON<br>+10%"+commonSay['attack']+commonSay['sword']+"<br>+5%"+commonSay['crit']+commonSay['dagger']);

armorSetInfo(22,
"Avadon Helmet<br>Avadon Gloves<br>Avadon Boots",
"+1"+commonSay['atkSpeed']+"<br>+5%"+commonSay['def']+"<br>+15%"+commonSay['mDef']+"<br>+175"+commonSay['hp']+"<br>+10"+commonSay['bow']);

armorSetInfo(23,
"Avadon Helmet<br>Avadon Gloves<br>Avadon Boots",
"+8%"+commonSay['def']+"<br>+200"+commonSay['hp']+"<br>+2 CON<br>+5%"+commonSay['def']+commonSay['blunt']+"<br>+5%"+commonSay['def']+" (Avadon Shield)");

armorSetInfo(24,
"Zubei Helmet<br>Zubei Gloves<br>Zubei Boots",
"+1"+commonSay['atkSpeed']+"<br>+8%"+commonSay['attack']+"<br>+5%"+commonSay['attack']+commonSay['sword']);

armorSetInfo(25,
"Doom Helmet<br>Doom Gloves<br>Doom Boots",
"+5%"+commonSay['attack']+"<br>+40"+commonSay['baseDmg']+"<br>+3 DEX");

armorSetInfo(26,
"Doom Helmet<br>Doom Gloves<br>Doom Boots",
"+15%"+commonSay['magicAttack']+"<br>+25%"+commonSay['critMagicoPow']+"<br>+8 INT");

armorSetInfo(27,
"Doom Helmet<br>Doom Gloves<br>Doom Boots",
"+1500"+commonSay['hp']+"<br>+3 CON<br>+12%"+commonSay['defBase']+""+commonSay['blunt']+"<br>+15"+commonSay['defBase']+"<br>-25%"+commonSay['shieldRate']+" (Doom Shield)");

armorSetInfo(28,
"Blue Wolf Helmet<br>Blue Wolf Gloves<br>Blue Wolf Boots",
"+800"+commonSay['mp']+"<br>+3"+commonSay['castSpeed']+"<br>+3 WIT<br>+2 MEN<br>+8%"+commonSay['critMagico']+commonSay['blunt']+"<br>+1"+commonSay['castSpeed']+commonSay['blunt']);
armorSetInfo(29,
"Blue Wolf Helmet<br>Blue Wolf Gloves<br>Blue Wolf Boots",
"+2"+commonSay['atkSpeed']+"<br>+500"+commonSay['hp']+"<br>+500"+commonSay['mp']+"<br>+40"+commonSay['baseDmg']);
armorSetInfo(30,
"Blue Wolf Helmet<br>Blue Wolf Gloves<br>Blue Wolf Boots",
"+1"+commonSay['atkSpeed']+"<br>+8%"+commonSay['crit']+"<br>+30"+commonSay['baseDmg']);

armorSetInfo(31,
"Dark Crystal Helmet<br>Dark Crystal Gloves<br>Dark Crystal Boots",
"+75"+commonSay['baseDmg']+"<br>+2 DEX<br>+1 STR<br>+25%"+commonSay['critoPow']+commonSay['dagger']);
armorSetInfo(32,
"Dark Crystal Helmet<br>Dark Crystal Gloves<br>Dark Crystal Boots",
"+2"+commonSay['castSpeed']+"<br>+2 WIT<br>75"+commonSay['baseDmgMagic']+"<br>+2"+commonSay['castSpeed']+"(Dark Crystal Shield)<br>+15"+commonSay['baseDmgMagic']+commonSay['sword']);
armorSetInfo(33,
"Dark Crystal Helmet<br>Dark Crystal Gloves<br>Dark Crystal Boots",
"+125"+commonSay['defBase']+"<br><br>+2600"+commonSay['hp']+"<br>+2 CON<br>+18%"+commonSay['shieldRate']+" (Dark Crystal Shield)");

armorSetInfo(34,
"Tallum Helmet<br>Tallum Gloves<br>Tallum Boots",
"+75"+commonSay['baseDmg']+"<br>+500"+commonSay['mp']+"<br>+15"+commonSay['defBase']+commonSay['bow']);
armorSetInfo(35,
"Tallum Helmet<br>Tallum Gloves<br>Tallum Boots",
"+50"+commonSay['baseDmg']+"<br>+50"+commonSay['defBase']+"<br>+1500"+commonSay['hp']);
armorSetInfo(36,
"Tallum Helmet<br>Tallum Gloves<br>Tallum Boots",
"+50"+commonSay['baseDmgMagic']+"<br>+8%"+commonSay['mDef']+"<br>+1500"+commonSay['mp']+"<br>+5 INT");

armorSetInfo(37,
"Nightmare Helmet<br>Nightmare Gloves<br>Nightmare Boots",
"200"+commonSay['defBase']+"<br>+3000"+commonSay['hp']+"<br>+50"+commonSay['defBase']+"(Shield Of Nightmare)");
armorSetInfo(38,
"Nightmare Helmet<br>Nightmare Gloves<br>Nightmare Boots",
"+1"+commonSay['atkSpeed']+"<br>+35%"+commonSay['critoPow']+"<br>+125"+commonSay['baseDmg']+"<br>+3 DEX<br>+3 STR<br>+3 CON");
armorSetInfo(39,
"Nightmare Helmet<br>Nightmare Gloves<br>Nightmare Boots",
"+100"+commonSay['baseDmgMagic']+"<br>+4"+commonSay['castSpeed']+"<br>+8 INT<br>+5 WIT");

armorSetInfo(40,
"Majestic Helmet<br>Majestic Gloves<br>Majestic Boots",
"+2"+commonSay['atkSpeed']+"<br>+80"+commonSay['defBase']+"<br>+80"+commonSay['baseDmg']+"<br>+1000"+commonSay['hp']+"<br>+1000"+commonSay['mp']+"<br>+2 STR<br>+2 CON");
armorSetInfo(41,
"Majestic Helmet<br>Majestic Gloves<br>Majestic Boots",
"+250"+commonSay['mp']+"<br>+100"+commonSay['baseDmg']+"<br>+3 DEX<br>-1 CON<br>+50"+commonSay['baseDmg']+commonSay['bow']);
armorSetInfo(42,
"Majestic Helmet<br>Majestic Gloves<br>Majestic Boots",
"+2500"+commonSay['mp']+"<br>+1000"+commonSay['hp']+"<br>+80"+commonSay['baseDmgMagic']+"<br>+9 INT<br>+11 WIT");

armorSetInfo(43,
"Imperial Helmet<br>Imperial Gloves<br>Imperial Boots",
"+5000"+commonSay['hp']+"<br>+1"+commonSay['atkSpeed']+"<br>+300"+commonSay['defBase']+"<br>+3 STR<br>+3 CON<br>+100"+commonSay['defBase']+" (Imperial Shield)<br>+100"+commonSay['defMBase']+" (Imperial Shield)<br>+500"+commonSay['hp']+" (Imperial Crusader Shield)<br>+100"+commonSay['baseDmg']+" (NO Imperial Shield)<br>+1"+commonSay['atkSpeed']+" (NO Imperial Shield)");

armorSetInfo(44,
"Arcana Helmet<br>Arcana Gloves<br>Arcana Boots",
"+3000"+commonSay['mp']+"<br>+1500"+commonSay['hp']+"<br>+4"+commonSay['castSpeed']+"<br>+150"+commonSay['baseDmgMagic']+"<br>+12 INT<br>+12 WIT");

armorSetInfo(45,
"Draconic Helmet<br>Draconic Gloves<br>Draconic Boots",
"+3000"+commonSay['mp']+"<br>+250"+commonSay['baseDmg']+"<br>+5 STR<br>+5 DEX<br>+50"+commonSay['baseDmg']+commonSay['bow']+"<br>+35%"+commonSay['critoPow']+commonSay['dagger']);

function enchantion(base,enchants)
{
	var baseN = parseInt(base);
	if(enchants>0)
	{
		var n= baseN + ((baseN/100)*20);
		base = n.toFixed();
	}
	return base;//n.toFixed();
	
}
function makeDesc(cosasLocas,extra)
{
	var desc="";
	if(cosasLocas['SA']==1 && extra == "<br>")
		 desc+= "<div class=SA>Habilidad: "+cosasLocas['SAchar']+"</div>";
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
	
		/*if(itemsCatch[i]['Fuego']>0)
					 desc+= "+"+itemsCatch[i]['Fuego']+" fire ";	 
				if(itemsCatch[i]['Agua']>0)
					 desc+= "+"+itemsCatch[i]['Agua']+" water ";	
				if(itemsCatch[i]['Aire']>0)
					 desc+= "+"+itemsCatch[i]['Aire']+" air ";
				if(itemsCatch[i]['Tierra']>0)
					 desc+= "+"+itemsCatch[i]['Tierra']+" earth ";	
				if(itemsCatch[i]['Dark']>0)
					 desc+= "+"+itemsCatch[i]['Dark']+" dark ";	
				if(itemsCatch[i]['Light']>0)
					 desc+= "+"+itemsCatch[i]['Light']+" light ";
					 
				if(itemsCatch[i]['RFuego']>0)
					 desc+= "+"+itemsCatch[i]['RFuego']+" Rfuego ";	 
				if(itemsCatch[i]['RAgua']>0)
					 desc+= "+"+itemsCatch[i]['RAgua']+" Ragua ";	
				if(itemsCatch[i]['RAire']>0)
					 desc+= "+"+itemsCatch[i]['RAire']+" Raire ";
				if(itemsCatch[i]['RTierra']>0)
					 desc+= "+"+itemsCatch[i]['RTierra']+" Rtierra ";	
				if(itemsCatch[i]['RDark']>0)
					 desc+= "+"+itemsCatch[i]['RDark']+" Rdark ";	
				if(itemsCatch[i]['RLight']>0)
					 desc+= "+"+itemsCatch[i]['RLight']+" Rlight ";*/
		 
	desc+= "<div class=requiere>";
				desc+= "Tipo: "+cosasLocas['tipo']+"";
				if(cosasLocas['subtipo'])
					desc+= "("+cosasLocas['subtipo']+")"+extra;
				if(cosasLocas['tipo']=="W")
					desc+= " Manos: "+cosasLocas['hand']+" "+extra;
				desc+= " Nivel: "+cosasLocas['Nivel']+" "+extra;
				
				if(cosasLocas['ClaseReq']>0)
					 desc+= "Clase: "+cosasLocas['txtClaseReq']+" "+extra;	 
		return desc;			 
}

