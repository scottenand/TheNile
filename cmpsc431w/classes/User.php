<?php

class User extends Entity {
	public function __construct($args) {
		parent::__construct($args);
	}

	public static function getAttributeList() {
		return array('uid', 'name', 'email', 'username', 'password', 'income');
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

		$attrs[$table]['uid']['type'] = "KEY";
		$attrs[$table]['name']['type'] = "TEXT";
		$attrs[$table]['email']['type'] = "TEXT";
		$attrs[$table]['username']['type'] = "TEXT";
		$attrs[$table]['password']['type'] = "TEXT";
		$attrs[$table]['income']['type'] = "REAL";

		$attrs[$table]['uid']['restrictions'] = "AUTO_INCREMENT";
		$attrs[$table]['name']['restrictions'] = "NOT NULL";
		$attrs[$table]['email']['restrictions'] = "NOT NULL";
		$attrs[$table]['username']['restrictions'] = "NOT NULL";
		$attrs[$table]['password']['restrictions'] = "NOT NULL";

		return $attrs;
	}

	public static function getTableName() {
		return "User";
	}

	public static function getPrimaryAttr() {
		return "uid";
	}
}

include("Person.php");
include("Company.php");

?>