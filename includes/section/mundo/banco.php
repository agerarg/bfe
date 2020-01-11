<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
/*
function checkChanges($name)
{
	global $moneda,$template;
	if($moneda[$name.'Change']!=0)
	{
		if($moneda[$name.'Change']>0)
			$moneda[$name.'Change']=(-$moneda[$name.'Change']);
		else
			$moneda[$name.'Change']=abs($moneda[$name.'Change']);

		if($moneda[$name.'Change']<0)
			$fnstring = 'coinDOWN';
		else
			$fnstring = 'coinUP';
		$template->assign_var($name.'Change','  <span class="'.$fnstring.'">'.$moneda[$name.'Change'].'%</span>');
	}
}					
		$goFight=0;
		$template->set_filenames(array(
				'content' => 'templates/sec/banco.html' ));
		
		$query = 'SELECT * FROM monedas';
		$monedasq = $db->sql_query($query);
		$moneda = $db->sql_fetchrow($monedasq);

		$template->assign_var('reroll', $moneda['reroll']);
		$template->assign_var('rerollOP', optimalDmg($moneda['reroll']));
		$template->assign_var('chaos', $moneda['chaos']);
		$template->assign_var('chaosOP', optimalDmg($moneda['chaos']));
		$template->assign_var('upulus', $moneda['upulus']);
		$template->assign_var('upulusOP', optimalDmg($moneda['upulus']));
		$template->assign_var('exodimo', $moneda['exodimo']);
		$template->assign_var('exodimoOP', optimalDmg($moneda['exodimo']));
		$template->assign_var('alchemist', $moneda['alchemist']);	
		$template->assign_var('alchemistOP', optimalDmg($moneda['alchemist']));							
		$template->assign_var('corruption', $moneda['corruption']);
		$template->assign_var('corruptionOP', optimalDmg($moneda['corruption']));

		checkChanges("reroll");
		checkChanges("chaos");
		checkChanges("upulus");
		checkChanges("exodimo");
		checkChanges("alchemist");
		checkChanges("corruption");	
		
		$_SESSION['secure_section']="bank";
			*/
									
?> 