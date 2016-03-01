<?php

class Creditcard extends Entity {
	public function __construct($args) {
		parent::__construct($args);
	}

	public static function getAttributeList() {
		return array('card_id', 'uid', 'description', 'defaultCard', 'cardNum', 'cardName', 'expDate', 'cardType');
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

		$attrs[$table]['card_id']['type'] = "KEY";
		$attrs[$table]['uid']['type'] = "KEY";
		$attrs[$table]['description']['type'] = "TEXT";
		$attrs[$table]['defaultCard']['type'] = "INT(11)";
		$attrs[$table]['cardNum']['type'] = "TEXT";
		$attrs[$table]['cardName']['type'] = "TEXT";
		$attrs[$table]['expDate']['type'] = "DATE";
		$attrs[$table]['cardType']['type'] = "TEXT";

		$attrs[$table]['card_id']['restrictions'] = "AUTO_INCREMENT";
		$attrs[$table]['uid']['restrictions'] = "NOT NULL";
		$attrs[$table]['defaultCard']['restrictions'] = "NOT NULL";
		$attrs[$table]['cardNum']['restrictions'] = "NOT NULL";
		$attrs[$table]['cardName']['restrictions'] = "NOT NULL";
		$attrs[$table]['expDate']['restrictions'] = "NOT NULL";
		$attrs[$table]['cardType']['restrictions'] = "NOT NULL";

		$attrs[$table]['FOREIGN']['keys'] = 'uid';
		$attrs[$table]['FOREIGN']['ref'] = User::getTableName() . '(' . User::getPrimaryAttr() . ')';

		return $attrs;
	}

	public static function getTableName() {
		return "Creditcard";
	}

	public static function getPrimaryAttr() {
		return "card_id";
	}
}

?>