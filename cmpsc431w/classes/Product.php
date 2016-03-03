<?php

class Product extends Entity {
	public function __construct($args) {
		parent::__construct($args);
	}

	public static function getAttributeList() {
		return array('pid', 'pname', 'location', 'description', 'buy_out', 'sold_by', 'img');
	}

	/**
	 * Gets SQL Info in 3-dimensional array format
	 * INFO		: 'type' : PRIMARY / TEXT / REAL / INT / etc.
	 * 			: 'restrictions' : string : NOT NULL / etc.
	 * 			: 'foreign' : string : Table_Name(attr) [ ON UPDATE ___ ] [ ON DELETE ___ ]
	 * @return array [ TABLE_NAME ] [ ATTR_NAME ] [ INFO ] = STRING VALUE
	 */
	protected function getSQLInfo() {
		return array_merge(self::getStaticSQLInfo(), $this->attrs);
	}

	protected static function getStaticSQLInfo() {
		$attrs = array();
		$table = self::getTableName();

		$attrs[$table]['pid']['type'] = "KEY";
		$attrs[$table]['pname']['type'] = "TEXT";
		$attrs[$table]['location']['type'] = "TEXT";
		$attrs[$table]['description']['type'] = "TEXT";
		$attrs[$table]['buy_out']['type'] = "REAL";
		$attrs[$table]['sold_by']['type'] = "VARCHAR(20)";
		$attrs[$table]['img']['type'] = "TEXT";

		$attrs[$table]['pid']['restrictions'] = "AUTO_INCREMENT";
		$attrs[$table]['pname']['restrictions'] = "NOT NULL";
		$attrs[$table]['description']['restrictions'] = "NOT NULL";
		$attrs[$table]['buy_out']['restrictions'] = "NOT NULL";
		$attrs[$table]['sold_by']['restrictions'] = "NOT NULL";

		$attrs[$table]['sold_by']['foreign'] = User::getTableName() . "(" . User::getPrimaryAttr() . ") ON UPDATE CASCADE ON DELETE RESTRICT";

		return $attrs;
	}

	protected static function getTableName() {
		return "Product";
	}

	protected static function getPrimaryAttr() {
		return "pid";
	}
}

include("Purchase.php");
include("Auction.php");

?>
