<?php

include("../Header.php");

createTables($CLASSES);

echo("\n\n\n\n\n\n\n");

$tables = array();
foreach($CLASSES as $i => $c) {
	if(is_array($c)) {
		foreach($c as $ci => $cn) {
			if(is_array($cn)) {
				foreach($cn as $cnn) {
					if(is_string($cnn))
						$tables = array_merge($tables, $cnn::create_table());
				}
			} elseif(is_string($cn))
				$tables = array_merge($tables, $cn::create_table());
		}
	} elseif(is_string($c))
		$tables = array_merge($tables, $c::create_table());
}
echo(implode("\n\n", $tables));

?>