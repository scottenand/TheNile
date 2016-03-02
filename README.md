# TheNile
The Nile code.

To create the tables on a MySQL InnoDB database, first edit "classes/MySQL.php" 's constructor's default values.
Once you have entered the default MySQL database (ip, username, password, and db), simply run "php setup/setup.php" on your command line.

## Requirements:
PHP >= 5.3.0
MySQL InnoDB
mysqli PHP module

## Classes:
database<br />
Entity<br />
<blockquote>	User<br />
	<blockquote>	Person<br />
		Company</blockquote><br />
	Address<br />
	Phone<br />
	Creditcard<br />
	UserRating<br />
	Product<br />
	<blockquote>	Purchase<br />
		Auction</blockquote><br />
	Category<br />
	<blockquote>	PartOf<br />
		ParentCategory</blockquote><br />
	RatedBy<br />
	Acquired<br />
	<blockquote>	PurchasedBy</blockquote><br />


Functions:
Entity:
	__construct($args)
	static protected getPrimaryAttr() : string
	static protected getTableName() : string
	static public getAttributeList() : array ( strings )
	static protected getStaticSQLInfo() : array [ TABLE NAME ] [ ATTRIBUTE NAME ] [ KEY ] = string
	static public create_table() : string
	protected getSQLInfo() : array [ TABLE NAME ] [ ATTRIBUTE NAME ] [ KEY ] = string
	public getID() : integer / array( attributes )
	public save() : boolean
    
