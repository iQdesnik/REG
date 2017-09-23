AUTH & REGISTRATION FORM.

1. Imprort DATA.SQL to your database

2. Config your database in class.db.php like :
   protected $db_name = 'DB NAME';
   protected $db_user = 'DB USER';
   protected $db_pass = 'DB PASSWORD';
   protected $db_host = 'DB HOST';

3. DONE


Application Files:

1. class.db.php : class for working with a database, methods :
   - select : makes a select query to database, return assoc array or num rows of the query;
        input data: 
		$table(name of the table in database)
		$where(condition of the query, input like "WHERE id=1")
		$num(if $num=1 return num rows of the query)
		
	    Example : $arr=$db->select("table","where id=1","0");
		          echo $arr['username'];
				  
- ChoseCountry : takes a country list from database for using in <select> form
	
	- insert : makes an insert query to database, works like a select()
	    $table(name of the table in database)
		$column(columns in the table, input like "column1,column2,column3")
		$values(your values, input like "value1,value2, value3")
		
		Example :$db->insert( "table" , "column1,column2,column3" , "value1,value2,value3");
		
	-filter : filters data with trim() and real_escape_string() before using in SQL
	
2. class.user.php : class for working with a users data, methods :

    - login : takes login(or e-mail) and password and cheking it in database, 
	          if login&password - ok - creates SESSION and returns 0; 
			  if login&password - wrong - returns message of the error;
			  
- RegUser : takes user data from reg.php and cheking it
	          if all is ok makes an insert query to database and using login() for authorize new user and returns 0,
			  if got an error - returns message of the error;
			  
- UsersOnly : by using this method we can make a protected page only for authorized users
	              returns error and stops executing script.
				  
- Logout : destroys SESSION data .
	
3. index.php : Auth form, takes login and password, using Login() 
               if login and password - ok - redirects user to a protected page, 
			   if got an error displays it on the screen
               if takes GET logout - makes user logout 
			   
4. reg.php : Registration form , takes user data from forms, using RegUser()
             if all data is ok - creates a new user and redirects him to a protected page
		if got an error displays it on the screen
		Button "SEND" active only if user put a checkbox "I agree with site rules"
			 
5. protected.php - Page only for authorized users, shows login, email and logout link.
		          
