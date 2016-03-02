<?php

$CLASSES = array(
"Entity" => array(
	"User" => array(
		"Person",
		"Company"
	),
	"Located",
		"Address",
	"Phone",
	"Creditcard",
	"UserRating",

	"Product" => array(
		"Purchase",
		"Auction",
	),
	"Category",
		"PartOf",
		"ParentCategory",
	"RatedBy",
	"Acquired",
		"PurchasedBy"
));

// INCLUDE ABOVE CLASSES : up to 3 levels deep
define("FOLDER", "classes/");
foreach($CLASSES as $i => $c) {
	if(is_array($c)) {
		require_once(FOLDER . $i . ".php");
		foreach($c as $ci => $cn) {
			if(is_array($cn)) {
				require_once(FOLDER . $ci . ".php");
				foreach($cn as $cii => $cnn) {
					if(is_string($cnn))
						require_once(FOLDER . $cnn . ".php");
				}
			} elseif(is_string($cn))
				require_once(FOLDER . $cn . ".php");
		}
	} elseif(is_string($c))
		require_once(FOLDER . $c . ".php");
}

?>