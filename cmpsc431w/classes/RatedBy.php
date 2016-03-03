<?php

class RatedBy extends Entity {
	public function __construct($args) {
		parent::__construct($args);
	}

	public static function getAttributeList() {
		return array('pid', 'username', 'rating', 'description', 'time');
	}

	/**
	 * Gets SQL Info in 3-dimensional array format
	 * INFO		: 'type' : PRIMARY / TEXT / REAL / INT / etc.
	 * 			: 'restrictions' : NOT NULL / etc.
	 * 			: 'foreign' : Table_Name(attr) [ ON UPDATE ___ ] [ ON DELETE ___ ]
	 * @return array [ TABLE_NAME ] [ ATTR_NAME ] [ INFO ] = STRING VALUE
	 */
	protected function getSQLInfo() {
		$attrs = array_merge(self::getStaticSQLInfo(), $this->attrs);

		return $attrs;
	}

	protected static function getStaticSQLInfo() {
		$attrs = array();
		$table = self::getTableName();

		$attrs[$table]['pid']['type'] = "KEY";
		$attrs[$table]['username']['type'] = "VARCHAR(20)";
		$attrs[$table]['rating']['type'] = "INT(11)";
		$attrs[$table]['description']['type'] = "TEXT";
		$attrs[$table]['time']['type'] = "DATETIME";

		$attrs[$table]['FOREIGN']['keys'] = array(
			"pid",
			"username");
		$attrs[$table]['FOREIGN']['ref'] = array(
			Product::getTableName() . "(" . Product::getPrimaryAttr() . ") ON UPDATE CASCADE ON DELETE CASCADE",
			User::getTableName() . "(" . User::getPrimaryAttr() . ") ON UPDATE CASCADE ON DELETE CASCADE");

		return $attrs;
	}

	public static function getTableName() {
		return "RatedBy";
	}

	public static function getPrimaryAttr() {
		return "pid, username";
	}
}

?>
