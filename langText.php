<?php
  $GLOBALS["messages"] = array (
    'en'=> array(
      'Monday' => 'Monday',
      'Tuesday' => 'Tuesday',
      'Wednesday' => 'Wednesday',
      'Thursday' => 'Thursday',
      'Friday' => 'Friday',
      'Saturday' => 'Saturday',
      'Sunday' => 'Sunday'
    ),
    'de'=> array(
      'Monday' => 'Montag',
      'Tuesday' => 'Dienstag',
      'Wednesday' => 'Mittwoch',
      'Thursday' => 'Donnerstag',
      'Friday' => 'Frietag',
      'Saturday' => 'Samstag',
      'Sunday' => 'Sontag'
    )
);
function msg($s) {
  $locale = $_SESSION["locale"];
    
  if (isset($GLOBALS["messages"][$locale][$s])) {
    return $GLOBALS["messages"][$locale][$s];
  } else {
    error_log("l10n error: locale: "."$locale, message:'$s'");
  }
}


session_start();
$_SESSION["locale"]="de";
print msg('Sunday');