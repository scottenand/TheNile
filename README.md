# TheNile
The Nile code.

To get started: go to a directory you would like to have the repository (i.e Desktop) and open up a terminal window to type:
	git clone https://github.com/TheNile431w/TheNile.git

To create the tables on a MySQL InnoDB database, first edit "classes/MySQL.php" 's constructor's default values.<br />
Once you have entered the default MySQL database (ip, username, password, and db), simply run "php setup/setup.php" on your command line.

## Requirements:
PHP >= 5.3.0<br />
MySQL InnoDB<br />
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
	<blockquote>	PurchasedBy</blockquote>
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
    
