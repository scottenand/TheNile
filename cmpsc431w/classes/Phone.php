<?php

class Phone extends Entity {
	public function __construct($args) {
		parent::__construct($args);
	}

	public static function getAttributeList() {
		return array('phone_id', 'uid', 'description', 'defaultPhone', 'pnum');
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

		$attrs[$table]['phone_id']['type'] = "KEY";
		$attrs[$table]['uid']['type'] = "KEY";
		$attrs[$table]['description']['type'] = "TEXT";
		$attrs[$table]['defaultPhone']['type'] = "INT(11)";
		$attrs[$table]['pnum']['type'] = "TEXT";

		$attrs[$table]['phone_id']['restrictions'] = "AUTO_INCREMENT";
		$attrs[$table]['uid']['restrictions'] = "NOT NULL";
		$attrs[$table]['defaultPhone']['restrictions'] = "NOT NULL";
		$attrs[$table]['pnum']['restrictions'] = "NOT NULL";

		$attrs[$table]['FOREIGN']['keys'] = 'uid';
		$attrs[$table]['FOREIGN']['ref'] = User::getTableName() . '(' . User::getPrimaryAttr() . ')';

		return $attrs;
	}

	public static function getTableName() {
		return "Phone";
	}

	public static function getPrimaryAttr() {
		return "phone_id";
	}
}

?>