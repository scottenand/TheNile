<?php

define("LOG_OUTPUT", 0x1);
define("LOG_FILE", 0x2);

define("LVL_ERROR", 1);
define("LVL_WARNING", 2);
define("LVL_DEFAULT", 3);

$fileLog = "log.txt";

date_default_timezone_set("America/New_York");

function logMsg($msg, $to = LOG_OUTPUT, $lvl = LVL_DEFAULT) {
	$msg = date("(n/j/Y H:i:s) ") . $msg;
	if($lvl == LVL_ERROR) {
		$msg = "[ERROR] " . $msg;
	} elseif($lvl == LVL_WARNING) {
		$msg = "[WARNING] " . $msg;
	}

	if($to & LOG_OUTPUT) {
		echo($msg);
	} if($to & LOG_FILE) {
		file_put_contents($fileLog, $msg);
	}
}

function createTables($classes) {
	$tables = array();

	foreach($classes as $c) {
		$tables = array_merge($tables, $c::create_table());
	}

	$d = new database();
	$d->open();
	foreach($tables as $t => $q) {
		$r = $d->query($q);
		if($r === TRUE) {
			echo("Table " . $t . " created!\n");
		} else {
			echo("Table " . $t . " failed:");
			echo($d->getError() . "\n");
		}
	}
	$d->close();
}

?>