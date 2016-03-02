<?php

class PurchasedBy extends Entity {
	public function __construct($args) {
		parent::__construct($args);
	}

	public static function getAttributeList() {
		return array('pid', 'uid', 'time', 'unitPrice', 'qty', 'acq_id');
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

		$attrs[$table]['pid']['type'] = "KEY";
		$attrs[$table]['uid']['type'] = "KEY";
		$attrs[$table]['unitPrice']['type'] = "REAL";
		$attrs[$table]['qty']['type'] = "INT(11)";
		$attrs[$table]['time']['type'] = "DATETIME";
		$attrs[$table]['acq_id']['type'] = "KEY";

		$attrs[$table]['FOREIGN']['keys'] = array(
			'pid',
			'uid',
			'acq_id');
		$attrs[$table]['FOREIGN']['ref'] = array(
			Product::getTableName() . "(" . Product::getPrimaryAttr() . ") ON UPDATE CASCADE ON DELETE RESTRICT",
			User::getTableName() . "(" . User::getPrimaryAttr() . ") ON UPDATE CASCADE ON DELETE RESTRICT",
			Acquired::getTableName() . "(" . Acquired::getPrimaryAttr() . ") ON UPDATE CASCADE ON DELETE RESTRICT");

		return $attrs;
	}

	public static function getTableName() {
		return "PurchasedBy";
	}

	public static function getPrimaryAttr() {
		return "pid, uid, time";
	}
}

?>