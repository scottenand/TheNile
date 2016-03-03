# TheNile
The Nile code.

#Instructions for setting up the webserver and the repository using ubuntu (linux)

The website is running under an apache server so to instal apache do:

<code>sudo apt-get update</code>

after that finishes do:

<code>sudo apt-get install apache2</code>


To get started: go to the directory where the apache server files are stored:

<code> cd /var/www/html </code>

You will see an index.html file that is there when apache is installed. You can remove this by running:

<code> rm index.html </code> (once in that directory)

After that, clone the git repo into the root directory of the apache server (in the directory that we described above, var/www/html). To clone, run:

<code> git clone https://github.com/TheNile431w/TheNile.git </code>

To have apache point to a specific folder to look for the main files when displaying in the browser, we will need to add a change to the config file in apache, to do this, run:

<code>sudo vim /etc/apache2/sites-available/000-default.conf </code>

This will open up a Vim editor, locate where it says: DocumentRoot and after html, add /TheNile  So that way it looks in the repo as the main files for the webserver

it should look like this
<code>DocumentRoot /var/www/html/TheNile </code>



Create a new user and password in mysql for the 431w project named team431 by typing the following command on the mysql shell

<code>CREATE USER 'team431'@'localhost' IDENTIFIED BY 'password'; </code><br />

Then Grant access to this user by running:

<code>GRANT ALL ON *.* TO 'team431'@'localhost'; </code><br />

Once you have entered the default MySQL database (ip, username, password, and db), simply run:

<code> php setup/setup.php </code> on your command line.

## Requirements:
PHP >= 5.3.0<br />
To install php run:
<code>sudo apt-get install php5 libapache2-mod-php5 </code>
MySQL InnoDB<br />
mysqli PHP module
To install run the following command:

<code>apt-get install php5-mysqlnd</code>


After everything is installed and changed, restart the apache server to get the latest updates we did, and start browsing!

To restart apache server run:

<code>sudo /etc/init.d/apache2 restart</code>
##NOTE:

You might need to change permissions of the root directory of the apache server (/var/www/html) so that you are allowed to write, or simply run the commands using sudo every time (if the permission is denied).

After all of that is done you can go to firefox (or any other browser) type localhost and you will see a basic form to submit a user, fill in the form and another page will display with an error o successful message. Then go to terminal and open up a mysql client so you can display all rows in user table and see the result. 

(In a few days we will add phpmyadmin functionality to ease this process)

Remember to join the slack team thenile-team.slack.com


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
    
