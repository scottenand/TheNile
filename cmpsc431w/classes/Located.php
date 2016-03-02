<?php

class Located extends Entity {
	public function __construct($args) {
		parent::__construct($args);
	}

	public static function getAttributeList() {
		return array('zip', 'city', 'state');
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

		$attrs[$table]['zip']['type'] = "VARCHAR(5)";
		$attrs[$table]['city']['type'] = "TEXT";
		$attrs[$table]['state']['type'] = "TEXT";

		$attrs[$table]['city']['restrictions'] = "NOT NULL";
		$attrs[$table]['state']['restrictions'] = "NOT NULL";

		return $attrs;
	}

	public static function getTableName() {
		return "Located";
	}

	public static function getPrimaryAttr() {
		return "zip";
	}
}

?>