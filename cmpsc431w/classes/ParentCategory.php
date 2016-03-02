<?php

class ParentCategory extends Entity {
	public function __construct($args) {
		parent::__construct($args);
	}

	public static function getAttributeList() {
		return array('child', 'parent');
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

		$attrs[$table]['child']['type'] = "KEY";
		$attrs[$table]['parent']['type'] = "KEY";

		$attrs[$table]['parent']['restrictions'] = "NOT NULL";

		$attrs[$table]['FOREIGN']['keys'] = array(
			"child",
			"parent");
		$attrs[$table]['FOREIGN']['ref'] = array(
			Category::getTableName() . "(" . Category::getPrimaryAttr() . ") ON UPDATE CASCADE ON DELETE CASCADE",
			Category::getTableName() . "(" . Category::getPrimaryAttr() . ") ON UPDATE CASCADE ON DELETE RESTRICT");

		return $attrs;
	}

	public static function getTableName() {
		return "ParentCategory";
	}

	public static function getPrimaryAttr() {
		return "child";
	}
}

?>