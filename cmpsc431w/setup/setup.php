<?php

include("../Header.php");

createTables($CLASSES);

echo("\n\n\n\n\n\n\n");

$tables = array();
foreach($CLASSES as $c) {
	$tables = array_merge($tables, $c::create_table());
}
echo(implode("\n\n", $tables));

?>