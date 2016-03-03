<?php

class Address extends Entity {
	public function __construct($args) {
		parent::__construct($args);
	}

	public static function getAttributeList() {
		return array('addr_id', 'username', 'description', 'defaultAddr', 'zip', 'street');
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

		$attrs[$table]['addr_id']['type'] = "KEY";
		$attrs[$table]['username']['type'] = "VARCHAR(20)";
		$attrs[$table]['description']['type'] = "TEXT";
		$attrs[$table]['defaultAddr']['type'] = "INT(11)";
		$attrs[$table]['zip']['type'] = "VARCHAR(5)";
		$attrs[$table]['street']['type'] = "TEXT";

		$attrs[$table]['addr_id']['restrictions'] = "AUTO_INCREMENT";
		$attrs[$table]['userame']['restrictions'] = "NOT NULL";
		$attrs[$table]['defaultAddr']['restrictions'] = "NOT NULL";
		$attrs[$table]['zip']['restrictions'] = "NOT NULL";
		$attrs[$table]['street']['restrictions'] = "NOT NULL";

		$attrs[$table]['FOREIGN']['keys'] = array(
			'username',
			'zip');
		$attrs[$table]['FOREIGN']['ref'] = array(
			User::getTableName() . '(' . User::getPrimaryAttr() . ') ON UPDATE CASCADE ON DELETE CASCADE',
			Located::getTableName() . '(' . Located::getPrimaryAttr() . ') ON UPDATE RESTRICT ON DELETE RESTRICT');

		return $attrs;
	}

	public static function getTableName() {
		return "Address";
	}

	public static function getPrimaryAttr() {
		return "addr_id";
	}
}

?>
