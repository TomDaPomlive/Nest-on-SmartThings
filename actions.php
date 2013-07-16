<?php

require_once('nest.class.php');

// Your Nest username and password.
define('USERNAME', $_POST['user']);
define('PASSWORD', $_POST['password']);
$action = $_POST['action'];
$temp  = isset($_POST['temp']) ? $_POST['temp'] : 72;

// The timezone you're in.
// See http://php.net/manual/en/timezones.php for the possible values.
date_default_timezone_set('America/Montreal');

$nest = new Nest();

switch ($action) {
	case 'fanauto':
		echo "Setting fan mode ".$action."\n";
		$success = $nest->setFanMode(FAN_MODE_AUTO); 
		break;
	case 'fanon':
		echo "Setting fan mode ".$action."\n";
		$success = $nest->setFanMode(FAN_MODE_ON);
		break;
	case 'away':
		echo "Setting away mode...\n";
		$success = $nest->setAway(AWAY_MODE_ON);	
		break;
	case 'heat':
		echo "Setting mode heat ".$action."\n";
		$success = $nest->setTargetTemperatureMode(TARGET_TEMP_MODE_HEAT,$temp);
		break;
	case 'cool':
		echo "Setting mode cool...\n";
		$success = $nest->setAway(AWAY_MODE_OFF);
		$success = $nest->setTargetTemperatureMode(TARGET_TEMP_MODE_COOL,$temp);	
		break;
	case 'settemp':
		echo "Setting temp to ".$temp."...\n";
		$success = $nest->setTargetTemperature($temp);	
		break;
	default:
		$success = "Fail";
}		
var_dump($success);

// FAN
// Available: FAN_MODE_AUTO or FAN_MODE_EVERY_DAY_OFF, FAN_MODE_ON or FAN_MODE_EVERY_DAY_ON
// setFanMode() can also take an array as it's argument. See the comments below for examples (FAN_MODE_TIMER, FAN_MODE_MINUTES_PER_HOUR).