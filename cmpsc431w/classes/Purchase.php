<?php

class Purchase extends Product {
	public function __construct($args) {
		parent::__construct($args);
	}

	public static function getAttributeList() {
		return array_merge(array('pid', 'qty'), parent::getAttributeList());
	}

	/**
	 * Gets SQL Info in 3-dimensional array format
	 * INFO		: 'type' : PRIMARY / TEXT / REAL / INT / etc.
	 * 			: 'restrictions' : NOT NULL / etc.
	 * 			: 'foreign' : Table_Name(attr) [ ON UPDATE ___ ] [ ON DELETE ___ ]
	 * @return array [ TABLE_NAME ] [ ATTR_NAME ] [ INFO ] = STRING VALUE
	 */
	protected function getSQLInfo() {
		return array_merge(self::getStaticSQLInfo(), $this->attrs, parent::getSQLInfo());
	}

	protected static function getStaticSQLInfo() {
		$attrs = array();
		$table = self::getTableName();

		$attrs[$table]['pid']['type'] = "KEY";
		$attrs[$table]['qty']['type'] = "INT(11)";

		$attrs[$table]['FOREIGN']['keys'] = "pid";
		$attrs[$table]['FOREIGN']['ref'] = parent::getTableName() . "(" . parent::getPrimaryAttr() . ") ON UPDATE CASCADE ON DELETE CASCADE";

		return $attrs;
	}

	public static function getTableName() {
		return "Purchase";
	}

	public static function getPrimaryAttr() {
		return "pid";
	}

	
}

?>