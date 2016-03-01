<?php

class UserRating extends Entity {
	public function __construct($args) {
		parent::__construct($args);
	}

	public static function getAttributeList() {
		return array('rater', 'ratee', 'rating', 'description');
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

		$attrs[$table]['rater']['type'] = "KEY";
		$attrs[$table]['ratee']['type'] = "KEY";
		$attrs[$table]['rating']['type'] = "INT(11)";
		$attrs[$table]['description']['type'] = "TEXT";

		$attrs[$table]['ratee']['restrictions'] = "NOT NULL";

		$attrs[$table]['FOREIGN']['keys'] = array(
			'rater',
			'ratee');
		$attrs[$table]['FOREIGN']['ref'] = array(
			User::getTableName() . "(" . User::getPrimaryAttr() . ")",
			User::getTableName() . "(" . User::getPrimaryAttr() . ")");

		return $attrs;
	}

	public static function getTableName() {
		return "UserRating";
	}

	public static function getPrimaryAttr() {
		return "rater, ratee";
	}
}

?>