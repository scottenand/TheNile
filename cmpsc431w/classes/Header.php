<?php

include("table.php");

$CLASSES = array(
	"User",
		"Person",
		"Company",

		"Address",
		"Phone",
		"Creditcard",
		"UserRating",


	"Product",
		"Purchase",
		"Auction",

		"Category",
			"PartOf",
			"ParentCategory",
		"RatedBy",
		"Acquired",
			"PurchasedBy"
);

foreach($CLASSES as $c) {
	require_once($c . ".php");
}

createTables($CLASSES);

echo("\n\n\n\n\n\n\n");

$tables = array();
foreach($CLASSES as $c) {
	$tables = array_merge($tables, $c::create_table());
}
echo(implode("\n\n", $tables));

?>