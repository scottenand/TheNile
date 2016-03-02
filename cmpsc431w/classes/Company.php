<?php

class Company extends User {
	public function __construct($args) {
		parent::__construct($args);
	}

	public static function getAttributeList() {
		return array_merge(array('uid', 'company_cat', 'PoC'), parent::getAttributeList());
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

		$attrs[$table]['uid']['type'] = "KEY";
		$attrs[$table]['company_cat']['type'] = "TEXT";
		$attrs[$table]['PoC']['type'] = "KEY";

		$attrs[$table]['company_cat']['restrictions'] = "NOT NULL";
		$attrs[$table]['PoC']['restrictions'] = "NOT NULL";

		$attrs[$table]['FOREIGN']['keys'] = array(
			'uid',
			'PoC');
		$attrs[$table]['FOREIGN']['ref'] = array(
			parent::getTableName() . "(" . parent::getPrimaryAttr() . ") ON UPDATE CASCADE ON DELETE CASCADE",
			Person::getTableName() . "(" . Person::getPrimaryAttr() . ") ON UPDATE RESTRICT ON DELETE RESTRICT");

		return $attrs;
	}

	public static function getTableName() {
		return "Company";
	}

	public static function getPrimaryAttr() {
		return "uid";
	}
}

?>