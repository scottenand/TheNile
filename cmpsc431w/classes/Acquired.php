<?php

class Acquired extends Entity {
	public function __construct($args) {
		parent::__construct($args);
	}

	public static function getAttributeList() {
		return array('acq_id', 'card_id', 'addr_id');
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

		$attrs[$table]['acq_id']['type'] = "KEY";
		$attrs[$table]['card_id']['type'] = "VARCHAR(16)";
		$attrs[$table]['addr_id']['type'] = "KEY";

		$attrs[$table]['FOREIGN']['keys'] = array(
			'card_id',
			'addr_id');
		$attrs[$table]['FOREIGN']['ref'] = array(
			CreditCard::getTableName() . "(" . CreditCard::getPrimaryAttr() . ") ON UPDATE RESTRICT ON DELETE RESTRICT",
			Address::getTableName() . "(" . Address::getPrimaryAttr() . ") ON UPDATE RESTRICT ON DELETE RESTRICT");

		return $attrs;
	}

	public static function getTableName() {
		return "Acquired";
	}

	public static function getPrimaryAttr() {
		return "acq_id";
	}
}

?>