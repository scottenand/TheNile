<?php

include("../Header.php");

createTables($CLASSES);

echo("\n\n\n\n\n\n\n");

$tables = array();
$tableAttrs = array();

foreach($CLASSES as $i => $c) {
	if(is_array($c)) {
		if($i != "Entity") {
			$tableAttrs[] = $i . "(" . implode(", ", $i::getAttributeList()) . ")";
			$tables = array_merge($tables, $i::create_table());
		}
		foreach($c as $ci => $cn) {
			if(is_array($cn)) {
				$tableAttrs[] = $ci . "(" . implode(", ", $ci::getAttributeList()) . ")";
				$tables = array_merge($tables, $ci::create_table());
				foreach($cn as $cnn) {
					if(is_string($cnn)) {
						$tableAttrs[] = $cnn . "(" . implode(", ", $cnn::getAttributeList()) . ")";
						$tables = array_merge($tables, $cnn::create_table());
					}
				}
			} elseif(is_string($cn)) {
				$tableAttrs[] = $cn . "(" . implode(", ", $cn::getAttributeList()) . ")";
				$tables = array_merge($tables, $cn::create_table());
			}
		}
	} elseif(is_string($c)) {
		$tableAttrs[] = $c . "(" . implode(", ", $c::getAttributeList()) . ")";
		$tables = array_merge($tables, $c::create_table());
	}
}
echo(implode("\n", $tableAttrs));
echo("\n\n");
echo(implode("\n\n", $tables));

?>