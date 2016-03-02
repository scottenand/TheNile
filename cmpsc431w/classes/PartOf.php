<?php

class PartOf extends Entity {
	public function __construct($args) {
		parent::__construct($args);
	}

	public static function getAttributeList() {
		return array('cid', 'pid');
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

		$attrs[$table]['cid']['type'] = "KEY";
		$attrs[$table]['pid']['type'] = "KEY";

		$attrs[$table]['FOREIGN']['keys'] = array(
			"cid",
			"pid");
		$attrs[$table]['FOREIGN']['ref'] = array(
			Category::getTableName() . "(" . Category::getPrimaryAttr() . ") ON UPDATE CASCADE ON DELETE CASCADE",
			Product::getTableName() . "(" . Product::getPrimaryAttr() . ") ON UPDATE CASCADE ON DELETE CASCADE");

		return $attrs;
	}

	public static function getTableName() {
		return "PartOf";
	}

	public static function getPrimaryAttr() {
		return "cid,pid";
	}
}

?>