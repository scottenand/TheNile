<?php

class Phone extends Entity {
	public function __construct($args) {
		parent::__construct($args);
	}

	public static function getAttributeList() {
		return array('pnum', 'username', 'description', 'defaultPhone');
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

		$attrs[$table]['pnum']['type'] = "VARCHAR(10)";
		$attrs[$table]['username']['type'] = "VARCHAR(20)";
		$attrs[$table]['description']['type'] = "TEXT";
		$attrs[$table]['defaultPhone']['type'] = "INT(11)";

		$attrs[$table]['username']['restrictions'] = "NOT NULL";
		$attrs[$table]['defaultPhone']['restrictions'] = "NOT NULL";

		$attrs[$table]['FOREIGN']['keys'] = 'username';
		$attrs[$table]['FOREIGN']['ref'] = User::getTableName() . '(' . User::getPrimaryAttr() . ') ON UPDATE CASCADE ON DELETE CASCADE';

		return $attrs;
	}

	public static function getTableName() {
		return "Phone";
	}

	public static function getPrimaryAttr() {
		return "pnum";
	}
}

?>
