<?php

require_once("MySQL.php");

abstract class Entity {
	protected $attrs;

	/**
	 * static protected getPrimaryAttr : Returns string representation of this table's primary attribute.
	 * @return string primary attribute(s) (commma , delimited for multiple attributes)
	 */
	abstract static protected function getPrimaryAttr();

	/**
	 * static protected getTableName : Returns string representation of this table's table name.
	 * @return string SQL table name
	 */
	abstract static protected function getTableName();

	/**
	 * static public getAttributeList : Returns array of strings representing all attributes of this class (including parent classes)
	 * @return array attributes associated with this table 
	 */
	abstract static public function getAttributeList();

	/**
	 * protected function getSQLInfo() :
	 * Returns 3d array [ TABLE NAME ] [ ATTRIBUTE NAME ] [ KEY ] = STRING
	 * Where ATTRIBUTE NAME = {
	 * 		{'FOREIGN'['keys'] = string / array representing the foreign keys, ['ref'] = string / array representing the foreign key REFRENCES},
	 * 		{'UNIQUE'['keys'] = similar to FOREIGN}}
	 * Where KEY = {
	 * 		'val' = (value),
	 * 		'type' = (SQL data type),
	 * 		[ 'restrictions' ] = (eg. NOT NULL),
	 * 		[ 'change' ] = (isset only when there is a discrepancy between local data and SQL data)}
	 * @return 3d array representing the full sql information of this object
	 */
	abstract protected function getSQLInfo();

	/**
	 * static protected getSQLInfo() :
	 * Returns the static portion of the SQL information, that is what can be given without 
	 * @return [type] [description]
	 */
	abstract static protected function getStaticSQLInfo();

	//abstract public function toString();
	//abstract protected function toArray();


	/**
	 * __construct($args) : FULL constructor. No subclass needs to implement another constructor.
	 * @param [ int | array ] $args : integer primary key or single dimensional array of attributes that define 
	 */
	public function __construct($args) {
		$info = $this->getSQLInfo();

		if(is_null($this->attrs))
			$this->attrs = array();

		$queries = array();

		if(is_int($args)) {
			// LOAD FROM KEY
			foreach($info as $t => $tv) {
				$queries[$t] = "SELECT * FROM " . $t . " WHERE " . $t::getPrimaryAttr() . "='" . $args . "';";
			}
		} else {
			// NEW ENTRY
			foreach($info as $t => $tv) {
				$saveAttrs = array();
				$outAttrs = array();
				foreach($tv as $a => $av) {
					if(isset($args[$a])) {
						$saveAttrs[$a] = $args[$a];
					} else {
						if($av['restrictions'] == "NOT NULL")
							throw new Exception("Required attribute " . $a . " not given for new entry of table " . $t);
						$outAttrs[] = $a;
					}
				}
				$queries[$t] = "INSERT INTO " . $t . "(" . implode(", ", array_keys($saveAttrs)) . ") OUTPUT INSERTED.* VALUES ('" . implode("', '", $saveAttrs) . "');";
			}
		}

		$t = array(static::getTableName());
		while(get_parent_class($t) != "Entity") {
			array_unshift($t, get_parent_class($t));
		}

		$d = new database;
		foreach($t as $table) {
			// QUERY $queries[$t], fill in results.
		}

		// -----CONNECT TO DATABASE, SAVE------, SET ID TO MYSQL CREATED ID
		// ^ saving has to be done in child class? NOPE :D
	}

	public function getID() {
		return $attrs[static::getTableName()][static::getPrimaryAttr()]['val'];
	}

	public function query($id) {
		// CONNECT TO DATABASE, QUERY TABLE ENTITYNAME FOR PRIMARY KEY ID;
	}

	public function save() {
		$query = array();
		if($this->getID() == false) {
			foreach($this->attrs as $table => $t) {
				$validAttrs = array();
				foreach($t as $attr => $a) {
					if($this->attrs[$table][$attr]['val'] != false) {
						$validAttrs[$attr] = $this->attrs[$table][$attr]['val'];
					}
				}
				$query[] = "INSERT INTO " . $table . "(" . implode(",", array_keys($validAttrs)) . ") OUTPUT INSERTED.* VALUES (" . implode(",", $validAttrs) . ");";
			}
		} else {
			foreach($this->attrs as $table => $t) {
				$validAttrs = array();
				foreach($t as $attr => $a) {
					if($this->attrs[$table][$attr]['val'] != false AND isset($this->attrs[$table][$attr]['change'])) {
						unset($this->attrs[$table][$attr]['change']);
						$validAttrs[] = $attr . "=" . $this->attrs[$table][$attr]['val'];
					}
				}
				$query[] = "UPDATE " . $table . " SET " . implode(",", $validAttrs) . " WHERE " . static::getPrimaryAttr() . "=" . $this->getID() . ";";
			}
		}

		$db = new database();
		$db->open();
		foreach($query as $q) {
			$db->query($q);
		}
		$db->close();
	}

	public static function create_table() {
		$queries = array();
		$strQueries = array();
		foreach(static::getStaticSQLInfo() as $table => $tv) {
			$queries[$table] = array();
			$queries[$table]["common"] = array();
			$queries[$table]["unique"] = array();
			$queries[$table]["primary"] = "PRIMARY KEY (" . static::getPrimaryAttr() . ")";
			$queries[$table]["foreign"] = array();
			foreach($tv as $attr => $av) {
				if($attr == "FOREIGN") {
					if(!isset($av["ref"]) || !isset($av["keys"]))
						throw new Exception("No references for foreign key in " . $table);
					if(is_array($av["keys"])) {
						foreach($av['keys'] as $i => $k) {
							$queries[$table]["foreign"][] = "FOREIGN KEY (" . $k . ") REFERENCES " . $av["ref"][$i];
						}
					}
					elseif(is_string($av["keys"]))
						$queries[$table]["foreign"][] = "FOREIGN KEY (" . $av["keys"] . ") REFERENCES " . $av["ref"];
				} elseif($attr == "UNIQUE") {
					if(is_string($av))
						$queries[$table]["unique"][] = "UNIQUE (" . $av . ")";
					elseif(is_array($av)) {
						foreach($av as $a => $v) {
							if(is_string($v))
								$queries[$table]["unique"][] = "UNIQUE (" . $v . ")";
							elseif(is_array($v)) {
								$queries[$table]["unique"][] = "UNIQUE (" . implode(", ", $v) . ")";
							}
						}
					}
				} else {
					if(!isset($av['type'])) {
						throw new Exception("Error in table " . $table . ": No type for attribute: " . $attr);
					} else {
						if($av['type'] == 'KEY')
							$av['type'] = "INT(11) UNSIGNED";
						$queries[$table]["common"][$attr] = $attr . " " . $av["type"];
						if(isset($av["restrictions"]))
							$queries[$table]['common'][$attr] .= " " . $av['restrictions'];
						if(isset($av['foreign']))
							$queries[$table]["foreign"][] = "FOREIGN KEY (" . $attr . ") REFERENCES " . $av["foreign"];
					}
				}
			}


			$DELIM = "\n\t";
			$oneDQueries = array();
			foreach($queries[$table] as $t => $v) {
				if(is_array($v) AND strlen(implode(",".$DELIM, $v)) > 0)
					$oneDQueries[] = implode(",".$DELIM, $v);
				elseif(is_string($v) AND strlen($v) > 0)
					$oneDQueries[] = $v;
			}
			$strQueries[$table] = "CREATE TABLE " . $table . "(" . implode(",".$DELIM, $oneDQueries) . ");";
		}

		return $strQueries;
	}
}

?>