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
		Company</blockquote>
	Address<br />
	Phone<br />
	Creditcard<br />
	UserRating<br />
	Product<br />
	<blockquote>	Purchase<br />
		Auction</blockquote>
	Category<br />
	<blockquote>	PartOf<br />
		ParentCategory</blockquote>
	RatedBy<br />
	Acquired<br />
	<blockquote>	PurchasedBy</blockquote><br />
</blockquote>

Functions:<br />
<blockquote>
	Entity:<br />
	<blockquote>
		__construct($args)<br />
		static protected getPrimaryAttr() : string<br />
		static protected getTableName() : string<br />
		static public getAttributeList() : array ( strings )<br />
		static protected getStaticSQLInfo() : array [ TABLE NAME ] [ ATTRIBUTE NAME ] [ KEY ] = string<br />
		static public create_table() : string<br />
		protected getSQLInfo() : array [ TABLE NAME ] [ ATTRIBUTE NAME ] [ KEY ] = string<br />
		public getID() : integer / array( attributes )<br />
		public save() : boolean<br />
	</blockquote>
</blockquote>
    
