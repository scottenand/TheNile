<?php

include("classes/table.php");

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
	require_once("classes/" . $c . ".php");
}

?>